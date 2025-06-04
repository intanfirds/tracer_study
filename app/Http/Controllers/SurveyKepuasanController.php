<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Instansi;
use App\Models\TokenInstansi;
use App\Models\SurveyKepuasanLulusan;
use Illuminate\Http\Request;
//export survey kepuasan
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Log;

class SurveyKepuasanController extends Controller
{
    public function create()
    {
        // Check if user is verified with token
        if (!Session::get('verified')) {
            return redirect()->route('survey.token')
                ->with('error', 'Silakan verifikasi token terlebih dahulu');
        }

        // Get instansi_id from session
        $instansi_id = Session::get('verified_instansi_id');

        // Get instansi data
        $instansi = Instansi::findOrFail($instansi_id);
        
        // Get first alumni associated with this instansi
        $alumni = Alumni::whereHas('instansi', function($query) use ($instansi_id) {
            $query->where('instansi_id', $instansi_id);
        })->firstOrFail();

        return view('survey.create', compact('instansi', 'alumni'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alumni_id' => 'required|exists:alumnis,alumni_id',
            'instansi_id' => 'required|exists:instansis,instansi_id',
            'tanggal' => 'required|date',
            'kerjasama_tim' => 'required|in:Kurang,Cukup,Baik,Sangat Baik',
            'keahlian_bidang_it' => 'required|in:Kurang,Cukup,Baik,Sangat Baik',
            'kemampuan_berbahasa_asing' => 'required|in:Kurang,Cukup,Baik,Sangat Baik',
            'kemampuan_berkomunikasi' => 'required|in:Kurang,Cukup,Baik,Sangat Baik',
            'pengembangan_diri' => 'required|in:Kurang,Cukup,Baik,Sangat Baik',
            'kepemimpinan' => 'required|in:Kurang,Cukup,Baik,Sangat Baik',
            'etos_kerja' => 'required|in:Kurang,Cukup,Baik,Sangat Baik',
            'saran_untuk_kurikulum_prodi' => 'nullable|string',
            'kemampuan_tdk_terpenuhi' => 'nullable|string',
            'status_pengisian' => 'required|string',
            'nama_instansi' => 'required|string',
            'nama_atasan' => 'required|string',
            'lokasi_instansi' => 'required|string',
            'jabatan' => 'required|string',
        ]);

        try {
            DB::beginTransaction();
            $survey = SurveyKepuasanLulusan::updateOrCreate(
                ['alumni_id' => $request->alumni_id], // find by alumni_id
                [
                    'instansi_id' => $request->instansi_id,
                    'tanggal' => $request->tanggal,
                    'kerjasama_tim' => $request->kerjasama_tim,
                    'keahlian_bidang_it' => $request->keahlian_bidang_it,
                    'kemampuan_berbahasa_asing' => $request->kemampuan_berbahasa_asing,
                    'kemampuan_berkomunikasi' => $request->kemampuan_berkomunikasi,
                    'pengembangan_diri' => $request->pengembangan_diri,
                    'kepemimpinan' => $request->kepemimpinan,
                    'etos_kerja' => $request->etos_kerja,
                    'saran_untuk_kurikulum_prodi' => $request->saran_untuk_kurikulum_prodi,
                    'kemampuan_tdk_terpenuhi' => $request->kemampuan_tdk_terpenuhi,
                    'status_pengisian' => 'Selesai'
                ]
            );
            $instansi = Instansi::updateOrCreate(
                ['instansi_id' => $request->instansi_id],
                [
                    'nama_instansi' => $request->nama_instansi,
                    'nama_atasan' => $request->nama_atasan,
                    'lokasi_instansi' => $request->lokasi_instansi,
                    'jabatan' => $request->jabatan
                ]
            );
            
            // Mark token as used after successful survey submission
            $token = Session::get('survey_token');
                if ($token) {
                    $tokenUpdate = TokenInstansi::where('token', $token)
                        ->where('is_used', false)
                        ->update([
                            'is_used' => true,
                            'updated_at' => now()
                        ]);

                    if (!$tokenUpdate) {
                        throw new \Exception('Gagal memperbarui status token.');
                    }
                }

            DB::commit();

            // Clear all related session data after successful commit
            Session::forget(['survey_token', 'verified_instansi_id', 'verified']);

            return redirect()->route('survey.token')
            ->with('alert', [
                'type' => 'success',
                'message' => 'Terimakasih telah mengirim survey. Survey Anda sangat berarti bagi kemajuan kami.'
            ]);


        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Survey store error: ' . $e->getMessage());
            
            Session::flash('alert', [
                'type' => 'danger',
                'message' => 'Terjadi kesalahan saat menyimpan survey.'
            ]);

            return back()->withInput();
        }
    }

public function export_excel()
{
    $data = SurveyKepuasanLulusan::with(['alumni.prodi', 'instansi']) // tambahkan relasi instansi
        ->orderBy('tanggal', 'desc')
        ->get();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Judul
    $sheet->setCellValue('A1', 'Export Survey Kepuasan Lulusan');
    $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
    $sheet->mergeCells('A1:P1');
    $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('A1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

    // Header
    $headerRow = 3;
    $headers = [
        'Nama', 'Instansi', 'Jabatan', 'Email', 'Nama Alumni', 'Program Studi', 'Tahun Lulus',
        'Kerjasama Tim', 'Keahlian di bidang TI', 'Kemampuan berbahasa asing', 'Kemampuan berkomunikasi',
        'Pengembangan diri', 'Kepemimpinan', 'Etos Kerja',
        'Kompetensi yang dibutuhkan tapi belum dapat dipenuhi', 'Saran untuk kurikulum program studi'
    ];

    $colIndex = 'A';
    foreach ($headers as $header) {
        $sheet->setCellValue($colIndex . $headerRow, $header);
        $colIndex++;
    }

    $sheet->getStyle('A' . $headerRow . ':' . chr(ord('A') + count($headers) - 1) . $headerRow)
        ->getFont()->setBold(true);

    // Data
    $row = $headerRow + 1;
    foreach ($data as $item) {
        $sheet->setCellValue('A' . $row, $item->instansi->nama ?? '-');
        $sheet->setCellValue('B' . $row, $item->instansi->nama ?? '-');
        $sheet->setCellValue('C' . $row, $item->instansi->jabatan ?? '-');
        $sheet->setCellValue('D' . $row, $item->instansi->email ?? '-');
        $sheet->setCellValue('E' . $row, $item->alumni->nama ?? '-');
        $sheet->setCellValue('F' . $row, $item->alumni->prodi->nama_prodi ?? '-');
        $sheet->setCellValue('G' . $row, $item->alumni->tahun_lulus ?? '-');
        $sheet->setCellValue('H' . $row, $item->kerjasama_tim);
        $sheet->setCellValue('I' . $row, $item->keahlian_bidang_it);
        $sheet->setCellValue('J' . $row, $item->kemampuan_berbahasa_asing);
        $sheet->setCellValue('K' . $row, $item->kemampuan_berkomunikasi);
        $sheet->setCellValue('L' . $row, $item->pengembangan_diri);
        $sheet->setCellValue('M' . $row, $item->kepemimpinan);
        $sheet->setCellValue('N' . $row, $item->etos_kerja);
        $sheet->setCellValue('O' . $row, $item->kemampuan_tdk_terpenuhi);
        $sheet->setCellValue('P' . $row, $item->saran_untuk_kurikulum_prodi);
        $row++;
    }

    // Auto-size columns
    foreach (range('A', chr(ord('A') + count($headers) - 1)) as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    $sheet->setTitle('Survey Lulusan');

    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $filename = 'Survey_Kepuasan_' . date('Ymd_His') . '.xlsx';

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;
}


public function exportBelumIsiExcel()
{
    // Ambil instansi yang belum mengisi survey, dengan relasi alumni
    $data = Instansi::whereNotIn('instansi_id', function($query) {
        $query->select('instansi_id')->from('survey_kepuasan_lulusans');
    })->with('alumni')->get();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Judul
    $sheet->setCellValue('A1', 'Atasan yang Belum Mengisi Survey Kepuasan');
    $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
    $sheet->mergeCells('A1:H1');
    $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    // Header
    $headerRow = 3;
    $sheet->setCellValue('A'.$headerRow, 'Nama');
    $sheet->setCellValue('B'.$headerRow, 'Instansi');
    $sheet->setCellValue('C'.$headerRow, 'Jabatan');
    $sheet->setCellValue('D'.$headerRow, 'No HP');
    $sheet->setCellValue('E'.$headerRow, 'Email');
    $sheet->setCellValue('F'.$headerRow, 'Nama Alumni');
    $sheet->setCellValue('G'.$headerRow, 'Program Studi');
    $sheet->setCellValue('H'.$headerRow, 'Tahun Lulus');

    $sheet->getStyle('A'.$headerRow.':H'.$headerRow)->getFont()->setBold(true);

    // Data
    $row = $headerRow + 1;
    foreach ($data as $item) {
        $sheet->setCellValue('A'.$row, $item->nama_atasan);
        $sheet->setCellValue('B'.$row, $item->nama_instansi);
        $sheet->setCellValue('C'.$row, $item->jabatan);
        $sheet->setCellValue('D'.$row, $item->no_hp_atasan);
        $sheet->setCellValue('E'.$row, $item->email_atasan);

        $alumni = $item->alumni;
        $sheet->setCellValue('F'.$row, $alumni ? $alumni->nama : '-');
        $sheet->setCellValue('G'.$row, $alumni ? $alumni->prodi->nama_prodi: '-');
        $sheet->setCellValue('H'.$row, $alumni ? $alumni->tahun_lulus : '-');

        $row++;
    }

    // Auto size kolom
    foreach (range('A', 'H') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    $sheet->setTitle('Atasan Belum Isi Survey');

    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $filename = 'Atasan_Belum_Mengisi_Survey_' . date('Ymd_His') . '.xlsx';

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;
}

    public function getInstansi($alumni_id)
    {
        $alumni = Alumni::with('instansi')->where('alumni_id', $alumni_id)->first();

        return response()->json([
            'instansi_id' => $alumni->instansi->instansi_id ?? null,
            'nama_instansi' => $alumni->instansi->nama_instansi ?? '',
            'nama_atasan' => $alumni->instansi->nama_atasan ?? '',
            'lokasi_instansi' => $alumni->instansi->lokasi_instansi ?? '',
        ]);
    }
    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'alumni_id');
    }


    public function token()
    {
        return view('survey.insertToken');
    }

    public function verifyToken(Request $request)
    {
        $request->validate([
            'token' => 'required|string'
        ]);

        $token = $request->token;
        
        // First check if token exists in database
        $tokenInstansi = TokenInstansi::where('token', $token)->first();

        if (!$tokenInstansi) {
            return back()->with('error', 'Token tidak valid. Silakan cek kembali email Anda.');
        }

        // Check if token is used
        if ($tokenInstansi->is_used) {
            return back()->with([
                'error' => 'Token sudah digunakan. Silakan gunakan token yang baru.',
                'token_status' => 'used'
            ]);
        }

        // Check if token is expired
        if ($tokenInstansi->expired_at && $tokenInstansi->expired_at <= now()) {
            return back()->with([
                'error' => 'Token sudah kadaluarsa. Silakan ajukan token baru.',
                'token_status' => 'expired',
                'old_token' => $token,
                'instansi_id' => $tokenInstansi->instansi_id
            ]);
        }

        // If token is valid, not used, and not expired
        Session::put('survey_token', $token);
        Session::put('verified_instansi_id', $tokenInstansi->instansi_id);
        Session::put('verified', true);

        return redirect()->route('survey.create')
            ->with('success', 'Token berhasil diverifikasi');
    }

    public function requestNewToken(Request $request)
    {
        try {
            // Validate request
            $validated = $request->validate([
                'old_token' => 'required|string',
                'instansi_id' => 'required'
            ]);

            Log::info('Request data:', $request->all());

            // Find the old token record
            $tokenRecord = TokenInstansi::where('token', $request->old_token)->first();

            if (!$tokenRecord) {
                Log::warning('Token not found:', ['old_token' => $request->old_token]);
                return back()->with([
                    'error' => 'Token lama tidak ditemukan.',
                    'token_status' => 'error'
                ]);
            }

            Log::info('Token record found:', $tokenRecord->toArray());

            // Get instansi data
            $instansi = Instansi::find($request->instansi_id);
            $alumni = $instansi ->alumni()->first();
            $detailProfesi = $alumni->detailProfesi()->first();
            

            if (!$instansi) {
                Log::warning('Instansi not found:', ['instansi_id' => $request->instansi_id]);
                return back()->with([
                    'error' => 'Data instansi tidak ditemukan.',
                    'token_status' => 'error'
                ]);
            }

            Log::info('Instansi found:', $instansi->toArray());

            // Generate new token
            $newToken = '';
            for ($i = 0; $i < 12; $i++) {
                $newToken .= rand(0, 9);
            }

            // Create new token
            $newTokenRecord = TokenInstansi::create([
                'instansi_id' => $instansi->instansi_id,
                'token' => $newToken,
                'expired_at' => now()->addMonth(),
                'is_used' => false
            ]);

            Log::info('New token created:', $newTokenRecord->toArray());

            // Return success response
            return redirect()->route('survey.token')->with([
                'alert' => [
                    'type' => 'success',
                    'message' => 'Token baru berhasil dibuat'
                ],
                'email_data' => [
                    'new_token' => $newToken,
                    'email_atasan' => $instansi->email_atasan,
                    'nama_atasan' => $instansi->nama_atasan,
                    'old_token' => $request->old_token,
                    'nama' => $alumni->nama ?? 'Alumni Tidak Ditemukan',
                    'profesi' => $detailProfesi->profesi ?? 'Profesi Tidak Ditemukan',
                    'should_send_email' => true // Add this flag
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error in requestNewToken:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with([
                'error' => 'Terjadi kesalahan saat memproses token: ' . $e->getMessage(),
                'token_status' => 'error'
            ]);
        }
    }

}

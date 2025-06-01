<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\ProgramStudi;
use App\Models\Instansi;
use App\Models\DetailProfesiAlumni;
use App\Models\JenisInstansi;
use App\Models\KategoriProfesi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\TokenInstansi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class AlumniController extends Controller
{
    // Menampilkan form pengisian data alumni
    public function form(Request $request)
    {
        $token = $request->query('token');

        $tokenData = DB::table('token_alumni')
            ->where('token', $token)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$tokenData) {
            return redirect('request-token-alumni')->with('error', 'Token tidak valid atau sudah kadaluarsa.');
        }

        $alumni = Alumni::where('email', $tokenData->email)->first();

        if (!$alumni) {
            return redirect('request-token-alumni')->with('error', 'Data alumni tidak ditemukan.');
        }

        session(['id' => $alumni->alumni_id]);

        $prodis = ProgramStudi::all();
        $detailProfesiAlumni = DetailProfesiAlumni::all();
        $kategoris = KategoriProfesi::all();
        $jenis_instansis = JenisInstansi::all();

        return view('alumni.form', compact('alumni', 'prodis', 'detailProfesiAlumni', 'kategoris', 'jenis_instansis'));
    }

    // Menyimpan data form
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prodi_id' => 'required|exists:program_studis,prodi_id',
            'tahun_lulus' => 'required|integer|min:2000|max:' . date('Y'),
            'nama' => 'required|string',
            'nim' => 'required|string',
            'no_hp' => 'required|numeric|digits_between:10,15',
            'email' => 'required|email',
            'tanggal_pertama_kerja' => 'required|date|after_or_equal:' . $request->tahun_lulus . '-01-01',
            'tanggal_mulai_kerja' => 'required|date|after_or_equal:' . $request->tanggal_pertama_kerja,
            'jenis_instansi_id' => 'required|exists:jenis_instansis,jenis_instansi_id',
            'lokasi_instansi' => 'required|string',
            'nama_instansi' => 'required|string',
            'skala' => 'required|string',
            'kategori_id' => 'required|exists:kategori_profesis,kategori_id',
            'profesi' => 'required|string',
            'nama_atasan' => 'required|string',
            'jabatan' => 'required|string',
            'no_hp_atasan' => 'required|numeric|digits_between:10,15',
            'email_atasan' => 'required|email',
        ]);

        if ($validator->fails()) {
            // Kalau AJAX, lebih baik return JSON error
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $nimUpper = strtoupper($request->nim);

            // Simpan data alumni
            $alumni = Alumni::updateOrCreate(
                ['NIM' => $nimUpper],
                [
                    'nama' => $request->nama,
                    'prodi_id' => $request->prodi_id,
                    'tahun_lulus' => $request->tahun_lulus,
                    'no_hp' => $request->no_hp,
                    'email' => $request->email,
                    'level_id' => 2,
                    'password' => bcrypt('123456') // default password
                ]
            );

            // Simpan data instansi
            $instansi = Instansi::create([
                'alumni_id' => $alumni->alumni_id,
                'nama_instansi' => $request->nama_instansi,
                'jenis_instansi_id' => $request->jenis_instansi_id,
                'lokasi_instansi' => $request->lokasi_instansi,
                'skala' => $request->skala,
                'nama_atasan' => $request->nama_atasan,
                'jabatan' => $request->jabatan,
                'no_hp_atasan' => $request->no_hp_atasan,
                'email_atasan' => $request->email_atasan,
                'level_id' => 3
            ]);

            // Buat token random 12 digit
            $token = '';
            for ($i = 0; $i < 12; $i++) {
                $token .= rand(0, 9);
            }

            // Simpan token ke tabel token_instansi
            TokenInstansi::create([
                'instansi_id' => $instansi->instansi_id,
                'token'       => $token,
                'expired_at'  => Carbon::now()->addMonth(),
            ]);

            // Hitung masa tunggu
            $tgl_lulus = Carbon::createFromDate($request->tahun_lulus, 1, 1);
            $tgl_pertama_kerja = Carbon::parse($request->tanggal_pertama_kerja);
            $masa_tunggu = $tgl_lulus->diffInMonths($tgl_pertama_kerja);

            // Simpan detail profesi alumni
            DetailProfesiAlumni::create([
                'alumni_id' => $alumni->alumni_id,
                'kategori_id' => $request->kategori_id,
                'profesi' => $request->profesi,
                'masa_tunggu' => $masa_tunggu,
                'status_pengisian' => 'Sudah Diisi',
                'tanggal_pertama_kerja' => $request->tanggal_pertama_kerja,
                'tanggal_mulai_kerja_instansi_saat_ini' => $request->tanggal_mulai_kerja,
                'tanggal_pengisian' => now(),
            ]);

            DB::commit();

            // Kembalikan response JSON untuk dipakai frontend (emailjs)
            return response()->json([
                'success' => true,
                'token' => $token,
                'email_atasan' => $request->email_atasan,
                'nama_atasan' => $request->nama_atasan,
                'nama_alumni' => $request->nama,
                'profesi' => $request->profesi,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function showImportForm()
    {
        return view('admin.import'); // pastikan file view-nya bernama import.blade.php
    }

    public function import(Request $request)
    {
        $rules = [
            'file_alumni' => ['required', 'mimes:xlsx', 'max:1024']
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validasi gagal. Silakan cek kembali file yang Anda upload.');
        }

        try {
            $file = $request->file('file_alumni');

            $reader = IOFactory::createReader('Xlsx');
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray(null, false, true, true);

            $insert = [];
            if (count($data) > 1) {
                foreach ($data as $baris => $value) {
                    if ($baris > 1) {
                        $insert[] = [
                            'level_id' => $value['A'],
                            'NIM' => $value['B'],
                            'password' => $value['C'],
                            'prodi_id' => $value['D'],
                            'nama' => $value['E'],
                            'no_hp' => $value['F'],
                            'email' => $value['G'],
                            'created_at' => now(),
                        ];
                    }
                }

                if (count($insert) > 0) {
                    Alumni::insertOrIgnore($insert);
                    return redirect()->back()->with('success', 'Data berhasil diimpor.');
                } else {
                    return redirect()->back()->with('warning', 'Tidak ada data yang diimpor.');
                }
            } else {
                return redirect()->back()->with('warning', 'File tidak memiliki data.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengimpor: ' . $e->getMessage());
        }
    }

    public function export_excel()
    {
        $barang = Alumni::select('level_id', 'NIM', 'password', 'prodi_id', 'nama', 'no_hp', 'email')
            ->orderBy('nama')
            ->with('level')
            ->with('prodi')
            ->get();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NIM');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Program Studi');
        $sheet->setCellValue('E1', 'No HP');
        $sheet->setCellValue('F1', 'Email');


        $sheet->getStyle('A1:F1')->getFont()->setBold(true);

        $no = 1;
        $baris = 2;
        foreach ($barang as $key => $value) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $value->NIM);
            $sheet->setCellValue('C' . $baris, $value->nama);
            $sheet->setCellValue('D' . $baris, $value->prodi->nama_prodi);
            $sheet->setCellValue('E' . $baris, $value->no_hp);
            $sheet->setCellValue('F' . $baris, $value->email);
            $baris++;
            $no++;
        }

        foreach (range('A', 'F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $sheet->setTitle('Data Alumni');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data User' . date('Y-m-d H:i:s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $writer->save('php://output');
        exit;
    }

    public function export_belum_survey()
    {
        // Ambil data alumni yang ingin diekspor (misalnya kriteria khusus)
        $alumni = Alumni::select('NIM', 'nama', 'prodi_id', 'no_hp', 'email')
            ->orderBy('nama')
            ->with('prodi')
            ->get();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header kolom
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NIM');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Program Studi');
        $sheet->setCellValue('E1', 'No HP');
        $sheet->setCellValue('F1', 'Email');

        $sheet->getStyle('A1:F1')->getFont()->setBold(true);

        // Isi data
        $no = 1;
        $baris = 2;
        foreach ($alumni as $value) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $value->NIM);
            $sheet->setCellValue('C' . $baris, $value->nama);
            $sheet->setCellValue('D' . $baris, $value->prodi->nama_prodi ?? '-');
            $sheet->setCellValue('E' . $baris, $value->no_hp);
            $sheet->setCellValue('F' . $baris, $value->email);
            $baris++;
            $no++;
        }

        foreach (range('A', 'F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $sheet->setTitle('Alumni Belum Survey');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Alumni_Belum_Survey_' . date('Y-m-d_H-i-s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $writer->save('php://output');
        exit;
    }

    public function daftarAlumni()
    {
        $alumnis = Alumni::with(['prodi', 'detailProfesi'])->get();

        return view('admin.daftarAlumni', compact('alumnis'));
    }

    public function verifikasiToken(Request $request)
    {
        $email = $request->email;
        $token = $request->token;

        $alumni = DB::table('token_alumni')
            // ->where('email', $email)
            ->where('token', $token)
            ->where('expires_at', '>', now())
            ->first();

        if ($alumni) {
            // Token valid, bisa redirect ke dashboard alumni
            return redirect()->route('alumni.form');
        } else {
            return back()->with('message', 'Token tidak valid atau sudah kedaluwarsa.');
        }
    }
}

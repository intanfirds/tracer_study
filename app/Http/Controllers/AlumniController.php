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
    public function form(Request $request)
    {
        $token = $request->query('token');

        $tokenData = DB::table('token_alumni')
            ->where('token', $token)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$tokenData) {
            return redirect('cek_token')->with('alert', [
                'type' => 'danger',
                'message' => 'Token tidak valid atau sudah kadaluarsa.'
            ]);
        }

        // Update used_at saat token dipakai
        DB::table('token_alumni')
            ->where('token_alumni_id', $tokenData->token_alumni_id)
            ->update(['used_at' => now()]);

        $alumni = Alumni::where('email', $tokenData->email)->first();

        if (!$alumni) {
            return redirect('cek_token')->with('alert', [
                'type' => 'danger',
                'message' => 'Data alumni tidak ditemukan.'
            ]);
        }

        // Cek apakah sudah pernah mengisi
        $sudahIsi = DetailProfesiAlumni::where('alumni_id', $alumni->alumni_id)
            ->where('status_pengisian', 'Sudah Diisi')
            ->exists();

        if ($sudahIsi) {
            return redirect('cek_token')->with('alert', [
                'type' => 'danger',
                'message' => 'Anda sudah pernah mengisi form.'
            ]);
        }

        session(['id' => $alumni->alumni_id]);

        $prodis = ProgramStudi::all();
        $detailProfesiAlumni = DetailProfesiAlumni::all();
        $kategoris = KategoriProfesi::all();
        $jenis_instansis = JenisInstansi::all();

        return view('alumni.form', compact('alumni', 'prodis', 'detailProfesiAlumni', 'kategoris', 'jenis_instansis'));
    }

    public function store(Request $request)
    {
        $kategoriBelumBekerja = 3;

        // Validasi dasar dulu
        $validator = Validator::make($request->all(), [
            'prodi_id' => 'required|exists:program_studis,prodi_id',
            'tahun_lulus' => 'required|integer|min:2000|max:' . date('Y'),
            'nama' => 'required|string',
            'nim' => 'required|string',
            'no_hp' => 'required|numeric|digits_between:10,15',
            'email' => 'required|email',
            'kategori_id' => 'required|exists:kategori_profesis,kategori_id',
        ]);

        // Validasi tambahan hanya jika bukan "Belum Bekerja"
        if ($request->kategori_id != $kategoriBelumBekerja) {
            $validator->after(function ($validator) use ($request) {
                $rulesTambahan = [
                    'tanggal_pertama_kerja' => 'required|date|after_or_equal:' . $request->tahun_lulus . '-01-01',
                    'tanggal_mulai_kerja' => 'required|date|after_or_equal:' . $request->tanggal_pertama_kerja,
                    'jenis_instansi_id' => 'required|exists:jenis_instansis,jenis_instansi_id',
                    'lokasi_instansi' => 'required|string',
                    'nama_instansi' => 'required|string',
                    'skala' => 'required|string',
                    'profesi' => 'required|string',
                    'nama_atasan' => 'required|string',
                    'jabatan' => 'required|string',
                    'no_hp_atasan' => 'required|numeric|digits_between:10,15',
                    'email_atasan' => 'required|email',
                ];

                $subValidator = Validator::make($request->all(), $rulesTambahan);
                if ($subValidator->fails()) {
                    foreach ($subValidator->errors()->all() as $message) {
                        $validator->errors()->add('form', $message);
                    }
                }
            });
        }

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
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
                    'password' => bcrypt('123456')
                ]
            );

            if ($request->kategori_id != $kategoriBelumBekerja) {
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
                    'token' => $token,
                    'expired_at' => Carbon::now()->addMonth(),
                ]);

                // Hitung masa tunggu
                $tgl_lulus = Carbon::createFromDate($request->tahun_lulus, 1, 1);
                $tgl_pertama_kerja = Carbon::parse($request->tanggal_pertama_kerja);
                $masa_tunggu = $tgl_lulus->diffInMonths($tgl_pertama_kerja);

                // Simpan detail profesi alumni dengan data lengkap
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
            } else {
                // Jika belum bekerja, simpan detail profesi dengan nilai null pada profesi dan tanggal kerja
                DetailProfesiAlumni::create([
                    'alumni_id' => $alumni->alumni_id,
                    'kategori_id' => $request->kategori_id,
                    'profesi' => null,
                    'masa_tunggu' => null,
                    'status_pengisian' => 'Sudah Diisi',
                    'tanggal_pertama_kerja' => null,
                    'tanggal_mulai_kerja_instansi_saat_ini' => null,
                    'tanggal_pengisian' => now(),
                ]);
                // Token dan instansi tidak dibuat
                $token = null;
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'token' => $token,
                'email_atasan' => $request->email_atasan ?? null,
                'nama_atasan' => $request->nama_atasan ?? null,
                'nama_alumni' => $request->nama,
                'profesi' => $request->profesi ?? null,
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
    $alumnis = Alumni::with([
        'prodi',
        'latestDetailProfesi.kategoriProfesi',
        'instansis.jenisInstansi'
    ])->orderBy('nama')->get();

    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $headers = [
        'A1' => 'Program Studi',
        'B1' => 'NIM',
        'C1' => 'Nama',
        'D1' => 'No.HP',
        'E1' => 'Email',
        'F1' => 'Tanggal Lulus',
        'G1' => 'Tahun Lulus',
        'H1' => 'Tanggal Pertama Kerja',
        'I1' => 'Masa Tunggu',
        'J1' => 'Tgl Mulai Kerja Instansi Saat Ini',
        'K1' => 'Jenis Instansi',
        'L1' => 'Nama Instansi',
        'M1' => 'Skala',
        'N1' => 'Lokasi Instansi',
        'O1' => 'Kategori Profesi',
        'P1' => 'Profesi',
        'Q1' => 'Pendapatan',
        'R1' => 'Alamat Kantor',
        'S1' => 'Kabupaten',
        'T1' => 'Nama Atasan Langsung',
        'U1' => 'Jabatan Atasan Langsung',
        'V1' => 'No HP Atasan Langsung',
        'W1' => 'Email Atasan Langsung'
    ];

    foreach ($headers as $cell => $text) {
        $sheet->setCellValue($cell, $text);
    }

    $sheet->getStyle('A1:W1')->getFont()->setBold(true);

    $row = 2;
    foreach ($alumnis as $alumni) {
        $detailProfesi = $alumni->latestDetailProfesi;

        // Ambil instansi terbaru, misal yang paling akhir (kamu bisa sesuaikan logicnya)
        $instansi = $alumni->instansis->sortByDesc('instansi_id')->first();

        $jenisInstansi = $instansi && $instansi->jenisInstansi ? $instansi->jenisInstansi->nama_jenis_instansi : '-';
        $kategoriProfesi = $detailProfesi && $detailProfesi->kategoriProfesi ? $detailProfesi->kategoriProfesi->nama : '-';

        $sheet->setCellValue('A' . $row, $alumni->prodi ? $alumni->prodi->nama_prodi : '-');
        $sheet->setCellValue('B' . $row, $alumni->NIM);
        $sheet->setCellValue('C' . $row, $alumni->nama);
        $sheet->setCellValue('D' . $row, $alumni->no_hp);
        $sheet->setCellValue('E' . $row, $alumni->email);
        $sheet->setCellValue('F' . $row, $alumni->tahun_lulus ? $alumni->tahun_lulus : '-');
        $sheet->setCellValue('G' . $row, $alumni->tahun_lulus);

        $sheet->setCellValue('H' . $row, $detailProfesi ? $detailProfesi->tanggal_pertama_kerja : '-');
        $sheet->setCellValue('I' . $row, $detailProfesi ? $detailProfesi->masa_tunggu : '-');
        $sheet->setCellValue('J' . $row, $detailProfesi ? $detailProfesi->tanggal_mulai_kerja_instansi_saat_ini : '-');

        $sheet->setCellValue('K' . $row, $jenisInstansi);
        $sheet->setCellValue('L' . $row, $instansi ? $instansi->nama_instansi : '-');
        $sheet->setCellValue('M' . $row, $instansi ? $instansi->skala : '-');
        $sheet->setCellValue('N' . $row, $instansi ? $instansi->lokasi_instansi : '-');

        $sheet->setCellValue('O' . $row, $kategoriProfesi);
        $sheet->setCellValue('P' . $row, $detailProfesi ? $detailProfesi->profesi : '-');

        $sheet->setCellValue('Q' . $row, '-'); // Pendapatan belum ada
        $sheet->setCellValue('R' . $row, '-'); // Alamat Kantor belum ada
        $sheet->setCellValue('S' . $row, '-'); // Kabupaten belum ada

        $sheet->setCellValue('T' . $row, $instansi ? $instansi->nama_atasan : '-');
        $sheet->setCellValue('U' . $row, $instansi ? $instansi->jabatan : '-');
        $sheet->setCellValue('V' . $row, $instansi ? $instansi->no_hp_atasan : '-');
        $sheet->setCellValue('W' . $row, $instansi ? $instansi->email_atasan : '-');

        $row++;
    }

    foreach (range('A', 'W') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    $sheet->setTitle('Data Alumni Lengkap');

    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
    $filename = 'Data_Alumni_' . date('Y-m-d_H-i-s') . '.xlsx';

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
    header('Cache-Control: cache, must-revalidate');
    header('Pragma: public');

    $writer->save('php://output');
    exit;
}

public function export_belum_survey()
{
    $alumni = Alumni::whereDoesntHave('detailProfesi', function ($query) {
    $query->where('status_pengisian', 'Sudah Diisi');
})
    ->with('prodi')
    ->orderBy('nama')
    ->get();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Header
    $sheet->setCellValue('A1', 'Program Studi');
    $sheet->setCellValue('B1', 'NIM');
    $sheet->setCellValue('C1', 'Nama');
    $sheet->setCellValue('D1', 'Tanggal Lulus');
    $sheet->getStyle('A1:D1')->getFont()->setBold(true);

    // Data
    $baris = 2;
    foreach ($alumni as $value) {
        $sheet->setCellValue('A' . $baris, $value->prodi->nama_prodi ?? '-');
        $sheet->setCellValue('B' . $baris, $value->NIM);
        $sheet->setCellValue('C' . $baris, $value->nama);

        $tanggalLulus = $value->tahun_lulus ? '31/07/' . $value->tahun_lulus : '-';
        $sheet->setCellValue('D' . $baris, $tanggalLulus);

        $baris++;
    }

    // Auto width
    foreach (range('A', 'D') as $columnID) {
        $sheet->getColumnDimension($columnID)->setAutoSize(true);
    }

    $sheet->setTitle('Alumni Belum Survey');

    // Export
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $filename = 'Alumni_Belum_Survey_' . date('Y-m-d_H-i-s') . '.xlsx';

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;
}

    public function daftarAlumni()
    {
        $alumnis = Alumni::with(['prodi', 'detailProfesi'])->get();

        return view('admin.daftarAlumni', compact('alumnis'));
    }
}

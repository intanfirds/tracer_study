<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Instansi;
use App\Models\SurveyKepuasanLulusan;
use Illuminate\Http\Request;
//export survey kepuasan
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB; 

class SurveyKepuasanController extends Controller
{
    public function create()
    {
        $alumnis = Alumni::all();
        $instansis = Instansi::all();
        return view('survey.create', compact('alumnis', 'instansis')); // Pastikan file blade-nya ada di resources/views/instansi/create.blade.php
    }

    public function store(Request $request)
    {
        $request->validate([
            'alumni_id' => 'required|exists:alumnis,alumni_id',
            'instansi_id' => 'required|exists:instansis,instansi_id',
            'tanggal' => 'required|date',
            'kerja_sama_tim' => 'required|in:1,2,3,4,5',
            'kemampuan_berbahasa_asing' => 'required|in:1,2,3,4,5',
            'kemampuan_berkomunikasi' => 'required|in:1,2,3,4,5',
            'etos_kerja' => 'required|in:1,2,3,4,5',
            'saran_untuk_kurikulum_prodi' => 'nullable|string',
            'kemampuan_tdk_terpenuhi' => 'nullable|string',
            'status_pengisian' => 'required|string',
        ]);

        // SurveyKepuasanLulusan::create([
        //     'alumni_id' => $request->alumni_id,
        //     'instansi_id' => $request->instansi_id,
        //     'tanggal' => $request->date,
        //     'kerja_sama_tim' => $request->kerja_sama_tim,
        //     'kemampuan_berbahasa_asing' => $request->kemampuan_berbahasa_asing,
        //     'kemampuan_berkomunikasi' => $request->kemampuan_berkomunikasi,
        //     'etos_kerja' => $request->etos_kerja,
        //     'saran_untuk_kurikulum_prodi' => $request->saran_untuk_kurikulum_prodi,
        //     'kemampuan_tdk_terpenuhi' => $request->kemampuan_tdk_terpenuhi,
        //     'status_pengisian' => $request->status_pengisian,
        // ]);

        SurveyKepuasanLulusan::create($request->all());

        return redirect()->back()->with('success', 'Survey berhasil disimpan.');
    }
    public function export_survey()
    {
    /**********************
     * 1. Ambil data riil *
     **********************/
    // Contoh kalau sudah punya tabel 'kepuasan_surveys'
    // $surveys = DB::table('kepuasan_surveys')->get();
    // if ($surveys->isEmpty()) {
    //     return redirect()->back()->with('error', 'Data belum tersedia');
    // }

    /********************************************************
     *  Jika memang belum ada data sama sekali -> tolak     *
     ********************************************************/
    // Untuk demo, anggap $totalResponden = 0
    $totalResponden = 0;
    if ($totalResponden === 0) {
        return redirect()->back()->with('error', 'Data belum tersedia');
    }

    /**********************************************
     * 2. Bangun array $data (di sini masih dummy) *
     **********************************************/
    $kemampuan = [
        "Kerjasama Tim",
        "Keahlian di Bidang TI",
        "Kemampuan Bahasa Asing",
        "Kemampuan Berkomunikasi",
        "Pengembangan Diri",
        "Kepemimpinan",
        "Etos Kerja"
    ];

    $data = [];
    foreach ($kemampuan as $i => $item) {
        // ganti 0% dengan perhitungan dari $surveys kalau sudah punya
        $data[] = [
            'no'            => $i + 1,
            'jenis'         => $item,
            'sangat_baik'   => '0%',
            'baik'          => '0%',
            'cukup'         => '0%',
            'kurang'        => '0%',
        ];
    }

    /*****************************
     * 3. Generate file Spreadsheet *
     *****************************/
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Survey Kepuasan');

    // Header
    $headers = ['No', 'Jenis Kemampuan', 'Sangat Baik', 'Baik', 'Cukup', 'Kurang'];
    $col = 'A';
    foreach ($headers as $h) {
        $sheet->setCellValue($col.'1', $h);
        $sheet->getStyle($col.'1')->getFont()->setBold(true);
        $col++;
    }

    // Isi
    $row = 2;
    foreach ($data as $d) {
        $sheet->fromArray([$d['no'], $d['jenis'], $d['sangat_baik'], $d['baik'], $d['cukup'], $d['kurang']], null, "A{$row}");
        $row++;
    }

    // Rata-rata (masih dummy)
    $sheet->setCellValue("B{$row}", 'Rata-rata');
    $sheet->setCellValue("C{$row}", '0%');
    $sheet->setCellValue("D{$row}", '0%');
    $sheet->setCellValue("E{$row}", '0%');
    $sheet->setCellValue("F{$row}", '0%');

    // Auto-size kolom
    foreach (range('A', 'F') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    /******************
     * 4. Proses download *
     ******************/
    $filename = 'Survey_Kepuasan_'.date('Y-m-d_H-i-s').'.xlsx';
    $writer   = IOFactory::createWriter($spreadsheet, 'Xlsx');

    // Output ke browser
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=\"{$filename}\"");
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;
    }
}

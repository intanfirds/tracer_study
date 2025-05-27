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
use Illuminate\Support\Facades\Log;

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
        ]);

        try {
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

            $message = $survey->wasRecentlyCreated 
                ? 'Survey berhasil disimpan.' 
                : 'Survey berhasil diperbarui.';

            return redirect()->back()->with('success', $message);

        } catch (\Exception $e) {
            Log::error('Survey store error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan survey.')
                ->withInput();
        }
    }


 public function export_excel()
{
    $data = SurveyKepuasanLulusan::with(['alumni.prodi']) // pastikan relasi alumni dan prodi benar
        ->orderBy('tanggal', 'desc')
        ->get();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Header
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'NIM');
    $sheet->setCellValue('C1', 'Nama');
    $sheet->setCellValue('D1', 'Program Studi');
    $sheet->setCellValue('E1', 'Tanggal');
    $sheet->setCellValue('F1', 'Kerjasama Tim');
    $sheet->setCellValue('G1', 'Keahlian IT');
    $sheet->setCellValue('H1', 'Bahasa Asing');
    $sheet->setCellValue('I1', 'Komunikasi');
    $sheet->setCellValue('J1', 'Pengembangan Diri');
    $sheet->setCellValue('K1', 'Kepemimpinan');
    $sheet->setCellValue('L1', 'Etos Kerja');
    $sheet->setCellValue('M1', 'Saran Kurikulum');
    $sheet->setCellValue('N1', 'Kemampuan Tidak Terpenuhi');
    $sheet->setCellValue('O1', 'Status');

    $sheet->getStyle('A1:O1')->getFont()->setBold(true);

    $baris = 2;
    $no = 1;
    foreach ($data as $item) {
        $sheet->setCellValue('A' . $baris, $no++);
        $sheet->setCellValue('B' . $baris, $item->alumni->NIM ?? '');
        $sheet->setCellValue('C' . $baris, $item->alumni->nama ?? '');
        $sheet->setCellValue('D' . $baris, $item->alumni->prodi->nama_prodi ?? '');
        $sheet->setCellValue('E' . $baris, $item->tanggal);
        $sheet->setCellValue('F' . $baris, $item->kerjasama_tim);
        $sheet->setCellValue('G' . $baris, $item->keahlian_bidang_it);
        $sheet->setCellValue('H' . $baris, $item->kemampuan_berbahasa_asing);
        $sheet->setCellValue('I' . $baris, $item->kemampuan_berkomunikasi);
        $sheet->setCellValue('J' . $baris, $item->pengembangan_diri);
        $sheet->setCellValue('K' . $baris, $item->kepemimpinan);
        $sheet->setCellValue('L' . $baris, $item->etos_kerja);
        $sheet->setCellValue('M' . $baris, $item->saran_untuk_kurikulum_prodi);
        $sheet->setCellValue('N' . $baris, $item->kemampuan_tdk_terpenuhi);
        $sheet->setCellValue('O' . $baris, $item->status_pengisian);
        $baris++;
    }

    foreach (range('A', 'O') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    $sheet->setTitle('Survey Kepuasan Lulusan');

    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $filename = 'Survey_Kepuasan_' . date('Ymd_His') . '.xlsx';

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


}

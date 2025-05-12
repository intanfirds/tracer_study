<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;

class AlumniController extends Controller
{
    public function index()
    {
        return view('alumni.index');
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


    // public function import()
    // {
    //     return view('admin.import');
    // }
    
    // public function import_ajax(Request $request)
    // {
    //     if($request->ajax() || $request->wantsJson()){
    //         $rules = [
    //             // validasi file harus xls atau xlsx, max 1MB
    //             'file_alumni' => ['required', 'mimes:xlsx', 'max:1024']
    //         ];

    //         $validator = Validator::make($request->all(), $rules);
    //         if($validator->fails()){
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Validasi Gagal',
    //                 'msgField' => $validator->errors()
    //             ]);
    //         }

    //         $file = $request->file('file_alumni');  // ambil file dari request

    //         $reader = IOFactory::createReader('Xlsx');  // load reader file excel
    //         $reader->setReadDataOnly(true);             // hanya membaca data
    //         $spreadsheet = $reader->load($file->getRealPath()); // load file excel
    //         $sheet = $spreadsheet->getActiveSheet();    // ambil sheet yang aktif

    //         $data = $sheet->toArray(null, false, true, true);   // ambil data excel

    //         $insert = [];
    //         if(count($data) > 1){ // jika data lebih dari 1 baris
    //             foreach ($data as $baris => $value) {
    //                 if($baris > 1){ // baris ke 1 adalah header, maka lewati
    //                     $insert[] = [
    //                         'level_id' => $value['A'],
    //                         'NIM' => $value['B'],
    //                         'password' => $value['C'],
    //                         'prodi_id' => $value['D'],
    //                         'nama' => $value['E'],
    //                         'no_hp' => $value['F'],
    //                         'email' => $value['G'],
    //                         'created_at' => now(),
    //                     ];
    //                 }
    //             }

    //             if(count($insert) > 0){
    //                 // insert data ke database, jika data sudah ada, maka diabaikan
    //                 Alumni::insertOrIgnore($insert);   
    //             }

    //             return response()->json([
    //                 'status' => true,
    //                 'message' => 'Data berhasil diimport'
    //             ]);
    //         }else{
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Tidak ada data yang diimport'
    //             ]);
    //         }
    //     }
    //     return redirect('/');
    // }

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
            $sheet->setCellValue('A' .$baris, $no);
            $sheet->setCellValue('B' .$baris, $value->NIM);
            $sheet->setCellValue('C' .$baris, $value->nama);
            $sheet->setCellValue('D' .$baris, $value->prodi->nama_prodi);
            $sheet->setCellValue('E' .$baris, $value->no_hp);
            $sheet->setCellValue('F' .$baris, $value->email);
            $baris++;
            $no++;
        }

        foreach(range('A','F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $sheet->setTitle('Data Alumni');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data User' .date('Y-m-d H:i:s').'.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' .gmdate('D, d M Y H:i:s'). ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $writer->save('php://output');
        exit;
    }

}
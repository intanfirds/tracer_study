<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function laporan()
    {
        return view('admin.laporan');
    }

    public function halamanDaftarAlumni()
    {
        $alumni = Alumni::all();
        $prodi = ProgramStudi::all();

        return view('admin.daftarAlumni', compact('alumni', 'prodi'));
    }

    // public function daftarAlumni(Request $request)
    // {
    //     // Ambil data alumni
    //     $query = Alumni::select('alumni_id', 'NIM', 'nama', 'no_hp', 'email', 'level_id', 'prodi_id');

    //     // Filter berdasarkan prodi_id jika diberikan
    //     if ($request->has('prodi_id')) {
    //         $query->where('prodi_id', $request->level_id);
    //     }

    //     // Ambil semua data
    //     $alumni = $query->get();

    //     // Tambahkan kolom index secara manual jika dibutuhkan
    //     $alumni = $alumni->map(function ($item, $index) {
    //         $item->index = $index + 1;
    //         return $item;
    //     });

    //     return response()->json([
    //         'success' => true,
    //         'data' => $alumni
    //     ]);

    //     // // Jika bukan AJAX, kembalikan ke view
    //     // $page = (object)[
    //     //     'title' => 'Daftar Alumni'
    //     // ];
    //     // $prodi = ProgramStudi::all();

    //     // return view('admin.daftarAlumni', compact('page', 'prodi'));
    // }

    public function daftarAlumni(Request $request)
    {
        $query = Alumni::with(['level', 'prodi']);

        if ($request->filled('prodi_id')) {
            $query->where('prodi_id', $request->prodi_id);
        }

        $alumni = $query->get();
        $prodi = ProgramStudi::all();

        return view('admin.daftarAlumni', [
            'page' => (object)['title' => 'Daftar Alumni'],
            'alumni' => $alumni,
            'prodi' => $prodi
        ]);
    }

}
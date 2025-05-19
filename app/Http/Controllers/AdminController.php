<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\ProgramStudi;
use App\Models\DetailProfesiAlumni;
use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Models\KategoriProfesi;

class AdminController extends Controller
{
    public function index()
    {
        session()->put('breadcrumb', [
            ['label' => 'Dashboard', 'url' => url('/admin/index')],
            ['label' => 'Dashboard', 'url' => null],
        ]);

        $prodi = ProgramStudi::all();
        $alumni = Alumni::all();

        $charts1 = [];
        $charts2 = [];

        // === CHART 1: PROFESI ===
        $profesi = DetailProfesiAlumni::select('profesi', DB::raw('count(*) as total'))
        ->groupBy('profesi')
        ->get();

        $charts1[] = [
        'title' => 'Sebaran Profesi Alumni',
        'labels' => $profesi->pluck('profesi')->toArray(),
        'data' => $profesi->pluck('total')->toArray()
        ];

        $instansi = DB::table('jenis_instansis')
            ->leftJoin('instansis', 'jenis_instansis.jenis_instansi_id', '=', 'instansis.jenis_instansi_id')
            ->select('jenis_instansis.nama_jenis_instansi', DB::raw('COUNT(instansis.instansi_id) as total'))
            ->groupBy('jenis_instansis.nama_jenis_instansi')
            ->get();

        $charts1[] = [
            'title' => 'Sebaran Jenis Instansi',
            'labels' => $instansi->pluck('nama_jenis_instansi')->toArray(),
            'data' => $instansi->pluck('total')->toArray()
        ];

        $tabel1 = DB::table('alumnis')
        ->leftJoin('detail_profesi_alumnis', 'alumnis.alumni_id', '=', 'detail_profesi_alumnis.alumni_id')
        ->leftJoin('instansis', 'alumnis.alumni_id', '=', 'instansis.alumni_id') // hubungan via alumni_id
        ->select(
            'alumnis.tahun_lulus',
            DB::raw('COUNT(DISTINCT alumnis.alumni_id) as jumlah_lulusan'),
            DB::raw('COUNT(DISTINCT CASE WHEN detail_profesi_alumnis.kategori_id IS NOT NULL THEN detail_profesi_alumnis.alumni_id END) as terlacak'),
            DB::raw('SUM(CASE WHEN detail_profesi_alumnis.kategori_id IN (1, 4) THEN 1 ELSE 0 END) as bidang_infokom'),
            DB::raw('SUM(CASE WHEN detail_profesi_alumnis.kategori_id IN (2, 5) THEN 1 ELSE 0 END) as bidang_non_infokom'),
            DB::raw("SUM(CASE WHEN LOWER(instansis.skala) = 'multinasional' OR LOWER(instansis.skala) = 'internasional' THEN 1 ELSE 0 END) as multinasional"),
            DB::raw("SUM(CASE WHEN LOWER(instansis.skala) = 'nasional' THEN 1 ELSE 0 END) as nasional"),
            DB::raw("SUM(CASE WHEN LOWER(instansis.skala) = 'wirausaha' THEN 1 ELSE 0 END) as wirausaha")
        )
        ->groupBy('alumnis.tahun_lulus')
        ->orderBy('alumnis.tahun_lulus', 'asc')
        ->get();

        return view('admin.index', compact('charts1', 'charts2', 'prodi', 'alumni', 'tabel1'));
    }


    public function laporan()
    {
        session()->put('breadcrumb', [
            ['label' => 'Dashboard', 'url' => url('/admin/admin')],
            ['label' => 'Laporan', 'url' => null],
        ]);

        return view('admin.laporan');
    }

    public function halamanDaftarAlumni()
    {
        session()->put('breadcrumb', [
            ['label' => 'Dashboard', 'url' => url('/admin/index')],
            ['label' => 'Daftar Alumni', 'url' => null],
        ]);

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

    public function show($id)
{
    $alumni = Alumni::with(['prodi', 'level', 'detailProfesi'])->findOrFail($id);
    return view('admin.show', compact('alumni'));
}

public function edit($id)
{
    $alumni = Alumni::with('prodi', 'detailProfesi')->findOrFail($id);
    $prodis = ProgramStudi::all();
    $kategoris = KategoriProfesi::all();
    return view('admin.edit', compact('alumni', 'prodis', 'kategoris'));
}
public function destroy($id)
{
    Alumni::destroy($id);

    $alumni = Alumni::with(['level', 'prodi'])->get();
    $prodi = ProgramStudi::all();

    return view('admin.daftarAlumni', [
        'page' => (object)['title' => 'Daftar Alumni'],
        'alumni' => $alumni,
        'prodi' => $prodi,
        'success' => 'Data alumni berhasil dihapus.'
    ]);
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required|string',
        'no_hp' => 'required|string',
        'email' => 'required|email',
        'prodi_id' => 'required|exists:program_studis,prodi_id',
    ]);

    $alumni = Alumni::findOrFail($id);
    $alumni->update([
        'nama' => $request->nama,
        'no_hp' => $request->no_hp,
        'email' => $request->email,
        'prodi_id' => $request->prodi_id,
    ]);

    if ($alumni->detailProfesi) {
        $alumni->detailProfesi->update([
            'profesi' => $request->profesi ?? '',
        ]);
    }

    $allAlumni = Alumni::with(['level', 'prodi'])->get();
    $allProdi = ProgramStudi::all();

    return redirect()->route('admin.daftarAlumni')->with('success', 'Data alumni berhasil diperbarui.');

}


}
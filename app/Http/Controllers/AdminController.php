<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\ProgramStudi;
use App\Models\DetailProfesiAlumni;
use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;
use App\Models\KategoriProfesi;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $prodiId = $request->prodi_id;
        $tahunLulus = $request->tahun_lulus;
        session()->put('breadcrumb', [
            ['label' => 'Dashboard', 'url' => url('/admin/index')],
            ['label' => 'Dashboard', 'url' => null],
        ]);
        try {
            // Basic data fetch
            $prodi = ProgramStudi::all();
            $alumni = Alumni::select('tahun_lulus')
                ->distinct()
                ->orderBy('tahun_lulus')
                ->get();

            // Fetch filtered data
            $tabel1 = $this->fetchTableData($prodiId, $tahunLulus);
            $charts1 = $this->fetchChartData($prodiId, $tahunLulus);
            $surveyData = $this->fetchSurveyData($prodiId, $tahunLulus);
            $surveyCharts = $this->fetchSurveyDataChart($prodiId, $tahunLulus);

            if ($request->ajax()) {
                try {
                    $tableHtml = view('admin.tab_profesi', [
                        'tabel1' => $tabel1,
                        'prodi' => $prodi,
                        'alumni' => $alumni
                    ])->render();

                    return response()->json([
                        'status' => 'success',
                        'tableHtml' => $tableHtml,
                        'charts1' => $charts1,
                        'surveyCharts' => $surveyCharts['charts']
                    ]);
                } catch (\Exception $e) {
                    Log::error('AJAX render error: ' . $e->getMessage());
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Gagal memperbarui tampilan'
                    ], 500);
                }
            }

            // Regular view response
            return view('admin.index', [
                'prodi' => $prodi,
                'alumni' => $alumni,
                'tabel1' => $tabel1,
                'charts1' => $charts1,
                'kepuasan' => $surveyData['detail'] ?? [],
                'total' => $surveyData['total'] ?? [],
                'totalResponden' => $surveyData['totalResponden'] ?? 0,
                'surveyCharts' => $surveyCharts['charts'] ?? [],
                'selectedProdi' => $prodiId,
                'selectedTahun' => $tahunLulus,
            ]);

        } catch (\Exception $e) {
            Log::error('Dashboard Error: ' . $e->getMessage());
            
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan saat memuat data'
                ], 500);
            }
            
            return back()->with('error', 'Terjadi kesalahan saat memuat data');
        }
    }

    // Contoh fungsi fetch data tabel, sesuaikan dengan kebutuhan aslinya
    protected function fetchTableData($prodiId, $tahunLulus)
    {
        $query = DB::table('alumnis')
            ->leftJoin('detail_profesi_alumnis', 'alumnis.alumni_id', '=', 'detail_profesi_alumnis.alumni_id')
            ->leftJoin('instansis', 'alumnis.alumni_id', '=', 'instansis.alumni_id');

        if ($prodiId) {
            $query->where('alumnis.prodi_id', $prodiId);
        }
        if ($tahunLulus) {
            $query->where('alumnis.tahun_lulus', $tahunLulus);
        }

        return $query
            ->select(
                'alumnis.tahun_lulus',
                DB::raw('COUNT(DISTINCT alumnis.alumni_id) as jumlah_lulusan'),
                DB::raw('COUNT(DISTINCT CASE WHEN detail_profesi_alumnis.kategori_id IS NOT NULL THEN detail_profesi_alumnis.alumni_id END) as terlacak'),
                DB::raw('SUM(CASE WHEN detail_profesi_alumnis.kategori_id IN (1, 4) THEN 1 ELSE 0 END) as bidang_infokom'),
                DB::raw('SUM(CASE WHEN detail_profesi_alumnis.kategori_id IN (2, 5) THEN 1 ELSE 0 END) as bidang_non_infokom'),
                DB::raw("SUM(CASE WHEN LOWER(instansis.skala) = 'multinasional' OR LOWER(instansis.skala) = 'internasional' THEN 1 ELSE 0 END) as multinasional"),
                DB::raw("SUM(CASE WHEN LOWER(instansis.skala) = 'nasional' THEN 1 ELSE 0 END) as nasional"),
                DB::raw("SUM(CASE WHEN LOWER(instansis.skala) = 'wirausaha' THEN 1 ELSE 0 END) as wirausaha"),
                DB::raw('ROUND(AVG(detail_profesi_alumnis.masa_tunggu)) as rata_masa_tunggu')
            )
            ->groupBy('alumnis.tahun_lulus')
            ->orderBy('alumnis.tahun_lulus', 'asc')
            ->get();
    }

    protected function fetchChartData($prodiId, $tahunLulus)
    {
        // PROFESI
        $profesiQuery = DB::table('detail_profesi_alumnis')
            ->join('alumnis', 'detail_profesi_alumnis.alumni_id', '=', 'alumnis.alumni_id')
            ->select('detail_profesi_alumnis.profesi', DB::raw('count(*) as total'))
            ->groupBy('detail_profesi_alumnis.profesi');

        if ($prodiId) {
            $profesiQuery->where('alumnis.prodi_id', $prodiId);
        }
        if ($tahunLulus) {
            $profesiQuery->where('alumnis.tahun_lulus', $tahunLulus);
        }

        $profesiData = $profesiQuery->get();

        
        // Format data for first chart
        $charts = [
            [
                'title' => 'Sebaran Jenis Profesi',
                'labels' => $profesiData->pluck('profesi')->toArray(),
                'data' => $profesiData->pluck('total')->toArray()
            ]
        ];

        // INSTANSI
        $instansiQuery = DB::table('instansis')
            ->join('jenis_instansis', 'instansis.jenis_instansi_id', '=', 'jenis_instansis.jenis_instansi_id')
            ->join('alumnis', 'instansis.alumni_id', '=', 'alumnis.alumni_id')
            ->select('jenis_instansis.nama_jenis_instansi', DB::raw('count(instansis.instansi_id) as total'))
            ->groupBy('jenis_instansis.nama_jenis_instansi');

        if ($prodiId) {
            $instansiQuery->where('alumnis.prodi_id', $prodiId);
        }
        if ($tahunLulus) {
            $instansiQuery->where('alumnis.tahun_lulus', $tahunLulus);
        }


        $instansiData = $instansiQuery->get();

        // Add second chart
        $charts[] = [
            'title' => 'Sebaran Jenis Instansi',
            'labels' => $instansiData->pluck('nama_jenis_instansi')->toArray(),
            'data' => $instansiData->pluck('total')->toArray()
        ];

        return $charts;
    }


    // Fungsi ambil data survey kepuasan dengan filter prodi & tahun
    protected function fetchSurveyData($prodiId, $tahunLulus)
    {
        $query = DB::table('survey_kepuasan_lulusans')
            ->join('alumnis', 'survey_kepuasan_lulusans.alumni_id', '=', 'alumnis.alumni_id');

        if ($prodiId) {
            $query->where('alumnis.prodi_id', $prodiId);
        }
        if ($tahunLulus) {
            $query->where('alumnis.tahun_lulus', $tahunLulus);
        }

        $surveys = $query->get();
        $totalResponden = $surveys->count();

        if ($totalResponden === 0) {
            return [
                'detail' => [],
                'total' => [],
                'totalResponden' => 0
            ];
        }

        $kategori = [
            'kerjasama_tim',
            'keahlian_bidang_it',
            'kemampuan_berbahasa_asing',
            'kemampuan_berkomunikasi',
            'pengembangan_diri',
            'kepemimpinan',
            'etos_kerja'
        ];

        $detail = [];

        foreach ($kategori as $k) {
            $count = $surveys->groupBy($k)->map->count();

            $detail[$k] = [
                'Sangat Baik' => round(($count['Sangat Baik'] ?? 0) / $totalResponden * 100, 1),
                'Baik' => round(($count['Baik'] ?? 0) / $totalResponden * 100, 1),
                'Cukup' => round(($count['Cukup'] ?? 0) / $totalResponden * 100, 1),
                'Kurang' => round(($count['Kurang'] ?? 0) / $totalResponden * 100, 1)
            ];
        }

        $total = [
            'Sangat Baik' => round(collect($detail)->pluck('Sangat Baik')->avg(), 1),
            'Baik' => round(collect($detail)->pluck('Baik')->avg(), 1),
            'Cukup' => round(collect($detail)->pluck('Cukup')->avg(), 1),
            'Kurang' => round(collect($detail)->pluck('Kurang')->avg(), 1)
        ];

        return [
            'detail' => $detail,
            'total' => $total,
            'totalResponden' => $totalResponden
        ];
    }

    // Fungsi ambil data survey untuk pie chart kepuasan
    protected function fetchSurveyDataChart($prodiId,   $tahunLulus ) 
    {
        $query = DB::table('survey_kepuasan_lulusans')
            ->join('alumnis', 'survey_kepuasan_lulusans.alumni_id', '=', 'alumnis.alumni_id');

        if ($prodiId) {
            $query->where('alumnis.prodi_id', $prodiId);
        }
        if ($tahunLulus) {
            $query->where('alumnis.tahun_lulus', $tahunLulus);
        }

        $surveys = $query->get();
        $totalResponden = $surveys->count();

        if ($totalResponden === 0) {
            return ['charts' => []];
        }

        $categories = [
            'kerjasama_tim' => 'Kemampuan Kerjasama Tim',
            'keahlian_bidang_it' => 'Keahlian Bidang IT',
            'kemampuan_berbahasa_asing' => 'Kemampuan Berbahasa Asing',
            'kemampuan_berkomunikasi' => 'Kemampuan Berkomunikasi',
            'pengembangan_diri' => 'Pengembangan Diri',
            'kepemimpinan' => 'Kepemimpinan',
            'etos_kerja' => 'Etos Kerja'
        ];

        $charts = [];

        foreach ($categories as $field => $title) {
            $count = $surveys->groupBy($field)->map->count();

            $charts[] = [
                'id' => $field,
                'title' => $title,
                'data' => [
                    round(($count['Sangat Baik'] ?? 0) / $totalResponden * 100, 1),
                    round(($count['Baik'] ?? 0) / $totalResponden * 100, 1),
                    round(($count['Cukup'] ?? 0) / $totalResponden * 100, 1),
                    round(($count['Kurang'] ?? 0) / $totalResponden * 100, 1)
                ]
            ];
        }

        return ['charts' => $charts];
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
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
    public function index()
    {
        session()->put('breadcrumb', [
            ['label' => 'Dashboard', 'url' => url('/admin/index')],
            ['label' => 'Dashboard', 'url' => null],
        ]);
        
        $prodi = ProgramStudi::all();
        $alumni = Alumni::select('tahun_lulus')->distinct()->orderBy('tahun_lulus')->get();
            
        // Fetch initial table data
        $tabel1 = $this->fetchTableData();
            
        // Fetch initial chart data
        $charts1 = $this->fetchChartData();

        // Fetch survey data (for table)
        $surveyData = $this->fetchSurveyData();

        // Fetch survey charts data (for pie charts)
        $surveyCharts = $this->fetchSurveyDataChart();

        return view('admin.index', array_merge(
            compact('prodi', 'alumni', 'tabel1', 'charts1'),
            [
                // Data for survey table
                'kepuasan' => $surveyData['detail'],
                'total' => $surveyData['total'],
                'totalResponden' => $surveyData['totalResponden'],
                
                // Data for survey pie charts
                'surveyCharts' => $surveyCharts['charts'],
            ]
        ));
    }

    public function getTableData(Request $request)
    {
        try {
            // Validasi input filter
            $filterProdi = $request->prodi ? intval($request->prodi) : null;
            $filterTahun = $request->tahun ? intval($request->tahun) : null;

            if ($filterProdi && !ProgramStudi::find($filterProdi)) {
                return response()->json(['error' => 'Program Studi tidak valid'], 400);
            }

            $tabel1 = $this->fetchTableData($filterProdi, $filterTahun);

            return response()->json([
                'status' => 'success',
                'tabel1' => $tabel1,
                'html' => view('partials.profesi_table', [
                    'tabel1' => $tabel1,
                ])->render()
            ]);

        } catch (\Exception $e) {
            Log::error('Table Data Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json(['error' => 'Terjadi kesalahan saat memproses data tabel'], 500);
        }
    }

    public function getChartData(Request $request)
    {
        try {
            // Validasi input filter
            $filterProdi = $request->prodi ? intval($request->prodi) : null;
            $filterTahun = $request->tahun ? intval($request->tahun) : null;

            if ($filterProdi && !ProgramStudi::find($filterProdi)) {
                return response()->json(['error' => 'Program Studi tidak valid'], 400);
            }

            $charts1 = $this->fetchChartData($filterProdi, $filterTahun);

            return response()->json([
                'status' => 'success',
                'charts1' => $charts1,
                'html' => view('partials.profesi_charts', [
                    'charts1' => $charts1,
                ])->render()
            ]);

        } catch (\Exception $e) {
            Log::error('Chart Data Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json(['error' => 'Terjadi kesalahan saat memproses data chart'], 500);
        }
    }

    protected function fetchTableData($prodiId = null, $tahunLulus = null)
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

    protected function fetchChartData($prodiId = null, $tahunLulus = null)
    {
        $charts = [];

        // Chart 1: Profesi
        $profesiQuery = DetailProfesiAlumni::query();
        if ($prodiId) {
            $profesiQuery->whereHas('alumni', function($q) use ($prodiId) {
                $q->where('prodi_id', $prodiId);
            });
        }
        if ($tahunLulus) {
            $profesiQuery->whereHas('alumni', function($q) use ($tahunLulus) {
                $q->where('tahun_lulus', $tahunLulus);
            });
        }

        $profesi = $profesiQuery->select('profesi', DB::raw('count(*) as total'))
                    ->groupBy('profesi')
                    ->get();

        $charts[] = [
            'title' => 'Sebaran Profesi Alumni',
            'labels' => $profesi->pluck('profesi')->toArray(),
            'data' => $profesi->pluck('total')->toArray()
        ];

        // Chart 2: Instansi
        $instansiQuery = DB::table('jenis_instansis')
            ->leftJoin('instansis', 'jenis_instansis.jenis_instansi_id', '=', 'instansis.jenis_instansi_id')
            ->leftJoin('alumnis', 'instansis.alumni_id', '=', 'alumnis.alumni_id');

        if ($prodiId) {
            $instansiQuery->where('alumnis.prodi_id', $prodiId);
        }
        if ($tahunLulus) {
            $instansiQuery->where('alumnis.tahun_lulus', $tahunLulus);
        }

        $instansi = $instansiQuery
            ->select('jenis_instansis.nama_jenis_instansi', DB::raw('COUNT(instansis.instansi_id) as total'))
            ->groupBy('jenis_instansis.nama_jenis_instansi')
            ->get();

        $charts[] = [
            'title' => 'Sebaran Jenis Instansi',
            'labels' => $instansi->pluck('nama_jenis_instansi')->toArray(),
            'data' => $instansi->pluck('total')->toArray()
        ];

        return $charts;
    }

    protected function fetchSurveyData()
    {
        // Get all survey data
        $surveys = DB::table('survey_kepuasan_lulusans')->get();
        $totalResponden = $surveys->count();

        // If no data, return empty arrays
        if ($totalResponden === 0) {
            return [
                'detail' => [],
                'total' => [],
                'totalResponden' => 0
            ];
        }

        // Categories to process
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
        
        // Calculate percentages for each category
        foreach ($kategori as $k) {
            $count = $surveys->groupBy($k)->map->count();
            
            $detail[$k] = [
                'Sangat Baik' => round(($count['Sangat Baik'] ?? 0) / $totalResponden * 100, 1),
                'Baik' => round(($count['Baik'] ?? 0) / $totalResponden * 100, 1),
                'Cukup' => round(($count['Cukup'] ?? 0) / $totalResponden * 100, 1),
                'Kurang' => round(($count['Kurang'] ?? 0) / $totalResponden * 100, 1)
            ];
        }

        // Calculate averages
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

    protected function fetchSurveyDataChart()
    {
        // Get all survey data
        $surveys = DB::table('survey_kepuasan_lulusans')->get();
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
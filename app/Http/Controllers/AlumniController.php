<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\ProgramStudi;
use App\Models\Instansi;
use App\Models\DetailProfesiAlumni;
use App\Models\KategoriProfesi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AlumniController extends Controller
{
    // Menampilkan daftar alumni
    public function index()
    {
        $alumnis = Alumni::whereHas('detailProfesi')
            ->with(['prodi', 'detailProfesi'])
            ->get();

        return view('alumni.index', compact('alumnis'));
    }

    // Menampilkan form pengisian data alumni
    public function form()
    {
        $alumni = \App\Models\Alumni::find(session('id'));
        dd($alumni);

        if (!$alumni) {
            return redirect('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $prodis = ProgramStudi::all();
        $detailProfesiAlumni = DetailProfesiAlumni::all();
        $kategoris = KategoriProfesi::all();

        return view('alumni.form', compact('alumni', 'prodis', 'detailProfesiAlumni', 'kategoris'));
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
            'jenis_instansi' => 'required|string',
            'nama_instansi' => 'required|string',
            'skala' => 'required|string',
            'lokasi_instansi' => 'required|string',
            'kategori_id' => 'required|exists:kategori_profesis,id',
            'profesi_id' => 'required|exists:profesis,id',
            'nama_atasan' => 'required|string',
            'jabatan' => 'required|string',
            'no_hp_atasan' => 'required|numeric|digits_between:10,15',
            'email_atasan' => 'required|email',
        ]);

        if ($validator->fails()) {
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
                'jenis' => $request->jenis_instansi,
                'skala' => $request->skala,
                'lokasi' => $request->lokasi_instansi,
                'nama_atasan' => $request->nama_atasan,
                'jabatan' => $request->jabatan,
                'no_hp_atasan' => $request->no_hp_atasan,
                'email_atasan' => $request->email_atasan,
                'level_id' => 3 // asumsi default level_id instansi
            ]);

            // Hitung masa tunggu
            $tgl_lulus = Carbon::createFromDate($request->tahun_lulus, 1, 1);
            $tgl_pertama_kerja = Carbon::parse($request->tanggal_pertama_kerja);
            $masa_tunggu = $tgl_lulus->diffInMonths($tgl_pertama_kerja);

            // Simpan detail profesi alumni
            DetailProfesiAlumni::create([
                'alumni_id' => $alumni->alumni_id,
                'kategori_id' => $request->kategori_id,
                'profesi_id' => $request->profesi_id,
                'masa_tunggu' => $masa_tunggu,
                'status_pengisian' => 'Sudah Diisi',
                'tanggal_pertama_kerja' => $request->tanggal_pertama_kerja,
                'tanggal_mulai_kerja_instansi_saat_ini' => $request->tanggal_mulai_kerja,
                'tanggal_pengisian' => now(),
            ]);

            DB::commit();
            return redirect()->route('alumni.index')->with('success', 'Data berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
}

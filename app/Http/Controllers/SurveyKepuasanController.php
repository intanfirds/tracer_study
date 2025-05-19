<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Instansi;
use App\Models\SurveyKepuasanLulusan;
use Illuminate\Http\Request;

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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumni;
use App\Models\DetailProfesiAlumni;
use App\Models\SurveyKepuasanLulusan;

class WelcomeController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang',
            'list' => ['Home', 'Welcome']
        ];

        $activeMenu = 'dashboard';

        return view('welcome', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    public function jumlah() {
        $alumni = Alumni::count();
        $detailProfesiAlumni = DetailProfesiAlumni::where('profesi', '!=', '')->count();
        $surveyKepuasanLulusan = SurveyKepuasanLulusan::count();

        return view('welcome', compact('alumni', 'detailProfesiAlumni', 'surveyKepuasanLulusan'));
    }
}
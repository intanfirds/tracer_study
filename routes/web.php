<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SurveyKepuasanController;
use App\Http\Controllers\TokenAlumniController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/request-token-alumni', [TokenAlumniController::class, 'showForm'])->name('request-token-alumni');
Route::post('/request-token-alumni', [TokenAlumniController::class, 'requestToken']);

Route::get('alumni/cek-token-alumni', function () {
    return view('alumni.cek_token_alumni');
});

Route::get('/login', [AuthController::class, 'loginPage'])->name('login.page');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware(['ceklevel:Admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout'); //proses logout
    Route::get('/admin/daftarAlumni', [AdminController::class, 'halamanDaftarAlumni']);
    Route::post('/admin/daftarAlumni/list', [AdminController::class, 'daftarAlumni']); //menampilkan daftar alumni
    Route::get('/admin/laporan', [AdminController::class, 'laporan'])->name('admin.laporan'); //menampilkan laporan
    Route::get('/admin/export_excel', [AlumniController::class, 'export_excel']);
    Route::get('/admin/import', [AlumniController::class, 'showImportForm'])->name('admin.import.form');
    Route::post('/admin/import', [AlumniController::class, 'import'])->name('admin.import');
    Route::get('/admin/laporan', [AdminController::class, 'laporan']);
    Route::get('/admin/filterAlumni', [AdminController::class, 'filterAlumni']);

    Route::get('/admin/detail/{id}', [AdminController::class, 'show'])->name('admin.detail');
    Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
    Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::get('/admin/daftarAlumni', [AdminController::class, 'halamanDaftarAlumni'])->name('admin.daftarAlumni');
    Route::get('/admin/get-data', [AdminController::class, 'getData'])->name('admin.getData');
});

Route::get('/survey', [SurveyKepuasanController::class, 'token'])->name('survey.token');
Route::post('/survey/verify-token', [SurveyKepuasanController::class, 'verifyToken'])->name('verify.token');
Route::get('/survey/index', [SurveyKepuasanController::class, 'create'])->name('survey.create');
Route::post('/survey/index', [SurveyKepuasanController::class, 'store'])->name('survey.store');
Route::get('/admin/export_survey', [SurveyKepuasanController::class, 'export_excel']);
Route::get('/get-instansi/{alumni_id}', [SurveyKepuasanController::class, 'getInstansi']);
Route::get('/admin/export_belum_survey', [AlumniController::class, 'export_belum_survey']);
Route::get('/survey/export-belum-isi', [SurveyKepuasanController::class, 'exportBelumIsiExcel'])->name('survey.export.belum_isi');

Route::get('/alumni/form', [AlumniController::class, 'form'])->name('alumni.form');
Route::post('/alumni/form', [AlumniController::class, 'store'])->name('alumni.store');
<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SurveyKepuasanController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'loginPage'])->name('login.page');
Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::middleware(['ceklevel:Admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout'); //proses logout
    Route::get('/admin/daftarAlumni', [AdminController::class, 'halamanDaftarAlumni']);
    Route::post('/admin/daftarAlumni/list', [AdminController::class, 'daftarAlumni']); //menampilkan daftar alumni
    Route::get('/admin/laporan', [AdminController::class, 'laporan'])->name('admin.laporan'); //menampilkan laporan
    Route::get('/admin/export_excel', [AlumniController::class, 'export_excel']);
    Route::get('/admin/import', [AlumniController::class, 'showImportForm'])->name('admin.import.form');
    Route::post('/admin/import', [AlumniController::class, 'import'])->name('admin.import');
    Route::get('/admin/laporan', [AdminController::class, 'laporan']);

    Route::get('/admin/detail/{id}', [AdminController::class, 'show'])->name('admin.detail');
    Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
    Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::get('/admin/daftarAlumni', [AdminController::class, 'halamanDaftarAlumni'])->name('admin.daftarAlumni');
    Route::get('/admin/get-data', [AdminController::class, 'getData'])->name('admin.getData');
});

Route::get('/survey', [SurveyKepuasanController::class, 'create'])->name('survey.create');
Route::post('/survey', [SurveyKepuasanController::class, 'store'])->name('survey.store');

Route::middleware(['ceklevel:Alumni'])->group(function () {
    Route::get('/alumni', [AlumniController::class, 'index'])->name('alumni.index');
    Route::get('/alumni/logout', [AuthController::class, 'logout'])->name('alumni.logout'); //proses logout
    Route::get('/alumni/form', [AlumniController::class, 'form'])->name('alumni.form');
    Route::post('/alumni/form', [AlumniController::class, 'store'])->name('alumni.store');
    Route::get('/alumni/profile', [AlumniController::class, 'profile'])->name('alumni.profile');
});

Route::resource('alumni', \App\Http\Controllers\AlumniController::class);


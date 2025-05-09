<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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
Route::get('/loginPage', [AuthController::class, 'loginPage'])->name('loginPage'); //button masuk ke halaman login
Route::post('/login', [AuthController::class, 'login'])->name('login'); //proses login

Route::middleware(['ceklevel:Admin'])->group(function () {
    Route::get('/admin/index', [AdminController::class, 'index']);
    Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout'); //proses logout
    Route::get('/admin/daftarAlumni', [AdminController::class, 'daftarAlumni'])->name('admin.daftarAlumni'); //menampilkan daftar alumni
    Route::get('/admin/laporan', [AdminController::class, 'laporan'])->name('admin.laporan'); //menampilkan laporan
});

Route::middleware(['ceklevel:Alumni'])->group(function () {
    Route::get('/alumni/index', [AlumniController::class, 'index']);
    Route::get('/alumni/logout', [AuthController::class, 'logout'])->name('alumni.logout'); //proses logout
    Route::get('/alumni/form', [AlumniController::class, 'form'])->name('alumni.form'); //menampilkan form
    Route::get('/alumni/profile', [AlumniController::class, 'profile'])->name('alumni.profile'); //menampilkan profile
});




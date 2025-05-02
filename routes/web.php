<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;

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

Route::get('/', [WelcomeController::class, 'index'])->name('home');
Route::get('/profile', [WelcomeController::class, 'profile'])->name('profile');
Route::get('/page', [WelcomeController::class, 'page'])->name('page');
Route::get('/virtual-reality', [WelcomeController::class, 'virtualReality'])->name('virtual-reality');
Route::get('/rtl', [WelcomeController::class, 'rtl'])->name('rtl');
Route::get('/profile-static', [WelcomeController::class, 'profileStatic'])->name('profile-static');
Route::get('/sign-in-static', [WelcomeController::class, 'signInStatic'])->name('sign-in-static');
Route::get('/sign-up-static', [WelcomeController::class, 'signUpStatic'])->name('sign-up-static');

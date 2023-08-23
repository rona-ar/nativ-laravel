<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\MasterData\DosenController;
use App\Http\Controllers\MasterData\MahasiswaController;

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

Route::singularResourceParameters(false);
Route::redirect('/', 'admin/dashboard');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginProcess']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('admin')
    ->group(function () {
        Route::get('dashboard', DashboardController::class);
        Route::resource('tugas', TugasController::class);
        Route::resource('pertanyaan', QuoteController::class);
        Route::prefix('master-data')
            ->group(function () {
                Route::resource('pengguna', MahasiswaController::class);
                Route::resource('dosen', DosenController::class);
            });
    });

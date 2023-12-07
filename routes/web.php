<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/redirect', function () {
    if (Auth::user()->level == 'admin') {
        return redirect('/admin/dashboard');
    } else {
        return redirect('/oprator/dashboard');
    }
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', Admin\DahsboardController::class);

    Route::get('/layanan/{id}', [Admin\LayananController::class, 'index']);
    Route::post('/layanan/store', [Admin\LayananController::class, 'store']);
    Route::get('/layanan/show/{id}', [Admin\LayananController::class, 'show']);

    Route::get('/oprator', [Admin\OpratorController::class, 'index']);
    Route::post('/oprator/store', [Admin\OpratorController::class, 'store']);
    Route::get('/oprator/show/{id}', [Admin\OpratorController::class, 'show']);

    Route::get('/laporan', [Admin\LaporanController::class, 'index']);
});

Route::middleware('auth')->prefix('oprator')->group(function () {
    Route::get('/dashboard', Oprator\DashboardController::class);

    Route::get('/laporan', [Oprator\LaporanController::class, 'index']);
    Route::post('/laporan/store', [Oprator\LaporanController::class, 'store']);
});

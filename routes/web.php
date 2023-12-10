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

    Route::get('/opd/{id}', Admin\OpdController::class);

    Route::get('/layanan/{id}', [Admin\LayananController::class, 'index']);
    Route::post('/layanan/store', [Admin\LayananController::class, 'store']);
    Route::get('/layanan/show/{id}', [Admin\LayananController::class, 'show']);
    Route::get('/layanan/delete/{id}', [Admin\LayananController::class, 'destroy']);

    Route::get('/oprator', [Admin\OpratorController::class, 'index']);
    Route::post('/oprator/store', [Admin\OpratorController::class, 'store']);
    Route::get('/oprator/show/{id}', [Admin\OpratorController::class, 'show']);
    Route::put('/oprator/update/{id}', [Admin\OpratorController::class, 'update']);
    Route::delete('/oprator/account/{id}', [Admin\OpratorController::class, 'delete']);

    Route::get('/laporan', [Admin\LaporanController::class, 'index']);

    Route::get('/profile', [Admin\ProfileController::class, 'index']);
    Route::put('/profile/update', [Admin\ProfileController::class, 'update']);
    Route::put('/profile/update/password', [Admin\ProfileController::class, 'password']);
});

Route::middleware('auth')->prefix('oprator')->group(function () {
    Route::get('/dashboard', Oprator\DashboardController::class);

    Route::get('/laporan', [Oprator\LaporanController::class, 'index']);
    Route::post('/laporan/store', [Oprator\LaporanController::class, 'store']);

    Route::get('/profile', [Oprator\ProfileController::class, 'index']);
    Route::put('/profile/update', [Oprator\ProfileController::class, 'update']);
    Route::put('/profile/update/password', [Oprator\ProfileController::class, 'password']);
});

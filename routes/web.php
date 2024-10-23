<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\PetugasController;
use Illuminate\Support\Facades\Route;




Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [DashboardController::class, 'indexAdmin']);            // Menampilkan halaman dashboard

    // Kelola Akun (CRUD)
    Route::group(['prefix' => 'akun'], function () {
        Route::get('/', [AkunController::class, 'index']);                  // Menampilkan data akun dari database
        Route::get('/create', [AkunController::class, 'create']);           // Menampilkan form create akun
        Route::post('/store', [AkunController::class, 'store']);            // Menyimpan data akun ke database
        Route::get('/edit/{id}', [AkunController::class, 'edit']);          // Menampilkan form edit akun
        Route::post('/update/{id}', [AkunController::class, 'update']);     // Mengupdate data akun ke database
        Route::delete('/delete/{id}', [AkunController::class, 'delete']);   // Menghapus data akun dari database
    });

    // Kelola Petugas (CRUD)
    Route::group(['prefix' => 'petugas'], function () {
        Route::get('/', [PetugasController::class, 'index']);
        Route::get('/create', [PetugasController::class, 'create']);
        Route::post('/store', [PetugasController::class, 'store']);
        Route::get('/edit/{id}', [PetugasController::class, 'edit']);
        Route::post('/update/{id}', [PetugasController::class, 'update']);
        Route::delete('/delete/{id}', [PetugasController::class, 'delete']);
    });

    // Kelola Peserta (CRUD)
    Route::group(['prefix' => 'peserta'], function () {
        Route::get('/', [PesertaController::class, 'index']);
        Route::get('/create', [PesertaController::class, 'create']);
        Route::post('/store', [PesertaController::class, 'store']);
        Route::get('/edit/{id}', [PesertaController::class, 'edit']);
        Route::post('/update/{id}', [PesertaController::class, 'update']);
        Route::delete('/delete/{id}', [PesertaController::class, 'delete']);
    });
});

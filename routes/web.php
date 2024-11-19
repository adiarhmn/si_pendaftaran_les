<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KursusController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\PetugasController;
use Illuminate\Support\Facades\Route;

// PARAMETER DEFENITION
Route::pattern('id', '[0-9]+');


// ===================================== AUTH ROUTES =====================================
Route::get('login', function () {
    return view('auth.login');
})->name('login');
Route::post('auth', [AuthController::class, 'auth'])->name('login.auth');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('register', function () {
    return view('auth.register');
})->name('auth.register');
Route::post('register', [AuthController::class, 'register'])->name('auth.register');

// ===================================== PUBLIC ROUTES ===================================== 
Route::group(['prefix' => ''], function () {
    Route::get('/', [HomeController::class, 'index']);                      // Menampilkan halaman home
});

// ===================================== PESERTA ROUTES ===================================== 
Route::group(['prefix' => 'peserta', 'middleware' => 'checkRole:peserta'], function () {
    Route::get('dashboard', [DashboardController::class, 'indexPeserta']);  // Menampilkan halaman dashboard
    Route::get('kursus', [PesertaController::class, 'kursusSaya'])->name('peserta.kursus.detail');
    Route::get('kursus/{id}', [KursusController::class, 'detail'])->name('peserta.kursus.detail');
    Route::get('register', [PesertaController::class, 'pesertaRegister'])->name('peserta.register');
});

// ===================================== ADMIN ROUTES ===================================== 
Route::group(['prefix' => 'admin', 'middleware' => 'checkRole:admin'], function () {
    Route::get('dashboard', [DashboardController::class, 'indexAdmin']);            // Menampilkan halaman dashboard

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

    // Kelola Kursus (CRUD - DLL)
    Route::group(['prefix' => 'kursus'], function () {
        Route::get('/', [KursusController::class, 'index']);
        Route::get('/create', [KursusController::class, 'create']);
        Route::post('/store', [KursusController::class, 'store']);
        Route::get('/edit/{id}', [KursusController::class, 'edit']);
        Route::post('/update/{id}', [KursusController::class, 'update']);
        Route::delete('/delete/{id}', [KursusController::class, 'delete']);

        // Peserta Kursus
        Route::get('/peserta/{id}', [KursusController::class, 'pesertaKursus'])->name('admin.kursus.peserta');
        Route::post('/peserta/store', [KursusController::class, 'tambahPesertaKursus'])->name('admin.kursus.peserta.store');
        Route::get('/pembayaran/{id}', [KursusController::class], 'pembayaranKursus')->name('admin.kursus.pembayaran');

        // Pembayaran Kursus
        Route::post('/upload-pembayaran-peserta', [PembayaranController::class, 'uploadPembayaran']);
    });
});

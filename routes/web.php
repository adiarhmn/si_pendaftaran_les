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

// PARAMETER DEFENITION (Agar Id Hanya Menerima Angka)
Route::pattern('id', '[0-9]+');


// ===================================== AUTH ROUTES =====================================
Route::get('login', function () {
    return view('auth.login');
})->name('login'); // Menampilkan halaman login
Route::post('auth', [AuthController::class, 'auth'])->name('login.auth'); // Proses login
Route::get('logout', [AuthController::class, 'logout'])->name('logout'); // Proses logout
Route::get('register', function () {
    return view('auth.register');
})->name('auth.register'); // Menampilkan halaman register
Route::post('register', [AuthController::class, 'register'])->name('auth.register'); // Proses register

// ===================================== PUBLIC ROUTES ===================================== 
Route::group(['prefix' => ''], function () {
    Route::get('/', [HomeController::class, 'index']); // Menampilkan halaman home
});

// ===================================== PESERTA ROUTES ===================================== 
Route::group(['prefix' => 'peserta', 'middleware' => 'checkRole:peserta'], function () {

    // Peserta - Dashboard
    Route::get('dashboard', [DashboardController::class, 'indexPeserta']);  // Menampilkan halaman dashboard

    // Peserta - Kursus
    Route::get('kursus', [PesertaController::class, 'kursusSaya'])->name('peserta.kursus.saya'); // Menampilkan kursus yang diikuti peserta
    Route::get('kursus/{id}', [KursusController::class, 'daftar_sekarang'])->name('peserta.kursus.daftar_sekarang'); // Menampilkan form daftar kursus
    Route::post('kursus/daftar', [KursusController::class, 'daftar_kursus'])->name('peserta.kursus.daftar_kursus'); // Proses daftar kursus ')

    // Peserta - API Pembayaran Midtrans
    Route::post('buat-token-pembayaran', [PembayaranController::class, 'buatTokenPembayaran'])->name('peserta.buat.token.pembayaran'); // Membuat token pembayaran midtrans
    Route::get('notification-handler', [PembayaranController::class, 'notificationHandler'])->name('peserta.notification.handler'); // Handler notifikasi pembayaran midtrans
    Route::post('finish-payment', [PembayaranController::class, 'finishPayment'])->name('peserta.finish.payment'); // Handler finish pembayaran midtrans
    Route::get('notification-handler', [PembayaranController::class, 'notificationHandler'])->name('peserta.notification.handler'); // Handler notifikasi pembayaran midtrans
    // Peserta - Profile
    Route::get('profile', [PesertaController::class, 'profile'])->name('peserta.profile'); // Menampilkan halaman profile peserta
    Route::post('profile/{id}', [PesertaController::class, 'update'])->name('peserta.update.profile');
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
        Route::delete('/peserta/{id}', [KursusController::class, 'hapusPesertaKursus'])->name('admin.hapus.kursus.peserta');
        Route::post('/peserta/store', [KursusController::class, 'tambahPesertaKursus'])->name('admin.kursus.peserta.store');
        Route::get('/pembayaran/{id}', [KursusController::class], 'pembayaranKursus')->name('admin.kursus.pembayaran');

        // Pembayaran Kursus
        Route::post('/upload-pembayaran-peserta', [PembayaranController::class, 'uploadPembayaran']);
    });

    // Kelola Pembayaran
    Route::post('pembayaran-konfirmasi', [PembayaranController::class, 'konfirmasi']);
    Route::group(['prefix' => 'pembayaran'], function () {
        Route::get('/', [PembayaranController::class, 'index']);
    });
});

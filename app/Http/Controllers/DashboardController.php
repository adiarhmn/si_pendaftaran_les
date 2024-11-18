<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // @METHOD index() akan menampilkan halaman dashboard public user
    public function index()
    {
        return view('welcome');
    }
    // @METHOD indexAdmin() ini akan menampilkan halaman dashboard admin
    public function indexAdmin()
    {
        return view('admin/dashboard');
    }

    // @METHOD indexPetugas() ini akan menampilkan halaman dashboard petugas
    public function indexPetugas()
    {
        return view('petugas/dashboard');
    }

    // @METHOD indexPeserta() ini akan menampilkan halaman dashboard peserta
    public function indexPeserta()
    {
        return view('peserta/dashboard');
    }
}

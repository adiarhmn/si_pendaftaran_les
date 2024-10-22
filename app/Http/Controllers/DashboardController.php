<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // @@ FIRST Method index() akan menampilkan halaman dashboard public user
    public function index()
    {
        return view('welcome');
    }
    // @@ FIRST Method indexAdmin() ini akan menampilkan halaman dashboard admin
    public function indexAdmin()
    {
        return view('admin/dashboard');
    }
}

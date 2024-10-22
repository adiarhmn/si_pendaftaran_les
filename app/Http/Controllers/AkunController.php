<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AkunController extends Controller
{
    // @METHOD index() akan menampilkan data akun dari database
    public function index()
    {
        return view('admin/akun');
    }


    // @METHOD delete() akan menghapus data akun dari database
    public function delete($id)
    {
        return redirect()->back()->with('success', 'Data akun berhasil dihapus');
    }
}

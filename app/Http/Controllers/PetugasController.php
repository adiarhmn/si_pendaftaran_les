<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetugasRequest;
use App\Models\AkunModel;
use App\Models\PetugasModel;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    // ====================================================================================================
    // @METHOD index() akan menampilkan data petugas dari database
    public function index()
    {
        $list_petugas = PetugasModel::all(); // Mengambil semua data petugas dari database

        // Menampilkan halaman petugas dan passing data petugas
        return view('admin/petugas', [
            'list_petugas' => $list_petugas
        ]);
    }


    // ====================================================================================================
    // @METHOD create() akan menampilkan form create petugas
    public function create()
    {
        $list_akun = AkunModel::where('level', 'petugas')->get(); // Mengambil semua data akun petugas dari database
        return view('admin/petugas_form', [
            'form' => 'Tambah',
            'url' => url('admin/petugas/store'),
            'list_akun' => $list_akun,
        ]);
    }

    // ====================================================================================================
    // @METHOD store() akan menyimpan data petugas ke database
    public function store(PetugasRequest $request)
    {
        dd($request->all());
    }

    // ====================================================================================================
    // @METHOD edit() akan menampilkan form edit petugas
}

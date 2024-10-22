<?php

namespace App\Http\Controllers;

use App\Models\AkunModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AkunController extends Controller
{
    // @METHOD index() akan menampilkan data akun dari database
    public function index()
    {
        $list_akun = AkunModel::all(); // Mengambil semua data akun dari database

        // Menampilkan halaman akun dan passing data akun
        return view('admin/akun', [
            'list_akun' => $list_akun
        ]);
    }

    // @METHOD create() akan menampilkan form create akun
    public function create()
    {
        return view('admin/akun_tambah');
    }

    // @METHOD store() akan menyimpan data akun ke database
    public function store(Request $request)
    {
        // Validasi data yang diinputkan
        $request->validate([
            'username' => 'required|alpha_num|max:25|unique:akun,username',
            'password' => 'required|min:8'
        ]);

        // Menyimpan data akun ke database
        $akun = new AkunModel();
        $akun->username = $request->username;
        $akun->password = password_hash($request->password, PASSWORD_DEFAULT);
        $akun->save();

        return redirect('/admin/akun')->with('success', 'Data akun berhasil disimpan');
    }

    // @METHOD edit() akan menampilkan form edit akun
    public function edit($id)
    {
        // Mengambil data akun berdasarkan id
        $akun = AkunModel::find($id);

        return view('admin/akun_edit', [
            'akun' => $akun
        ]);
    }

    // @METHOD delete() akan menghapus data akun dari database
    public function delete($id)
    {
        // Mengambil Data Akun
        $akun = AkunModel::find($id);

        // Menghapus Data Akun
        $akun->delete();

        return redirect()->back()->with('success', 'Data akun berhasil dihapus ');
    }
}

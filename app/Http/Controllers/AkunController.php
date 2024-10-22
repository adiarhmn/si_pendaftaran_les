<?php

namespace App\Http\Controllers;

use App\Http\Requests\AkunRequest;
use App\Models\AkunModel;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    // ====================================================================================================
    // @METHOD index() akan menampilkan data akun dari database
    public function index(Request $request)
    {
        $query = $request->input('query') ?? null;
        if ($query) {
            $list_akun = AkunModel::where('username', 'like', '%' . $query . '%')
            ->orWhere('level', 'like', '%' . $query . '%')
            ->paginate(5);
        } else {
            $list_akun = AkunModel::paginate(5);
        }

        // Menampilkan halaman akun dan passing data akun
        return view('admin/akun', [
            'list_akun' => $list_akun
        ]);
    }

    // ====================================================================================================
    // @METHOD create() akan menampilkan form create akun
    public function create()
    {
        return view('admin/akun_form', [
            'form' => 'Tambah',
            'url' => url('admin/akun/store'),
        ]);
    }

    // ====================================================================================================
    // @METHOD store() akan menyimpan data akun ke database
    public function store(AkunRequest $request)
    {
        // Menyimpan data akun ke database
        $akun = new AkunModel();
        $akun->username = $request->username;
        $akun->level = $request->level;
        $akun->password = password_hash($request->password, PASSWORD_DEFAULT);
        $akun->save();

        return redirect('/admin/akun')->with('success', 'Data akun berhasil disimpan');
    }

    // ====================================================================================================
    // @METHOD edit() akan menampilkan form edit akun
    public function edit($id)
    {
        // Mengambil data akun berdasarkan id
        $akun = AkunModel::find($id);

        // Menampilkan form edit akun dan passing data akun
        return view('admin/akun_form', [
            'form' => 'Edit',
            'url' => url('admin/akun/update/' . $id),
            'akun' => $akun,
        ]);
    }

    // ====================================================================================================
    // @METHOD update() akan mengupdate data akun ke database
    public function update(AkunRequest $request, $id)
    {
        // Mengambil data akun berdasarkan id
        $akun = AkunModel::find($id);

        // Mengupdate data akun ke database
        $akun->username = $request->username;
        $akun->level = $request->level;
        if ($request->filled('password')) $akun->password = password_hash($request->password, PASSWORD_DEFAULT);
        $akun->save();

        return redirect('/admin/akun')->with('success', 'Data akun berhasil diupdate');
    }

    // ====================================================================================================
    // @METHOD delete() akan menghapus data akun dari database
    public function delete($id)
    {
        // Mengambil Data Akun Sesuai ID Primary Key
        $akun = AkunModel::find($id);

        // Menghapus Data Akun
        $akun->delete();

        return redirect()->back()->with('success', 'Data akun berhasil dihapus ');
    }
}

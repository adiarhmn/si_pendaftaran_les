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
        $query = request()->input('query') ?? null;
        if ($query) {
            $list_petugas = PetugasModel::where('nama_petugas', 'like', '%' . $query . '%')
                ->orWhere('telp', 'like', '%' . $query . '%')
                ->orWhere('alamat', 'like', '%' . $query . '%')
                ->paginate(5); // Mengambil data petugas dari database berdasarkan query
        } else {
            $list_petugas = PetugasModel::paginate(5); // Mengambil semua data petugas dari database
        }

        // Menampilkan halaman petugas dan passing data petugas
        return view('admin/petugas/petugas_data', [
            'list_petugas' => $list_petugas
        ]);
    }


    // ====================================================================================================
    // @METHOD create() akan menampilkan form create petugas
    public function create()
    {
        // Mengambil data akun yang belum terdaftar sebagai petugas
        $list_akun = AkunModel::where('level', 'petugas')
            ->whereDoesntHave('petugas')
            ->get();

        return view('admin/petugas/petugas_form', [
            'form' => 'Tambah',
            'url' => url('admin/petugas/store'),
            'list_akun' => $list_akun,
        ]);
    }

    // ====================================================================================================
    // @METHOD store() akan menyimpan data petugas ke database
    public function store(PetugasRequest $request)
    {

        // Create Akun
        $akun = new AkunModel();
        $akun->username = $request->username;
        $akun->level = 'petugas';
        $akun->password = password_hash($request->password, PASSWORD_DEFAULT);
        $akun->save();


        // Menyimpan data petugas ke database
        $petugas = new PetugasModel();
        $petugas->nama_petugas = $request->nama_petugas;
        $petugas->telp = $request->telp;
        $petugas->alamat = $request->alamat;
        $petugas->id_akun = $akun->id_akun;
        $petugas->save();

        // Redirect ke halaman petugas dengan pesan sukses
        return redirect('/admin/petugas')->with('success', 'Data petugas berhasil disimpan');
    }

    // ====================================================================================================
    // @METHOD edit() akan menampilkan form edit petugas
    public function edit($id)
    {
        // Mengambil data petugas berdasarkan id
        $petugas = PetugasModel::find($id);

        // Mengambil data akun yang belum terdaftar sebagai petugas
        $list_akun = AkunModel::where('level', 'petugas')
            ->whereDoesntHave('petugas')
            ->orWhere('id_akun', $petugas->id_akun)
            ->get();

        return view('admin/petugas/petugas_form', [
            'form' => 'Edit',
            'url' => url('admin/petugas/update/' . $id),
            'petugas' => $petugas,
            'list_akun' => $list_akun,
        ]);
    }

    // ====================================================================================================
    // @METHOD update() akan mengupdate data petugas ke database
    public function update(PetugasRequest $request, $id)
    {

        // Mengambil data petugas berdasarkan id
        $petugas = PetugasModel::find($id);

        // Update Akun
        $akun = AkunModel::find($petugas->id_akun);
        $akun->username = $request->username;
        if ($request->filled('password')) $akun->password = password_hash($request->password, PASSWORD_DEFAULT);
        $akun->save();

        // Mengupdate data petugas ke database
        $petugas->nama_petugas = $request->nama_petugas;
        $petugas->telp = $request->telp;
        $petugas->alamat = $request->alamat;
        $petugas->save();

        // Redirect ke halaman petugas dengan pesan sukses
        return redirect('/admin/petugas')->with('success', 'Data petugas berhasil diupdate');
    }


    // ====================================================================================================
    // @METHOD delete() akan menghapus data petugas dari database
    public function delete($id)
    {
        // Menghapus data petugas berdasarkan id
        PetugasModel::destroy($id);

        // Redirect ke halaman petugas dengan pesan sukses
        return redirect('/admin/petugas')->with('success', 'Data petugas berhasil dihapus');
    }
}

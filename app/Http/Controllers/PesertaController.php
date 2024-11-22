<?php

namespace App\Http\Controllers;

use App\Http\Requests\PesertaRequest;
use App\Models\AkunModel;
use App\Models\PesertaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesertaController extends Controller
{
    // ====================================================================================
    // @METHOD index() akan menampilkan data peserta dari database
    public function index()
    {
        $query = request()->input('query') ?? null;
        if ($query) {
            $list_peserta = PesertaModel::where('nama_peserta', 'like', '%' . $query . '%')
                ->orWhere('telp', 'like', '%' . $query . '%')
                ->orWhere('alamat', 'like', '%' . $query . '%')
                ->paginate(5); // Mengambil data peserta dari database berdasarkan query
        } else {
            $list_peserta = PesertaModel::paginate(5); // Mengambil semua data peserta dari database
        }

        // Menampilkan halaman peserta dan passing data peserta
        return view('admin/peserta/peserta_data', [
            'list_peserta' => $list_peserta
        ]);
    }



    // ====================================================================================
    // @METHOD create() akan menampilkan form create peserta
    public function create()
    {
        $list_akun = AkunModel::where('level', 'peserta')
            ->whereDoesntHave('peserta')
            ->get();

        return view('admin/peserta/peserta_form', [
            'form' => 'Tambah',
            'url' => url('admin/peserta/store'),
            'list_akun' => $list_akun,
        ]);
    }

    // ====================================================================================
    // @METHOD store() akan menyimpan data peserta ke database
    public function store(PesertaRequest $request)
    {
        // Create Akun
        $akun = new AkunModel();
        $akun->username = $request->username;
        $akun->level = 'peserta';
        $akun->password = password_hash($request->password, PASSWORD_DEFAULT);
        $akun->save();

        // Menyimpan data peserta ke database
        $peserta = new PesertaModel();
        $peserta->nama_peserta = $request->nama_peserta;
        $peserta->telp = $request->telp;
        $peserta->alamat = $request->alamat;
        $peserta->id_akun = $akun->id_akun;
        $peserta->save();

        return redirect('/admin/peserta')->with('success', 'Data peserta berhasil disimpan');
    }


    // ====================================================================================
    // @METHOD edit() akan menampilkan form edit peserta
    public function edit($id)
    {
        // Mengambil data peserta berdasarkan id
        $peserta = PesertaModel::find($id);

        // Mengambil data akun yang belum terdaftar sebagai peserta
        $list_akun = AkunModel::where('level', 'peserta')
            ->whereDoesntHave('peserta')
            ->orWhere('id_akun', $peserta->id_akun)
            ->get();

        return view('admin/peserta/peserta_form', [
            'form' => 'Edit',
            'url' => url('admin/peserta/update/' . $id),
            'peserta' => $peserta,
            'list_akun' => $list_akun,
        ]);
    }

    // ====================================================================================
    // @METHOD update() akan mengupdate data peserta ke database
    public function update(PesertaRequest $request, $id)
    {

        // Mengambil data peserta berdasarkan id
        $peserta = PesertaModel::find($id);


        // Memperbarui jika password tidak kosong
        if ($request->filled('passsword')) {
            $akun = AkunModel::find($peserta->id_akun);
            $akun->password = password_hash($request->password, PASSWORD_DEFAULT);
            $akun->save();
        }

        // Mengupdate data peserta ke database
        $peserta->nama_peserta = $request->nama_peserta;
        $peserta->telp = $request->telp;
        $peserta->alamat = $request->alamat;
        $peserta->save();

        return redirect('/admin/peserta')->with('success', 'Data peserta berhasil diupdate');
    }

    // ====================================================================================
    // @METHOD delete() akan menghapus data peserta dari database
    public function delete($id)
    {
        // Menghapus data peserta dari database
        PesertaModel::destroy($id);

        return redirect('/admin/peserta')->with('success', 'Data peserta berhasil dihapus');
    }


    public function indexPeserta() {}

    public function kursusSaya()
    {
    //    $list_kursus = 
    }

    public function registerCourse(Request $request) {}
}

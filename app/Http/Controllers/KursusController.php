<?php

namespace App\Http\Controllers;

use App\Http\Requests\KursusRequest;
use App\Models\KursusModel;
use App\Models\PesertaKursusModel;
use App\Models\PesertaModel;
use App\Models\PetugasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KursusController extends Controller
{
    // ====================================================================================
    // @METHOD index() akan menampilkan data kursus dari database
    public function index()
    {
        $query = request()->input('query') ?? null;
        if ($query) {
            $list_kursus = KursusModel::where('nama_kursus', 'like', '%' . $query . '%')
                ->orWhere('deskripsi', 'like', '%' . $query . '%')
                ->paginate(5); // Mengambil data kursus dari database berdasarkan query
        } else {
            $list_kursus = KursusModel::paginate(5); // Mengambil semua data kursus dari database
        }

        // Menampilkan halaman kursus dan passing data kursus
        return view('admin/kursus/kursus_data', [
            'list_kursus' => $list_kursus
        ]);
    }

    // ====================================================================================
    // @METHOD create() akan menampilkan form create kursus
    public function create()
    {
        $list_petugas = PetugasModel::all();
        return view('admin/kursus/kursus_form', [
            'form' => 'Tambah',
            'url' => url('admin/kursus/store'),
            'list_petugas' => $list_petugas,
        ]);
    }

    // ====================================================================================
    // @METHOD store() akan menyimpan data kursus ke database
    public function store(KursusRequest $request)
    {

        // Menyimpan gambar cover ke folder public/images
        $file = $request->file('gambar_cover');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $file->move('images', $nama_file);


        $kursus = new KursusModel();
        // Menyimpan data kursus ke database
        $kursus->nama_kursus = $request->nama_kursus;
        $kursus->deskripsi = $request->deskripsi;
        $kursus->durasi = $request->durasi;
        $kursus->harga = $request->harga;
        $kursus->jumlah_peserta = $request->jumlah_peserta;
        $kursus->tanggal_mulai = $request->tanggal_mulai;
        $kursus->tanggal_selesai = $request->tanggal_selesai;
        $kursus->status_kursus = 'open';
        $kursus->gambar_cover = $nama_file;
        $kursus->id_petugas = $request->id_petugas;
        $kursus->save();

        return redirect('/admin/kursus')->with('success', 'Data kursus berhasil disimpan');
    }

    // ====================================================================================
    // @METHOD edit() akan menampilkan form edit kursus
    public function edit($id)
    {
        // Mengambil data kursus berdasarkan id
        $kursus = KursusModel::find($id);
        $list_petugas = PetugasModel::all();
        return view('admin/kursus/kursus_form', [
            'form' => 'Edit',
            'url' => url('admin/kursus/update/' . $id),
            'kursus' => $kursus,
            'list_petugas' => $list_petugas,
        ]);
    }

    // ====================================================================================
    // @METHOD update() akan mengupdate data kursus ke database
    public function update(KursusRequest $request, $id)
    {
        // Mengupdate data kursus ke database
        $kursus = KursusModel::find($id);
        $kursus->nama_kursus = $request->nama_kursus;
        $kursus->deskripsi = $request->deskripsi;
        $kursus->id_petugas = $request->id_petugas;
        $kursus->save();

        return redirect('/admin/kursus')->with('success', 'Data kursus berhasil diupdate');
    }

    // ====================================================================================
    // @METHOD delete() akan menghapus data kursus dari database
    public function delete($id)
    {
        // Menghapus data kursus dari database
        KursusModel::destroy($id);

        return redirect('/admin/kursus')->with('success', 'Data kursus berhasil dihapus');
    }

    // ====================================================================================
    // @METHOD detail() akan menampilkan detail kursus
    public function detail($id)
    {
        // Mengambil data kursus berdasarkan id
        $kursus = KursusModel::find($id);

        return view(Auth::user()->level . '/kursus/kursus_detail', [
            'kursus' => $kursus
        ]);
    }

    public function pesertaKursus(int $id)
    {
        $kursus = KursusModel::find($id);
        $list_peserta = $kursus->peserta_kursus;

        $list_peserta_free = PesertaModel::whereDoesntHave('peserta_kursus', function ($query) use ($id) {
            $query->where('id_kursus', $id);
        })->get();


        return view('admin/kursus/kursus_peserta', [
            'kursus' => $kursus,
            'list_peserta' => $list_peserta,
            'list_peserta_free' => $list_peserta_free,
        ]);
    }

    public function tambahPesertaKursus(Request $request)
    {
        // Validasi Request
        $request->validate([
            'id_kursus' => 'required',
            'id_peserta' => 'required',
        ]);

        $Kursus = KursusModel::find($request->id_kursus);

        // Create Peserta Kursus
        $peserta_kursus = new PesertaKursusModel();
        $peserta_kursus->id_kursus = $request->id_kursus;
        $peserta_kursus->id_peserta = $request->id_peserta;
        $peserta_kursus->status_peserta_kursus = 'pending';
        $peserta_kursus->status_pembayaran = 'belum lunas';
        $peserta_kursus->total_tagihan = $Kursus->harga;
        $peserta_kursus->total_pembayaran = 0;
        $peserta_kursus->tgl_tenggat_pembayaran = $Kursus->tanggal_mulai;
        $peserta_kursus->status_sertifikat = 'belum teribit';
        $peserta_kursus->save();

        return redirect('/admin/kursus/peserta/' . $request->id_kursus)->with('success', 'Peserta berhasil ditambahkan ke kursus');
    }
}

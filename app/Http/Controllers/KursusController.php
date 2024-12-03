<?php

namespace App\Http\Controllers;

use App\Http\Requests\KursusRequest;
use App\Models\KursusModel;
use App\Models\PesertaKursusModel;
use App\Models\PesertaModel;
use App\Models\PetugasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;

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
        $nama_file = time() . "_kursus_cover";
        $file->storeAs('images/', $nama_file);

        $kursus = new KursusModel();
        // Menyimpan data kursus ke database
        $kursus->nama_kursus = $request->nama_kursus;
        $kursus->deskripsi = $request->deskripsi;
        $kursus->durasi = $request->durasi;
        $kursus->harga = $request->harga;
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

        // Jika gambar cover diubah
        if ($request->hasFile('gambar_cover')) {
            // Menyimpan gambar cover ke folder public/images
            $file = $request->file('gambar_cover');
            $nama_file = time() . "_kursus_cover" . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $nama_file);

            // Menghapus gambar cover lama
            $kursus = KursusModel::find($id);
            if ($kursus->gambar_cover) {
                // jika file exist
                if (file_exists(public_path('images/' . $kursus->gambar_cover))) {
                    unlink(public_path('images/' . $kursus->gambar_cover));
                }
            }
        }

        // Mengupdate data kursus ke database
        $kursus = KursusModel::find($id);
        $kursus->nama_kursus = $request->nama_kursus;
        $kursus->deskripsi = $request->deskripsi;
        $kursus->durasi = $request->durasi;
        $kursus->harga = $request->harga;
        $kursus->id_petugas = $request->id_petugas;
        if ($request->hasFile('gambar_cover')) {
            $kursus->gambar_cover = $nama_file;
        }
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
        $peserta_kursus->status_pembayaran = 'belum lunas';
        $peserta_kursus->total_tagihan = $Kursus->harga;
        $peserta_kursus->total_pembayaran = 0;

        // Tenggat + 3 Hari Dari Tanggal now
        $peserta_kursus->tgl_tenggat_pembayaran = date('Y-m-d', strtotime('+3 days', strtotime(date('Y-m-d'))));

        $peserta_kursus->status_sertifikat = 'belum terbit';
        $peserta_kursus->save();

        return redirect('/admin/kursus/peserta/' . $request->id_kursus)->with('success', 'Peserta berhasil ditambahkan ke kursus');
    }

    public function hapusPesertaKursus(int $id)
    {
        $peserta_kursus = PesertaKursusModel::find($id);
        $id_kursus = $peserta_kursus->id_kursus;
        $peserta_kursus->delete();

        return redirect('/admin/kursus/peserta/' . $id_kursus)->with('success', 'Peserta berhasil dihapus dari kursus');
    }


    public function daftar_sekarang($id)
    {
        // Mengambil data kursus berdasarkan id
        $kursus = KursusModel::find($id);

        // User atau Peserta
        $peserta = PesertaModel::where('id_akun', Auth::user()->id_akun)->first();
        if (!$peserta) {
            return redirect()->back()->with('error', 'Anda belum terdaftar sebagai peserta');
        }

        // Cek apakah peserta sudah terdaftar di kursus yang belum selesai
        $peserta_kursus = PesertaKursusModel::where('id_kursus', $id)
            ->where('id_peserta', $peserta->id_peserta)
            ->where('status_pelatihan', '!=', 'selesai')
            ->first();

        if ($peserta_kursus) {
            return redirect(url('peserta/kursus'))->with('warning', 'Anda sudah terdaftar di kursus ini');
        }


        return view(Auth::user()->level . '/kursus/kursus_detail', [
            'kursus' => $kursus,
        ]);
    }

    // Daftar Kursus
    public function daftar_kursus(Request $request)
    {
        // Validate Input
        $request->validate([
            'id_kursus' => 'required|exists:kursus,id_kursus'
        ]);

        // Save to Database
        $peserta_kursus = new PesertaKursusModel();
        $peserta_kursus->id_kursus = $request->id_kursus;
        $peserta_kursus->id_peserta = Auth::user()->peserta->id_peserta;
        $peserta_kursus->status_pembayaran = 'belum lunas';
        $peserta_kursus->total_tagihan = KursusModel::find($request->id_kursus)->harga;
        $peserta_kursus->total_pembayaran = 0;
        $peserta_kursus->tgl_tenggat_pembayaran = date('Y-m-d', strtotime('+3 days', strtotime(date('Y-m-d'))));
        $peserta_kursus->status_sertifikat = 'belum terbit';
        $peserta_kursus->save();

        return redirect('/peserta/kursus')->with('success', 'Anda berhasil mendaftar kursus');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\PembayaranModel;
use App\Models\PesertaKursusModel;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $list_pembayaran = PembayaranModel::all();
        return view('admin.pembayaran.pembayaran_data', [
            'list_pembayaran' => $list_pembayaran
        ]);
    }
    public function uploadPembayaran(Request $request)
    {
        // Validasi Input
        $request->validate([
            'id_peserta_kursus' => 'required',
            'total_pembayaran' => 'required|numeric',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Simpan Bukti Pembayaran
        $imageName = time() . '.' . $request->bukti_pembayaran->extension();
        $request->bukti_pembayaran->move(public_path('images/bukti_pembayaran'), $imageName);

        // Simpan Data Pembayaran
        $pembayaran = new PembayaranModel();
        $pembayaran->id_peserta_kursus = $request->id_peserta_kursus;
        $pembayaran->total_pembayaran = $request->total_pembayaran;
        $pembayaran->bukti_pembayaran = $imageName;
        $pembayaran->save();

        // // Update Tagihan dan Status Peserta Kursus
        // $pesertaKursus = PesertaKursusModel::find($request->id_peserta_kursus);
        // $pesertaKursus->total_pembayaran += $request->total_pembayaran;
        // $pesertaKursus->total_tagihan -= $request->total_pembayaran;
        // $pesertaKursus->status_pembayaran = $pesertaKursus->total_pembayaran >= $pesertaKursus->total_tagihan ? 'lunas' : 'belum lunas';
        // $pesertaKursus->save();

        return redirect()->back()->with('success', 'Bukti Pembayaran Berhasil Diupload');
    }

    public function konfirmasi(Request $request)
    {
        $pembayaran = PembayaranModel::find($request->id_pembayaran);
        $pembayaran->status_pembayaran = $request->status_pembayaran;
        $pembayaran->save();

        // Update Tagihan dan Status Peserta Kursus
        if ($request->status_pembayaran == 'lunas') {
            $pesertaKursus = PesertaKursusModel::find($pembayaran->id_peserta_kursus);
            $pesertaKursus->total_pembayaran += $pembayaran->total_pembayaran;
            $pesertaKursus->total_tagihan -= $pembayaran->total_pembayaran;
            $pesertaKursus->status_pembayaran = $pesertaKursus->total_tagihan <= 0 ? 'lunas' : 'belum lunas';

            if ($pesertaKursus->total_tagihan <= 0) {
                $pesertaKursus->status_pelatihan = 'berlangsung';
            }

            $pesertaKursus->save();
        }

        return redirect()->back()->with('success', 'Pembayaran Berhasil Dikonfirmasi');
    }
}

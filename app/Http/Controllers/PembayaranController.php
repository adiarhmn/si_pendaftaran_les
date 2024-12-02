<?php

namespace App\Http\Controllers;

use App\Models\PembayaranModel;
use App\Models\PesertaKursusModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;

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


    // API Pembayaran Midtrans Buat Token
    public function buatTokenPembayaran(Request $request)
    {
        // Midtrans Config 
        Config::$serverKey = config('app.midtrans.serverKey');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Validasi Input
        $request->validate([
            'id_peserta_kursus' => 'required',
            'pembayaran' => 'required',
        ]);

        $pesertaKursus = PesertaKursusModel::find($request->id_peserta_kursus);

        $total_pembayaran = ($request->pembayaran == '50%' ? ($pesertaKursus->total_tagihan / 2) : $pesertaKursus->total_tagihan);

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $total_pembayaran,
            ),
            'customer_details' => array(
                'name' => $pesertaKursus->peserta->nama_peserta,
                'phone' => $pesertaKursus->peserta->telp,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        session()->flash('snapToken', $snapToken);
        session()->flash('id_peserta_kursus', $request->id_peserta_kursus);
        return redirect()->back()->with('success-no-popup', 'Token Pembayaran Berhasil Dibuat');
    }

    public function finishPayment(Request $request)
    {
        $id_peserta_kursus = $request->input('id_peserta_kursus');
        $paymentResult = $request->input('paymentResult');

        // Temukan peserta kursus berdasarkan ID
        $pesertaKursus = PesertaKursusModel::find($id_peserta_kursus);

        if ($pesertaKursus) {

            // Start Kursus
            if ($pesertaKursus->status_pelatihan == 'belum dimulai') {
                $pesertaKursus->status_pelatihan = 'berlangsung';
                $pesertaKursus->save();
            }

            // Uploading Data Pembayaran di Table Pembayaran
            $pembayaran = new PembayaranModel();
            $pembayaran->id_peserta_kursus = $id_peserta_kursus;
            $pembayaran->total_pembayaran = $paymentResult['gross_amount'];
            $pembayaran->bukti_pembayaran = $paymentResult['transaction_time'];
            $pembayaran->status_pembayaran = 'lunas';
            $pembayaran->save();

            // Kurangi tagihan di database
            $sisa_tagihan = $pesertaKursus->total_tagihan - $paymentResult['gross_amount'];
            $pesertaKursus->total_tagihan = $sisa_tagihan;

            // Tambahkan total yang sudah dibayar di database
            $pesertaKursus->total_pembayaran += $paymentResult['gross_amount'];

            // Jika tagihan sudah lunas, maka status pembayaran menjadi lunas
            $pesertaKursus->status_pembayaran = $sisa_tagihan <= 0 ? 'lunas' : 'belum lunas';

            // Jika Lunas, maka tanggal tenggat jadi null dan sebaliknya
            $pesertaKursus->tgl_tenggat_pembayaran = ($sisa_tagihan <= 0)
                ? null
                : date('Y-m-d', strtotime($pesertaKursus->tgl_tenggat_pembayaran . ' +6 days'));

            // Simpan
            $pesertaKursus->save();

            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error', 'message' => 'Peserta kursus tidak ditemukan'], 404);
    }
}

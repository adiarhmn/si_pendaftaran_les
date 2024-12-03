@extends('layouts.peserta_layout')

@section('script-head')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key={{ config('app.midtrans.clientKey') }}></script>
@endsection
@section('content')
    {{-- @Page Title --}}
    <div class="pagetitle">
        <h1>Konfirmasi Pembayaran</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('peserta/dashboard') }}">Kursus</a></li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body pt-3">
                <h5 class="fw-bold m-0">Detail Kursus</h5>
                <div class="row">
                    <div class="col-md-2">
                        <img src={{ asset('images/' . $kursus->gambar_cover) }} alt="" style="width:100%;">
                    </div>
                    <div class="col-md-10">
                        <table style="width: 100%; font-size: 14px;">
                            <tr>
                                <td>Nama Kursus</td>
                                <td>:</td>
                                <td>{{ $kursus->nama_kursus }}</td>
                            </tr>
                            <tr>
                                <td colspan="3">{!! $kursus->deskripsi !!}</td>
                            </tr>
                            <tr>
                                <td>Pengajar / Petugas</td>
                                <td>:</td>
                                <td>{{ $kursus->petugas->nama_petugas }}</td>
                            </tr>
                            <tr>
                                <td>Durasi</td>
                                <td>:</td>
                                <td>{{ $kursus->durasi }} jam</td>
                            </tr>
                            <tr>
                                <td>Harga</td>
                                <td>:</td>
                                <td class="fw-bold text-primary">{{ rupiah($kursus->harga) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="form-pendaftaran">
        <div class="card">
            <div class="card-body pt-3">
                <h5 class="fw-bold m-0">Form Pendaftaran</h5>
                <form action="{{ url('peserta/kursus/daftar') }}" method="POST">
                    @csrf
                    {{-- Kolom Hidden id_kursus --}}
                    <input type="hidden" name="id_kursus" value="{{ $kursus->id_kursus }}">

                    {{-- Kolom Nama Peserta --}}
                    <div class="mb-3">
                        <label for="nama_peserta" class="form-label">Nama Peserta</label>
                        <input disabled type="text" class="form-control" id="nama_peserta" name="nama_peserta"
                            value={{ Auth::user()->peserta->nama_peserta }}>
                    </div>

                    {{-- Kolom Alamat --}}
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" required
                            value="{{ Auth::user()->peserta->alamat}}">
                    </div>

                    <div class="mb-3">
                        <label for="hari_kursus" class="form-label">Hari Kursus</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="senin" name="hari_kursus[]"
                                value="Senin">
                            <label class="form-check-label" for="senin">Senin</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="selasa" name="hari_kursus[]"
                                value="Selasa">
                            <label class="form-check-label" for="selasa">Selasa</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rabu" name="hari_kursus[]"
                                value="Rabu">
                            <label class="form-check-label" for="rabu">Rabu</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="kamis" name="hari_kursus[]"
                                value="Kamis">
                            <label class="form-check-label" for="kamis">Kamis</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="jumat" name="hari_kursus[]"
                                value="Jumat">
                            <label class="form-check-label" for="jumat">Jumat</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Daftar</button>
                    <button type="button" class="btn btn-secondary" >Batal</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Persyaratan Section --}}
    <section class="section">
        <div class="card">
            <div class="card-body pt-3">
                <h5 class="fw-bold m-0">Persyaratan</h5>
                <ul>
                    <li>Peserta wajib membayar biaya kursus 50% atau sebesar {{ rupiah($kursus->harga / 2) }} atau dibayar
                        sekaligus</li>
                    <li>Biaya dilunasi pada pertemuan ke 6</li>
                    <li>Biaya Privat instruktur/pengajar ke rumah PP 50.000 tiap kali pertemuan</li>
                    <li>Waktu Belajar : Jam 09.00 - 17.00 WIT</li>
                    <li>Jadwal Pelatihan Senin - Sabtu</li>
                </ul>
            </div>
        </div>
    </section>

    {{-- Pembayaran Otomatis atau digital --}}
    <section>
        <div class="card">
            <div class="card-body pt-3">
                <h5 class="fw-bold m-0">Pembayaran Otomatis</h5>
                <p>Pembayaran otomatis akan dilakukan</p>
            </div>
            <div id="snap-container"></div>
            <button class="btn btn-primary" id="pay-button">Bayar Sekarang</button>
        </div>
    </section>

    {{-- @Section Content --}}
    <section class="section">
        <div class="card">
            <div class="card-body pt-3">
                <h5 class="fw-bold">Upload Bukti Pembayaran</h5>
                <p>Pembayaran manual, tolong masukkan data berikut</p>
                <form action="{{ url('admin/kursus/upload-pembayaran-peserta') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_peserta_kursus" value="{{ Auth::user()->peserta->id_peserta_kursus }}">
                    <div class="mb-3">
                        <label for="total_pembayaran" class="form-label">Total
                            Pembayaran</label>
                        <input type="number" class="form-control" id="total_pembayaran" name="total_pembayaran" required>
                    </div>
                    <div class="mb-3">
                        <label for="bukti_pembayaran" class="form-label">Bukti
                            Pembayaran</label>
                        <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran"
                            required>
                    </div>
                    <div class="pt-2 gap-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    {{-- NOTIFIKASI SWEETALERT --}}
    @include('components.notifications')
@endsection

@section('script')
    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Also, use the embedId that you defined in the div above, here.
            window.snap.embed("{{ $snapToken }}", {
                embedId: 'snap-container',
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    alert("payment success!");
                    console.log(result);
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!");
                    console.log(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            });
        });
    </script>
@endsection

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
                <div class="row">
                    <div class="col-md-3">
                        <img src={{ asset('images/' . $kursus->gambar_cover) }} alt="" style="width:100%;">
                    </div>
                    <div class="col-md-9">
                        <h4 class="fw-bold mb-2">{{ $kursus->nama_kursus }}</h4>
                        <table style="width: 100%; font-size: 14px;">
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

    <div class="form-pendaftaran">
        <div class="card">
            <div class="card-body pt-3">
                <h5 class="fw-bold m-0">Form Pendaftaran</h5>
                <form action="{{ url('peserta/kursus/daftar') }}" method="POST">
                    @csrf
                    {{-- Kolom Hidden id_kursus --}}
                    <input type="hidden" name="id_kursus" value="{{ $kursus->id_kursus }}">

                    {{-- Detail Peserta --}}
                    <table class="w-100" style="font-size: 12px">
                        <tbody>
                            <tr>
                                <td>Nama Peserta</td>
                                <td>:</td>
                                <td>{{ Auth::user()->peserta->nama_peserta }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{ Auth::user()->peserta->alamat }}</td>
                            </tr>
                            <tr>
                                <td>No. HP</td>
                                <td>:</td>
                                <td>{{ Auth::user()->peserta->telp }}</td>
                            </tr>
                        </tbody>
                    </table>

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
                    <button type="button" class="btn btn-secondary">Batal</button>
                </form>
            </div>
        </div>
    </div>

    {{-- NOTIFIKASI SWEETALERT --}}
    @include('components.notifications')
@endsection

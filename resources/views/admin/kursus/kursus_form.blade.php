@extends('layouts.admin_layout')

@section('content')
    {{-- @Page Title --}}
    <div class="pagetitle">
        <h1>Kursus</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/kursus') }}">Data Kursus</a></li>
                <li class="breadcrumb-item active">{{ $form }} Kursus</li>
            </ol>
        </nav>
    </div>

    {{-- @Section Content --}}
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Form {{ $form }} Kursus</h5>

                <!-- Start Form -->
                <form action="{{ $url }}" class="row g-3 @if ($errors->any()) validated @endif"
                    method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Nama Kursus (nama_kursus) --}}
                    <div class="col-12">
                        <label for="nama_kursus" class="form-label">Nama Kursus</label>
                        <input name="nama_kursus" value="{{ old('nama_kursus', $kursus->nama_kursus ?? '') }}"
                            type="text" class="form-control @error('nama_kursus') is-invalid @enderror" id="nama_kursus"
                            placeholder="Masukkan Nama Kursus">
                        @error('nama_kursus')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Harga (harga) --}}
                    <div class="col-12">
                        <label for="harga" class="form-label">Harga</label>
                        <input name="harga" value="{{ old('harga', $kursus->harga ?? '') }}" type="number"
                            class="form-control @error('harga') is-invalid @enderror" id="harga"
                            placeholder="Masukkan Harga Kursus">
                        @error('harga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Deskripsi (deskripsi) --}}
                    <div class="col-12">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" rows="3"
                            placeholder="Masukkan Deskripsi Kursus">{{ old('deskripsi', $kursus->deskripsi ?? '') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Durasi (durasi) --}}
                    <div class="col-12">
                        <label for="durasi" class="form-label">Durasi</label>
                        <input name="durasi" value="{{ old('durasi', $kursus->durasi ?? '') }}" type="text"
                            class="form-control @error('durasi') is-invalid @enderror" id="durasi"
                            placeholder="Masukkan Durasi Kursus">
                        @error('durasi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Tanggal Mulai (tanggal_mulai) --}}
                    <div class="col-12">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                        <input name="tanggal_mulai" value="{{ old('tanggal_mulai', $kursus->tanggal_mulai ?? '') }}"
                            type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror"
                            id="tanggal_mulai">
                        @error('tanggal_mulai')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Tanggal Selesai (tanggal_selesai) --}}
                    <div class="col-12">
                        <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                        <input name="tanggal_selesai" value="{{ old('tanggal_selesai', $kursus->tanggal_selesai ?? '') }}"
                            type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror"
                            id="tanggal_selesai">
                        @error('tanggal_selesai')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Jumlah Peserta (jumlah_peserta) --}}
                    <div class="col-12">
                        <label for="jumlah_peserta" class="form-label">Jumlah Peserta</label>
                        <input name="jumlah_peserta" value="{{ old('jumlah_peserta', $kursus->jumlah_peserta ?? '') }}"
                            type="number" class="form-control @error('jumlah_peserta') is-invalid @enderror"
                            id="jumlah_peserta" placeholder="Masukkan Jumlah Peserta">
                        @error('jumlah_peserta')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Petugas Selection (id_petugas) --}}
                    <div class="col-12">
                        <label for="id_petugas" class="form-label">Petugas</label>
                        <select name="id_petugas" class="form-select @error('id_petugas') is-invalid @enderror" id="id_petugas">
                            <option value="">Pilih Petugas</option>
                            @foreach ($list_petugas as $item)
                                <option value="{{ $item->id_petugas }}" @if (old('id_petugas', $kursus->id_petugas ?? '') == $item->id_petugas) selected @endif>
                                    {{ $item->nama_petugas }}</option>
                            @endforeach
                        </select>
                        @error('id_petugas')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Gambar Cover --}}
                    <div class="col-12">
                        <label for="gambar_cover" class="form-label">Gambar Cover</label>
                        <input name="gambar_cover" type="file" class="form-control @error('gambar_cover') is-invalid @enderror"
                            id="gambar_cover">
                        @error('gambar_cover')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Tombol Simpan dan Batal --}}
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ url('admin/kursus') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
                <!-- End Form -->
            </div>
        </div>
    </section>
@endsection

@extends('layouts.admin_layout')

@section('content')
    {{-- @Page Title --}}
    <div class="pagetitle">
        <h1>Peserta</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/peserta') }}">Data Peserta</a></li>
                <li class="breadcrumb-item active">{{ $form }} Peserta</li>
            </ol>
        </nav>
    </div>

    {{-- @Section Content --}}
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Form {{ $form }} Peserta</h5>

                <!-- Start Form -->
                <form action="{{ $url }}" class="row g-3 @if ($errors->any()) validated @endif"
                    method="POST">
                    @csrf

                    {{-- Nama Lengkap Input --}}
                    <div class="col-12">
                        <label for="nama_peserta" class="form-label">Nama Lengkap</label>
                        <input name="nama_peserta" value="{{ old('nama_peserta', $peserta->nama_peserta ?? '') }}" type="text"
                            class="form-control @error('nama_peserta') is-invalid @enderror" id="nama_peserta"
                            placeholder="Masukkan Nama Lengkap Peserta">
                        @error('nama_peserta')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Alamat Input --}}
                    <div class="col-12">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input name="alamat" value="{{ old('alamat', $peserta->alamat ?? '') }}" type="alamat"
                            class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                            placeholder="Masukkan Alamat Peserta">
                        @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Telephone Input --}}
                    <div class="col-12">
                        <label for="telp" class="form-label">No Telephone</label>
                        <input name="telp" value="{{ old('telp', $peserta->telp ?? '') }}" type="text"
                            class="form-control @error('telp') is-invalid @enderror" id="telp"
                            placeholder="Masukkan No Telephone Peserta">
                        @error('telp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Akun Selection --}}
                    <div class="col-12">
                        <label for="id_akun" class="form-label">Akun</label>
                        <select name="id_akun" class="form-select @error('id_akun') is-invalid @enderror" id="id_akun">
                            <option value="">Pilih Akun</option>
                            @foreach ($list_akun as $item)
                                <option value="{{ $item->id_akun }}" @if (old('id_akun', $peserta->id_akun ?? '') == $item->id_akun) selected @endif>
                                    {{ $item->username }}</option>
                            @endforeach
                        </select>
                        @error('id_akun')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Tombol Simpan dan Batal --}}
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ url('admin/peserta') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
                <!-- End Form -->
            </div>
        </div>
    </section>
@endsection

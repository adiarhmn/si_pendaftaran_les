@extends('layouts.admin_layout')

@section('content')
    {{-- @Page Title --}}
    <div class="pagetitle">
        <h1>Petugas</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/petugas') }}">Data Petugas</a></li>
                <li class="breadcrumb-item active">{{ $form }} Petugas</li>
            </ol>
        </nav>
    </div>

    {{-- @Section Content --}}
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Form {{ $form }} Petugas</h5>

                <!-- Start Form -->
                <form action="{{ $url }}" class="row g-3 @if ($errors->any()) validated @endif"
                    method="POST">
                    @csrf

                    {{-- Nama Lengkap Input --}}
                    <div class="col-12">
                        <label for="nama_petugas" class="form-label">Nama Lengkap</label>
                        <input name="nama_petugas" value="{{ old('nama_petugas', $akun->nama_petugas ?? '') }}"
                            type="text" class="form-control @error('nama_petugas') is-invalid @enderror"
                            id="nama_petugas" placeholder="Masukkan Nama Lengkap Petugas">
                        @error('nama_petugas')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Alamat Input --}}
                    <div class="col-12">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input name="alamat" value="{{ old('alamat') }}" type="alamat"
                            class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                            placeholder="Masukkan Alamat Petugas">
                        @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Telephone Input --}}
                    <div class="col-12">
                        <label for="telp" class="form-label">No Telephone</label>
                        <input name="telp" value="{{ old('telp') }}" type="text"
                            class="form-control @error('telp') is-invalid @enderror" id="telp"
                            placeholder="Masukkan No Telephone Petugas">
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
                                <option value="{{ $item->id_akun }}" @if (old('id_akun', $akun->id_akun ?? '') == $item->id_akun) selected @endif>
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
                        <button type="reset" class="btn btn-secondary">Batal</button>
                    </div>
                </form>
                <!-- End Form -->
            </div>
        </div>
    </section>
@endsection

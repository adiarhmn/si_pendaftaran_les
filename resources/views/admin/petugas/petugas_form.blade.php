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

                    {{-- Username --}}
                    <div class="col-12">
                        <label for="username" class="form-label">Username</label>
                        <input name="username" value="{{ old('username', $petugas->akun->username ?? '') }}" type="text"
                            class="form-control @error('username') is-invalid @enderror" id="username"
                            placeholder="Masukkan Username">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="col-12">
                        <label for="password" class="form-label">Password</label>
                        <input name="password" value="{{ old('password') }}" type="password"
                            class="form-control @error('password') is-invalid @enderror" id="password"
                            placeholder="***********">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Nama Lengkap Input --}}
                    <div class="col-12">
                        <label for="nama_petugas" class="form-label">Nama Lengkap</label>
                        <input name="nama_petugas" value="{{ old('nama_petugas', $petugas->nama_petugas ?? '') }}"
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
                        <input name="alamat" value="{{ old('alamat', $petugas->alamat ?? '') }}" type="alamat"
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
                        <input name="telp" value="{{ old('telp', $petugas->telp ?? '') }}" type="text"
                            class="form-control @error('telp') is-invalid @enderror" id="telp"
                            placeholder="Masukkan No Telephone Petugas">
                        @error('telp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- id_akun Hidden --}}
                    <input type="hidden" name="id_akun" value="{{ $petugas->id_akun ?? '' }}">

                    {{-- Tombol Simpan dan Batal --}}
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ url('admin/petugas') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
                <!-- End Form -->
            </div>
        </div>
    </section>
@endsection

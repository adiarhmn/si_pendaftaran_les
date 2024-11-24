@extends('layouts.peserta_layout')

@section('content')
    {{-- @Page Title --}}
    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('peserta/profile') }}">Profile Peserta</a></li>
            </ol>
        </nav>
    </div>

    {{-- @Section Content --}}
    <section class="section">
        <div class="card">
            <div class="card-body pt-3">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">

                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab"
                            data-bs-target="#profile-overview">Overview</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                    </li>
                </ul>
                <div class="tab-content pt-2">

                    <div class="tab-pane fade profile-overview @if (!$errors->any()) active show @endif"
                        id="profile-overview">
                        <h5 class="card-title">Data Profile Saya</h5>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">Username</th>
                                <td>:</td>
                                <td>{{ $peserta->akun->username ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Nama Lengkap</th>
                                <td>:</td>
                                <td>{{ $peserta->nama_peserta ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Alamat</th>
                                <td>:</td>
                                <td>{{ $peserta->alamat ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">No Telephone</th>
                                <td>:</td>
                                <td>{{ $peserta->telp ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>

                    </div>

                    <div class="tab-pane fade profile-edit pt-3 @if ($errors->any()) active show @endif"
                        id="profile-edit">

                        <!-- Profile Edit Form -->
                        <form action="{{ 'profile/' . Auth::user()->peserta->id_peserta }}"
                            class="row g-3 @if ($errors->any()) validated @endif" method="POST">
                            @csrf

                            {{-- Username --}}
                            <div class="col-12">
                                <label for="username" class="form-label">Username</label>
                                <input name="username" value="{{ old('username', $peserta->akun->username ?? '') }}"
                                    type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" placeholder="Masukkan Username">
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
                                <label for="nama_peserta" class="form-label">Nama Lengkap</label>
                                <input name="nama_peserta" value="{{ old('nama_peserta', $peserta->nama_peserta ?? '') }}"
                                    type="text" class="form-control @error('nama_peserta') is-invalid @enderror"
                                    id="nama_peserta" placeholder="Masukkan Nama Lengkap Peserta">
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

                            {{-- Tombol Simpan dan Batal --}}
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ url('admin/peserta') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>

                </div><!-- End Bordered Tabs -->

            </div>
        </div>
    </section>

    {{-- NOTIFIKASI SWEETALERT --}}
    @include('components.notifications')
@endsection

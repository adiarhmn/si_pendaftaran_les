@extends('layouts.admin_layout')

@section('content')
    {{-- @Page Title --}}
    <div class="pagetitle">
        <h1>Akun</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/akun') }}">Data Akun</a></li>
                <li class="breadcrumb-item active">{{ $form }} Akun</li>
            </ol>
        </nav>
    </div>

    {{-- @Section Content --}}
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Form {{ $form }} Akun</h5>

                <!-- Start Form -->
                <form action="{{ $url }}" class="row g-3 @if ($errors->any()) validated @endif"
                    method="POST">
                    @csrf

                    {{-- Username Input --}}
                    <div class="col-12">
                        <label for="username" class="form-label">Username</label>
                        <input name="username" value="{{ old('username', $akun->username ?? '') }}" type="text"
                            class="form-control @error('username') is-invalid @enderror" id="username"
                            placeholder="Masukkan Username">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Password Input --}}
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

                    {{-- Level Selection --}}
                    <div class="col-12">
                        <label for="level" class="form-label">Level</label>
                        <select name="level" class="form-select @error('level') is-invalid @enderror" id="level">
                            <option value="">Pilih Level</option>
                            <option value="admin" @if (old('level', $akun->level ?? '') == 'admin') selected @endif>Admin
                            </option>
                            <option value="petugas" @if (old('level', $akun->level ?? '') == 'petugas') selected @endif>Petugas
                            </option>
                            <option value="peserta" @if (old('level', $akun->level ?? '') == 'peserta') selected @endif>Peserta
                            </option>
                        </select>
                        @error('level')
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

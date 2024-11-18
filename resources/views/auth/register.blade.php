@extends('layouts.auth_layout')
@section('content')
    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">NiceAdmin</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                        <p class="text-center small">Enter your personal details to create account</p>
                                    </div>

                                    {{-- <form class="row g-3 needs-validation" novalidate>
                                        <div class="col-12">
                                            <label for="yourName" class="form-label">Nama lengkap</label>
                                            <input type="text" name="name" class="form-control" id="yourName"
                                                required>
                                            <div class="invalid-feedback">Please, enter your name!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourEmail" class="form-label">Your Email</label>
                                            <input type="email" name="email" class="form-control" id="yourEmail"
                                                required>
                                            <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Username</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="text" name="username" class="form-control" id="yourUsername"
                                                    required>
                                                <div class="invalid-feedback">Please choose a username.</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="yourPassword"
                                                required>
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" name="terms" type="checkbox"
                                                    value="" id="acceptTerms" required>
                                                <label class="form-check-label" for="acceptTerms">I agree and accept the <a
                                                        href="#">terms and conditions</a></label>
                                                <div class="invalid-feedback">You must agree before submitting.</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Create Account</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Already have an account? <a href="pages-login.html">Log
                                                    in</a></p>
                                        </div>
                                    </form> --}}

                                    <!-- Start Form -->
                                    <form action="{{ $url ?? '' }}"
                                        class="row g-3 @if ($errors->any()) validated @endif" method="POST">
                                        @csrf

                                        {{-- Username --}}
                                        <div class="col-12">
                                            <label for="username" class="form-label">Username</label>
                                            <input name="username"
                                                value="{{ old('username', $peserta->akun->username ?? '') }}" type="text"
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
                                            <label for="nama_peserta" class="form-label">Nama Lengkap</label>
                                            <input name="nama_peserta"
                                                value="{{ old('nama_peserta', $peserta->nama_peserta ?? '') }}"
                                                type="text"
                                                class="form-control @error('nama_peserta') is-invalid @enderror"
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
                                            <input name="alamat" value="{{ old('alamat', $peserta->alamat ?? '') }}"
                                                type="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                                id="alamat" placeholder="Masukkan Alamat Peserta">
                                            @error('alamat')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Telephone Input --}}
                                        <div class="col-12">
                                            <label for="telp" class="form-label">No Telephone</label>
                                            <input name="telp" value="{{ old('telp', $peserta->telp ?? '') }}"
                                                type="text" class="form-control @error('telp') is-invalid @enderror"
                                                id="telp" placeholder="Masukkan No Telephone Peserta">
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
                                    <!-- End Form -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main><!-- End #main -->



    {{-- NOTIFIKASI SWEETALERT --}}
    @include('components.notifications')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
@endsection

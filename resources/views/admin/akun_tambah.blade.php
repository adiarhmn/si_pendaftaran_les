@extends('layouts.admin_layout')

@section('content')
    {{-- @Page Title --}}
    <div class="pagetitle">
        <h1>Akun</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/akun') }}">Data Akun</a></li>
                <li class="breadcrumb-item active">Tambah Akun</li>
            </ol>
        </nav>
    </div>

    {{-- @Section Content --}}
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Form Tambah Akun</h5>

                <!-- Start Form -->
                <form action="{{ url('admin/akun/store') }}"
                    class="row g-3 @if ($errors->any()) validated @endif" method="POST">
                    @csrf
                    <div class="col-12">
                        <label for="username" class="form-label">Username</label>
                        <input name="username" value="{{ old('username') }}" type="text" class="form-control @error('username') is-invalid @enderror"
                            id="username" placeholder="Masukkan Username" >
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="password" class="form-label">Password</label>
                        <input name="password" value="{{ old('password') }}" type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" placeholder="***********">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

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

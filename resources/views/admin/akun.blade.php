@extends('layouts.admin_layout')

@section('content')
    {{-- @Page Title --}}
    <div class="pagetitle">
        <h1>Akun</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/akun') }}">Data Akun</a></li>
            </ol>
        </nav>
    </div>

    {{-- @Section Content --}}
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Daftar Data Akun</h5>
                    <a href="{{ url('admin/akun/create') }}" class="btn btn-primary">Tambah Akun</a>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Username</th>
                            <th scope="col">Password</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Brandon Jacob</td>
                            <td>Designer</td>
                            <td>
                                <a href="{{ url('admin/akun/1/edit') }}" class="btn btn-warning">Edit</a>
                                <button type="button" class="btn btn-danger"
                                    onclick="confirmDelete('Adi', '{{ url('admin/akun/delete/1') }}')">Hapus</button>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

{{-- Fungsi Delete --}}
@section('script')
    @include('components/notifications')
    @include('components/confirm_delete')
@endsection

@extends('layouts.admin_layout')

@section('content')
    {{-- @Page Title --}}
    <div class="pagetitle">
        <h1>Petugas</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/petugas') }}">Data Petugas</a></li>
            </ol>
        </nav>
    </div>

    {{-- @Section Content --}}
    <section class="section">
        <div class="card">
            <div class="card-body">

                {{-- @Header Card --}}
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Daftar Data Petugas</h5>
                    <a href="{{ url('admin/petugas/create') }}" class="btn btn-primary">Tambah Petugas</a>
                </div>


                {{-- @Search Bar --}}
                <form class="input-group mb-3" style="max-width:350px; " action="{{ url()->current() }}">
                    <input value="{{ request()->query('query') }}" type="text" name="query" type="text"
                        class="form-control" placeholder="Cari..." aria-label="Cari..." aria-describedby="button-addon2">
                    <button class="btn btn-outline-primary" type="submit" id="button-addon2"><i
                            class="bi bi-search"></i></button>
                </form>

                {{-- @Table --}}
                <table class="table border">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Lengkap</th>
                            <th scope="col">No Telephone</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Username</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_petugas as $index => $item)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $item->nama_petugas }}</td>
                                <td>{{ $item->telp }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->akun->username }}</td>
                                <td>
                                    <a href="{{ url('admin/petugas/edit/' . $item->id_petugas) }}"
                                        class="btn btn-warning">Edit</a>
                                    <button type="button" class="btn btn-danger"
                                        onclick="confirmDelete('{{ $item->nama_petugas }}', '{{ url('admin/petugas/delete/' . $item->id_petugas) }}')">Hapus</button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- End Table --}}

                {{-- @Jika Data Tidak Ada --}}
                @if (count($list_petugas) == 0)
                    <div class="alert alert-warning text-center">Data Tidak Ditemukan</div>
                @endif

                {{-- Paginate --}}
                {{ $list_petugas->appends(request()->query())->links('components/pagination') }}

            </div>
        </div>
    </section>
@endsection

{{-- @Fungsi Delete --}}
@section('script')
    @include('components/notifications')
    @include('components/confirm_delete')
@endsection

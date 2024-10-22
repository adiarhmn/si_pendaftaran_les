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
                {{-- @Head Card --}}
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Daftar Data Akun</h5>
                    <a href="{{ url('admin/akun/create') }}" class="btn btn-primary">Tambah Akun</a>
                </div>

                {{-- @Search Bar --}}
                <form class="input-group mb-3" style="max-width:350px; " action="{{ url()->current() }}">
                    <input value="{{ request()->query('query') }}" type="text" name="query" type="text"
                        class="form-control" placeholder="Cari..." aria-label="Cari..." aria-describedby="button-addon2">
                    <button class="btn btn-outline-primary" type="submit" id="button-addon2"><i
                            class="bi bi-search"></i></button>
                </form>

                {{-- @Table --}}
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Username</th>
                            <th scope="col">Password</th>
                            <th scope="col">Level</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_akun as $index => $item)
                            <tr>
                                <th scope="row">{{ $index + 1 + (($_GET['page'] ?? 1) - 1) * 5 }}</th>
                                <td>{{ $item->username }}</td>
                                <td>Password Hidden</td>
                                <td>{{ $item->level }}</td>
                                <td>
                                    <a href="{{ url('admin/akun/edit/' . $item->id_akun) }}"
                                        class="btn btn-warning">Edit</a>
                                    <button type="button" class="btn btn-danger"
                                        onclick="confirmDelete('{{ $item->username }}', '{{ url('admin/akun/delete/' . $item->id_akun) }}')">Hapus</button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- End Table --}}

                {{-- Paginate --}}
                {{ $list_akun->appends(request()->query())->links('components/pagination') }}
            </div>
        </div>
    </section>
@endsection

{{-- @Fungsi Delete --}}
@section('script')
    @include('components/notifications')
    @include('components/confirm_delete')
@endsection

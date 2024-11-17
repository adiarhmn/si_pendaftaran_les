@extends('layouts.admin_layout')

@section('content')
    {{-- @Page Title --}}
    <div class="pagetitle">
        <h1>Kursus</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/kursus') }}">Data Kursus</a></li>
            </ol>
        </nav>
    </div>

    {{-- @Section Content --}}
    <section class="section">
        <div class="card">
            <div class="card-body">
                {{-- @Head Card --}}
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Daftar Data Kursus</h5>
                    <a href="{{ url('admin/kursus/create') }}" class="btn btn-primary">Tambah Kursus</a>
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
                            <th scope="col">Cover</th>
                            <th scope="col">Nama Kursus</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Durasi</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Jumlah Peserta</th>
                            <th scope="col">Status Kursus</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_kursus as $index => $item)
                            <tr>
                                <th scope="row">{{ $index + 1 + (($_GET['page'] ?? 1) - 1) * 5 }}</th>
                                <td>
                                    <img src="{{ url('images/' . $item->gambar_cover) }}" alt="{{ $item->nama_kursus }}"
                                        style="width: 50px;">
                                </td>
                                <td>{{ $item->nama_kursus }}</td>
                                <td>{{ rupiah($item->harga) }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>{{ $item->durasi }}</td>
                                <td>{{ $item->tanggal_mulai }} - {{ $item->tanggal_selesai }}</td>
                                <td>{{ $item->jumlah_peserta }}</td>
                                <td>
                                    <span
                                        class="badge rounded-pill 
                                        @if ($item->status_kursus == 'open') bg-primary 
                                        @else bg-danger @endif">
                                        {{ $item->status_kursus }}
                                    </span>
                                </td>
                                <td>
                                    <button type="button"
                                        class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="visually-hidden">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ url('admin/kursus/edit/' . $item->id_kursus) }}"
                                                class="dropdown-item">Edit</a>
                                        </li>
                                        <li>
                                            <button type="button" class="dropdown-item"
                                                onclick="confirmDelete('{{ $item->nama_kursus }}', '{{ url('admin/kursus/delete/' . $item->id_kursus) }}')">Hapus</button>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- End Table --}}

                {{-- @Jika Data Tidak Ada --}}
                @if (count($list_kursus) == 0)
                    <div class="alert alert-warning text-center">Data Tidak Ditemukan</div>
                @endif

                {{-- Paginate --}}
                {{ $list_kursus->appends(request()->query())->links('components/pagination') }}
            </div>
        </div>
    </section>
@endsection

{{-- @Fungsi Delete --}}
@section('script')
    @include('components/notifications')
    @include('components/confirm_delete')
@endsection

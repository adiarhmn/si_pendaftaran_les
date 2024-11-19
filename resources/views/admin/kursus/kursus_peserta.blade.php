@extends('layouts.admin_layout')

@section('content')
    {{-- @Page Title --}}
    <div class="pagetitle">
        <h1>Peserta Kursus</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/peserta') }}">Data Peserta Kursus</a></li>
            </ol>
        </nav>
    </div>

    {{-- SECTION KURSUS DETAIL --}}
    <section class="section">
        <div class="card">
            <div class="card-body pt-3">
                <h5 class="fw-bold m-0">Detail Kursus</h5>
                <div class="row">
                    <div class="col-md-2">
                        <img src={{ asset('images/' . $kursus->gambar_cover) }} alt="" style="width:100%;">
                    </div>
                    <div class="col-md-10">
                        <table style="width: 100%;">
                            <tr>
                                <td>Nama Kursus</td>
                                <td>:</td>
                                <td>{{ $kursus->nama_kursus }}</td>
                            </tr>
                            <tr>
                                <td>Deskripsi</td>
                                <td>:</td>
                                <td>{{ $kursus->deskripsi }}</td>
                            </tr>
                            <tr>
                                <td>Pengajar / Petugas</td>
                                <td>:</td>
                                <td>{{ $kursus->petugas->nama_petugas }}</td>
                            </tr>
                            <tr>
                                <td>Durasi</td>
                                <td>:</td>
                                <td>{{ $kursus->durasi }} jam</td>
                            </tr>
                            <tr>
                                <td>Tanggal Mulai</td>
                                <td>:</td>
                                <td>{{ $kursus->tanggal_mulai }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Selesai</td>
                                <td>:</td>
                                <td>{{ $kursus->tanggal_selesai }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- @Section Content --}}
    <section class="section">
        <div class="card">
            <div class="card-body">

                {{-- @Header Card --}}
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Daftar Data Peserta Kursus</h5>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#tambahPesertaModal">
                        Tambah Peserta
                    </button>
                </div>

                {{-- Modal Tambah Peserta --}}
                <!-- Modal -->
                <div class="modal fade" id="tambahPesertaModal" tabindex="-1" aria-labelledby="tambahPesertaModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tambahPesertaModalLabel">Tambah Peserta</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ url('admin/kursus/peserta/store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" name="id_kursus" value={{ $kursus->id_kursus }}>
                                    <div class="mb-3">
                                        <label for="peserta" class="form-label">Pilih Peserta</label>
                                        <select class="form-select" id="peserta" name="id_peserta" required>
                                            <option value="" selected disabled>Pilih Peserta</option>
                                            @foreach ($list_peserta_free as $peserta)
                                                <option value="{{ $peserta->id_peserta }}">{{ $peserta->nama_peserta }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
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
                            <th scope="col">Status Kursus</th>
                            <th scope="col">Status Pembayaran</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_peserta as $index => $item)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $item->peserta->nama_peserta }}</td>
                                <td>{{ $item->peserta->telp }}</td>
                                <td>{{ $item->peserta->alamat }}</td>
                                <td>
                                    <span style="text-transform: uppercase;"
                                        class="badge rounded-pill @if ($item->status_peserta == 'approved') bg-primary @else bg-danger @endif">
                                        {{ $item->status_peserta_kursus }}
                                    </span>
                                </td>
                                <td>
                                    <span style="text-transform: uppercase;"
                                        class="badge rounded-pill @if ($item->status_pembayaran == 'approved') bg-primary @else bg-danger @endif">
                                        {{ $item->status_pembayaran }}
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
                                            <a href="{{ url('admin/kursus/peserta/' . $item->id_kursus) }}"
                                                class="dropdown-item">
                                                <div class="btn btn-primary btn-sm w-100">Terima</div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('admin/kursus/peserta/' . $item->id_kursus) }}"
                                                class="dropdown-item">
                                                <div class="btn btn-warning btn-sm w-100">Tolak</div>
                                            </a>
                                        </li>
                                        <li>
                                            <button type="button" class="dropdown-item">
                                                <div class="btn btn-danger btn-sm w-100">Hapus</div>
                                            </button>
                                        </li>
                                    </ul>
                                </td>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- End Table --}}

                {{-- @Jika Data Tidak Ada --}}
                @if (count($list_peserta) == 0)
                    <div class="alert alert-warning text-center">Data Tidak Ditemukan</div>
                @endif

                {{-- Paginate --}}
                {{-- {{ $list_peserta->appends(request()->query())->links('components/pagination') }} --}}

            </div>
        </div>
    </section>
@endsection

{{-- @Fungsi Delete --}}
@section('script')
    @include('components/notifications')
    @include('components/confirm_delete')
@endsection

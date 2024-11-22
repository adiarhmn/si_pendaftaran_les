@extends('layouts.admin_layout')

@section('content')
    {{-- @Page Title --}}
    <div class="pagetitle">
        <h1>Pembayaran</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/pembayaran') }}">Data Pembayaran</a></li>
            </ol>
        </nav>
    </div>

    {{-- @Section Content --}}
    <section class="section">
        <div class="card">
            <div class="card-body">
                {{-- @Head Card --}}
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Daftar Data Pembayaran</h5>
                </div>

                {{-- @Search Bar --}}
                <form class="input-group mb-3" style="max-width:350px; " action="{{ url()->current() }}">
                    <input value="{{ request()->query('query') }}" type="text" name="query" type="text"
                        class="form-control" placeholder="Cari..." aria-label="Cari..." aria-describedby="button-addon2">
                    <button class="btn btn-outline-primary" type="submit" id="button-addon2"><i
                            class="bi bi-search"></i></button>
                </form>

                {{-- @Table Pembayaran --}}
                <table class="table border" style="font-size: 12px;">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Username</th>
                            <th scope="col">Nama Peserta</th>
                            <th scope="col">Nama Kursus</th>
                            <th scope="col">Total Pembayaran</th>
                            <th scope="col">Status</th>
                            <th scope="col">Bukti</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_pembayaran as $index => $item)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $item->pesertaKursus->peserta->akun->username }}</td>
                                <td>{{ $item->pesertaKursus->peserta->nama_peserta }}</td>
                                <td>{{ $item->pesertaKursus->kursus->nama_kursus }}</td>
                                <td>{{ rupiah($item->total_pembayaran) }}</td>
                                <td style="text-transform: uppercase">
                                    @if ($item->status_pembayaran == 'pending')
                                        <span class="badge bg-warning text-dark">{{ $item->status_pembayaran }}</span>
                                    @elseif ($item->status_pembayaran == 'lunas')
                                        <span class="badge bg-success">{{ $item->status_pembayaran }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ $item->status_pembayaran }}</span>
                                    @endif
                                </td>
                                <td>
                                    <!-- Button to trigger modal -->
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#buktiPembayaranModal{{ $item->id_pembayaran }}">
                                        <i class="bi bi-eye"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="buktiPembayaranModal{{ $item->id_pembayaran }}" tabindex="-1" aria-labelledby="buktiPembayaranModalLabel{{ $item->id_pembayaran }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="buktiPembayaranModalLabel{{ $item->id_pembayaran }}">Bukti Pembayaran</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body d-flex justify-content-center">
                                                    <img src="{{ asset('images/bukti_pembayaran/' . $item->bukti_pembayaran) }}" class="img-fluid" alt="Bukti Pembayaran">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{-- Dropdown --}}
                                    <button type="button"
                                        class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="visually-hidden">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <form action="{{ url('admin/pembayaran/konfirmasi') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id_pembayaran"
                                                    value="{{ $item->id_pembayaran }}">
                                                <input type="hidden" name="status_pembayaran" value="lunas">
                                                <button type="submit" class="dropdown-item">Terima</button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="{{ url('admin/pembayaran/konfirmasi') }}">
                                                @csrf
                                                <input type="hidden" name="id_pembayaran"
                                                    value="{{ $item->id_pembayaran }}">
                                                <input type="hidden" name="status_pembayaran" value="gagal">
                                                <button type="submit" class="dropdown-item">Tolak</button>
                                            </form>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- End Table --}}

                {{-- @Jika Data Tidak Ada --}}
                @if (count($list_pembayaran) == 0)
                    <div class="alert alert-warning text-center">Data Tidak Ditemukan</div>
                @endif

                {{-- Paginate --}}
                {{-- {{ $list_akun->appends(request()->query())->links('components/pagination') }} --}}
            </div>
        </div>
    </section>
@endsection

{{-- @Fungsi Delete --}}
@section('script')
    @include('components/notifications')
    @include('components/confirm_delete')
@endsection

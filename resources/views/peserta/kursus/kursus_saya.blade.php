@use('Carbon\Carbon')
@extends('layouts.peserta_layout')
@section('script-head')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key={{ config('app.midtrans.clientKey') }}></script>
@endsection
@section('content')
    {{-- @Page Title --}}
    <div class="pagetitle">
        <h1>Kursus Saya</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/kursus') }}">Data Kursus Saya</a></li>
            </ol>
        </nav>
    </div>


    <section class="section">
        @foreach ($list_kursus as $index => $item)
            <div class="card">
                <div class="card-body pt-3">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <img src={{ asset('images/' . $item->kursus->gambar_cover) }} alt="" style="width:100%;">
                        </div>
                        <div class="col-md-9">
                            {{-- Kursus --}}
                            <div class="d-flex gap-1 mb-2">
                                <h5 class="fw-bold m-0">{{ $item->kursus->nama_kursus }}</h5>
                                {{-- Status Kursus --}}
                                @if ($item->status_pelatihan == 'berlangsung')
                                    <span class="badge bg-primary text-capitalize">{{ $item->status_pelatihan }}</span>
                                @elseif ($item->status_pelatihan == 'Belum Dimulai')
                                    <span class="badge bg-warning text-capitalize">{{ $item->status_pelatihan }}</span>
                                @else
                                    <span class="badge bg-danger text-capitalize">{{ $item->status_pelatihan }}</span>
                                @endif
                            </div>
                            <div class="m-0" style="font-size: 12px">
                                {!! $item->kursus->deskripsi !!}
                            </div>
                            <table style="width: 100%; font-size: 12px; margin-bottom: 10px">
                                <tbody>
                                    <tr>
                                        <td style="width: 200px;">Pengajar / Petugas</td>
                                        <td>:</td>
                                        <td>{{ $item->kursus->petugas->nama_petugas }}</td>
                                    </tr>
                                    <tr>
                                        <td>Durasi</td>
                                        <td>:</td>
                                        <td>{{ $item->kursus->durasi }} JP</td>
                                    </tr>
                                    <tr>
                                        <td>Harga Pelatihan</td>
                                        <td>:</td>
                                        <td>Rp. {{ number_format($item->kursus->harga, 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            {{-- Pembayaran --}}
                            <h5 class="fw-bold m-0">Pembayaran</h5>
                            <table style="width: 100%; font-size: 12px;">
                                <tbody>
                                    <tr>
                                        <td style="width: 200px;">Tenggat Pembayaran</td>
                                        <td>:</td>
                                        @if ($item->tgl_tenggat_pembayaran != null)
                                            <td
                                                class="fw-bold {{ $item->tgl_tenggat_pembayaran < date('Y-m-d') ? 'text-danger' : '' }}">

                                                {{ Carbon::parse($item->tgl_tenggat_pembayaran)->translatedFormat('d F Y') }}
                                            </td>
                                        @else
                                            <td>
                                                -
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Sisa Tagihan</td>
                                        <td>:</td>
                                        <td>Rp. {{ number_format($item->total_tagihan, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total Dibayar</td>
                                        <td>:</td>
                                        <td>Rp. {{ number_format($item->total_pembayaran, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status Pembayaran</td>
                                        <td>:</td>
                                        <td>
                                            @if ($item->status_pembayaran == 'lunas')
                                                <span
                                                    class="badge bg-success text-capitalize">{{ $item->status_pembayaran }}
                                                </span>
                                            @else
                                                <span
                                                    class="badge bg-warning text-capitalize">{{ $item->status_pembayaran }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            {{-- Tombol Bayar --}}
                            <div class="d-flex mt-3">

                                @if ($item->status_pembayaran != 'lunas')
                                    {{-- Bayar Full --}}
                                    <form action="{{ url('peserta/buat-token-pembayaran') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id_peserta_kursus"
                                            value="{{ $item->id_peserta_kursus }}">
                                        <input type="hidden" name="pembayaran" value="100%">
                                        <button type="submit" class="btn btn-primary btn-sm">Bayar 100%</button>
                                    </form>
                                @endif

                                @if ($item->total_pembayaran <= 0)
                                    {{-- Bayar Sebagian --}}
                                    <form action="{{ url('peserta/buat-token-pembayaran') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id_peserta_kursus"
                                            value="{{ $item->id_peserta_kursus }}">
                                        <input type="hidden" name="pembayaran" value="50%">
                                        <button type="submit" class="btn btn-primary btn-sm ms-2">Bayar 50%</button>
                                    </form>
                                @endif

                                {{-- Tombol Modal Riwayat Pembayaran --}}
                                <button class="btn btn-info btn-sm ms-2" data-bs-toggle="modal"
                                    data-bs-target="#riwayatPembayaranModal{{ $item->id_peserta_kursus }}">Riwayat
                                    Pembayaran</button>
                                <!-- Modal Riwayat Pembayaran -->
                                <div class="modal fade" id="riwayatPembayaranModal{{ $item->id_peserta_kursus }}"
                                    tabindex="-1" aria-labelledby="riwayatPembayaranModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="riwayatPembayaranModalLabel">Riwayat Pembayaran
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table table-bordered" style="font-size: 12px">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Tanggal Pembayaran</th>
                                                            <th>Jumlah Pembayaran</th>
                                                            {{-- Bukti Pembayaran --}}
                                                            <th>Bukti Pembayaran</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($item->pembayaran as $index => $pembayaran)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>{{ Carbon::parse($pembayaran->tanggal_pembayaran)->translatedFormat('d F Y') }}
                                                                </td>
                                                                <td>Rp.
                                                                    {{ number_format($pembayaran->total_pembayaran, 0, ',', '.') }}
                                                                </td>
                                                                <td>
                                                                    @if ($pembayaran->bukti_pembayaran)
                                                                        {{-- Jika Bukti Pembayaran adalah Datetime bukan file maka dari Midatrans --}}
                                                                        <a href="{{ asset('images/bukti_pembayaran/' . $pembayaran->bukti_pembayaran) }}"
                                                                            target="_blank">Lihat Bukti</a>
                                                                    @else
                                                                        <span>
                                                                            Midtrans Payment
                                                                        </span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($pembayaran->status_pembayaran == 'pending')
                                                                        <span
                                                                            class="badge bg-warning text-dark">{{ $pembayaran->status_pembayaran }}</span>
                                                                    @elseif ($pembayaran->status_pembayaran == 'lunas')
                                                                        <span
                                                                            class="badge bg-success">{{ $pembayaran->status_pembayaran }}</span>
                                                                    @else
                                                                        <span
                                                                            class="badge bg-danger">{{ $pembayaran->status_pembayaran }}</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Tombol Batalkan --}}
                                @if ($item->status_pembayaran == 'Belum Lunas')
                                    <button class="btn btn-danger btn-sm ms-2" data-bs-toggle="modal"
                                        data-bs-target="#confirmDeleteModal{{ $item->id }}">Batalkan</button>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
@endsection

{{-- @Fungsi Delete --}}
@section('script')
    @include('components/notifications')
    @include('components/confirm_delete')
    @include('components/midtrans_popup')
@endsection

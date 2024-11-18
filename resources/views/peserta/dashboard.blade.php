@extends('layouts.peserta_layout')

@section('content')
    {{-- @Page Title --}}
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('peserta/dashboard') }}">Dashboard Peserta</a></li>
            </ol>
        </nav>
    </div>

    {{-- @Section Content --}}
    <section class="section">

    </section>

    {{-- NOTIFIKASI SWEETALERT --}}
    @include('components.notifications')
@endsection

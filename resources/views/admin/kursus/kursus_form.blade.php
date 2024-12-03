@extends('layouts.admin_layout')
@section('style')
    {{-- CKEDITOR5 STYLE CUSTOM --}}
    <link rel="stylesheet" href="{{ url('/') }}/assets/ckeditor5/ckeditor5.css">
    <style>
        div[role="textbox"] {
            min-height: 400px;
        }
    </style>
@endsection

@section('content')
    {{-- @Page Title --}}
    <div class="pagetitle">
        <h1>Kursus</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/kursus') }}">Data Kursus</a></li>
                <li class="breadcrumb-item active">{{ $form }} Kursus</li>
            </ol>
        </nav>
    </div>

    {{-- @Section Content --}}
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Form {{ $form }} Kursus</h5>

                <!-- Start Form -->
                <form action="{{ $url }}" class="row g-3 @if ($errors->any()) validated @endif"
                    method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Nama Kursus (nama_kursus) --}}
                    <div class="col-12">
                        <label for="nama_kursus" class="form-label">Nama Kursus</label>
                        <input name="nama_kursus" value="{{ old('nama_kursus', $kursus->nama_kursus ?? '') }}"
                            type="text" class="form-control @error('nama_kursus') is-invalid @enderror" id="nama_kursus"
                            placeholder="Masukkan Nama Kursus">
                        @error('nama_kursus')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Harga (harga) --}}
                    <div class="col-12">
                        <label for="harga" class="form-label">Harga</label>
                        <input name="harga" value="{{ old('harga', $kursus->harga ?? '') }}" type="number"
                            class="form-control @error('harga') is-invalid @enderror" id="harga"
                            placeholder="Masukkan Harga Kursus">
                        @error('harga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Deskripsi (deskripsi) --}}
                    <div class="col-12">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        @error('deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <textarea id="editor" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi"
                            rows="3" placeholder="Masukkan Deskripsi Kursus"></textarea>
                    </div>

                    {{-- Durasi (durasi) --}}
                    <div class="col-12">
                        <label for="durasi" class="form-label">Durasi (x JP)</label>
                        <input name="durasi" value="{{ old('durasi', $kursus->durasi ?? '') }}" type="text"
                            class="form-control @error('durasi') is-invalid @enderror" id="durasi"
                            placeholder="Masukkan Durasi Kursus">
                        @error('durasi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Petugas Selection (id_petugas) --}}
                    <div class="col-12">
                        <label for="id_petugas" class="form-label">Petugas</label>
                        <select name="id_petugas" class="form-select @error('id_petugas') is-invalid @enderror"
                            id="id_petugas">
                            <option value="">Pilih Petugas</option>
                            @foreach ($list_petugas as $item)
                                <option value="{{ $item->id_petugas }}" @if (old('id_petugas', $kursus->id_petugas ?? '') == $item->id_petugas) selected @endif>
                                    {{ $item->nama_petugas }}</option>
                            @endforeach
                        </select>
                        @error('id_petugas')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Gambar Cover --}}
                    <div class="col-12">
                        <label for="gambar_cover" class="form-label">Gambar Cover</label>
                        <input name="gambar_cover" type="file"
                            class="form-control @error('gambar_cover') is-invalid @enderror" id="gambar_cover">
                        @error('gambar_cover')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Tombol Simpan dan Batal --}}
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ url('admin/kursus') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
                <!-- End Form -->
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ url('/') }}/assets/ckeditor5/ckeditor5.js"></script>
    <script type="importmap">
    {
        "imports": {
            "ckeditor5": "{{url('/')}}/assets/ckeditor5/ckeditor5.js",
            "ckeditor5/": "{{url('/')}}/assets/ckeditor5/"
        }
    }
</script>
    <script type="module">
        import {
            ClassicEditor,
            Essentials,
            Paragraph,
            Bold,
            Italic,
            Font,
            List, // Import the List plugin
            Heading,
            Alignment,
            Link,
            BlockQuote,
            MediaEmbed
        } from 'ckeditor5';

        ClassicEditor
            .create(document.querySelector('#editor'), {
                plugins: [Essentials, Paragraph, Bold, Italic, Font, List, Heading, Alignment, Link, BlockQuote,
                    MediaEmbed
                ],
                toolbar: [
                    'undo', 'redo', '|', 'bold', 'italic', 'heading', '|', 'fontColor', 'fontBackgroundColor', '|',
                    'bulletedList', 'numberedList', '|', 'alignment', '|', 'link', '|',
                    'blockQuote', '|', 'mediaEmbed',
                ]
            })
            .then(editor => {
                window.editor = editor;
                editor.setData(`{!! old('deskripsi', $kursus->deskripsi ?? '') !!}`);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection

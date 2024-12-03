@extends('layouts.user_layout')
@section('content')
    <main class="main">
        <section id="hero" class="hero section">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <h1 data-aos="fade-up" class="aos-init aos-animate">Pendaftaran Les</h1>
                        <p data-aos="fade-up" data-aos-delay="100" class="aos-init aos-animate">Batuah Talenta Semesta
                        </p>
                        <div class="d-flex flex-column flex-md-row aos-init aos-animate" data-aos="fade-up"
                            data-aos-delay="200">
                            <a href="#about" class="btn-get-started">Daftar Sekarang <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 hero-img aos-init aos-animate" data-aos="zoom-out">
                        <img src={{ asset('assets/flex-start/img/hero-img.png') }} class="img-fluid animated"
                            alt="">
                    </div>
                </div>
            </div>

        </section>


        {{-- SECTION KURSUS --}}
        <section id="courses" class="pricing section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Kursus</h2>
                <p>Daftar Pelatihan Batuah<br></p>
            </div><!-- End Section Title -->

            <div class="container">
                <div class="row gy-4">
                    @foreach ($list_kursus as $item)
                        <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                            <div class="pricing-tem">
                                <h3 style="color: #20c997;">{{ $item->nama_kursus }}</h3>
                                <div class="price">{{ rupiah($item->harga) }}</div>
                                <div class="icon">
                                    <img src={{ asset('images/' . $item->gambar_cover) }} alt=""
                                        style="width:100px;">
                                </div>
                                <a href={{ route('peserta.kursus.daftar_sekarang', $item->id_kursus) }}
                                    class="btn-buy">Daftar
                                    Sekarang</a>
                            </div>
                        </div><!-- End Pricing Item -->
                    @endforeach
                </div><!-- End pricing row -->
            </div>
        </section><!-- /Pricing Section -->
    </main>
@endsection

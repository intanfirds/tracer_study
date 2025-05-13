@extends('layouts.guest')

@section('content')
    <div class="in-height-300 py-5" style="margin-left: 2rem;">
        {{-- <h2 class="fw-bold mb-3">Welcome to Tracer Study</h2> --}}
        {{-- <p class="fw-bold text-white mt-1" style="font-size: 70px">Welcome to Tracer Study</p> --}}
        <div class="mt-0">
            <p class="text-white mb-0" style="font-size: 60px; font-weight: 900;">Welcome to Tracer Study!</p>
            <p class="text-white ms-2 fst-italic" style="font-size: 18px;">Dari Alumni, Untuk Kemajuan Institusi.</p>
        </div>
        <p class="mt-4 ms-2 text-dark" style="max-width: 720px; font-size: 18px;">
            Selamat datang di Laman Tracer Study Politeknik Negeri Malang.
            Laman ini digunakan untuk menghimpun data alumni sebagai bagian dari evaluasi dan pengembangan mutu pendidikan
            di Polinema.
            Melalui tracer study ini, kami berupaya mengetahui jejak karier lulusan serta memperoleh umpan balik guna
            meningkatkan kualitas pembelajaran dan relevansi kurikulum dengan dunia kerja.
        </p>
        {{-- <a href="" class="btn bg-dark btn-secondary ms-2 mt-4">Isi Kuesioner</a> --}}
        <a href="{{ url('/login') }}" class="btn bg-dark btn-secondary ms-2 mt-4">
            <i class="fa fa-sign-in-alt me-1"></i> Login
        </a>

        <!-- Gambar Alumni di Pojok Kanan Bawah -->
        <img src="{{ asset('images/3.png') }}" alt="Alumni"
            style="position: absolute; bottom: 5px; right: 50px; width: 450px; height: auto;">
    </div>
@endsection

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Tracer Study Polinema - Lacak Jejak Alumni</title>
    <meta name="description" content="Platform Tracer Study Politeknik Negeri Malang untuk melacak perkembangan karir alumni dan meningkatkan kualitas pendidikan.">
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!-- CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #3cdee7;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
            --success-color: #27ae60;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            scroll-behavior: smooth;
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 1.5rem 0 6rem;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path fill="rgba(255,255,255,0.03)" d="M0,0 L100,0 L100,100 L0,100 Z" /></svg>');
            background-size: cover;
            z-index: 1;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
        }
        
        .hero-title {
            font-weight: 800;
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .hero-subtitle {
            font-size: 1.35rem;
            opacity: 0.9;
            margin-bottom: 2.5rem;
            line-height: 1.6;
        }
        
        .btn-primary-custom {
            background-color: var(--accent-color);
            border: none;
            padding: 0.85rem 2.5rem;
            font-weight: 600;
            transition: all 0.4s ease;
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
            border-radius: 50px;
            letter-spacing: 0.5px;
        }
        
        .btn-primary-custom:hover {
            background-color: #c0392b;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(231, 76, 60, 0.4);
        }
        
        .feature-card {
            background: white;
            border-radius: 12px;
            padding: 2.5rem 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
            border: 1px solid rgba(0,0,0,0.03);
            position: relative;
            overflow: hidden;
        }
        
        .feature-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--secondary-color), var(--accent-color));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }
        
        .feature-card:hover::after {
            transform: scaleX(1);
        }
        
        .feature-icon {
            font-size: 3rem;
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .feature-card:hover .feature-icon {
            transform: scale(1.1);
            color: var(--accent-color);
        }
        
        .stats-section {
            background: linear-gradient(135deg, var(--dark-color) 0%, var(--primary-color) 100%);
            padding: 3rem 0;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .stat-item {
            padding: 2rem;
            border-radius: 10px;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(5px);
            transition: all 0.3s ease;
            border: 1px solid rgba(255,255,255,0.1);
        }
        
        .stat-item:hover {
            transform: translateY(-5px);
            background: rgba(255,255,255,0.15);
        }
        
        .stat-number {
            font-size: 3.5rem;
            font-weight: 800;
            color: white;
            line-height: 1;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: rgba(255,255,255,0.8);
            font-weight: 500;
            font-size: 1.1rem;
        }
        
        .alumni-image {
            position: relative;
            animation: float 6s ease-in-out infinite;
            filter: drop-shadow(0 15px 30px rgba(0,0,0,0.2));
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        
        .navbar {
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            background: rgba(255,255,255,0.98);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            padding: 0.5rem 0;
        }
        
        .navbar.scrolled {
            background: rgba(255,255,255,0.95);
            box-shadow: 0 5px 25px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            font-weight: 700;
            display: flex;
            align-items: center;
        }
        
        .navbar-brand img {
            height: 50px;
            transition: all 0.3s ease;
        }
        
        .navbar.scrolled .navbar-brand img {
            height: 50px;
        }
        
        .nav-link {
            font-weight: 500;
            position: relative;
            padding: 0.5rem 1rem;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 1rem;
            width: calc(100% - 2rem);
            height: 2px;
            background: var(--accent-color);
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.3s ease;
        }
        
        .nav-link:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }
        
        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 1.5rem;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 4px;
            background: linear-gradient(90deg, var(--secondary-color), var(--accent-color));
            border-radius: 2px;
        }
        
        .process-step {
            position: relative;
            padding-left: 80px;
            margin-bottom: 3rem;
        }
        
        .step-number {
            position: absolute;
            left: 0;
            top: 0;
            width: 60px;
            height: 60px;
            background: var(--secondary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
        }
        
        .testimonial-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            position: relative;
            margin: 1rem;
        }
        
        .testimonial-card::before {
            content: '"';
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 5rem;
            color: rgba(52, 152, 219, 0.1);
            font-family: Georgia, serif;
            line-height: 1;
        }
        
        .testimonial-text {
            position: relative;
            z-index: 1;
            font-style: italic;
            margin-bottom: 1.5rem;
        }
        
        .testimonial-author {
            display: flex;
            align-items: center;
        }
        
        .testimonial-author img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 1rem;
            border: 3px solid var(--secondary-color);
        }
        
        .cta-section {
            background: linear-gradient(135deg, var(--accent-color) 0%, #2b35c0 100%);
            color: white;
            padding: 6rem 0;
            position: relative;
            overflow: hidden;
        }
        
        .cta-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path fill="rgba(255,255,255,0.05)" d="M0,0 L100,0 L100,100 L0,100 Z" /></svg>');
            background-size: cover;
            z-index: 1;
        }
        
        .cta-content {
            position: relative;
            z-index: 2;
        }
        
        .faq-item {
            margin-bottom: 1rem;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .faq-question {
            background: white;
            padding: 1.5rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }
        
        .faq-question:hover {
            background: #f8f9fa;
        }
        
        .faq-question::after {
            content: '+';
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .faq-question.active::after {
            content: '-';
            color: var(--accent-color);
        }
        
        .faq-answer {
            background: white;
            padding: 0 1.5rem;
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .faq-answer.show {
            padding: 0 1.5rem 1.5rem;
            max-height: 500px;
        }
        
        .timeline {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .timeline::after {
            content: '';
            position: absolute;
            width: 4px;
            background: var(--secondary-color);
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -2px;
            border-radius: 2px;
        }
        
        .timeline-item {
            padding: 10px 40px;
            position: relative;
            width: 50%;
            box-sizing: border-box;
        }
        
        .timeline-item::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background: var(--accent-color);
            border-radius: 50%;
            top: 15px;
            z-index: 1;
        }
        
        .left {
            left: 0;
        }
        
        .right {
            left: 50%;
        }
        
        .left::after {
            right: -10px;
        }
        
        .right::after {
            left: -10px;
        }
        
        .timeline-content {
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            position: relative;
        }
        
        .timeline-content::before {
            content: '';
            position: absolute;
            width: 0;
            height: 0;
            border-style: solid;
            top: 15px;
        }
        
        .left .timeline-content::before {
            right: -15px;
            border-width: 8px 0 8px 15px;
            border-color: transparent transparent transparent white;
        }
        
        .right .timeline-content::before {
            left: -15px;
            border-width: 8px 15px 8px 0;
            border-color: transparent white transparent transparent;
        }
        
        @media screen and (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
            }
            
            .timeline::after {
                left: 31px;
            }
            
            .timeline-item {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
            }
            
            .timeline-item::after {
                left: 21px;
            }
            
            .left::after, .right::after {
                left: 21px;
            }
            
            .right {
                left: 0;
            }
            
            .left .timeline-content::before, .right .timeline-content::before {
                left: -15px;
                border-width: 8px 15px 8px 0;
                border-color: transparent white transparent transparent;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logo1.png') }}" alt="Logo Polinema" style="height: 50px; margin-right: 15px;">
                <span class="d-none d-md-inline">Tracer Study Polinema JTI</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#process">Proses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#faq">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#cta-section">Isi Data Alumni</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-outline-primary" href="{{ url('/login') }}">Masuk Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content" data-aos="fade-right" data-aos-duration="1000">
                    <h1 class="hero-title animate__animated animate__fadeInDown">Selamat Datang di Tracer Study</h1>
                    <p class="hero-subtitle animate__animated animate__fadeIn animate__delay-1s">Dari Alumni JTI, Untuk Kemajuan Institusi</p>
                    <p class="mb-4 animate__animated animate__fadeIn animate__delay-1s">
                        Selamat datang di Laman Tracer Study JTI Politeknik Negeri Malang. Platform ini menghimpun data alumni 
                        untuk evaluasi dan pengembangan mutu pendidikan di Polinema Khususnya Jurusan Teknologi Informasi. Kami berupaya mengetahui jejak karir 
                        lulusan serta memperoleh umpan balik guna meningkatkan kualitas pembelajaran.
                    </p>
                    <div class="d-flex flex-wrap gap-3 animate__animated animate__fadeIn animate__delay-1s">
                        <a href="{{ url('/cek_token') }}" class="btn btn-light btn-primary-custom me-2">
                            <i class="bi bi-pencil-square me-2"></i>Isi Data Alumni
                        </a>
                        <a href="{{ url('/login') }}" class="btn btn-outline-light">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Masuk Admin
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <img src="{{ asset('images/3.png') }}" alt="Alumni Illustration" class="img-fluid alumni-image">
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-5 bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                    <img src="{{ asset('images/tracer.png') }}" alt="About Tracer Study" class="img-fluid">
                </div>
                <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                    <h2 class="section-title fw-bold">Tentang Tracer Study</h2>
                    <p class="lead">Tracer Study adalah studi pelacakan jejak alumni untuk mengevaluasi hasil pendidikan tinggi.</p>
                    <p>
                        Tracer Study Polinema merupakan sistem yang dirancang untuk mengumpulkan data tentang kondisi pekerjaan 
                        alumni setelah lulus. Data ini digunakan untuk mengevaluasi dan meningkatkan kualitas pendidikan, 
                        kurikulum, serta pelayanan kepada mahasiswa.
                    </p>
                    <div class="mt-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <span>Meningkatkan relevansi kurikulum dengan kebutuhan industri</span>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <span>Mengetahui tingkat kepuasan pengguna lulusan</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <span>Mengembangkan jejaring alumni Polinema</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section py-5">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="fw-bold text-white">Tracer Study dalam Angka</h2>
                <p class="text-white-50">Data terkini partisipasi alumni dalam Tracer Study</p>
            </div>
            <div class="row g-4">
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-item text-center">
                        <div class="stat-number" data-count="{{ $alumni }}">0</div>
                        <div class="stat-label">Alumni Terdata</div>
                    </div>
                </div>
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-item text-center">
                        <div class="stat-number" data-count="{{ $surveyKepuasanLulusan }}">0</div>
                        <div class="stat-label">Respons Pengguna Alumni</div>
                    </div>
                </div>
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-item text-center">
                        <div class="stat-number" data-count="{{ $detailProfesiAlumni }}">0</div>
                        <div class="stat-label">Alumni Bekerja</div>
                    </div>
                </div>
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="stat-item text-center">
                        <div class="stat-number" data-count="4">0</div>
                        <div class="stat-label">Program Studi</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="fw-bold">Mengapa Berpartisipasi dalam Tracer Study?</h2>
                <p class="text-muted">Umpan balik Anda membantu meningkatkan kualitas pendidikan Polinema</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <h4>Pelacakan Karir</h4>
                        <p class="text-muted">
                            Membantu kami memahami jalur karir alumni dan meningkatkan bimbingan karir untuk mahasiswa.
                            Data yang terkumpul akan digunakan untuk menyusun strategi pengembangan karir yang lebih baik.
                        </p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-book"></i>
                        </div>
                        <h4>Pengembangan Kurikulum</h4>
                        <p class="text-muted">
                            Masukan Anda membantu kami menyempurnakan kurikulum agar sesuai kebutuhan industri.
                            Kami menganalisis kompetensi yang dibutuhkan di dunia kerja untuk meningkatkan relevansi pendidikan.
                        </p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <h4>Jaringan Alumni</h4>
                        <p class="text-muted">
                            Tetap terhubung dengan almamater dan sesama alumni melalui jaringan kami yang terus berkembang.
                            Dapatkan informasi lowongan kerja, pelatihan, dan acara eksklusif untuk alumni.
                        </p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-award"></i>
                        </div>
                        <h4>Akreditasi Institusi</h4>
                        <p class="text-muted">
                            Data tracer study merupakan komponen penting dalam proses akreditasi program studi dan institusi.
                            Kontribusi Anda membantu Polinema mempertahankan dan meningkatkan peringkat akreditasinya.
                        </p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="500">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-chat-square-text"></i>
                        </div>
                        <h4>Umpan Balik Pendidikan</h4>
                        <p class="text-muted">
                            Bagikan pengalaman Anda selama kuliah untuk membantu kami meningkatkan kualitas pengajaran,
                            fasilitas, dan layanan pendukung lainnya bagi mahasiswa saat ini dan yang akan datang.
                        </p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="600">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-bar-chart"></i>
                        </div>
                        <h4>Data Statistik</h4>
                        <p class="text-muted">
                            Hasil tracer study akan dipublikasikan sebagai referensi bagi calon mahasiswa dan stakeholder.
                            Data ini menunjukkan kinerja lulusan Polinema di dunia kerja.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section id="process" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="fw-bold">Proses Pengisian Tracer Study</h2>
                <p class="text-muted">Ikuti langkah-langkah sederhana ini untuk berpartisipasi</p>
            </div>
            
            <div class="timeline" data-aos="fade-up">
                <div class="timeline-item left" data-aos="fade-right">
                    <div class="timeline-content">
                        <h4>1. Permintaan Token</h4>
                        <p>Alumni meminta token unik melalui sistem dengan mengisi data dasar seperti NIM dan email.</p>
                    </div>
                </div>
                <div class="timeline-item right" data-aos="fade-left" data-aos-delay="100">
                    <div class="timeline-content">
                        <h4>2. Verifikasi Data</h4>
                        <p>Sistem akan memverifikasi data alumni dan mengirimkan token melalui email yang terdaftar.</p>
                    </div>
                </div>
                <div class="timeline-item left" data-aos="fade-right" data-aos-delay="200">
                    <div class="timeline-content">
                        <h4>3. Login dengan Token</h4>
                        <p>Gunakan token yang diterima untuk mengakses formulir tracer study secara online.</p>
                    </div>
                </div>
                <div class="timeline-item right" data-aos="fade-left" data-aos-delay="300">
                    <div class="timeline-content">
                        <h4>4. Pengisian Formulir</h4>
                        <p>Isi data secara lengkap dan akurat tentang kondisi pekerjaan dan pendidikan lanjut.</p>
                    </div>
                </div>
                <div class="timeline-item left" data-aos="fade-right" data-aos-delay="400">
                    <div class="timeline-content">
                        <h4>5. Submit Data</h4>
                        <p>Setelah yakin data benar, submit formulir dan dapatkan konfirmasi via email.</p>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="500">
                <a href="#cta-section" class="btn btn-primary btn-lg px-4">
                    <i class="bi bi-pencil-square me-2"></i>Mulai Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="fw-bold">Pertanyaan yang Sering Diajukan</h2>
                <p class="text-muted">Temukan jawaban atas pertanyaan umum seputar Tracer Study</p>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="faq-item" data-aos="fade-up">
                        <div class="faq-question">
                            <span>Apa itu Tracer Study?</span>
                        </div>
                        <div class="faq-answer">
                            <p>
                                Tracer Study adalah studi pelacakan jejak alumni yang bertujuan untuk mengetahui outcome 
                                pendidikan berupa transisi dari dunia pendidikan ke dunia kerja, situasi kerja, 
                                serta relevansi antara pendidikan dengan pekerjaan alumni.
                            </p>
                        </div>
                    </div>
                    
                    <div class="faq-item" data-aos="fade-up" data-aos-delay="100">
                        <div class="faq-question">
                            <span>Siapa yang harus mengisi Tracer Study?</span>
                        </div>
                        <div class="faq-answer">
                            <p>
                                Semua alumni Politeknik Negeri Malang diharapkan berpartisipasi dalam pengisian Tracer Study, 
                                terutama yang telah lulus dalam 5 tahun terakhir. Partisipasi alumni sangat penting untuk 
                                evaluasi dan pengembangan institusi.
                            </p>
                        </div>
                    </div>
                    
                    <div class="faq-item" data-aos="fade-up" data-aos-delay="200">
                        <div class="faq-question">
                            <span>Berapa lama waktu yang dibutuhkan untuk mengisi?</span>
                        </div>
                        <div class="faq-answer">
                            <p>
                                Pengisian Tracer Study membutuhkan waktu sekitar 10-15 menit, tergantung pada kelengkapan 
                                informasi yang Anda miliki. Pastikan Anda memiliki data tentang pekerjaan atau pendidikan 
                                lanjut sebelum memulai pengisian.
                            </p>
                        </div>
                    </div>
                    
                    <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
                        <div class="faq-question">
                            <span>Bagaimana jika saya belum bekerja?</span>
                        </div>
                        <div class="faq-answer">
                            <p>
                                Data tentang alumni yang belum bekerja atau sedang mencari pekerjaan juga sangat penting. 
                                Anda dapat memilih opsi "Sedang Mencari Pekerjaan" atau "Melanjutkan Pendidikan" sesuai 
                                kondisi Anda saat ini.
                            </p>
                        </div>
                    </div>
                    
                    <div class="faq-item" data-aos="fade-up" data-aos-delay="400">
                        <div class="faq-question">
                            <span>Apakah data saya akan dijaga kerahasiaannya?</span>
                        </div>
                        <div class="faq-answer">
                            <p>
                                Ya, semua data yang Anda berikan akan dijaga kerahasiaannya dan hanya digunakan untuk 
                                keperluan akademik dan pengembangan institusi. Data akan diproses secara agregat untuk 
                                keperluan statistik dan laporan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta-section" id="cta-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center cta-content" data-aos="zoom-in">
                    <h2 class="fw-bold mb-4">Siap Berbagi Pengalaman Anda?</h2>
                    <p class="lead mb-4">
                        Kontribusi Anda sangat berharga dalam membentuk masa depan pendidikan Polinema yang lebih baik.
                        Mari bersama-sama meningkatkan kualitas almamater kita.
                    </p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="{{ url('/cek_token') }}" class="btn btn-light btn-lg px-4 btn-primary-custom">
                            <i class="bi bi-pencil-square me-2"></i>Isi Data Alumni
                        </a>
                        <a href="{{ url('/login') }}" class="btn btn-outline-light btn-lg px-4">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Masuk Admin
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white pt-5 pb-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="mb-3">Tracer Study Polinema JTI</h5>
                    <p>
                        Platform untuk melacak karir alumni dan mengumpulkan umpan balik untuk pengembangan institusi.
                        Mari bersama-sama membangun almamater yang lebih baik.
                    </p>
                    <div class="mt-4">
                        <img src="{{ asset('images/logo1.png') }}" alt="Logo Polinema" style="height: 70px; margin-right: 10px;">
                        <img src="{{ asset('images/logo-jti.png') }}" alt="Logo Polinema" style="height: 70px;">
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5 class="mb-3">Tautan Cepat</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#about" class="text-white-50">Tentang</a></li>
                        <li class="mb-2"><a href="#features" class="text-white-50">Fitur</a></li>
                        <li class="mb-2"><a href="#process" class="text-white-50">Proses</a></li>
                        <li class="mb-2"><a href="#faq" class="text-white-50">FAQ</a></li>
                        <li><a href="{{ url('/login') }}" class="text-white-50">Masuk Admin</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="mb-3">Hubungi Kami</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-geo-alt-fill me-2"></i> Jl. Soekarno Hatta No.9, Malang</li>
                        <li class="mb-2"><i class="bi bi-envelope me-2"></i> tracer@polinema.ac.id</li>
                        <li class="mb-2"><i class="bi bi-telephone me-2"></i> (0341) 404424</li>
                        <li><i class="bi bi-clock me-2"></i> Senin-Jumat, 08:00-16:00</li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h5 class="mb-3">Ikuti Kami</h5>
                    <div class="social-links mb-3">
                        <a href="#" class="text-white-50 me-3"><i class="bi bi-facebook fs-4"></i></a>
                        <a href="#" class="text-white-50 me-3"><i class="bi bi-twitter fs-4"></i></a>
                        <a href="#" class="text-white-50 me-3"><i class="bi bi-instagram fs-4"></i></a>
                        <a href="#" class="text-white-50"><i class="bi bi-linkedin fs-4"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4 bg-secondary">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">&copy; 2025 Tracer Study Polinema JTI. Hak cipta dilindungi.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">Politeknik Negeri Malang - Lembaga Penelitian dan Pengabdian Masyarakat</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#" class="btn btn-primary btn-lg back-to-top" id="backToTop" style="display: none; position: fixed; bottom: 20px; right: 20px; z-index: 99; border-radius: 50%; width: 50px; height: 50px; padding: 0; display: flex; align-items: center; justify-content: center;">
        <i class="bi bi-arrow-up"></i>
    </a>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        // Initialize AOS (Animate On Scroll)
        AOS.init({
            duration: 1000,
            once: false,
            offset: 120,
            easing: 'ease-in-out',
            mirror: true
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Back to top button
        const backToTopButton = document.getElementById('backToTop');
        
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopButton.style.display = 'flex';
            } else {
                backToTopButton.style.display = 'none';
            }
        });
        
        backToTopButton.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({top: 0, behavior: 'smooth'});
        });

        // FAQ accordion functionality
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', function() {
                this.classList.toggle('active');
                const answer = this.nextElementSibling;
                answer.classList.toggle('show');
                
                // Close other open FAQs
                document.querySelectorAll('.faq-question').forEach(q => {
                    if (q !== this && q.classList.contains('active')) {
                        q.classList.remove('active');
                        q.nextElementSibling.classList.remove('show');
                    }
                });
            });
        });

        // Animation for stats counting with improved performance
        function animateStats() {
            const statNumbers = document.querySelectorAll('.stat-number');
            const animationDuration = 2000; // 2 seconds
            const frameDuration = 1000 / 60; // 60fps
            
            statNumbers.forEach(stat => {
                const target = parseInt(stat.getAttribute('data-count'));
                const start = 0;
                const totalFrames = Math.round(animationDuration / frameDuration);
                let frame = 0;
                
                const counter = setInterval(() => {
                    frame++;
                    const progress = frame / totalFrames;
                    const currentCount = Math.floor(progress * target);
                    
                    stat.textContent = currentCount;
                    
                    if (frame === totalFrames) {
                        clearInterval(counter);
                        stat.textContent = target;
                    }
                }, frameDuration);
            });
        }

        // Intersection Observer for stats animation
        const statsSection = document.querySelector('.stats-section');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateStats();
                    observer.unobserve(entry.target);
                }
            });
        }, {threshold: 0.5});

        if (statsSection) {
            observer.observe(statsSection);
        }

        // Floating animation for alumni image
        function animateFloating() {
            const alumniImage = document.querySelector('.alumni-image');
            if (alumniImage) {
                let position = 0;
                let direction = 1;
                const amplitude = 20;
                const speed = 0.02;
                
                function updatePosition() {
                    position += speed * direction;
                    if (position > Math.PI) {
                        direction = -1;
                    } else if (position < 0) {
                        direction = 1;
                    }
                    
                    const offset = Math.sin(position) * amplitude;
                    alumniImage.style.transform = `translateY(${offset}px)`;
                    
                    requestAnimationFrame(updatePosition);
                }
                
                updatePosition();
            }
        }

        // Start animations when page loads
        window.addEventListener('load', function() {
            animateFloating();
        });
    </script>
</body>

</html>
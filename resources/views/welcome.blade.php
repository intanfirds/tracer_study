<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Tracer Study Polinema</title>
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 5rem 0;
            position: relative;
            overflow: hidden;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
        }
        
        .hero-title {
            font-weight: 700;
            font-size: 3.5rem;
            margin-bottom: 1rem;
        }
        
        .hero-subtitle {
            font-size: 1.25rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }
        
        .btn-primary-custom {
            background-color: var(--accent-color);
            border: none;
            padding: 0.75rem 2rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary-custom:hover {
            background-color: #c0392b;
            transform: translateY(-2px);
        }
        
        .feature-card {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .feature-icon {
            font-size: 2.5rem;
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
        }
        
        .stats-section {
            background-color: var(--light-color);
            padding: 4rem 0;
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .stat-label {
            color: #7f8c8d;
            font-weight: 500;
        }
        
        .alumni-image {
            position: absolute;
            right: 0;
            bottom: 0;
            max-height: 80%;
            z-index: 1;
        }
        
        .navbar {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            font-weight: 700;
        }
        
        .search-box {
            max-width: 400px;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('images/logo1.png') }}" alt="Logo" style="height: 60px; margin-right: 15px;">
                <span class="d-none d-md-inline">Tracer Study Polinema</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#cta-section">Isi Data</a>
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
                <div class="col-lg-6 hero-content">
                    <h1 class="hero-title">Selamat Datang di Tracer Study</h1>
                    <p class="hero-subtitle">Dari Alumni, Untuk Kemajuan Institusi</p>
                    <p class="mb-4">
                        Selamat datang di Laman Tracer Study Politeknik Negeri Malang. Platform ini menghimpun data alumni 
                        untuk evaluasi dan pengembangan mutu pendidikan di Polinema. Kami berupaya mengetahui jejak karir 
                        lulusan serta memperoleh umpan balik guna meningkatkan kualitas pembelajaran.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ url('/login') }}" class="btn btn-light btn-primary-custom">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Masuk Admin
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="{{ asset('images/3.png') }}" alt="Alumni Illustration" class="img-fluid alumni-image">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Mengapa Berpartisipasi dalam Tracer Study?</h2>
                <p class="text-muted">Umpan balik Anda membantu meningkatkan kualitas pendidikan Polinema</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <h4>Pelacakan Karir</h4>
                        <p class="text-muted">
                            Membantu kami memahami jalur karir alumni dan meningkatkan bimbingan karir untuk mahasiswa.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-book"></i>
                        </div>
                        <h4>Pengembangan Kurikulum</h4>
                        <p class="text-muted">
                            Masukan Anda membantu kami menyempurnakan kurikulum agar sesuai kebutuhan industri.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <h4>Jaringan Alumni</h4>
                        <p class="text-muted">
                            Tetap terhubung dengan almamater dan sesama alumni melalui jaringan kami yang terus berkembang.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5 bg-white" id="cta-section">
        <div class="container text-center py-4">
            <h2 class="fw-bold mb-4">Siap Berbagi Pengalaman Anda?</h2>
            <p class="lead mb-4">
                Umpan balik Anda sangat berharga dalam membentuk masa depan pendidikan Polinema.
            </p>
            <a href="{{ url('/request-token-alumni') }}" class="btn btn-primary btn-lg px-4">
                <i class="bi bi-pencil-square me-2"></i>Isi Data
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5>Tracer Study Polinema</h5>
                    <p>
                        Platform untuk melacak karir alumni dan mengumpulkan umpan balik untuk pengembangan institusi.
                    </p>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <h5>Hubungi Kami</h5>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-envelope me-2"></i> tracer@polinema.ac.id</li>
                        <li><i class="bi bi-telephone me-2"></i> (0341) 404424</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Ikuti Kami</h5>
                    <div class="social-links">
                        <a href="#" class="text-white-50 me-2"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white-50 me-2"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-white-50 me-2"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-white-50"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4 bg-secondary">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2025 Tracer Study Polinema. Hak cipta dilindungi.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">Politeknik Negeri Malang</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animation for stats counting
        document.addEventListener('DOMContentLoaded', function() {
            const statNumbers = document.querySelectorAll('.stat-number');
            
            statNumbers.forEach(stat => {
                const target = parseInt(stat.textContent);
                let count = 0;
                const duration = 2000; // 2 seconds
                const increment = target / (duration / 16); // 60fps
                
                const updateCount = () => {
                    count += increment;
                    if (count < target) {
                        stat.textContent = Math.floor(count);
                        requestAnimationFrame(updateCount);
                    } else {
                        stat.textContent = target + (stat.textContent.includes('%') ? '%' : '+');
                    }
                };
                
                // Start counting when element is in viewport
                const observer = new IntersectionObserver((entries) => {
                    if (entries[0].isIntersecting) {
                        updateCount();
                        observer.unobserve(stat);
                    }
                });
                
                observer.observe(stat);
            });
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            });
        });
    </script>
</body>

</html>
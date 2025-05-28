<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Kepuasan Pengguna Lulusan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            min-height: 100vh;
            background: #45526e;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
        }
        
        .form-wrapper {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .form-title { font-size: 1.5rem; font-weight: 700; color: #354764; margin-bottom: 0; }
        .subtitle { font-size: 1.2rem; color: #666; margin-bottom: 1rem; }
        .logo-img { height: 80px; margin: 1rem 0; }
        
        .form-control {
            padding: 0.75rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            text-align: center;
            margin: 1rem 0;
        }
        
        .btn-verify {
            background: #354764;
            color: white;
            font-weight: 500;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            border: none;
            width: 100%;
            max-width: 200px;
        }

        .info-text {
            color: #666;
            font-size: 0.9rem;
            margin: 0.5rem 0;
        }

        @media (max-width: 576px) {
            .form-wrapper { margin: 1rem; }
            .form-title { font-size: 1.2rem; }
            .subtitle { font-size: 1rem; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-wrapper">
            <h1 class="form-title">SURVEY KEPUASAN PENGGUNA LULUSAN</h1>
            <h2 class="subtitle">POLITEKNIK NEGERI MALANG</h2>
            <img src="{{ asset('images/logo1.png') }}" alt="Logo Polinema" class="logo-img">

            @if(session('alert'))
                <div class="alert alert-{{ session('alert')['type'] }} py-2" role="alert">
                    @if(session('alert')['type'] == 'success')
                        <i class="fas fa-check-circle me-2"></i>
                    @else
                        <i class="fas fa-exclamation-circle me-2"></i>
                    @endif
                    {{ session('alert')['message'] }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger py-2" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                </div>
            @endif

            <form action="{{ route('verify.token') }}" method="POST">
                @csrf
                <input type="text" 
                    class="form-control @error('token') is-invalid @enderror" 
                    placeholder="Masukkan token Anda"
                    name="token" 
                    required 
                    autocomplete="off">
                
                <p class="info-text">
                    <i class="fas fa-info-circle me-1"></i>
                    Token dapat ditemukan pada email yang telah dikirimkan alumni.
                </p>

                <button type="submit" class="btn btn-verify">
                    <i class="fas fa-arrow-right me-2"></i>Verifikasi Token
                </button>
            </form>
        </div>
    </div>
</body>
</html>
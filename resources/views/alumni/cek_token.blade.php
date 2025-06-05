<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cek Token Alumni</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        body {
            background: linear-gradient(to right, #2c3e50, #4ca1af);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            border-radius: 16px;
            padding: 2rem;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #354764;
            border: none;
            border-radius: 10px;
        }

        .btn-primary:hover {
            background-color: #2b3a57;
        }

        .form-control {
            border-radius: 10px;
        }

        .extra-link {
            font-size: 0.9rem;
            margin-top: 1rem;
        }

        .text-small {
            font-size: 0.85rem;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="card bg-white text-center">
        <div class="d-flex justify-content-center align-items-center mb-4">
            <img src="{{ asset('images/logo1.png') }}" style="max-height: 60px; width: auto; margin-right: 2px;"
                alt="Logo Polinema" />
            <img src="{{ asset('images/logo-jti.png') }}" style="max-height: 60px; width: auto;" alt="Logo JTI" />
        </div>

        <h4 class="fw-semibold text-dark">Cek Token Alumni</h4>
        <p class="text-muted mb-4">Politeknik Negeri Malang</p>

        @if (session('alert'))
            <div class="alert alert-{{ session('alert')['type'] }} d-flex align-items-center">
                <i
                    class="fas me-2 {{ session('alert')['type'] == 'success' ? 'fa-check-circle' : 'fa-exclamation-circle' }}"></i>
                <div>{{ session('alert')['message'] }}</div>
            </div>
        @endif

        <form action="{{ route('alumni.form') }}" method="GET">
            @csrf
            <div class="mb-3">
                <input type="text" name="token" class="form-control @error('token') is-invalid @enderror"
                    placeholder="Masukkan token alumni Anda" required autocomplete="off" />
                <div class="text-small mt-1">
                    <i class="fas fa-info-circle me-1"></i> Token dikirim ke email Anda saat request.
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-key me-2"></i>Validasi Token
            </button>
        </form>

        <div class="extra-link mt-3">
            Belum punya token? <a href="{{ url('/request_token') }}" class="text-decoration-none">Request di
                sini</a>
        </div>
    </div>
</body>

</html>

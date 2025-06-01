<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Request & Cek Token Alumni</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap dan Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- EmailJS -->
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <script>
        (function() {
            emailjs.init("fHVyExSnS3Edg1P2l");
        })();
    </script>

    <style>
        body {
            background-color: #45526e;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .wrapper {
            background: #fff;
            padding: 2.5rem;
            border-radius: 20px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .logo-img {
            height: 70px;
            margin-bottom: 1rem;
        }

        h1,
        h2 {
            color: #354764;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        h4 {
            margin-top: 2rem;
            color: #354764;
            font-weight: 500;
        }

        .form-control {
            padding: 0.8rem;
            border-radius: 10px;
            border: 1px solid #ced4da;
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }

        .btn-submit {
            background-color: #354764;
            color: #fff;
            padding: 0.75rem;
            border-radius: 10px;
            width: 100%;
            border: none;
            font-weight: 500;
            transition: 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #2c3a57;
        }

        .info-text {
            font-size: 0.85rem;
            color: #666;
            margin-top: -0.5rem;
            margin-bottom: 1rem;
        }

        .alert {
            font-size: 0.9rem;
            border-radius: 10px;
            padding: 0.75rem 1rem;
        }

        #status-message {
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }

        hr {
            margin-top: 2rem;
            margin-bottom: 1.5rem;
        }
    </style>
</head>

<body>

    <div class="wrapper text-center">
        <img src="{{ asset('images/logo1.png') }}" alt="Logo Polinema" class="logo-img">
        <h1>CEK TOKEN ALUMNI</h1>
        <h2 class="mb-4">POLITEKNIK NEGERI MALANG</h2>

        <!-- Form Request Token -->
        <h4>Request Token</h4>
        <form id="request-token-form">
            @csrf
            <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email alumni"
                required />
            <button type="submit" class="btn btn-submit">Kirim Email</button>
            <p id="status-message" class="text-info"></p>
        </form>

        <hr>

        <!-- Form Cek Token -->
        <h4>Cek Token</h4>

        @if (session('alert'))
            <div class="alert alert-{{ session('alert')['type'] }}">
                @if (session('alert')['type'] == 'success')
                    <i class="fas fa-check-circle me-2"></i>
                @else
                    <i class="fas fa-exclamation-circle me-2"></i>
                @endif
                {{ session('alert')['message'] }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            </div>
        @endif

        <form action="{{ route('verifikasi.token') }}" method="POST">
            @csrf
            <input type="text" class="form-control @error('token') is-invalid @enderror" name="token"
                placeholder="Masukkan token alumni Anda" required autocomplete="off">
            <p class="info-text">
                <i class="fas fa-info-circle me-1"></i>
                Token bisa kamu dapat dari email yang dikirimkan oleh sistem tracer alumni.
            </p>
            <button type="submit" class="btn btn-submit">
                <i class="fas me-2"></i>Kirim Token
            </button>
        </form>
    </div>

    <script>
        const form = document.getElementById('request-token-form');
        const statusMessage = document.getElementById('status-message');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const email = document.getElementById('email').value;

            fetch('/request-token-alumni', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        email: email
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.token) {
                        statusMessage.textContent = data.message;

                        emailjs.send('service_n8pyris', 'template_khtm20x', {
                                to_email: email,
                                token: data.token,
                                login_link: `{{ url('/request-token-alumni') }}?email=${encodeURIComponent(email)}&token=${data.token}`,
                            })
                            .then(() => {
                                statusMessage.textContent += ' Email berhasil dikirim!';
                            }, (error) => {
                                statusMessage.textContent += ' Gagal kirim email: ' + error.text;
                            });
                    } else {
                        statusMessage.textContent = data.message || 'Terjadi kesalahan.';
                    }
                })
                .catch(() => {
                    statusMessage.textContent = 'Gagal menghubungi server.';
                });
        });
    </script>

</body>

</html>

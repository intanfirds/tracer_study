<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Request Token Alumni</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <script>
        emailjs.init("fHVyExSnS3Edg1P2l");
    </script>

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

        .text-small {
            font-size: 0.85rem;
            color: #666;
        }

        #status-message {
            font-size: 0.85rem;
            margin-top: 1rem;
        }

        .btn-secondary-custom {
            background-color: #6c757d;
            /* Abu-abu netral */
            color: #fff;
            border: none;
            border-radius: 10px;
        }

        .btn-secondary-custom:hover {
            background-color: #5a6268;
            /* Hover sedikit lebih gelap */
            color: #fff;
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
        <h4 class="fw-semibold text-dark">Request Token</h4>
        <p class="text-muted mb-4">Politeknik Negeri Malang</p>

        <form id="request-token-form">
            @csrf
            <div class="mb-3">
                <input type="email" id="email" name="email" class="form-control"
                    placeholder="Masukkan email alumni" required />
            </div>

            <!-- Tombol kirim token -->
            <button type="submit" class="btn btn-primary w-100 mb-2">
                <i class="fas fa-envelope me-2"></i>Kirim Token ke Email
            </button>

            <!-- Tombol Cek Token, disamakan bentuk & warna -->
            <a href="{{ url('/cek_token') }}" class="btn btn-secondary-custom w-100">
                <i class="fas fa-arrow-left me-2"></i>Cek Token
            </a>

            <p id="status-message" class="text-info mt-3"></p>
        </form>
    </div>

    <script>
        const form = document.getElementById('request-token-form');
        const statusMessage = document.getElementById('status-message');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const email = document.getElementById('email').value;

            fetch('/request_token', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        email
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.token) {
                        statusMessage.textContent = data.message;

                        emailjs.send('service_n8pyris', 'template_khtm20x', {
                            to_email: email,
                            token: data.token,
                            login_link: `{{ url('/alumni/form') }}?token=${data.token}`,
                        }).then(() => {
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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <title>Tracer Study Polinema - Login</title>
  <!-- Fonts and icons -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet"/>
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet"/>
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet"/>
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.1.0') }}" rel="stylesheet"/>
  <style>
    :root {
      --primary-color: #2d4271;
      --secondary-color: #f8a51b;
    }
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
    }
    .login-container {
      display: flex;
      min-height: 100vh;
      align-items: center;
    }
    .brand-section {
        flex: 1;
        padding: 2rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center; /* ini diubah dari flex-start ke center */
        text-align: center; /* tambahan supaya teks ikut center */
    }
    .login-section {
      flex: 1;
      padding: 2rem;
    }
    .card {
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      border: none;
      overflow: hidden;
      background: white;
    }
    .login-title {
      font-size: 2rem;
      font-weight: 700;
      color: var(--primary-color);
      margin: 1rem 0 0.5rem;
    }
    .institution-name {
      font-size: 1.2rem;
      font-weight: 600;
      color: var(--primary-color);
      margin-bottom: 2rem;
    }
    .brand-description {
        color: #555;
        line-height: 1.6;
        text-align: center;
    }
    .welcome-text {
      font-size: 1rem;
      color: #555;
      margin-bottom: 1.5rem;
      font-weight: 400;
    }
    .form-label {
      font-weight: 600;
      color: var(--primary-color);
      margin-bottom: 0.5rem;
      display: block;
      font-size: 0.95rem;
    }
    .btn-login {
      background-color: var(--primary-color);
      border: none;
      padding: 12px;
      font-weight: 600;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      font-size: 0.9rem;
      transition: all 0.3s;
    }
    .btn-login:hover {
      background-color: #1e2e4f;
      transform: translateY(-2px);
    }
    .divider-text {
      font-size: 0.8rem;
      font-weight: 500;
      color: #777;
      text-transform: uppercase;
      letter-spacing: 1px;
    }
    .form-control {
      border-radius: 8px;
      padding: 12px 15px;
      border: 1px solid #e0e0e0;
      font-size: 0.95rem;
      margin-bottom: 1.2rem;
    }
    .form-control::placeholder {
      color: #aaa;
      font-weight: 300;
    }
    .logo-img {
      height: 220px;
      margin-bottom: 1rem;
    }
    @media (max-width: 992px) {
      .login-container {
        flex-direction: column;
      }
      .brand-section, .login-section {
        padding: 1rem;
        width: 100%;
      }
      .brand-description {
        max-width: 100%;
      }
    }
  </style>
</head>

<body>
  <div class="login-container">
    <!-- Bagian Kiri (Branding) -->
    <div class="brand-section">
      <div>
        <img src="assets/img/logo-polinema.png" alt="Polinema Logo" class="logo-img">
        <h1 class="login-title">TRACER STUDY</h1>
        <p class="institution-name">POLITEKNIK NEGERI MALANG</p>
        <p class="brand-description">
          Sistem tracer study Politeknik Negeri Malang untuk melacak jejak alumni 
          dan mengumpulkan data perkembangan karir lulusan.
        </p>
      </div>
    </div>

    <!-- Bagian Kanan (Form Login) -->
    <div class="login-section">
      <div class="card">
        <div class="card-body p-4">
          <p class="welcome-text">Silakan masuk dengan akun Anda</p>
          
          <!-- FORM LOGIN -->
          <form role="form" action="{{ url('/login') }}" method="POST">
            @csrf
            <div>
              <label for="username" class="form-label">USERNAME</label>
              <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username Anda" aria-label="Nama/NIM" required>
            </div>
            <div>
              <label for="password" class="form-label">PASSWORD</label>
              <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password Anda" aria-label="Password" required>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-login w-100 mt-3 mb-2">MASUK</button>
            </div>
          </form>
          
          <div class="text-center mt-3">
            <a href="{{ route('password.request') }}" class="text-muted small">Lupa password?</a>
          </div>
        </div>
      </div>
      
      <div class="text-center mt-3">
        <p class="text-muted small">© 2025 Tracer Study Polinema</p>
      </div>
    </div>
  </div>

  <!-- Core JS Files -->
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
</body>

</html>
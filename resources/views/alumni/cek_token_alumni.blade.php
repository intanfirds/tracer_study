<!-- resources/views/cek_token_alumni.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi Token Alumni</title>
</head>
<body>
    <h2>Verifikasi Token Login</h2>

    @if(session('message'))
        <p>{{ session('message') }}</p>
    @endif

    <form method="POST" action="{{ route('verifikasi.token') }}">
        @csrf
        <input type="email" name="email" value="{{ request('email') }}" placeholder="Email" required readonly><br>
        <input type="text" name="token" value="{{ request('token') }}" placeholder="Token" required readonly><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>

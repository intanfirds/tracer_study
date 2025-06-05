@extends('auth.layouts.authAdmin') {{-- atau gunakan template kamu --}}
@section('content')
<div class="form-wrapper">
    <h3 class="form-title">Lupa Password Admin</h3>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email Admin</label>
            <input type="email" class="form-control" name="email" required autofocus>
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-submit">Kirim Link Reset</button>
    </form>
</div>
@endsection

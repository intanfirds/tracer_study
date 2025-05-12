{{-- resources/views/admin/import.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">Import Data Alumni</h3>
    </div>

    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/admin/import') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Download Template</label><br>
                <a href="{{ asset('template_alumni.xlsx') }}" class="btn btn-info btn-sm" download>
                    <i class="fa fa-file-excel"></i> Download Template
                </a>
            </div>

            <div class="form-group">
                <label for="file_alumni">Pilih File Excel</label>
                <input type="file" name="file_alumni" id="file_alumni" class="form-control @error('file_alumni') is-invalid @enderror" required>
                @error('file_alumni')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <a href="{{ url('/admin/daftarAlumni') }}" class="btn btn-warning">Kembali</a>
                <button type="submit" class="btn btn-primary">Import</button>
            </div>
        </form>
    </div>
</div>
@endsection

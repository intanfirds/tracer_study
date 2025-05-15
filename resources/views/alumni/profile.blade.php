@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body" style="max-height: calc(100vh - 200px); overflow-y: auto;">
                <h3 class="mb-4">Profil Alumni</h3>

                @if ($alumni)
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama</label>
                            <input type="text" class="form-control" value="{{ $alumni->nama }}" readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>NIM</label>
                            <input type="text" class="form-control" value="{{ strtoupper($alumni->NIM) }}" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" value="{{ $alumni->email }}" readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>No HP</label>
                            <input type="text" class="form-control" value="{{ $alumni->no_hp }}" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Program Studi</label>
                            <input type="text" class="form-control" value="{{ $alumni->prodi->nama_prodi ?? '-' }}" readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Tahun Lulus</label>
                            <input type="text" class="form-control" value="{{ $alumni->tahun_lulus ?? '-' }}" readonly>
                        </div>
                    </div>
                @else
                    <div class="alert alert-danger">
                        Data alumni tidak ditemukan atau belum login.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

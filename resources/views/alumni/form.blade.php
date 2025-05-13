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
                <form action="{{ route('alumni.store') }}" method="POST">
                    @csrf
                    <h3 class="mb-4">Formulir Pengisian Data Lulusan</h3>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Terjadi kesalahan:</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @php
                        $alumni = \App\Models\Alumni::find(session('id'));
                    @endphp

                    @if ($alumni)
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Nama</label>
                                <input type="text" class="form-control" value="{{ $alumni->nama }}" readonly>
                                <input type="hidden" name="nama" value="{{ $alumni->nama }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>NIM</label>
                                <input type="text" class="form-control" value="{{ strtoupper($alumni->NIM) }}" readonly>
                                <input type="hidden" name="nim" value="{{ strtoupper($alumni->NIM) }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Program Studi</label>
                                <input type="text" class="form-control" value="{{ $alumni->prodi->nama_prodi ?? '-' }}"
                                    readonly>
                                <input type="hidden" name="prodi_id" value="{{ $alumni->prodi_id }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Tahun Lulus</label>
                                <input type="text" class="form-control" value="{{ $alumni->tahun_lulus ?? '-' }}"
                                    readonly>
                                <input type="hidden" name="tahun_lulus" value="{{ $alumni->tahun_lulus }}">
                            </div>
                        </div>
                    @else
                        <div class="alert alert-danger">
                            Pengguna belum login atau data alumni tidak ditemukan.
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>No. HP</label>
                            <input type="text" name="no_hp" class="form-control" pattern="[0-9]+" maxlength="15"
                                required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Kategori Profesi</label>
                            <select name="kategori_id" class="form-control" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->kategori_id }}">{{ $kategori->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Profesi</label>
                            <input type="text" name="profesi" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Tanggal Pertama Kerja</label>
                            <input type="date" name="tanggal_pertama_kerja" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Tanggal Mulai Kerja di Instansi Saat Ini</label>
                            <input type="date" name="tanggal_mulai_kerja" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Jenis Instansi</label>
                            <select name="jenis_instansi" class="form-control" required>
                                <option value="">-- Pilih Jenis --</option>
                                <option>Pemerintah</option>
                                <option>Swasta</option>
                                <option>BUMN</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Nama Instansi</label>
                            <input type="text" name="nama_instansi" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Skala Instansi</label>
                            <select name="skala" class="form-control" required>
                                <option value="">-- Pilih Skala --</option>
                                <option>Lokal</option>
                                <option>Nasional</option>
                                <option>Internasional</option>
                            </select>
                        </div>
                    </div>


                    <hr>
                    <h5>Data Atasan Langsung</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama Atasan</label>
                            <input type="text" name="nama_atasan" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Jabatan Atasan</label>
                            <input type="text" name="jabatan" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>No. HP Atasan</label>
                            <input type="text" name="no_hp_atasan" class="form-control" pattern="[0-9]+"
                                maxlength="15" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Email Atasan</label>
                            <input type="email" name="email_atasan" class="form-control" required>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('survey.store') }}" method="POST">
                @csrf
                <h3 class="mb-4">Survey Kepuasan Pengguna Lulusan</h3>

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

                <div class="mb-3">
                    <label for="alumni_id" class="form-label">Pilih Alumni</label>
                    <select name="alumni_id" id="alumni_id" class="form-control" required>
                        <option value="">-- Pilih Alumni --</option>
                        @foreach($alumnis as $alumni)
                            <option value="{{ $alumni->alumni_id }}">{{ $alumni->nama }} ({{ $alumni->NIM }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="instansi_id" class="form-label">Pilih Instansi</label>
                    <select name="instansi_id" id="instansi_id" class="form-control" required>
                        <option value="">-- Pilih Instansi --</option>
                        @foreach($instansis as $instansi)
                            <option value="{{ $instansi->instansi_id }}">{{ $instansi->nama_instansi }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- <div class="mb-3">
                    <label>Nama Instansi</label>
                    <input type="text" name="instansi" class="form-control" required>
                </div> -->

                <div class="mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>

                @php
                    $indikatorOptions = ['1' => 'Sangat Buruk', '2' => 'Buruk', '3' => 'Cukup', '4' => 'Baik', '5' => 'Sangat Baik'];
                @endphp

                <div class="mb-3">
                    <label>Kemampuan Kerja Sama Tim</label>
                    <select name="kerja_sama_tim" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        @foreach($indikatorOptions as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Kemampuan Berbahasa Asing</label>
                    <select name="kemampuan_berbahasa_asing" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        @foreach($indikatorOptions as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Kemampuan Berkomunikasi</label>
                    <select name="kemampuan_berkomunikasi" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        @foreach($indikatorOptions as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Etos Kerja</label>
                    <select name="etos_kerja" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        @foreach($indikatorOptions as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Saran untuk Kurikulum</label>
                    <textarea name="saran_untuk_kurikulum_prodi" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label>Kemampuan yang Tidak Terpenuhi oleh Lulusan</label>
                    <textarea name="kemampuan_tdk_terpenuhi" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label>Status Pengisian</label>
                    <select name="status_pengisian" class="form-control" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="selesai">Selesai</option>
                        <option value="belum">Belum</option>
                    </select>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

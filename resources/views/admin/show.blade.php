@extends('layouts.app')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Detail Alumni</h3>
        
    </div>
    <div class="card-body">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row">
            {{-- KIRI: Data Alumni --}}
            <div class="col-md-6">
                <h5>Data Alumni</h5>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th style="width: 200px;">NIM</th>
                        <td>{{ $alumni->NIM }}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>{{ $alumni->nama }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $alumni->email }}</td>
                    </tr>
                    <tr>
                        <th>No HP</th>
                        <td>{{ $alumni->no_hp }}</td>
                    </tr>
                    <tr>
                        <th>Program Studi</th>
                        <td>{{ $alumni->prodi->nama_prodi }}</td>
                    </tr>
                    <tr>
                        <th>Tahun Lulus</th>
                        <td>{{ $alumni->tahun_lulus }}</td>
                    </tr>
                    <tr>
                        <th>Profesi</th>
                        <td>{{ $alumni->detailProfesi->profesi ?? 'belum bekerja' }}</td>
                    </tr>
                    <tr>
                        <th>Masa Tunggu</th>
                        <td>{{ $alumni->detailProfesi->masa_tunggu ?? '-' }} bulan</td>
                    </tr>
                </table>
            </div>

            {{-- KANAN: Data Instansi & Atasan --}}
            <div class="col-md-6">
                <h5>Data Instansi & Atasan</h5>

                @if($alumni->instansi)
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Nama Instansi</th>
                            <td>{{ $alumni->instansi->nama_instansi }}</td>
                        </tr>
                        <tr>
                            <th>Jenis</th>
                            <td>{{ $alumni->instansi->jenis }}</td>
                        </tr>
                        <tr>
                            <th>Skala</th>
                            <td>{{ $alumni->instansi->skala }}</td>
                        </tr>
                        <tr>
                            <th>Nama Atasan</th>
                            <td>{{ $alumni->instansi->nama_atasan }}</td>
                        </tr>
                        <tr>
                            <th>Jabatan</th>
                            <td>{{ $alumni->instansi->jabatan }}</td>
                        </tr>
                        <tr>
                            <th>Email Atasan</th>
                            <td>{{ $alumni->instansi->email_atasan }}</td>
                        </tr>
                        <tr>
                            <th>No HP Atasan</th>
                            <td>{{ $alumni->instansi->no_hp_atasan }}</td>
                        </tr>
                    </table>
                @else
                    <div class="alert alert-warning">Data instansi dan atasan belum tersedia.</div>
                @endif
            </div>
        </div>
        <a href="{{ url('/admin/daftarAlumni') }}" class="btn btn-secondary float-right">
            <i class="fa fa-arrow-left"></i> Kembali
        </a>

    </div>
</div>
@endsection

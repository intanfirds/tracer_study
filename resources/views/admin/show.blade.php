@extends('layouts.app')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Detail Alumni</h3>
            <a href="{{ url('/admin/daftarAlumni') }}" class="btn btn-secondary float-right">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

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
                    <td>{{ $alumni->detailProfesi->profesi ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Masa Tunggu</th>
                    <td>{{ $alumni->detailProfesi->masa_tunggu ?? '-' }} bulan</td>
                </tr>
            </table>
        </div>
    </div>
@endsection

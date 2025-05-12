@extends('layouts.app') <!-- Sesuaikan dengan nama file layout Anda -->

@section('content')
  <!-- Konten Anda di sini -->
  <div class="card">
    <div class="card-body">
      <a href="{{ url('/admin/export_excel') }}" class="btn btn-warning">
        <i class="fa fa-file-pdf"></i> Export Alumni
      </a>
      <p>Laporan</p>
    </div>
  </div>
@endsection
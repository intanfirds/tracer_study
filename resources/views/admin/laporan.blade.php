@extends('layouts.app') <!-- Sesuaikan dengan nama file layout Anda -->

@section('content')
  <!-- Konten Anda di sini -->
  <div class="card">
    <div class="card-body">
      <a href="{{ url('/admin/export_excel') }}" class="btn btn-warning mb-2">
        <i class="fa fa-file-pdf"></i> Export Alumni
      </a>
      
      <a href="{{ url('/admin/export_survey') }}" class="btn btn-success mb-2">
  <i class="fa fa-file-excel"></i> Export Survey Kepuasan
      </a>
      <a href="{{ url('/admin/export_belum_survey') }}" class="btn btn-danger mb-2">
          <i class="fa fa-file-excel"></i> Export Alumni Belum Isi Survey
      </a>
      <p>Laporan</p>
    </div>
  </div>
@endsection
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

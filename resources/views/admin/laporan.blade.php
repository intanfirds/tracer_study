@extends('layouts.app')

@section('content')
<div class="container py-4">

  <!-- Header Total Laporan -->
  <div class="bg-primary text-white rounded p-3 d-flex align-items-center mb-4">
    <i class="fas fa-file-alt fa-2x me-3"></i>
    <div>
      <small class="d-block">TOTAL LAPORAN</small>
      <h5 class="mb-0 fw-bold">4 Laporan</h5>
    </div>
  </div>

  <!-- 2x2 Grid -->
  <div class="row g-4">
    <!-- Box 1 -->
    <div class="col-md-6">
      <div class="bg-white shadow-sm rounded-3 p-3 d-flex flex-column justify-content-between h-100">
        <div class="d-flex align-items-center">
          <i class="fas fa-user-graduate fa-2x text-primary me-3"></i>
          <div>Rekap Hasil Tracer Study Lulusan</div>
        </div>
        <a href="{{ url('/admin/export_excel') }}" class="btn btn-outline-primary mt-3">
          Download <i class="fas fa-download ms-2"></i>
        </a>
      </div>
    </div>

    <!-- Box 2 -->
    <div class="col-md-6">
      <div class="bg-white shadow-sm rounded-3 p-3 d-flex flex-column justify-content-between h-100">
        <div class="d-flex align-items-center">
          <i class="far fa-smile fa-2x text-success me-3"></i>
          <div>Rekap Hasil Survei Kepuasan Pengguna Lulusan</div>
        </div>
        <a href="{{ url('/admin/export_survey') }}" class="btn btn-outline-success mt-3">
          Download <i class="fas fa-download ms-2"></i>
        </a>
      </div>
    </div>

    <!-- Box 3 -->
    <div class="col-md-6">
      <div class="bg-white shadow-sm rounded-3 p-3 d-flex flex-column justify-content-between h-100">
        <div class="d-flex align-items-center">
          <i class="fas fa-users-slash fa-2x text-danger me-3"></i>
          <div>Rekap Lulusan yang Belum Mengisi Tracer Study</div>
        </div>
        <a href="{{ url('/admin/export_belum_survey') }}" class="btn btn-outline-danger mt-3">
          Download <i class="fas fa-download ms-2"></i>
        </a>
      </div>
    </div>

    <!-- Box 4 -->
    <div class="col-md-6">
      <div class="bg-white shadow-sm rounded-3 p-3 d-flex flex-column justify-content-between h-100">
        <div class="d-flex align-items-center">
          <i class="fas fa-user-times fa-2x text-warning me-3"></i>
          <div>Rekap Pengguna Lulusan yang Belum Mengisi Survei Kepuasan</div>
        </div>
        <a href="{{ route('survey.export.belum_isi') }}" class="btn btn-outline-warning mt-3">
          Download <i class="fas fa-download ms-2"></i>
        </a>
      </div>
    </div>
  </div>
</div>
@endsection

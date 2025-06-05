@extends('layouts.app')

@section('content')
<div class="container py-4">

  <!-- Header Total Laporan -->
  <div class="bg-gradient-primary text-white rounded-3 p-4 d-flex align-items-center shadow-sm mb-5">
    <i class="fas fa-file-alt fa-2x me-3 opacity-75"></i>
    <div>
      <small class="d-block text-uppercase fw-semibold opacity-75">Total Laporan</small>
      <h4 class="mb-0 fw-bold">4 Laporan</h4>
    </div>
  </div>

  <!-- Grid -->
  <div class="row g-4">
    <!-- Laporan Box Component -->
    @php
      $reports = [
        [
          'title' => 'Rekap Hasil Tracer Study Lulusan',
          'icon' => 'fas fa-user-graduate',
          'color' => 'primary',
          'url' => url('/admin/export_excel')
        ],
        [
          'title' => 'Rekap Hasil Survei Kepuasan Pengguna Lulusan',
          'icon' => 'far fa-smile',
          'color' => 'success',
          'url' => url('/admin/export_survey')
        ],
        [
          'title' => 'Rekap Lulusan yang Belum Mengisi Tracer Study',
          'icon' => 'fas fa-users-slash',
          'color' => 'danger',
          'url' => url('/admin/export_belum_survey')
        ],
        [
          'title' => 'Rekap Pengguna Lulusan yang Belum Mengisi Survei Kepuasan',
          'icon' => 'fas fa-user-times',
          'color' => 'warning',
          'url' => route('survey.export.belum_isi')
        ],
      ];
    @endphp

    @foreach ($reports as $report)
    <div class="col-md-6">
      <div class="bg-white shadow-sm rounded-4 p-4 d-flex flex-column justify-content-between h-100 hover-shadow transition">
        <div class="d-flex align-items-start mb-3">
          <i class="{{ $report['icon'] }} fa-xl text-{{ $report['color'] }} me-3"></i>
          <div class="fw-semibold text-dark">{{ $report['title'] }}</div>
        </div>
        <a href="{{ $report['url'] }}" class="btn btn-sm btn-{{ $report['color'] }} px-4 py-2 rounded-pill mt-auto align-self-start shadow-sm">
          <i class="fas fa-download me-2"></i>Download
        </a>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection

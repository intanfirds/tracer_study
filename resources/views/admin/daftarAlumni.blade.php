@extends('layouts.app')

@section('content')

    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Daftar Alumni</h3>
            <a href="{{ url('/admin/import') }}" class="btn btn-info">
                <i class="fa fa-file-excel"></i> Import Alumni
            </a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif 

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="prodi_id">Filter Prodi:</label>
                    <select class="form-control" id="prodi_filter">
                        <option value="">- Semua -</option>
                        @foreach ($prodi as $item)
                            <option value="{{ $item->prodi_id }}">{{ $item->nama_prodi }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div id="alumni-table">
                @include('admin.alumniTable', ['alumni' => $alumni])
            </div> 
        </div>
    </div>
@endsection

@push('scripts')

<script>
    document.getElementById('prodi_filter').addEventListener('change', function () {
        let prodiId = this.value;
        fetch(`/admin/filterAlumni?prodi_id=${prodiId}`)
            .then(response => response.text())
            .then(html => {
                document.getElementById('alumni-table').innerHTML = html;
            })
            .catch(error => console.error('Gagal:', error));
    });
</script>

@endpush('scripts')

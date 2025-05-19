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
                    <form method="GET" action="{{ url('/admin/daftarAlumni') }}">
                        <div class="input-group">
                            <select class="form-control" id="prodi_id" name="prodi_id" onchange="this.form.submit()">
                                <option value="">- Semua -</option>
                                @foreach ($prodi as $item)
                                    <option value="{{ $item->prodi_id }}" {{ request('prodi_id') == $item->prodi_id ? 'selected' : '' }}>
                                        {{ $item->nama_prodi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            <table class="table table-bordered table-hover table-sm">
            <thead>
    <tr>
        <th>No</th>
        <th>NIM</th>
        <th>Nama</th>
        <th>No HP</th>
        <th>Email</th>
        <th>Level</th>
        <th>Prodi</th>
        <th>Aksi</th> {{-- Tambahan --}}
    </tr>
</thead>
<tbody>
    @forelse ($alumni as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->NIM }}</td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->no_hp }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->level->nama }}</td>
            <td>{{ $item->prodi->nama_prodi }}</td>
            <td>
                <a href="{{ url('/admin/detail', $item->alumni_id) }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-eye"></i>
                </a>
                <a href="{{ url('/admin/edit', $item->alumni_id) }}" class="btn btn-sm btn-warning">
                    <i class="fa fa-edit"></i>
                </a>
                <form action="{{ url('/admin/delete', $item->alumni_id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8" class="text-center">Tidak ada data alumni.</td>
        </tr>
    @endforelse
</tbody>

            </table>
        </div>
    </div>
@endsection

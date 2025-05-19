@extends('layouts.app') <!-- Sesuaikan dengan nama file layout Anda -->

@section('content')
  <!-- Konten Anda di sini -->
  <table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>No HP</th>
            <th>Email</th>
            <th>Level</th>
            <th>Prodi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($alumnis as $index => $alumni)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $alumni->nim }}</td>
            <td>{{ $alumni->nama }}</td>
            <td>{{ $alumni->no_hp }}</td>
            <td>{{ $alumni->email }}</td>
            <td>{{ $alumni->level }}</td>
            <td>{{ $alumni->prodi }}</td>
            <td>
                <a href="{{ route('alumni.show', $alumni->id) }}" class="btn btn-info btn-sm">Detail</a>
                <a href="{{ route('alumni.edit', $alumni->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('alumni.destroy', $alumni->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
  <div class="card">
    <div class="card-body">
      <p>Dashboard Alumni</p>
    </div>
  </div>
@endsection
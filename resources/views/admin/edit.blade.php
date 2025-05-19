@extends('layouts.app')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Data Alumni</h3>
        </div>
        <div class="card-body">
        <form action="{{ route('admin.update', $alumni->alumni_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" value="{{ $alumni->nama }}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="no_hp">No HP</label>
                    <input type="text" id="no_hp" name="no_hp" value="{{ $alumni->no_hp }}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ $alumni->email }}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="prodi_id">Program Studi</label>
                    <select name="prodi_id" id="prodi_id" class="form-control">
                        @foreach($prodis as $prodi)
                            <option value="{{ $prodi->prodi_id }}" {{ $alumni->prodi_id == $prodi->prodi_id ? 'selected' : '' }}>
                                {{ $prodi->nama_prodi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Bisa tambah profesi kalau dibutuhkan --}}
                <div class="form-group">
                    <label for="profesi">Profesi</label>
                    <input type="text" id="profesi" name="profesi" value="{{ $alumni->detailProfesi->profesi ?? '' }}" class="form-control">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ url('/admin/daftarAlumni') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection

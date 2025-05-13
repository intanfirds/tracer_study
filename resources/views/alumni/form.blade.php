@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow-sm border-0">
            <div class="card-body" style="max-height: calc(100vh - 200px); overflow-y: auto;">
                <form action="{{ route('alumni.store') }}" method="POST">
                    @csrf
                    <h3 class="mb-4">Formulir Pengisian Data Lulusan</h3>

                    @php
                        $alumni = \App\Models\Alumni::find(session('id'));
                    @endphp

                    @if ($alumni)
                        {{-- Nama dan NIM --}}
                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" class="form-control" value="{{ $alumni->nama }}" readonly>
                            <input type="hidden" name="nama" value="{{ $alumni->nama }}">
                        </div>

                        <div class="mb-3">
                            <label>Nim</label>
                            <input type="text" class="form-control" value="{{ strtoupper($alumni->nim) }}" readonly>
                            <input type="hidden" name="nim" value="{{ strtoupper($alumni->nim) }}">
                        </div>
                        
                        {{-- Program Studi --}}
                        <div class="mb-3">
                            <label>Program Studi</label>
                            <input type="text" class="form-control" value="{{ $alumni->prodi->nama_prodi ?? '-' }}"
                                readonly>
                            <input type="hidden" name="prodi_id" value="{{ $alumni->prodi_id }}">
                        </div>

                        {{-- Tahun Lulus --}}
                        <div class="mb-3">
                            <label>Tahun Lulus</label>
                            <input type="text" class="form-control" value="{{ $alumni->tahun_lulus ?? '-' }}" readonly>
                            <input type="hidden" name="tahun_lulus" value="{{ $alumni->tahun_lulus }}">
                        </div>
                    @else
                        <div class="alert alert-danger">
                            Pengguna belum login atau data alumni tidak ditemukan.
                        </div>
                    @endif

                    {{-- No HP --}}
                    <div class="mb-3">
                        <label>No. HP</label>
                        <input type="text" name="no_hp" class="form-control" pattern="[0-9]+" maxlength="15" required>
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    {{-- Tanggal Pertama Kerja --}}
                    <div class="mb-3">
                        <label>Tanggal Pertama Kerja</label>
                        <input type="date" name="tanggal_pertama_kerja" class="form-control" required>
                    </div>

                    {{-- Tanggal Mulai Kerja di Instansi Saat Ini --}}
                    <div class="mb-3">
                        <label>Tanggal Mulai Kerja di Instansi Saat Ini</label>
                        <input type="date" name="tanggal_mulai_instansi" class="form-control" required>
                    </div>

                    {{-- Jenis Instansi --}}
                    <div class="mb-3">
                        <label>Jenis Instansi</label>
                        <select name="jenis_instansi" class="form-control" required>
                            <option value="">-- Pilih Jenis --</option>
                            <option>Pemerintah</option>
                            <option>Swasta</option>
                            <option>BUMN</option>
                        </select>
                    </div>

                    {{-- Nama Instansi --}}
                    <div class="mb-3">
                        <label>Nama Instansi</label>
                        <input type="text" name="nama_instansi" class="form-control" required>
                    </div>

                    {{-- Skala Instansi --}}
                    <div class="mb-3">
                        <label>Skala Instansi</label>
                        <select name="skala_instansi" class="form-control" required>
                            <option value="">-- Pilih Skala --</option>
                            <option>Lokal</option>
                            <option>Nasional</option>
                            <option>Internasional</option>
                        </select>
                    </div>

                    {{-- Lokasi Instansi --}}
                    <div class="mb-3">
                        <label>Lokasi Instansi (Kota/Kabupaten)</label>
                        <input type="text" name="lokasi_instansi" class="form-control" required>
                    </div>

                    {{-- Kategori Profesi --}}
                    <div class="mb-3">
                        <label>Kategori Profesi</label>
                        <select name="kategori_id" class="form-control" id="kategori_profesi" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Profesi --}}
                    <div class="mb-3">
                        <label>Profesi</label>
                        <input type="text" name="profesi" class="form-control" required>
                    </div>

                    {{-- Data Atasan --}}
                    <div class="mb-3">
                        <label>Nama Atasan Langsung</label>
                        <input type="text" name="nama_atasan" class="form-control" required>

                        <label>Jabatan Atasan Langsung</label>
                        <input type="text" name="jabatan_atasan" class="form-control" required>

                        <label>No. HP Atasan</label>
                        <input type="text" name="no_hp_atasan" class="form-control" pattern="[0-9]+" maxlength="15"
                            required>

                        <label>Email Atasan</label>
                        <input type="email" name="email_atasan" class="form-control" required>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Dropdown profesi berdasarkan kategori
                $('#kategori_profesi').change(function() {
                    let kategoriId = $(this).val();
                    if (kategoriId) {
                        $.get('/api/profesi-by-kategori/' + kategoriId, function(data) {
                            let html = '<option value="">-- Pilih Profesi --</option>';
                            data.forEach(function(profesi) {
                                html +=
                                    `<option value="${profesi.id}">${profesi.nama}</option>`;
                            });
                            $('#profesi_dropdown').html(html);
                        });
                    } else {
                        $('#profesi_dropdown').html('<option value="">-- Pilih Profesi --</option>');
                    }
                });
            });
        </script>
    @endpush
@endsection

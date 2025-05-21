<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Kepuasan Pengguna Lulusan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #354764 0%, #354764 50%, #ECEEF1 50%, #ECEEF1 100%);
            min-height: 100vh;
            padding: 40px 0;
        }
        .form-wrapper {
            background-color: #ECEEF1;
            padding: 40px;
            border-radius: 12px;
            max-width: 1000px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-title {
            color: #354764;
            font-weight: bold;
        }
    </style>
</head>

<script>
    document.getElementById('alumni_id').addEventListener('change', function() {
        const selected = this.options[this.selectedIndex];
        document.getElementById('nama_instansi').value = selected.dataset.instansi || '';
        document.getElementById('nama_atasan').value = selected.dataset.atasan || '';
        document.getElementById('lokasi_instansi').value = selected.dataset.lokasi || '';
    });
</script>


<body>
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="form-wrapper">
            <form action="{{ route('survey.store') }}" method="POST">
                @csrf
                <h3 class="mb-4 form-title">Survey Kepuasan Pengguna Lulusan</h3>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Terjadi kesalahan:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row g-3">
                
                    <div class="col-md-6">
                        <label for="alumni_id" class="form-label">Pilih Alumni</label>
                        <select name="alumni_id" id="alumni_id" class="form-control" required>
                            <option value="">-- Pilih Alumni --</option>
                            @foreach($alumnis as $alumni)
                                <option 
                                    value="{{ $alumni->alumni_id }}"
                                    data-instansi="{{ $alumni->instansi->nama_instansi ?? '' }}"
                                    data-atasan="{{ $alumni->instansi->nama_atasan ?? '' }}"
                                    data-lokasi="{{ $alumni->instansi->lokasi_instansi ?? '' }}"
                                >
                                    {{ $alumni->nama }} ({{ $alumni->NIM }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" name="instansi_id" id="instansi_id">


                    <div class="col-md-6">
                        <label for="nama_instansi" class="form-label">Nama Instansi</label>
                        <input type="text" name="nama_instansi" id="nama_instansi" class="form-control" readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="nama_atasan" class="form-label">Nama Atasan</label>
                        <input type="text" name="nama_atasan" id="nama_atasan" class="form-control" readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="lokasi_instansi" class="form-label">Lokasi Instansi</label>
                        <input type="text" name="lokasi_instansi" id="lokasi_instansi" class="form-control" readonly>
                    </div>


                    <div class="col-md-6">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                    </div>

                    @php
                        $indikatorOptions = ['1' => 'Sangat Buruk', '2' => 'Buruk', '3' => 'Cukup', '4' => 'Baik', '5' => 'Sangat Baik'];
                    @endphp

                    <div class="col-md-6">
                        <label>Kemampuan Kerja Sama Tim</label>
                        <select name="kerjasama_tim" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            @foreach($indikatorOptions as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label>Keahlian Bidang IT</label>
                        <select name="keahlian_bidang_it" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            @foreach($indikatorOptions as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label>Kemampuan Berbahasa Asing</label>
                        <select name="kemampuan_berbahasa_asing" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            @foreach($indikatorOptions as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label>Kemampuan Berkomunikasi</label>
                        <select name="kemampuan_berkomunikasi" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            @foreach($indikatorOptions as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label>Pengembangan Diri</label>
                        <select name="pengembangan_diri" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            @foreach($indikatorOptions as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label>Kepemimpinan</label>
                        <select name="kepemimpinan" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            @foreach($indikatorOptions as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label>Etos Kerja</label>
                        <select name="etos_kerja" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            @foreach($indikatorOptions as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label>Status Pengisian</label>
                        <select name="status_pengisian" class="form-control" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="selesai">Selesai</option>
                            <option value="belum">Belum</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label>Saran untuk Kurikulum</label>
                        <textarea name="saran_untuk_kurikulum_prodi" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="col-md-6">
                        <label>Kemampuan yang Tidak Terpenuhi oleh Lulusan</label>
                        <textarea name="kemampuan_tdk_terpenuhi" class="form-control" rows="3"></textarea>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#alumni_id').on('change', function () {
    var alumniId = $(this).val();
    if (alumniId) {
        $.ajax({
            url: '/get-instansi/' + alumniId,
            type: 'GET',
            success: function (data) {
                $('#nama_instansi').val(data.nama_instansi);
                $('#nama_atasan').val(data.nama_atasan);
                $('#lokasi_instansi').val(data.lokasi_instansi);
                $('#instansi_id').val(data.instansi_id); // tambahkan baris ini
            }
        });
    } else {
        $('#nama_instansi').val('');
        $('#nama_atasan').val('');
        $('#lokasi_instansi').val('');
        $('#instansi_id').val('');
    }
});

</script>

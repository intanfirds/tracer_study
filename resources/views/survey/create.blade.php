<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Kepuasan Pengguna Lulusan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #354764;
            --secondary-color: #4a6fa5;
            --light-color: #f8f9fa;
        }
        
        body {
            background: linear-gradient(to bottom, var(--primary-color) 0%, var(--primary-color) 30%, var(--light-color) 30%, var(--light-color) 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .form-wrapper {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            max-width: 1000px;
            margin: 2rem auto;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .form-title {
            color: var(--primary-color);
            font-weight: 700;
            text-align: center;
            margin-bottom: 1rem;
        }
        
        .survey-section {
            background-color: #fff;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--secondary-color);
        }
        
        .section-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #eee;
        }
        
        .rating-group {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            margin-bottom: 1rem;
            padding: 0.75rem;
            background-color: #f8f9fa;
            border-radius: 6px;
        }
        
        .rating-label {
            flex: 1;
            min-width: 250px;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        
        .rating-options {
            flex: 2;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }
        
        .rating-option {
            display: flex;
            align-items: center;
        }
        
        .form-check-input {
            margin-top: 0;
            cursor: pointer;
        }
        
        .btn-submit {
            background-color: var(--secondary-color);
            color: white;
            font-weight: 600;
            padding: 0.5rem 1.5rem;
        }
        
        @media (max-width: 768px) {
            .rating-group {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .rating-label {
                margin-bottom: 1rem;
            }
            
            body {
                background: linear-gradient(to bottom, var(--primary-color) 0%, var(--primary-color) 20%, var(--light-color) 20%, var(--light-color) 100%);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-wrapper">
            <div class="text-center mb-4">
                <h2 class="form-title">SURVEY KEPUASAN PENGGUNA LULUSAN</h2>
                <h4 class="text-muted">POLITEKNIK NEGERI MALANG</h4>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('survey.store') }}" method="POST">
                @csrf
                <input type="hidden" name="status_pengisian" value="selesai">
                
                <!-- Data Alumni Section -->
                <div class="survey-section">
                    <h5 class="section-title">Data Alumni</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="alumni_id" class="form-label">Pilih Alumni</label>
                            <select name="alumni_id" id="alumni_id" class="form-select" required>
                                <option value="">-- Pilih Alumni --</option>
                                @foreach($alumnis as $alumni)
                                    <option value="{{ $alumni->alumni_id }}"
                                        data-instansi="{{ $alumni->instansi->nama_instansi ?? '' }}"
                                        data-atasan="{{ $alumni->instansi->nama_atasan ?? '' }}"
                                        data-lokasi="{{ $alumni->instansi->lokasi_instansi ?? '' }}">
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
                    </div>
                </div>

                <!-- Survey Kepuasan Section -->
                <div class="survey-section">
                    <h5 class="section-title">Survey Kepuasan</h5>
                    
                    @php
                        $surveyItems = [
                            'kerjasama_tim' => 'Kemampuan Kerja Sama Tim',
                            'keahlian_bidang_it' => 'Keahlian Bidang IT',
                            'kemampuan_berbahasa_asing' => 'Kemampuan Berbahasa Asing',
                            'kemampuan_berkomunikasi' => 'Kemampuan Berkomunikasi',
                            'pengembangan_diri' => 'Pengembangan Diri',
                            'kepemimpinan' => 'Kepemimpinan',
                            'etos_kerja' => 'Etos Kerja'
                        ];
                        $ratings = [
                            'Kurang' => 'Kurang',
                            'Cukup' => 'Cukup',
                            'Baik' => 'Baik',
                            'Sangat Baik' => 'Sangat Baik'
                        ];
                    @endphp

                    @foreach($surveyItems as $name => $label)
                    <div class="rating-group">
                        <div class="rating-label">{{ $label }}</div>
                        <div class="rating-options">
                            @foreach($ratings as $value => $text)
                            <div class="rating-option">
                                <input class="form-check-input" type="radio" 
                                    name="{{ $name }}" value="{{ $value }}" 
                                    id="{{ $name }}_{{ str_replace(' ', '_', $value) }}" required>
                                <label class="form-check-label ms-1" for="{{ $name }}_{{ str_replace(' ', '_', $value) }}">
                                    {{ $text }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Saran untuk Kurikulum</label>
                        <textarea name="saran_untuk_kurikulum_prodi" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kemampuan yang Tidak Terpenuhi oleh Lulusan</label>
                        <textarea name="kemampuan_tdk_terpenuhi" class="form-control" rows="3"></textarea>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-submit">Kirim Survey</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Set today's date as default
            $('#tanggal').val(new Date().toISOString().substr(0, 10));
            
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
                            $('#instansi_id').val(data.instansi_id);
                        }
                    });
                } else {
                    $('#nama_instansi').val('');
                    $('#nama_atasan').val('');
                    $('#lokasi_instansi').val('');
                    $('#instansi_id').val('');
                }
            });
        });
    </script>
</body>
</html>
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
                            <label class="form-label fw-semibold">Nama Alumni</label>
                            <input type="text" class="form-control" value="{{ $alumni->nama }}" readonly>
                            <input type="hidden" name="alumni_id" value="{{ $alumni->alumni_id }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">NIM</label>
                            <input type="text" class="form-control" value="{{ $alumni->NIM }}" readonly>
                        </div>
                    </div>
                </div>

                <!-- Data Instansi Section -->
                <div class="survey-section">
                    <h5 class="section-title">Data Instansi
                        <small class="text-muted" style="font-size: 0.75rem;">
                            <i class="fas fa-info-circle me-1"></i>
                            *data instansi bisa di edit jika ada kesalahan input oleh alumni
                        </small>
                    </h5>
                    <div class="row g-3">
                        <input type="hidden" name="instansi_id" value="{{ $instansi->instansi_id }}">
                        <div class="col-md-6">
                            <label for="nama_instansi" class="form-label fw-semibold">Nama Instansi</label>
                            <input type="text" name="nama_instansi" id="nama_instansi" class="form-control" 
                                   value="{{ $instansi->nama_instansi }}">
                        </div>
                        <div class="col-md-6">
                            <label for="lokasi_instansi" class="form-label fw-semibold">Lokasi Instansi</label>
                            <input type="text" name="lokasi_instansi" id="lokasi_instansi" class="form-control" 
                                   value="{{ $instansi->lokasi_instansi }}">
                        </div>
                        <div class="col-md-6">
                            <label for="nama_atasan" class="form-label fw-semibold">Nama Atasan</label>
                            <input type="text" name="nama_atasan" id="nama_atasan" class="form-control" 
                                   value="{{ $instansi->nama_atasan }}">
                        </div>
                        <div class="col-md-6">
                            <label for="jabatan" class="form-label fw-semibold">Jabatan Atasan</label>
                            <input type="text" name="jabatan" id="jabatan" class="form-control"
                                   value="{{ $instansi->jabatan }}">
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal" class="form-label fw-semibold">Tanggal Pengisian</label>
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
        });
    </script>
</body>
</html>
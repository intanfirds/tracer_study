<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Kepuasan Pengguna Lulusan - Politeknik Negeri Malang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2563b3;    /* Lighter blue */
            --secondary-color: #45526e;  /* Darker blue */
            --accent-color: #3b82f6;     /* Kept the same accent color */
            --light-color: #f8f9fa;
            --border-color: #dee2e6;
        }
        
        body {
            background-color: #f5f7fa;
            font-family: 'Calibri', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }
        
        .header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 1rem 0;
            margin-bottom: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-bottom: 4px solid #ffc107;
        }
        
        .logo-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0;
        }
        
        .logo {
            height: 65px;
            transition: transform 0.3s ease;
        }
        
        .logo:hover {
            transform: scale(1.05);
        }
        
        .institution-info {
            text-align: center;
            flex-grow: 1;
            margin: 0 20px;
        }
        
        .institution-name {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 0.3rem;
            letter-spacing: 0.5px;
        }
        
        .institution-address {
            font-size: 0.85rem;
            opacity: 0.9;
            margin-bottom: 0.2rem;
        }
        
        .form-wrapper {
            background-color: white;
            padding: 2.5rem;
            border-radius: 5px;
            max-width: 1000px;
            margin: 0 auto 3rem;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid var(--border-color);
        }
        
        .form-title {
            color: var(--primary-color);
            font-weight: 700;
            text-align: center;
            margin-bottom: 2rem;
            font-size: 1.8rem;
            position: relative;
            padding-bottom: 0.8rem;
        }
        
        .form-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 25%;
            width: 50%;
            height: 3px;
            background-color: var(--secondary-color);
        }
        
        .survey-section {
            background-color: #fff;
            padding: 2rem;
            border-radius: 5px;
            margin-bottom: 2.5rem;
            border: 1px solid var(--border-color);
        }
        
        .section-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.7rem;
            border-bottom: 1px solid var(--border-color);
            font-size: 1.3rem;
            position: relative;
        }
        
        .section-title:before {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100px;
            height: 2px;
            background-color: var(--secondary-color);
        }
        
        .section-subtitle {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 1.5rem;
            font-style: italic;
            display: flex;
            align-items: center;
        }
        
        .rating-group {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            margin-bottom: 1.2rem;
            padding: 1rem;
            background-color: #f8fafc;
            border-radius: 4px;
            border-left: 3px solid var(--secondary-color);
        }
        
        .rating-label {
            flex: 1;
            min-width: 250px;
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #495057;
        }
        
        .rating-options {
            flex: 2;
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
        }
        
        .rating-option {
            display: flex;
            align-items: center;
        }
        
        .form-check-input {
            margin-top: 0;
            cursor: pointer;
            border: 1px solid var(--secondary-color);
        }
        
        .form-check-input:checked {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .form-control, .form-select {
            border: 1px solid var(--border-color);
            padding: 0.6rem 0.75rem;
            border-radius: 0.25rem;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.25rem rgba(26, 75, 140, 0.25);
        }
        
        .btn-submit {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            padding: 0.7rem 2.5rem;
            border: none;
            border-radius: 0.3rem;
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
        }
        
        .btn-submit:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 35, 102, 0.2);
        }
        
        .form-label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 0.5rem;
        }
        
        .info-icon {
            color: var(--secondary-color);
            margin-right: 0.5rem;
            font-size: 1.1rem;
        }
        
        .alert {
            border-left: 4px solid #dc3545;
        }
        
        .confidential-notice {
            font-size: 0.9rem;
            color: #6c757d;
            display: flex;
            align-items: center;
        }
        
        @media (max-width: 768px) {
            .logo-container {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }
            
            .logo {
                height: 55px;
            }
            
            .institution-info {
                margin: 0.5rem 0;
            }
            
            .institution-name {
                font-size: 1.4rem;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="container">
            <div class="logo-container">
                <img src="{{ asset('images/logo1.png') }}" alt="Logo Polinema" class="logo">
                <div class="institution-info">
                    <div class="institution-name">POLITEKNIK NEGERI MALANG</div>
                    <div class="institution-address">Jl. Soekarno-Hatta No.9, Malang 65141</div>
                    <div class="institution-address">Telp: (0341) 404424 | Email: info@polinema.ac.id</div>
                </div>
                <img src="{{ asset('images/logo-jti.png') }}" alt="Logo Secondary" class="logo">
            </div>
        </div>
    </div>

    <div class="container">
        <div class="form-wrapper">
            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <h5 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i>Terjadi Kesalahan</h5>
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
                
                <h2 class="form-title">FORMULIR SURVEY KEPUASAN PENGGUNA LULUSAN</h2>
                
                <!-- Data Alumni Section -->
                <div class="survey-section">
                    <h5 class="section-title">I. DATA ALUMNI</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Alumni</label>
                            <input type="text" class="form-control" value="{{ $alumni->nama }}" readonly>
                            <input type="hidden" name="alumni_id" value="{{ $alumni->alumni_id }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">NIM</label>
                            <input type="text" class="form-control" value="{{ $alumni->NIM }}" readonly>
                        </div>
                    </div>
                </div>

                <!-- Data Instansi Section -->
                <div class="survey-section">
                    <h5 class="section-title">II. DATA INSTANSI</h5>
                    <p class="section-subtitle">
                        <i class="fas fa-info-circle info-icon"></i>
                        Data instansi dapat diperbarui jika terdapat kesalahan input oleh alumni
                    </p>
                    
                    <div class="row g-3">
                        <input type="hidden" name="instansi_id" value="{{ $instansi->instansi_id }}">
                        <div class="col-md-6">
                            <label for="nama_instansi" class="form-label">Nama Instansi/Perusahaan</label>
                            <input type="text" name="nama_instansi" id="nama_instansi" class="form-control" 
                                   value="{{ $instansi->nama_instansi }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="lokasi_instansi" class="form-label">Lokasi Instansi</label>
                            <input type="text" name="lokasi_instansi" id="lokasi_instansi" class="form-control" 
                                   value="{{ $instansi->lokasi_instansi }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nama_atasan" class="form-label">Nama Atasan/Pimpinan</label>
                            <input type="text" name="nama_atasan" id="nama_atasan" class="form-control" 
                                   value="{{ $instansi->nama_atasan }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="jabatan" class="form-label">Jabatan Atasan</label>
                            <input type="text" name="jabatan" id="jabatan" class="form-control"
                                   value="{{ $instansi->jabatan }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal" class="form-label">Tanggal Pengisian</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                        </div>
                    </div>
                </div>

                <!-- Survey Kepuasan Section -->
                <div class="survey-section">
                    <h5 class="section-title">III. EVALUASI KOMPETENSI LULUSAN</h5>
                    <p class="section-subtitle">
                        <i class="fas fa-info-circle info-icon"></i>
                        Berikan penilaian Anda terhadap kompetensi lulusan Politeknik Negeri Malang (beri tanda ✓ pada kolom yang sesuai)
                    </p>
                    
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
                        <div class="rating-label">{{ $loop->iteration }}. {{ $label }}</div>
                        <div class="rating-options">
                            @foreach($ratings as $value => $text)
                            <div class="rating-option">
                                <input class="form-check-input" type="radio" 
                                    name="{{ $name }}" value="{{ $value }}" 
                                    id="{{ $name }}_{{ str_replace(' ', '_', $value) }}" required>
                                <label class="form-check-label ms-2" for="{{ $name }}_{{ str_replace(' ', '_', $value) }}">
                                    {{ $text }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach

                    <div class="mt-4">
                        <label class="form-label">Saran untuk Pengembangan Kurikulum Program Studi</label>
                        <textarea name="saran_untuk_kurikulum_prodi" class="form-control" rows="3" placeholder="Masukkan saran Anda untuk pengembangan kurikulum..."></textarea>
                    </div>

                    <div class="mt-3">
                        <label class="form-label">Kemampuan yang Masih Kurang pada Lulusan</label>
                        <textarea name="kemampuan_tdk_terpenuhi" class="form-control" rows="3" placeholder="Jelaskan kemampuan apa saja yang menurut Anda masih perlu ditingkatkan..."></textarea>
                    </div>
                </div>

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-5 pt-3 border-top">
                    <div class="confidential-notice mb-3 mb-md-0">
                        <i class="fas fa-lock me-2"></i> Data yang Anda berikan akan dijaga kerahasiaannya
                    </div>
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-paper-plane me-2"></i>Kirim Survey
                    </button>
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
            
            // Add smooth scrolling to form sections
            $('.section-title').click(function() {
                $('html, body').animate({
                    scrollTop: $(this).parent().offset().top - 20
                }, 500);
            });
        });
    </script>
</body>
</html>
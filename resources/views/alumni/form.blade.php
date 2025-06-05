<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pengisian Data Lulusan - Politeknik Negeri Malang</title>
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
            @if (session('success'))
                <div class="alert alert-success mb-4">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger mb-4">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                </div>
            @endif
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

            @php
                $alumni = \App\Models\Alumni::find(session('id'));
            @endphp

            <form id="alumni-form" action="{{ route('alumni.store') }}" method="POST">
                @csrf
                
                <h2 class="form-title">FORMULIR PENGISIAN DATA LULUSAN</h2>
                
                <!-- Data Alumni Section -->
                <div class="survey-section">
                    <h5 class="section-title">I. DATA ALUMNI</h5>
                    
                    @if ($alumni)
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Alumni</label>
                                <input type="text" class="form-control" value="{{ $alumni->nama }}" readonly>
                                <input type="hidden" name="nama" value="{{ $alumni->nama }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">NIM</label>
                                <input type="text" class="form-control" value="{{ strtoupper($alumni->NIM) }}" readonly>
                                <input type="hidden" name="nim" value="{{ strtoupper($alumni->NIM) }}">
                            </div>
                        </div>
                        <div class="row g-3 mt-2">
                            <div class="col-md-6">
                                <label class="form-label">Program Studi</label>
                                <input type="text" class="form-control" value="{{ $alumni->prodi->nama_prodi ?? '-' }}" readonly>
                                <input type="hidden" name="prodi_id" value="{{ $alumni->prodi_id }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tahun Lulus</label>
                                <input type="text" class="form-control" value="{{ $alumni->tahun_lulus ?? '-' }}" readonly>
                                <input type="hidden" name="tahun_lulus" value="{{ $alumni->tahun_lulus }}">
                            </div>
                        </div>
                    @else
                        <div class="alert alert-danger">Pengguna belum login atau data alumni tidak ditemukan.</div>
                    @endif

                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <label class="form-label">No. HP</label>
                            <input type="text" name="no_hp" class="form-control" pattern="[0-9]+" maxlength="15" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" value="{{ $alumni->email ?? '-' }}" readonly>
                            <input type="hidden" name="email" value="{{ $alumni->email }}">
                        </div>
                    </div>
                </div>

                <!-- Data Profesi Section -->
                <div class="survey-section">
                    <h5 class="section-title">II. DATA PROFESI</h5>
                    <p class="section-subtitle">
                        <i class="fas fa-info-circle info-icon"></i>
                        Silakan lengkapi data profesi Anda saat ini
                    </p>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Kategori Profesi</label>
                            <select name="kategori_id" id="kategori_profesi" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->kategori_id }}">{{ $kategori->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 pekerjaan-field">
                            <label class="form-label">Profesi</label>
                            <input type="text" name="profesi" class="form-control" required>
                        </div>
                    </div>
                </div>

                <!-- Data Instansi Section -->
                <div class="survey-section">
                    <h5 class="section-title">III. DATA INSTANSI</h5>
                    <p class="section-subtitle">
                        <i class="fas fa-info-circle info-icon"></i>
                        Lengkapi data instansi tempat Anda bekerja (jika bekerja)
                    </p>
                    
                    <div class="row g-3">
                        <div class="col-md-6 pekerjaan-field">
                            <label class="form-label">Tanggal Pertama Kerja</label>
                            <input type="date" name="tanggal_pertama_kerja" class="form-control" required>
                        </div>
                        <div class="col-md-6 pekerjaan-field">
                            <label class="form-label">Tanggal Mulai Kerja di Instansi Saat Ini</label>
                            <input type="date" name="tanggal_mulai_kerja" class="form-control" required>
                        </div>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-md-6 pekerjaan-field">
                            <label class="form-label">Jenis Instansi</label>
                            <select name="jenis_instansi_id" class="form-select" required>
                                <option value="">-- Pilih Jenis Instansi --</option>
                                @foreach ($jenis_instansis as $jenis_instansi)
                                    <option value="{{ $jenis_instansi->jenis_instansi_id }}">
                                        {{ $jenis_instansi->nama_jenis_instansi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 pekerjaan-field">
                            <label class="form-label">Nama Instansi</label>
                            <input type="text" name="nama_instansi" class="form-control" required>
                        </div>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-md-6 pekerjaan-field">
                            <label class="form-label">Skala Instansi</label>
                            <select name="skala" class="form-select" required>
                                <option value="">-- Pilih Skala --</option>
                                <option>Lokal</option>
                                <option>Nasional</option>
                                <option>Internasional</option>
                            </select>
                        </div>
                        <div class="col-md-6 pekerjaan-field">
                            <label class="form-label">Lokasi Instansi</label>
                            <input type="text" name="lokasi_instansi" class="form-control" required>
                        </div>
                    </div>
                </div>

                <!-- Data Atasan Section -->
                <div class="survey-section">
                    <h5 class="section-title">IV. DATA ATASAN LANGSUNG</h5>
                    <p class="section-subtitle">
                        <i class="fas fa-info-circle info-icon"></i>
                        Lengkapi data atasan langsung Anda di instansi saat ini
                    </p>
                    
                    <div class="row g-3">
                        <div class="col-md-6 pekerjaan-field">
                            <label class="form-label">Nama Atasan</label>
                            <input type="text" name="nama_atasan" class="form-control" required>
                        </div>
                        <div class="col-md-6 pekerjaan-field">
                            <label class="form-label">Jabatan Atasan</label>
                            <input type="text" name="jabatan" class="form-control" required>
                        </div>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-md-6 pekerjaan-field">
                            <label class="form-label">No. HP Atasan</label>
                            <input type="text" name="no_hp_atasan" class="form-control" pattern="[0-9]+" maxlength="15" required>
                        </div>
                        <div class="col-md-6 pekerjaan-field">
                            <label class="form-label">Email Atasan</label>
                            <input type="email" name="email_atasan" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-5 pt-3 border-top">
                    <div class="confidential-notice mb-3 mb-md-0">
                        <i class="fas fa-lock me-2"></i> Data yang Anda berikan akan dijaga kerahasiaannya
                    </div>
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-paper-plane me-2"></i>Kirim Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function togglePekerjaanFields(disable) {
            $('.pekerjaan-field input, .pekerjaan-field select').prop('disabled', disable);
            if (disable) {
                $('.pekerjaan-field input, .pekerjaan-field select').val('');
            }
        }

        $('#kategori_profesi').on('change', function() {
            const selectedText = $(this).find('option:selected').text().trim().toLowerCase();
            if (selectedText === 'belum bekerja') {
                togglePekerjaanFields(true);
            } else {
                togglePekerjaanFields(false);
            }
        });

        // Jalankan sekali di awal (jika kategori sudah dipilih sebelumnya)
        $('#kategori_profesi').trigger('change');

        $(document).ready(function() {
            emailjs.init("fHVyExSnS3Edg1P2l");

            $('#alumni-form').on('submit', function(e) {
                e.preventDefault();

                const form = this;
                const formData = new FormData(form);

                // Kirim data alumni ke backend dulu
                $.ajax({
                    url: form.action,
                    method: form.method,
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            if (response.token && response.email_atasan) {
                                const emailParams = {
                                    to_email: response.email_atasan,
                                    to_name: response.nama_atasan,
                                    alumni_name: response.nama_alumni,
                                    alumni_profesi: response.profesi,
                                    token: response.token,
                                    survey_link: `{{ url('/survey/index') }}?token=${response.token}`
                                };

                                emailjs.send('service_n8pyris', 'template_el4150l', emailParams)
                                    .then(function() {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Sukses!',
                                            text: 'Data berhasil disimpan dan email terkirim ke atasan.',
                                            confirmButtonText: 'OK'
                                        }).then(() => {
                                            window.location.href =
                                                "{{ route('cek_token') }}";
                                        });
                                    }, function(error) {
                                        console.error("Gagal kirim email:", error);
                                        Swal.fire({
                                            icon: 'warning',
                                            title: 'Peringatan',
                                            text: 'Data berhasil disimpan, tapi gagal mengirim email ke atasan.',
                                            confirmButtonText: 'OK'
                                        }).then(() => {
                                            window.location.href =
                                                "{{ route('cek_token') }}";
                                        });
                                    });
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Sukses!',
                                    text: 'Data berhasil disimpan.',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.href = "{{ route('cek_token') }}";
                                });
                            }
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Gagal menyimpan data.',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Kesalahan!',
                            text: 'Terjadi kesalahan saat menyimpan data.',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
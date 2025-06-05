<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pengisian Data Lulusan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            margin-bottom: 2rem;
        }

        label {
            font-weight: 500;
            color: #333;
        }

        .btn-submit {
            background-color: var(--secondary-color);
            color: white;
            font-weight: 600;
            padding: 0.5rem 1.5rem;
        }
    </style>
</head>

<body>
    <div class="form-wrapper">
        <h3 class="form-title">Formulir Pengisian Data Lulusan</h3>

        <!-- Alert -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan:</strong>
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

            @if ($alumni)
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nama</label>
                        <input type="text" class="form-control" value="{{ $alumni->nama }}" readonly>
                        <input type="hidden" name="nama" value="{{ $alumni->nama }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>NIM</label>
                        <input type="text" class="form-control" value="{{ strtoupper($alumni->NIM) }}" readonly>
                        <input type="hidden" name="nim" value="{{ strtoupper($alumni->NIM) }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Program Studi</label>
                        <input type="text" class="form-control" value="{{ $alumni->prodi->nama_prodi ?? '-' }}"
                            readonly>
                        <input type="hidden" name="prodi_id" value="{{ $alumni->prodi_id }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Tahun Lulus</label>
                        <input type="text" class="form-control" value="{{ $alumni->tahun_lulus ?? '-' }}" readonly>
                        <input type="hidden" name="tahun_lulus" value="{{ $alumni->tahun_lulus }}">
                    </div>
                </div>
            @else
                <div class="alert alert-danger">Pengguna belum login atau data alumni tidak ditemukan.</div>
            @endif

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>No. HP</label>
                    <input type="text" name="no_hp" class="form-control" pattern="[0-9]+" maxlength="15" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input type="text" class="form-control" value="{{ $alumni->email ?? '-' }}" readonly>
                    <input type="hidden" name="email" value="{{ $alumni->email }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Kategori Profesi</label>
                    <select name="kategori_id" id="kategori_profesi" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->kategori_id }}">{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3 pekerjaan-field">
                    <label>Profesi</label>
                    <input type="text" name="profesi" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3 pekerjaan-field">
                    <label>Tanggal Pertama Kerja</label>
                    <input type="date" name="tanggal_pertama_kerja" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3 pekerjaan-field">
                    <label>Tanggal Mulai Kerja di Instansi Saat Ini</label>
                    <input type="date" name="tanggal_mulai_kerja" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3 pekerjaan-field">
                    <label>Jenis Instansi</label>
                    <select name="jenis_instansi_id" class="form-control" required>
                        <option value="">-- Pilih Jenis Instansi --</option>
                        @foreach ($jenis_instansis as $jenis_instansi)
                            <option value="{{ $jenis_instansi->jenis_instansi_id }}">
                                {{ $jenis_instansi->nama_jenis_instansi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3 pekerjaan-field">
                    <label>Nama Instansi</label>
                    <input type="text" name="nama_instansi" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3 pekerjaan-field">
                    <label>Skala Instansi</label>
                    <select name="skala" class="form-control" required>
                        <option value="">-- Pilih Skala --</option>
                        <option>Lokal</option>
                        <option>Nasional</option>
                        <option>Internasional</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3 pekerjaan-field">
                    <label>Lokasi Instansi</label>
                    <input type="text" name="lokasi_instansi" class="form-control" required>
                </div>
            </div>

            <hr>
            <h5 class="text-primary mt-4 mb-3">Data Atasan Langsung</h5>
            <div class="row">
                <div class="col-md-6 mb-3 pekerjaan-field">
                    <label>Nama Atasan</label>
                    <input type="text" name="nama_atasan" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3 pekerjaan-field">
                    <label>Jabatan Atasan</label>
                    <input type="text" name="jabatan" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3 pekerjaan-field">
                    <label>No. HP Atasan</label>
                    <input type="text" name="no_hp_atasan" class="form-control" pattern="[0-9]+" maxlength="15"
                        required>
                </div>
                <div class="col-md-6 mb-3 pekerjaan-field">
                    <label>Email Atasan</label>
                    <input type="email" name="email_atasan" class="form-control" required>
                </div>
            </div>

            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-submit">Kirim</button>
            </div>
        </form>
    </div>

    <!-- jQuery dan EmailJS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    </script>
    <script>
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

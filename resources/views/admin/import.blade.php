@extends('layouts.app')

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">Import Data Alumni</h3>
        </div>

        <div class="card-body">
            <form action="{{ url('/admin/import') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Download Template</label><br>
                    <a href="{{ asset('template_alumni.xlsx') }}" class="btn btn-success btn-sm" download>
                        <i class="fa fa-file-excel"></i> Download Template
                    </a>
                </div>

                <div class="form-group">
                    <label for="file_alumni">Pilih File Excel</label>
                    <input type="file" name="file_alumni" id="file_alumni"
                        class="form-control @error('file_alumni') is-invalid @enderror" required>
                    @error('file_alumni')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <a href="{{ url('/admin/daftarAlumni') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-info">
                        Import <i class="fa fa-download"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- SweetAlert2 Flash Messages --}}
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: @json(session('success')),
                showConfirmButton: false,
                timer: 3000
            });
        @elseif (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: @json(session('error')),
                showConfirmButton: true
            });
        @elseif (session('warning'))
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: @json(session('warning')),
                showConfirmButton: true
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal!',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonText: 'Oke'
            });
        @endif
    </script>

    {{-- EmailJS Section --}}
    @if (session('send_email') && session('email_data'))
        <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                emailjs.init("fHVyExSnS3Edg1P2l");

                const alumniList = @json(session('email_data'));
                const loginBase = @json(url('/alumni/form'));

                if (Array.isArray(alumniList) && alumniList.length > 0 && window.emailjs) {
                    let suksesEmails = [];
                    let counter = 0;
                    let total = alumniList.length;

                    alumniList.forEach(item => {
                        const loginLink = `${loginBase}?token=${item.token}`;
                        emailjs.send("service_n8pyris", "template_khtm20x", {
                            to_email: item.email,
                            token: item.token,
                            login_link: loginLink
                        }).then(function(response) {
                            suksesEmails.push(item.email);
                            console.log("✅ Email berhasil dikirim ke:", item.email);
                        }).catch(function(error) {
                            console.error("❌ Gagal kirim ke:", item.email, error);
                        }).finally(() => {
                            counter++;
                            if (counter === total) {
                                Swal.fire({
                                    icon: suksesEmails.length > 0 ? 'success' : 'error',
                                    title: suksesEmails.length > 0 ?
                                        'Email Terkirim!' :
                                        'Gagal Kirim!',
                                    text: suksesEmails.length > 0 ?
                                        `Email berhasil dikirim ke ${suksesEmails.length} alumni.` :
                                        'Semua email gagal dikirim.',
                                    confirmButtonText: 'Oke'
                                });
                            }
                        });
                    });
                } else {
                    Swal.fire({
                        icon: 'info',
                        title: 'Tidak Ada Email',
                        text: 'Tidak ada data email yang bisa dikirim.',
                        confirmButtonText: 'Oke'
                    });
                }
            });
        </script>
    @endif
@endpush

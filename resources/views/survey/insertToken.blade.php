<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Kepuasan Pengguna Lulusan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            min-height: 100vh;
            background: #45526e;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
        }
        
        .form-wrapper {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .form-title { font-size: 1.5rem; font-weight: 700; color: #354764; margin-bottom: 0; }
        .subtitle { font-size: 1.2rem; color: #666; margin-bottom: 1rem; }
        .logo-img { height: 80px; margin: 1rem 0; }
        
        .form-control {
            padding: 0.75rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            text-align: center;
            margin: 1rem 0;
        }
        
        .btn-verify {
            background: #354764;
            color: white;
            font-weight: 500;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            border: none;
            width: 100%;
            max-width: 200px;
        }

        .info-text {
            color: #666;
            font-size: 0.9rem;
            margin: 0.5rem 0;
        }

        /* Add to existing styles */
        .modal-content {
            border-radius: 15px;
        }
        
        .modal-header {
            background: #354764;
            color: white;
            border-radius: 15px 15px 0 0;
        }
        
        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }
        
        .modal-body {
            padding: 2rem;
        }
        
        #requestNewTokenForm .form-control {
            text-align: left;
            background-color: #f8f9fa;
        }

        .input-group-text {
            background-color: #f8f9fa !important;
            border: 1px solid #ced4da !important;
            border-right: none !important;
            padding: 0.75rem 0.5rem 0.75rem 1rem !important;
        }

        .input-group-text i {
            font-size: 1rem;
            width: auto;
            opacity: 0.8;
        }

        #oldTokenInput {
            border-left: none !important;
            padding-left: 0.5rem !important;
        }

        @media (max-width: 576px) {
            .form-wrapper { margin: 1rem; }
            .form-title { font-size: 1.2rem; }
            .subtitle { font-size: 1rem; }
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="form-wrapper">
            <h1 class="form-title">SURVEY KEPUASAN PENGGUNA LULUSAN</h1>
            <h2 class="subtitle">POLITEKNIK NEGERI MALANG</h2>
            <img src="{{ asset('images/logo1.png') }}" alt="Logo Polinema" class="logo-img">

            @if(session('alert'))
                <div class="alert alert-{{ session('alert')['type'] }} py-2" role="alert">
                    @if(session('alert')['type'] == 'success')
                        <i class="fas fa-check-circle me-2"></i>
                    @else
                        <i class="fas fa-exclamation-circle me-2"></i>
                    @endif
                    {{ session('alert')['message'] }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger py-2" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                </div>
            @endif

            <form action="{{ route('verify.token') }}" method="POST">
                @csrf
                <input type="text" 
                    class="form-control @error('token') is-invalid @enderror" 
                    placeholder="Masukkan token Anda"
                    name="token" 
                    required 
                    autocomplete="off">
                
                <p class="info-text">
                    <i class="fas fa-info-circle me-1"></i>
                    Token dapat ditemukan pada email yang telah dikirimkan alumni.
                </p>

                <button type="submit" class="btn btn-verify">
                    <i class="fas fa-arrow-right me-2"></i>Verifikasi Token
                </button>
            </form>
        </div>
    </div>

    <div class="modal fade" id="requestNewTokenModal" tabindex="-1" aria-labelledby="requestNewTokenModalLabel" aria-hidden="true">
        @csrf
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="requestNewTokenForm" action="{{ route('survey.requestNewToken') }}" method="POST">
                    @csrf
                    <input type="hidden" name="instansi_id" value="{{ session('instansi_id') }}">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="requestNewTokenModalLabel">
                            <i class="fas fa-key me-2"></i>Permintaan Token Baru
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body px-4 py-4">
                        <div class="text-center mb-4">
                            <div class="token-expired-icon mb-3">
                                <i class="fas fa-clock fa-3x text-warning"></i>
                            </div>
                            <h6 class="fw-bold">Token Anda Telah Kadaluarsa</h6>
                            <p class="text-muted small">Silakan gunakan token lama Anda untuk mengajukan token baru</p>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold">Token Lama</label>
                            <div class="input-group">
                                <input type="text" 
                                    class="form-control border-start-0 ps-2" 
                                    id="oldTokenInput" 
                                    name="old_token"
                                    value="{{ session('old_token') }}"
                                    readonly>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-2"></i>Kirim Permintaan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    @if(session()->has('token_status') && session('token_status') == 'expired')
        let modal = new bootstrap.Modal(document.getElementById('requestNewTokenModal'));
        modal.show();
        // Isi old token kalau ada
        @if(session()->has('old_token'))
            document.getElementById('oldTokenInput').value = '{{ session('old_token') }}';
        @endif
    @endif
});
</script>
<script>
$(document).ready(function() {
    // Initialize EmailJS
    emailjs.init("fHVyExSnS3Edg1P2l");

    // Debug log to check if email data exists
    @if(session()->has('email_data'))
        console.log('Email data found:', @json(session('email_data')));
    @endif

    // Check if we have email data and should send email
    @if(session()->has('email_data') && session('email_data')['should_send_email'])
        const emailData = @json(session('email_data'));
        console.log('Preparing to send email with data:', emailData);
        
        // Prepare email parameters
        const emailParams = {
            to_email: emailData.email_atasan,
            to_name: emailData.nama_atasan,
            alumni_name: emailData.nama,
            alumni_profesi: emailData.profesi,
            token: emailData.new_token,
            message: `Token Anda: ${emailData.new_token}\n\nCatatan: Mohon simpan token ini dengan baik. Token ini hanya dapat digunakan sekali untuk mengisi survei.`,
            survey_link: `{{ url('/survey/index') }}?token=${emailData.new_token}`,
        };

        console.log('Sending email with params:', emailParams);

        // Send email automatically
        emailjs.send('service_n8pyris', 'template_el4150l', emailParams)
            .then(function(response) {
                console.log('Email sent successfully:', response);
                
                // Create success alert without token information
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-success py-2';
                alertDiv.innerHTML = `
                    <div class="d-flex align-items-start">
                        <i class="fas fa-check-circle me-2 mt-1"></i>
                        <div>
                            <div>Token baru telah dikirim ke email ${emailData.email_atasan}</div>
                        </div>
                    </div>
                `;
                
                // Insert alert before the form
                const formWrapper = document.querySelector('.form-wrapper');
                const existingForm = formWrapper.querySelector('form');
                formWrapper.insertBefore(alertDiv, existingForm);

                // Hide modal if it's open
                const modal = bootstrap.Modal.getInstance(document.getElementById('requestNewTokenModal'));
                if (modal) {
                    modal.hide();
                }
            })
            .catch(function(error) {
                console.error('Failed to send email:', error);
                
                // Create error alert
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-danger py-2';
                alertDiv.innerHTML = `
                    <i class="fas fa-exclamation-circle me-2"></i>
                    Gagal mengirim email token baru. Error: ${error.text}
                `;
                
                // Insert alert before the form
                const formWrapper = document.querySelector('.form-wrapper');
                const existingForm = formWrapper.querySelector('form');
                formWrapper.insertBefore(alertDiv, existingForm);
            });
    @endif
});
</script>
<!-- Keep Bootstrap JS at the end of body -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
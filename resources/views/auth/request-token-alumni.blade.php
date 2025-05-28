<!DOCTYPE html>
<html>
<head>
    <title>Request Login Token</title>
    {{-- <script src="https://cdn.emailjs.com/sdk/3.2/email.min.js"></script> --}}
    {{-- <script src="https://cdn.emailjs.com/sdk/3.6/email.min.js"></script> --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <script>
        (function(){
            emailjs.init("fHVyExSnS3Edg1P2l"); // Ganti dengan user ID EmailJS kamu
        })();
    </script>
</head>
<body>
    <h2>Request Login Token</h2>

    <form id="request-token-form">
        @csrf
        <input type="email" id="email" name="email" placeholder="Masukkan email alumni" required />
        <button type="submit">Kirim Token</button>
    </form>

    <p id="status-message"></p>

    <script>
        const form = document.getElementById('request-token-form');
        const statusMessage = document.getElementById('status-message');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const email = document.getElementById('email').value;

            fetch('/request-token-alumni', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ email: email })
            })
            .then(res => res.json())
            .then(data => {
                if(data.token) {
                    statusMessage.textContent = data.message;

                    // Kirim email via EmailJS
                    emailjs.send('service_n8pyris', 'template_khtm20x', {
                        to_email: email,
                        token: data.token,
                        login_link: `{{ url('/cek-token-alumni') }}?email=${encodeURIComponent(email)}&token=${data.token}`,
                    })
                    .then(() => {
                        statusMessage.textContent += ' Email berhasil dikirim!';
                    }, (error) => {
                        statusMessage.textContent += ' Gagal kirim email: ' + error.text;
                    });
                } else {
                    statusMessage.textContent = data.message || 'Terjadi kesalahan.';
                }
            })
            .catch(() => {
                statusMessage.textContent = 'Gagal menghubungi server.';
            });
        });
    </script>
</body>
</html>
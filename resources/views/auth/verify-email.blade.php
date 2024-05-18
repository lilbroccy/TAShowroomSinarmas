<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>
    <link href="{{ asset('user/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/css/auth.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="auth-container">
            <img src="{{ asset('user/img/logo-doang.jpg') }}" alt="Logo" class="logo">
            <h2 class="text-center">Verifikasi Email Anda</h2>
            <div class="alert alert-info text-center">
                {{ __('Sebelum melanjutkan, silakan periksa email Anda untuk tautan verifikasi.') }}
                {{ __('Jika Anda tidak menerima email') }},
            </div>
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                </div>
                <script>
                    // Tampilkan Sweet Alert jika resend berhasil saat halaman dimuat
                    Swal.fire({
                        icon: 'success',
                        title: 'Tautan verifikasi berhasil dikirim ulang!',
                        showConfirmButton: false,
                        timer: 3000 // Hide after 3 seconds
                    });
                </script>
            @endif
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block">{{ __('klik di sini untuk meminta yang lain') }}</button>
                </div>
            </form></br>
            <p class="text-center">Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
        </div>
    </div>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
</body>
</html>

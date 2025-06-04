<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SMAK YOS SUDARSO – Lupa Password</title>

    <!-- Google Fonts & Font Awesome -->
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />

    <!-- SweetAlert2 (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>

  <body>
    <main class="login-container">
      <section class="login-wrapper">
        <section class="image-section">
          <img
            src="{{ asset('assets/image 3.jpeg') }}"
            class="school-image"
            alt="Background Image"
          />
          <div class="image-overlay"></div>
        </section>

        <section class="content-section">
          <header class="title-container">
            <h1 class="main-title">TRACER STUDY</h1>
            <h2 class="school-name">SMAK YOS SUDARSO</h2>
          </header>

          <div class="form-container">
            <form action="{{ route('password.email') }}" method="POST">
              @csrf

              <h3 class="form-title">Lupa Password</h3>

              <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input
                  type="email"
                  name="email"
                  id="email"
                  placeholder="you@example.com"
                  class="form-input"
                  required
                />
              </div>

              <div class="form-actions">
                <button type="submit" class="sign-in-button">
                  Kirim Reset Link
                </button>
                <button
                  type="button"
                  class="backtologin-button"
                  onclick="window.location.href='{{ route('login') }}'"
                >
                  Kembali ke Sign In
                </button>
              </div>
            </form>
          </div>

          @if (session('status'))
            <div class="alert alert-success" role="alert">
              Kami telah mengirimkan tautan pengaturan ulang kata sandi Anda melalui email
            </div>
          @endif
        </section>
      </section>
    </main>

    <!-- SweetAlert handler -->
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        @if ($errors->has('email'))
          Swal.fire({
            title: 'Gagal!',
            text: 'Email tidak ditemukan.',
            icon: 'error',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
          });
        @endif

        @if (session('status'))
          Swal.fire({
            title: 'Berhasil!',
            text: 'Kami telah mengirimkan tautan pengaturan ulang kata sandi Anda melalui email',
            icon: 'success',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
          });
        @endif
      });
    </script>
  </body>
</html>

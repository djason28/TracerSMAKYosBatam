<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SMAK YOS SUDARSO - Reset Password</title>

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
            src="{{ asset('assets/image 1.png') }}"
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
            <form action="{{ route('password.update') }}" method="POST">
              @csrf

              <h3 class="form-title">Reset Password</h3>

              {{-- Passed-in hidden email --}}
              <input 
                type="hidden" 
                name="email" 
                value="{{ old('email', $email) }}" 
              />

              {{-- Input Password Baru --}}
              <div class="form-group" style="position: relative;">
                <label class="form-label">Password</label>
                <div class="password-wrapper">
                  <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    placeholder="Password" 
                    class="form-input"  
                    required
                  />
                  <span 
                    class="password-toggle" 
                    onclick="togglePassword('password', 'eyeIcon_reset')"
                  >
                    <i class="fa fa-eye" id="eyeIcon_reset"></i>
                  </span>
                </div>
              </div>

              {{-- Input Konfirmasi Password --}}
              <div class="form-group" style="position: relative;">
                <label class="form-label">Confirmation Password</label>
                <div class="password-wrapper">
                  <input 
                    type="password" 
                    name="password_confirmation" 
                    id="password_confirmation" 
                    placeholder="Password Confirmation" 
                    class="form-input"  
                    required
                  />
                  <span 
                    class="password-toggle" 
                    onclick="togglePassword('password_confirmation', 'cfm_eyeIcon_reset')"
                  >
                    <i class="fa fa-eye" id="cfm_eyeIcon_reset"></i>
                  </span>
                </div>
              </div>

              {{-- Hidden token --}}
              <input
                type="hidden"
                name="token"
                value="{{ $token }}"
                id="token"
                class="form-input"
                required
              />

              <button type="submit" class="sign-in-button">
                Send Reset Link
              </button>
            </form>
          </div>

          {{-- SweetAlert2 untuk notifikasi sukses / error validasi --}}
          <script>
            document.addEventListener('DOMContentLoaded', function () {
              @if (session('status'))
                Swal.fire({
                  title: 'Berhasil!',
                  text: '{{ session('status') }}',
                  icon: 'success',
                  confirmButtonText: 'OK',
                  confirmButtonColor: '#3085d6'
                });
              @endif

              @if ($errors->any())
                Swal.fire({
                  title: 'Gagal!',
                  icon: 'error',
                  html: `{!! implode('<br/>', $errors->all()) !!}`,
                  confirmButtonText: 'OK',
                  confirmButtonColor: '#d33'
                });
              @endif
            });
          </script>
          {{-- End SweetAlert2 --}}
        </section>
      </section>
    </main>

    <script>
      function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (input.type === "password") {
          input.type = "text";
          icon.classList.remove("fa-eye");
          icon.classList.add("fa-eye-slash");
        } else {
          input.type = "password";
          icon.classList.remove("fa-eye-slash");
          icon.classList.add("fa-eye");
        }
      }
    </script>
  </body>
</html>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SMAK YOS SUDARSO - Login</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script>
    localStorage.removeItem('token');
    document.cookie = 'laravel_session=; Max-Age=0; path=/';
    document.cookie = 'XSRF-TOKEN=; Max-Age=0; path=/';

</script>
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
  </head>
  <body>
    <main class="login-container">
      <section class="login-wrapper">
        <section class="image-section">
          <img
            src="{{ asset('assets/image 3.jpeg') }}"
            class="school-image"
          />
          <div class="image-overlay"></div>
        </section>

        <section class="content-section">
          <header class="title-container">
            <h1 class="main-title">TRACER STUDY</h1>
            <h2 class="school-name">SMAK YOS SUDARSO</h2>
          </header>
          <div class="form-container">
            <form class="login-form">
            @csrf
              <h3 class="form-title">Sign In</h3>
              <div class="form-group">
                <label for="login" class="form-label">Email atau NIS</label>
                <input
                  type="text"
                  id="login"
                  name="login"
                  placeholder="email atau nis"
                  class="form-input"
                  required
                />
              </div>
            <div class="form-group" style="position: relative;">
              <label class="form-label">Password</label>
              <div class="password-wrapper">
                <input 
                type="password" 
                name="password" 
                id="password" 
                placeholder="Password" 
                class="form-input"  
                required/>
                <span 
                class="password-toggle" 
                onclick="togglePassword('password', 'eyeIcon')"
                >
                <i class="fa fa-eye" id="eyeIcon"></i>
              </span>
            </div>
                <br>
                <a href="/forgot-password">Lupa password?</a>
            </div>
              <div class="form-spacer"></div>
              <button type="submit" class="sign-in-button">Sign In</button>

            </form>
          </div>
        </section>
      </section>
    </main>
 
    

<script>
document.querySelector('.login-form').addEventListener('submit', async function(e) {
    e.preventDefault();

    const login = document.querySelector('#login').value;
    const password = document.querySelector('#password').value;

    try {
        const response = await fetch('/login', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ login, password })
        });

        let data = {};
        try {
            data = await response.json();
        } catch (e) {
            data.message = 'Terjadi kesalahan pada server.';
        }

        if (response.ok) {
            localStorage.setItem('token', data.access_token);

            Swal.fire({
                title: 'Berhasil!',
                text: 'Login berhasil!',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6'
            }).then(() => {
                if (data.user.role === 'admin') {
                    window.location.href = '/dashboard';
                } else {
                    window.location.href = `/alumni/${data.user.id}`;
                }
            });
        } else {
            Swal.fire({
                title: 'Login Gagal',
                text: data.message || 'Email/NIS atau password salah.',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6'
            });
        }

    } catch (error) {
        console.error(error);
        Swal.fire({
            title: 'Kesalahan',
            text: 'Tidak dapat menghubungi server.',
            icon: 'error',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        });
    }
});

</script>

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

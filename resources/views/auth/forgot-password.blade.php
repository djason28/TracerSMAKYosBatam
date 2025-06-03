<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SMAK YOS SUDARSO - Login</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            <form action="{{ route('password.email') }}" method="POST">
            @csrf

            <h3 class="form-title">Forget Password</h3>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input
                type="email"
                name="email"            {{-- HARUS ADA --}}
                id="email"
                placeholder="you@example.com"
                class="form-input"
                required                 {{-- opsional tapi disarankan --}}
                />
            </div>
            <div class="form-actions">
            <button type="submit" class="sign-in-button">
                Send Reset Link
            </button>

            <button type="button" class="backtologin-button" onclick="window.location.href='{{ route('login') }}'">Kembali ke Sign In</button>
            </form>
            </div>

          </div>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            {{-- end session message --}}

            {{-- begin validation errors --}}
            @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif
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

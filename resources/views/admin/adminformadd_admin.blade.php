<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="requires-auth" content="true">
    <title>Tammbah Admin</title>
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap"
      rel="stylesheet"
    />
    <script src="{{ asset('assets/js/auth.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <body class="admin-add-form-page">
    <div class="container">
      <aside class="sidebar">
        
      <div class="avatar-wrapper">
        <img src="{{ asset('assets/Ellipse 1.png') }}" alt="Profile Image" class="avatar-img">
        </div>


        <nav class="sidebar-nav">
          <a href="#" class="nav-item" onclick="window.location.href='{{ route('dashboard') }}'">DASHBOARD</a>
          <a href="#" class="nav-item" onclick="window.location.href='{{ route('alumnidb_admin') }}'">ALUMNI</a>
          <a href="#" class="nav-item nav-item-active" >ADMIN</a>
        </nav>
      </aside>

      <main class="main-content">
        <header class="header">
          <h1 class="page-title">TAMBAH ADMIN</h1>
  
        </header>

        <section class="form-section">
          <form class="alumni-form" id="addAdminForm" method="POST">
            <div class="form-grid-single">

              <div class="form-group">
                <label class="form-label"
                  >Nama Admin</label
                >
                <input
                  type="text"
                  name="name"
                  placeholder="Nama Admin"
                  class="form-input" required
                />
              </div>

              <div class="form-group">
                <label class="form-label">Email</label>
                <input
                  type="email"
                  placeholder="Email"
                  name="email"
                  class="form-input"
                  id="emailInput"
                  required
                />
                <small id="emailError" style="color: red; display: none;">Email harus menggunakan @gmail.com</small>
              </div>

              <div class="form-group" style="position: relative;">
                <label class="form-label"
                  >Password</label>
                <div class="password-wrapper">
                <input
                  type="text"
                  name="password"
                  id="password_addadm"
                  placeholder="Password"
                  class="form-input"
                  minlength="6" required
                />
              <span 
                class="password-toggle" 
                onclick="togglePassword('password_addadm', 'eyeIcon_addadm')"
                >
                <i class="fa fa-eye" id="eyeIcon_addadm"></i>
              </span>
              </div>
              </div>

              <div class="form-actions">
              <button type="button" class="back-button"  onclick="window.location.href='{{ route('admindb_admin') }}'">Kembali</button>
              <button type="submit" class="submit-button">Tambah Admin</button>
            </div>

            </div>

          </form>
        </section>
      </main>
    </div>

<script> const REDIRECT_URL = "{{ route('admindb_admin') }}"; </script>
<script src="{{ asset('assets/js/custom.js') }}"> </script>


</body>
</html>

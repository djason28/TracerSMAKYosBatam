<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="requires-auth" content="true">
    <title>Tammbah Alumni</title>
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap"
      rel="stylesheet"
    />
    <script src="{{ asset('assets/js/auth.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


  </head>
  <body class="alumni-add-form-page">
    <div class="container">
      <aside class="sidebar">

      <div class="avatar-wrapper">
        <img src="{{ asset('assets/Ellipse 1.png') }}" alt="Profile Image" class="avatar-img">
        </div>


        <nav class="sidebar-nav">
          <a href="#" class="nav-item" onclick="window.location.href='{{ route('dashboard') }}'">DASHBOARD</a>
          <a href="#" class="nav-item nav-item-active">ALUMNI</a>
          <a href="#" class="nav-item" onclick="window.location.href='{{ route('admindb_admin') }}'">ADMIN</a>
        </nav>
      </aside>

      <main class="main-content">
        <header class="header">
          <h1 class="page-title">TAMBAH ALUMNI</h1>
  
        </header>

        <section class="form-section">
          <form class="alumni-form" id="addAlumniForm" method="POST">
            <div class="form-grid">

              <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input
                  type="text"
                  placeholder="Nama Lengkap"
                  name="name"
                  class="form-input"
                  required
                />
              </div>

              <div class="form-group">
                <label class="form-label">NIS</label>
                <input
                  type="text"
                  placeholder="NIS"
                  id="nis"
                  name="nis"
                  class="form-input"
                  required
                />
              </div>

              <div class="form-group">
                <label class="form-label">Tanggal Lahir</label>
                <input
                  type="date"
                  placeholder="Tanggal Lahir"
                  name="birth_date"
                  class="form-input"
                />
              </div>

              <div class="form-group">
                <label class="form-label">Tahun Kelulusan</label>
                <input
                  type="number"
                  placeholder="Angkatan"
                  name="graduation_year"
                  class="form-input"
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
                />
                <small id="emailError" style="color: red; display: none;">Email harus menggunakan @gmail.com</small>
              </div>


              <div class="form-group">
                <label class="form-label">Instagram</label>
                <input
                  type="text"
                  placeholder="Instagram"
                  name="insta"
                  class="form-input"
                />
              </div>

              <div class="form-group">
                <label class="form-label">Nama Universitas</label>
                <select
                  type="text"
                  placeholder="Nama Universitas"
                  name="university_name"
                  id="univ"
                  class="form-input"
                ></select>
              </div>


              <div class="form-group">
                <label class="form-label">Jurusan</label>
                <select
                  type="text"
                  placeholder="Jurusan"
                  name="major"
                  id="major"
                  class="form-input"
                ></select>
              </div>


              <div class="form-group">
                <label class="form-label">Tempat Kerja</label>
                <div class="form-group" style="flex-direction:row;">
                <input
                  type="text"
                  placeholder="Tempat Kerja"
                  name="work"
                  class="form-input"
                />                
                <select id="city" name="city" class="city-dropdown">
                  <option value=""></option>
                </select>
              </div>
              </div>

              <div class="form-group">
                <label class="form-label">Jabatan</label>
                <input
                  type="text"
                  placeholder="Jabatan"
                  name="job_title"
                  class="form-input"
                />
              </div>


              <div class="form-group">
                <label class="form-label">Nomor Telepon</label>
                <input
                  type="number"
                  placeholder="Nomor Telepon"
                  name="phone"
                  class="form-input"
                />
              </div>

            <div class="form-group" style="position: relative;">
                <label class="form-label">Password</label>
                <div class="password-wrapper">
                <input
                  type="password"
                  id="password_addalum"
                  placeholder="Password"
                  name="password"
                  class="form-input"
                  minlength="8" required
                />
              <span 
                class="password-toggle" 
                onclick="togglePassword('password_addalum', 'eyeIcon_addalum')"
              >
                <i class="fa fa-eye" id="eyeIcon_addalum"></i>
              </span>
              </div>
            </div>
          

          </div>

            <div class="form-actions">
              <button type="button" class="back-button"  onclick="window.location.href='{{ route('alumnidb_admin') }}'">Kembali</button>
              <button type="submit" class="submit-button">Tambah Alumni</button>
            </div>

          </form>
        </section>
      </main>
    </div>

<script> const REDIRECT_URL = "{{ route('alumnidb_admin') }}"; </script>
<script src="{{ asset('assets/js/custom.js') }}"> </script>

</body>
</html>

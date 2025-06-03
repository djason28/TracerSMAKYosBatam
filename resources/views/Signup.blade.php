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
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

  </head>
  <body>
    <main class="login-container">
      <section class="login-wrapper">
        <section class="image-section">
            <img
            src="{{ asset('assets/image 1.png') }}"
            class="school-image"
          />
          <div class="image-overlay"></div>
        </section>

    <section class="registration-container">
      <form class="registration-form" id="addAlumniForm" method="POST">
        <header class="form-header">
          <h1 class="form-title">Daftar Akun</h1>
        </header>

        <section class="form-row">
          <div class="form-group">
            <label class="form-label">Nama Lengkap</label>
            <input
              type="text"
              id="name"
              name="name"
              placeholder="Nama Lengkap"
              class="form-input"
            />
          </div>
          <div class="form-group">
            <label  class="form-label">NISN</label>
            <input
              type="text"
              id="nisn"
              name="nisn"
              placeholder="NISN"
              class="form-input"
            />
          </div>
        </section>

        <section class="form-row">
          <div class="form-group">
            <label  class="form-label">Email</label>
            <input
              type="email"
              id="email"
              name="email"
              placeholder="Email"
              class="form-input"
            />
          </div>
          <div class="form-group">
            <label class="form-label">Tanggal Lahir</label>
            <input
              type="date"
              id="birth_date"
              name="birth_date"
              placeholder="Tanggal Lahir"
              class="form-input"
            />
          </div>
        </section>

        <section class="form-row">
          <div class="form-group">
            <label for="nisn" class="form-label">Password</label>
            <input
              type="password"
              id="password"
              name="password"
              placeholder="NISN"
              class="form-input"
            />
          </div>
          <div class="form-group">
            <label for="nisn" class="form-label">password_confirmation</label>
            <input
              type="password"
              id="password"
              name="password"
              placeholder="NISN"
              class="form-input"
            />
          </div>
        </section>


        <section class="form-row">
          <div class="form-group">
            <label class="form-label">Nomor Telepon</label>
            <input
              type="number"
              id="phone"
              name="phone"
              placeholder="nomor telepon"
              class="form-input"
            />
          </div>
          <div class="form-group">
            <label class="form-label">Angkatan Lulus</label>
            <input
              type="number"
              id="graduation_year"
              name="graduation_year"
              placeholder="Angkatan"
              class="form-input"
            />
          </div>
        </section>

        <section class="form-row">
          <div class="form-group">
            <label for="universityName" class="form-label"
              >Nama Universitas</label
            >
            <input
              type="text"
              id="universityName"
              placeholder="Nama Universitas"
              class="form-input"
            />
          </div>
          <div class="form-group">
            <label for="universityId" class="form-label">NIM Universitas</label>
            <input
              type="text"
              id="universityId"
              placeholder="NIM Universitas"
              class="form-input"
            />
          </div>
        </section>

        <section class="form-row">
          <div class="form-group">
            <label for="workplaceName" class="form-label"
              >Tempat Kerja</label
            >
            <input
              type="text"
              id="workplaceName"
              placeholder="Tempat Kerja , Kota"
              class="form-input"
            />
          </div>
          <div class="form-group">
            <label for="position" class="form-label">Jabatan</label>
            <input
              type="text"
              id="position"
              placeholder="Jabatan"
              class="form-input"
            />
          </div>
        </section>

        <button type="submit" class="register-button" >Daftar</button>
      </form>

      <footer class="login-section">
        <p class="login-text">Sudah punya akun?</p>
        <button type="button" class="login-button" onclick="window.location.href='{{ route('login') }}'">Kembali ke Sign In</button>
      </footer>

</section>
      </section>
    </main>
  </body>
</html>

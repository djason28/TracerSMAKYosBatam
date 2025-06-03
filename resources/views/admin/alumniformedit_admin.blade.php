<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="requires-auth" content="true">
    <title>Edit Alumni</title>
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
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

  </head>
  <body>
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
          <h1 class="page-title">EDIT ALUMNI</h1>
  
        </header>

        <section class="form-section">
          <form class="alumni-form" method="POST" action="{{ route('updatealumni', $alumniad->id) }}">
          @csrf
          @method('PUT')   

          <div class="form-grid">
              <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input
                  type="text"
                  name="name"
                  value="{{ $alumniad->name}}" 
                  class="form-input"
                  required
                />
              </div>
              
              <div class="form-group">
                <label class="form-label">NIS</label>
                <input
                  type="text"
                  name="nis"
                  value="{{ $alumniad->nis}}" 
                  class="form-input"
                  required
                />
              </div>

              <div class="form-group">
                <label class="form-label">Tanggal Lahir</label>
                <input
                  type="date"
                  name="birth_date"
                  value="{{ $alumniad->birth_date}}" 
                  class="form-input"
                />
              </div>

              <div class="form-group">
                <label class="form-label">Tahun Kelulusan</label>
                <input
                  type="number"
                  name="graduation_year"
                  value="{{ $alumniad->graduation_year}}" 
                  class="form-input"
                />
              </div>

               <div class="form-group">
                <label class="form-label">Email</label>
                <input
                  type="email"
                  name="email"
                  value="{{ $alumniad->email}}" 
                  class="form-input"
                />
              </div>

              <div class="form-group">
                <label class="form-label">Instagram</label>
                <input
                  type="text"
                  name="insta"
                  value="{{ $alumniad->insta}}" 
                  class="form-input"
                />
              </div>


              <div class="form-group">
                <label class="form-label">Nama Universitas</label>
                <select
                  type="text"
                  name="university_name"
                  id="univ"
                  data-selected="{{ $alumniad->university_name}}" 
                ></select>
              </div>

              
              <div class="form-group">
                <label class="form-label">Jurusan</label>
                <select
                  type="text"
                  placeholder="Jurusan"
                  name="major"
                  id="major"
                  data-selected="{{ $alumniad->major}}" 
                ></select>
              </div>

              
              <div class="form-group">
                <label class="form-label">Tempat Kerja</label>
                <div class="form-group" style="flex-direction:row;">
                <input
                  type="text"
                  name="work"
                  class="form-input"
                  value="{{ old('work', $work ?? '') }}"
                />
                <select id="city" name="city" class="city-dropdown" data-selected="{{ old('city', $city ?? '') }}" style="background-color: #ff0303;"></select>
              </div>
              </div>

              <div class="form-group">
                <label class="form-label">Jabatan</label>
                <input
                  type="text"
                  name="job_title"
                  value="{{ $alumniad->job_title}}" 
                  class="form-input"
                />
              </div>
            
              <div class="form-group">
                <label class="form-label">Nomor Telepon</label>
                <input
                  type="number"
                  name="phone"
                  value="{{ $alumniad->phone}}"
                  class="form-input"
                />
              </div>

            <div class="form-group" style="position: relative;">
              <label class="form-label">Password</label>
              <div class="password-wrapper">
                <input 
                type="password" 
                name="password" 
                id="password_editalm" 
                placeholder="kosongkan jika tidak ingin diubah" 
                class="form-input" 
                />
              <span 
                class="password-toggle" 
                onclick="togglePassword('password_editalm', 'eyeIcon_editalm')"
              >
                <i class="fa fa-eye" id="eyeIcon_editalm"></i>
              </span>
            </div>
            </div>
          
          </div>

            <div class="form-actions">
              <button type="button" class="back-button"  onclick="window.location.href='{{ route('alumnidb_admin') }}'">Kembali</button>
              <button type="submit" class="submit-button">Edit Alumni</button>
            </div>
          </form>

@if ($errors->any())
<script>
    Swal.fire({
        title: 'Gagal!',
        html: `{!! implode('<br>', $errors->all()) !!}`,
        icon: 'error',
        confirmButtonText: 'OK',
        confirmButtonColor: '#3085d6'
    });
</script>
@endif

        </section>
      </main>
    </div>

<script src="{{ asset('assets/js/custom.js') }}"></script>

  </body>
</html>

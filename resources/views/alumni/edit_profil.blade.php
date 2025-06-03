<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="requires-auth" content="true">
  <title>Data Diri Siswa</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.30.0/tabler-icons.min.css">
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="{{ asset('assets/js/auth.js') }}"></script>  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body>
  <div class="dashboard-container">
<aside class="sidebar">
       
<div class="avatar-wrapper">
        <img src="{{ asset('assets/Ellipse 1.png') }}" alt="Profile Image" class="avatar-img">
        </div>


        <nav class="sidebar-nav">
          <a href="#" class="nav-item nav-item-active">DATA DIRI</a>
        </nav>
      </aside>

    <main class="main-content">
      <header class="top-bar">
      <h1 class="page-title">EDIT DATA DIRI</h1>
      </header>

      <section class="form-section">
          <form class="alumni-form" method="POST" action="{{ route('updateprofil', $alumni->id) }}">
          @csrf
          @method('PUT')   

          <div class="form-grid">
              <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input
                  type="text"
                  name="name"
                  value="{{ $alumni->name}}" 
                  class="form-input"
                  required
                />
              </div>

              <div class="form-group">
                <label class="form-label">NIS</label>
                <input
                  type="text"
                  name="nis"
                  value="{{ $alumni->nis}}" 
                  class="form-input"
                  required
                />
              </div>

              <div class="form-group">
                <label class="form-label">Tanggal Lahir</label>
                <input
                  type="date"
                  name="birth_date"
                  value="{{ $alumni->birth_date}}" 
                  class="form-input"
                  required
                />
              </div>

              <div class="form-group">
                <label class="form-label">Tahun Kelulusan</label>
                <input
                  type="number"
                  name="graduation_year"
                  value="{{ $alumni->graduation_year}}" 
                  class="form-input"
                  required
                />
              </div>

               <div class="form-group">
                <label class="form-label">Email</label>
                <input
                  type="email"
                  name="email"
                  value="{{ $alumni->email}}" 
                  class="form-input"
                  required
                />
              </div>

              <div class="form-group">
                <label class="form-label">Instagram</label>
                <input
                  type="text"
                  name="insta"
                  value="{{ $alumni->insta}}" 
                  class="form-input"
                  required
                />
              </div>

              <div class="form-group">
                <label class="form-label">Nama Universitas</label>
                <select
                  type="text"
                  name="university_name"
                  id="univ"
                  data-selected="{{ $alumni->university_name}}" 
                  required
                ></select>
              </div>

              <div class="form-group">
                <label class="form-label">Jurusan</label>
                <select
                  type="text"
                  name="major"
                  id="major"
                  data-selected="{{ $alumni->major}}" 
                  required
                ></select>
              </div>

              <div class="form-group">
                <label class="form-label">Tempat Kerja</label>
                <div class="form-group" style="flex-direction:row;">
                <input
                    type="text"
                    name="work"
                    class="form-input"
                    placeholder="isi 'Belum Kerja' jika belum kerja"
                    @if(old('work', $work ?? '') != '') 
                        value="{{ old('work', $work ?? '') }}" 
                    @endif
                    required
                />
                <select id="city" name="city" class="city-dropdown" data-selected="{{ old('city', $city ?? '') }}" required></select>
              </div>
              </div>

              <div class="form-group">
                <label class="form-label">Jabatan</label>
                  <input
                    type="text"
                    name="job_title"
                    placeholder="isi 'Belum Kerja' jika belum kerja"
                    class="form-input"
                    @if(!empty($alumni->job_title))
                      value="{{ $alumni->job_title }}"
                    @endif
                    required
                  />
              </div>

            <div class="form-group">
                <label class="form-label">Nomor Telepon</label>
                <input
                  type="number"
                  name="phone"
                  value="{{ $alumni->phone}}"
                  class="form-input"
                  required
                />
              </div>

            
              
            <div class="form-group" style="position: relative;">
              <label class="form-label">Password Lama</label>
              <div class="password-wrapper">
                <input 
                type="password" 
                name="old_password" 
                id="old_password_editalm" 
                placeholder="Password Lama (kosongkan jika tidak ingin diubah)" 
                class="form-input"  />
                <span 
                class="password-toggle" 
                onclick="togglePassword('old_password_editalm', 'old_eyeIcon_editalm')"
                >
                <i class="fa fa-eye" id="old_eyeIcon_editalm"></i>
              </span>
            </div>
            </div>


          <div class="form-group" style="position: relative;">
            <label class="form-label">Password Baru</label>
            <div class="password-wrapper">
            <input
              type="password"
              name="password"
              id="password_new_editalm" 
              class="form-input"
              placeholder="Password Baru (kosongkan jika tidak ingin diubah)"
            />
             <span 
                class="password-toggle" 
                onclick="togglePassword('password_new_editalm', 'eyeIcon_new_editalm')"
                >
                <i class="fa fa-eye" id="eyeIcon_new_editalm"></i>
              </span>
          </div>
          </div>
            
          
            <div class="form-actions" style="margin-top: 30px;">
              <button type="button" class="back-button"  onclick="window.location.href='{{ route('alumni', ['id' => $alumni->id])  }}'">Kembali</button>
              <button type="submit" class="submit-button">Edit Alumni</button>
            </div>

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

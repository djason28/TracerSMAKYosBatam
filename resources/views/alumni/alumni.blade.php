<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="requires-auth" content="true">
  <title>Alumni Dashboard</title>
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap"
    rel="stylesheet"
  />
  <script src="{{ asset('assets/js/auth.js') }}"></script>  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <div class="dashboard-container">
<aside class="sidebar" id="sidebar">

        <div class="avatar-wrapper">
        <img src="{{ asset('assets/Ellipse 1.png') }}" alt="Profile Image" class="avatar-img">
        </div>


        <nav class="sidebar-nav">
          <a href="#" class="nav-item nav-item-active" >DATA DIRI</a>
        </nav>
      </aside>

    <main class="main-content">
      <header class="top-bar">
      <button id="toggleSidebar" class="toggle-btn">☰</button>
      <h1 class="page-title">DATA DIRI SISWA</h1>
      
        <div class="user-section">
          <div class="welcome-message">
            <i class="ti ti-user-circle"></i>
            <span>Welcome!</span>
          </div>
          <button class="add-admin-button" onclick="window.location.href='{{ route('edit_profil' , $alumni->id) }}'">
          <i class="ti ti-edit action-icon"></i> Edit Profil</button>
          <button class="logout-button" onclick="logout()">Log Out</button>
        </div>
      </header>

      <section class="form-image-section">
        <div class="form-column">
          <form class="alumni-form" method="POST">
          @method('PUT') 

            <div class="form-group-list">
              <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input
                  type="text"
                  name="name"
                  value="{{ $alumni->name}}" 
                  class="form-input"
                  readonly
                />
              </div>

              <div class="form-group">
                <label class="form-label">NIS</label>
                <input
                  type="text"
                  name="nis"
                  value="{{ $alumni->nis}}" 
                  class="form-input"
                  readonly
                />
              </div>

              <div class="form-group">
                <label class="form-label">Tanggal Lahir</label>
                <input
                  type="date"
                  name="birth_date"
                  value="{{ $alumni->birth_date}}" 
                  class="form-input"
                  readonly
                />
              </div>

              <div class="form-group">
                <label class="form-label">Tahun Kelulusan</label>
                <input
                  type="text"
                  name="graduation_year"
                  value="{{ $alumni->graduation_year}}" 
                  class="form-input"
                  readonly
                />
              </div>

              <div class="form-group">
                <label class="form-label">Email</label>
                <input
                  type="email"
                  name="email"
                  value="{{ $alumni->email}}" 
                  class="form-input"
                  readonly
                />
              </div>

              <div class="form-group">
                <label class="form-label">Instagram</label>
                <input
                  type="text"
                  name="insta"
                  value="{{ $alumni->insta}}" 
                  class="form-input"
                  readonly
                />
              </div>

              <div class="form-group">
                <label class="form-label">Nama Universitas</label>
                <input
                  type="text"
                  name="university_name"
                  value="{{ $alumni->university_name}}" 
                  class="form-input"
                  readonly
                />
              </div>

              <div class="form-group">
                <label class="form-label">Jurusan</label>
                <input
                  type="text"
                  name="major"
                  value="{{ $alumni->major}}" 
                  class="form-input"
                  readonly
                />
              </div>

              <div class="form-group">
                <label class="form-label">Nama Tempat Kerja</label>
                <input
                  type="text"
                  name="work_place"
                  value="{{ $alumni->work_place}}" 
                  class="form-input"
                  readonly
                />
              </div>

              <div class="form-group">
                <label class="form-label">Jabatan</label>
                <input
                  type="text"
                  name="job_title"
                  value="{{ $alumni->job_title}}" 
                  class="form-input"
                  readonly
                />
              </div>


            <div class="form-group">
                <label class="form-label">Nomor Telepon</label>
                <input
                  type="number"
                  name="phone"
                  value="{{ $alumni->phone}}"
                  class="form-input"
                  readonly
                />
              </div>
            </div>
          
          </form>
        </div>
        <div class="image-column">
          <img src="{{ asset('assets/image 2.png') }}" class="image-db" />
        </div>
      </section>
    </main>
  </div>
  
@if (session('success'))
<script>
    Swal.fire({
        title: 'Berhasil!',
        text: '{{ session("success") }}',
        icon: 'success',
        confirmButtonText: 'OK',
        confirmButtonColor: '#3085d6'
    });
</script>
@endif

  <script src="{{ asset('assets/js/custom.js') }}"></script>

</body>
</html>

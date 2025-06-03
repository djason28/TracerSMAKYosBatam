<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="requires-auth" content="true">
    <title>Edit Admin</title>
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
    <script src="{{ asset('assets/js/auth.js') }}"></script>  
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <body>
    <div class="container">
      <aside class="sidebar">
        <div class="avatar-wrapper">
          <img src="{{ asset('assets/Ellipse 1.png') }}" alt="Profile Image" class="avatar-img">
        </div>

        <nav class="sidebar-nav">
          <a href="#" class="nav-item" onclick="window.location.href='{{ route('dashboard') }}'">DASHBOARD</a>
          <a href="#" class="nav-item" onclick="window.location.href='{{ route('alumnidb_admin') }}'">ALUMNI</a>
          <a href="#" class="nav-item nav-item-active">ADMIN</a>
        </nav>
      </aside>

      <main class="main-content">
        <header class="header">
          <h1 class="page-title">EDIT ADMIN</h1>
        </header>

        <section class="form-section">
        <form class="alumni-form" method="POST" action="{{ route('updateadmin', $admin->id) }}">
    @csrf
    @method('PUT') 

        <div class="form-grid-single">


    <div class="form-group">
        <label class="form-label">Nama Admin</label>
        <input type="text" name="name" value="{{ $admin->name }}" class="form-input" />
    </div>

    <div class="form-group">
        <label class="form-label">Email</label>
        <input type="email" name="email" value="{{ $admin->email }}" class="form-input" />
    </div>

    <div class="form-group" style="position: relative;">
      <label class="form-label">Password Lama</label>
      <div class="password-wrapper">
        <input type="password" name="old_password" id="password_old_editadm" placeholder="Masukkan password lama" class="form-input"  />
        <span 
        class="password-toggle" 
        onclick="togglePassword('password_old_editadm', 'eyeIcon_old_editadm')"
        >
        <i class="fa fa-eye" id="eyeIcon_old_editadm"></i>
      </span>
    </div>
    </div>

    <div class="form-group" style="position: relative;">
      <label class="form-label">Password Baru</label>
      <div class="password-wrapper">
        <input type="password" name="password" id="password_new_editadm" placeholder="Kosongkan jika tidak ingin mengubah password" class="form-input" />
        <span 
        class="password-toggle" 
        onclick="togglePassword('password_new_editadm', 'eyeIcon_new_editadm')"
        >
        <i class="fa fa-eye" id="eyeIcon_new_editadm"></i>
      </span>
    </div>
    </div>

    <div class="form-actions">
        <button type="button" class="back-button" onclick="window.location.href='{{ route('admindb_admin') }}'">Kembali</button>
        <button type="submit" class="submit-button">Edit Admin</button>
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

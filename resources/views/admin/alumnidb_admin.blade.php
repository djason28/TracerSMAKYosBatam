<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="requires-auth" content="true">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Alumni Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.30.0/tabler-icons.min.css">
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
  <script src="{{ asset('assets/js/auth.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
</head>
<body>
  <div class="dashboard-container">
<aside id="sidebar" class="sidebar">
       
<div class="avatar-wrapper">
        <img src="{{ asset('assets/Ellipse 1.png') }}" alt="Profile Image" class="avatar-img">
        </div>


        <nav class="sidebar-nav">
          <a href="#" class="nav-item" onclick="window.location.href='{{ route('dashboard') }}'">DASHBOARD</a>
          <a href="#" class="nav-item nav-item-active" >ALUMNI</a>
          <a href="#" class="nav-item" onclick="window.location.href='{{ route('admindb_admin') }}'" >ADMIN</a>
        </nav>
</aside>

    <main class="main-content">
      <header class="top-bar">

      <button id="toggleSidebar" class="toggle-btn">☰</button>

      <div class="search-section">
          <div class="search-input-wrapper">
              <i class="ti ti-search search-icon"></i>
              <input type="text" placeholder="Search" class="search-input" id="searchInput">
          </div>
          <button class="search-button">Search</button>
      </div>

      
        
        <div class="user-section">
          <div class="welcome-message">
            <i class="ti ti-user-circle"></i>
            <span>Welcome!</span>
          </div>
          <button class="logout-button" onclick="logout()">Log Out</button>
        </div>
      </header>

      <section class="section-header">
        <h1 class="section-title">DAFTAR ALUMNI</h1>

        <div style="display: flex; gap: 10px; align-items: center;">
        <button 
          id="deleteSelectedBtn" 
          class="delete-icon-btn"
          onclick="deleteSelectedAlumni()" 
          style="display: none;">
          <i class="ti ti-trash" title="Hapus Terpilih"></i>
        </button>

        <button class="add-admin-button" onclick="window.location.href='{{ route('addalumni') }}'">
            Tambah Alumni
        </button>

        <button class="add-admin-button" onclick="openExcelModal()">
          Import Data
        </button>

<!-- Modal Overlay -->
<div id="excel-modal" class="modal-overlay" style="display: none;">
  <div class="modal-content">
    <!-- Tombol Close sebagai <button> -->
    <button type="button" class="modal-close" onclick="closeExcelModal()">&times;</button>

    <!-- Section Header -->
    <div class="modal-header">
      <h2>Upload File</h2>
    </div>

    <!-- Form Import Excel -->
    <form action="{{ route('import.alumni.process') }}" method="POST" enctype="multipart/form-data" id="excel-upload-form" novalidate>
      @csrf
      <div class="modal-body">
        <!-- Choose File Button sebagai <button> -->
        <div class="modal-section">
          <button
            type="button"
            id="file-upload-button"
            class="add-admin-button"
            onclick="document.getElementById('excel-file-input').click();"
          >
            Choose File
          </button>
          <input
            type="file"
            id="excel-file-input"
            name="file"
            accept=".xls,.xlsx"
            hidden
            required
          >
        </div>

        <!-- Nama File -->
        <div class="modal-section file-name">
          <span id="excel-file-name">Belum ada file dipilih</span>
        </div>

        <!-- Import Button -->
        <div class="modal-section">
          <button type="submit" class="add-admin-button">Import</button>
        </div>
      </div>
    </form>
  </div>
</div>


      </section>

      <section class="table-container">
        <table class="admin-table">
          <thead>
            <tr>
              <th class="table-header">
                <input type="checkbox" id="selectAll" onchange="toggleAllCheckboxes(this)">
              </th>
              <th class="table-header">
                <span>NO</span>
              </th>
              <th class="table-header">
                <span>NIS</span>
              </th>
              <th class="table-header">
                <span>NAMA SISWA</span>
              </th>
              <th class="table-header">
                <span>TANGGAL LAHIR</span>
              </th>
              <th class="table-header">
                <span>TAHUN KELULUSAN</span>
              </th>
              <th class="table-header">
                <span>EMAIL</span>
              </th>
              <th class="table-header">
                <span>UNIVERSITAS</span>
              </th>
              <th class="table-header">
                <span>JURUSAN</span>
              </th>
              <th class="table-header">
                <span>TEMPAT KERJA</span>
              </th>
              <th class="table-header">
                <span>JABATAN</span>
              </th>
              <th class="table-header">
                <span>INSTAGRAM</span>
              </th>
              <th class="table-header">
                <span>NO TELP</span>
              </th>
              <th class="table-header">Action</th>
            </tr>
          </thead>
          <tbody id="alumniTableBody">

            @foreach ($alumniad as $alumniadmin)
                <tr>
                    <td class="table-cell" style="text-align: center; width:60px;"><input type="checkbox" class="admin-checkbox" value="{{ $alumniadmin->id }}"></td>
                    <td class="table-cell" style="text-align: center;">{{ $loop->iteration }}</td>
                    <td class="table-cell">{{ $alumniadmin->nis }}</td>
                    <td class="table-cell">{{ $alumniadmin->name }}</td>
                    <td class="table-cell">{{ $alumniadmin->birth_date }}</td>
                    <td class="table-cell">{{ $alumniadmin->graduation_year }}</td>
                    <td class="table-cell">{{ $alumniadmin->email }}</td>
                    <td class="table-cell">{{ $alumniadmin->university_name}}</td>
                    <td class="table-cell">{{ $alumniadmin->major}}</td>
                    <td class="table-cell">{{ $alumniadmin->work_place}}</td>
                    <td class="table-cell">{{ $alumniadmin->job_title }}</td>
                    <td class="table-cell">{{ $alumniadmin->insta}}</td>
                    <td class="table-cell">{{ $alumniadmin->phone}}</td>
                    <td class="action-cell">
                        <i class="ti ti-edit action-icon" onclick="window.location.href='{{ route('editalumni' , $alumniadmin->id) }}'"></i>
                        <i class="ti ti-trash action-icon" onclick="deleteAlumni({{ $alumniadmin->id }})"></i>
                    </td>
                </tr>
            @endforeach

          </tbody>

        </table>

        <div class="pagination-wrapper">
            {{ $alumniad->links('pagination.custom') }}
        </div>
            

      </section>
    </main>
  </div>

<script>
  window.openExcelModal = () => document.getElementById('excel-modal').style.display = 'flex';
  window.closeExcelModal = () => document.getElementById('excel-modal').style.display = 'none';

  document.addEventListener('DOMContentLoaded', () => {
    const form              = document.getElementById('excel-upload-form');
    const fileInput         = document.getElementById('excel-file-input');
    const fileNameSpan      = document.getElementById('excel-file-name');
    const csrfMeta          = document.querySelector('meta[name="csrf-token"]');
    const submitButton      = form.querySelector('button[type="submit"], input[type="submit"]');
    const fileUploadButton  = document.getElementById('file-upload-button');
    const closeButton       = document.querySelector('.modal-close');

    if (!form || !fileInput || !fileNameSpan || !csrfMeta) {
      return;
    }

    // Helper untuk cek ekstensi Excel
    function isValidExcel(file) {
      const validExtensions = ['.xls', '.xlsx'];
      const name = file.name.toLowerCase();
      return validExtensions.some(ext => name.endsWith(ext));
    }

    // Tampilkan nama file & validasi saat user memilih file
    fileInput.addEventListener('change', () => {
      if (fileInput.files.length) {
        const file = fileInput.files[0];
        if (!isValidExcel(file)) {
          Swal.fire({
            title: 'Tipe File Tidak Valid',
            text: 'Silakan unggah file Excel (.xls atau .xlsx).',
            icon: 'warning',
            confirmButtonText: 'OK',
            confirmButtonColor: '#d33'
          });
          fileInput.value = '';
          fileNameSpan.textContent = 'Belum ada file dipilih';
        } else {
          fileNameSpan.textContent = file.name;
        }
      } else {
        fileNameSpan.textContent = 'Belum ada file dipilih';
      }
    });

    const csrfToken = csrfMeta.content;

    form.addEventListener('submit', async e => {
      e.preventDefault();

      // Validasi: pastikan file sudah terpilih
      if (!fileInput.files.length) {
        Swal.fire({
          title: 'Oops',
          text: 'File belum di‐upload.',
          icon: 'warning',
          confirmButtonText: 'OK',
          confirmButtonColor: '#d33'
        });
        return;
      }

      // Validasi ekstensi file satu lagi
      const file = fileInput.files[0];
      if (!isValidExcel(file)) {
        Swal.fire({
          title: 'Tipe File Tidak Valid',
          text: 'Silakan unggah file Excel (.xls atau .xlsx).',
          icon: 'warning',
          confirmButtonText: 'OK',
          confirmButtonColor: '#d33'
        });
        return;
      }

      // Disable tombol agar user tidak spam
      if (submitButton)      submitButton.disabled = true;
      if (fileUploadButton)  fileUploadButton.disabled = true;
      if (closeButton)       closeButton.disabled = true;

      const actionUrl = form.action;
      const formData  = new FormData(form);

      try {
        const response = await fetch(actionUrl, {
          method: 'POST',
          headers: { 'X-CSRF-TOKEN': csrfToken },
          body: formData
        });

        if (!response.ok) {
          throw new Error('HTTP ' + response.status);
        }

        const contentType = response.headers.get('content-type') || '';
        if (contentType.includes('application/json')) {
          const data = await response.json();
          if (data.job_id) {
            await pollJobStatus(data.job_id);
            return;
          }
        }

        // Jika bukan JSON berisi job_id, reload halaman
        window.location.reload();

      } catch (err) {
        console.error(err);
        if (submitButton)      submitButton.disabled = false;
        if (fileUploadButton)  fileUploadButton.disabled = false;
        if (closeButton)       closeButton.disabled = false;
        Swal.fire('Error', 'Import gagal', 'error');
      }
    });

    async function pollJobStatus(jobId) {
      const statusUrl = `/jobs/status/${jobId}`;

      while (true) {
        let res, json;
        try {
          res = await fetch(statusUrl, {
            headers: { 'X-CSRF-TOKEN': csrfToken }
          });
        } catch (fetchError) {
          console.error('Fetch status error:', fetchError);
          enableButtons();
          Swal.fire('Error', 'Tidak bisa mengecek status import.', 'error');
          return;
        }

        if (!res.ok) {
          console.error('Status endpoint mengembalikan HTTP', res.status);
          enableButtons();
          Swal.fire('Error', 'Tidak bisa mengecek status import.', 'error');
          return;
        }

        try {
          json = await res.json();
        } catch (parseError) {
          console.error('Gagal parse JSON dari status endpoint:', parseError);
          enableButtons();
          Swal.fire('Error', 'Format respons status tidak valid.', 'error');
          return;
        }

        // **Kunci Utama**: json.status harus string, bukan nested‐object
        const status     = json.status     || 'pending';
        const duplicates = Array.isArray(json.duplicates) ? json.duplicates : [];
        const imported   = Array.isArray(json.imported)   ? json.imported   : [];

        // console.log('Status import alumni:', status, { duplicates, imported });

        // 1) Kasus error / gagal
        if (['missing_fields','invalid_nis','no_data_alumni','import_failed'].includes(status)) {
          enableButtons();

          let title = 'Gagal Import', text = 'Terjadi kesalahan.';
          switch (status) {
            case 'missing_fields':
              text = 'Kolom NIS atau nama tidak ditemukan di file Excel.';
              break;
            case 'invalid_nis':
              text = 'Format NIS salah: pastikan setiap NIS terdiri dari 4 digit angka.';
              break;
            case 'no_data_alumni':
              text = 'File Excel valid, tetapi tidak ada baris data yang bisa di‐import.';
              break;
            case 'import_failed':
              text = 'Terjadi kesalahan saat import. Silakan coba lagi.';
              break;
          }

          Swal.fire({
            title,
            text,
            icon: 'error',
            confirmButtonText: 'OK',
            confirmButtonColor: '#d33'
          });
          return;
        }

        // 2) Kasus “hanya duplikat” (status = no_new_data_alumni)
        if (status === 'no_new_data_alumni') {
          enableButtons();
          if (duplicates.length > 0) {
            let shownDup = duplicates.slice(0, 3).join(', ');
            if (duplicates.length > 3) shownDup += ', ...';

            Swal.fire({
              title: 'Gagal Import',
              text: `NIS sudah ada (duplicate): ${shownDup}`,
              icon: 'error',
              confirmButtonText: 'OK',
              confirmButtonColor: '#d33'
            });
          } else {
            // Edge‐case: duplicates array kosong (seharusnya tidak terjadi),
            // fallback ke pesan umum:
            Swal.fire({
              title: 'Gagal Import',
              text: 'Data sudah ada di database, tidak ada yang ditambahkan.',
              icon: 'error',
              confirmButtonText: 'OK',
              confirmButtonColor: '#d33'
            });
          }
          return;
        }

        // 3) Kasus “sukses” (status = done), bisa ada imported dan/atau duplicates
        if (status === 'done') {
          enableButtons();

          if (imported.length > 0) {
            // Tampilkan maksimal 3 imported
            let shownImp = imported.slice(0, 3).join(', ');
            if (imported.length > 3) shownImp += ', ...';

            // Jika ada duplicates juga, siapkan teks terpisah
            let dupText = '';
            if (duplicates.length > 0) {
              let shownDup2 = duplicates.slice(0, 3).join(', ');
              if (duplicates.length > 3) shownDup2 += ', ...';
              dupText = `\n\nDuplicate (sudah ada): ${shownDup2}`;
            }

            Swal.fire({
              title: 'Berhasil!',
              text: `Data baru berhasil di‐import: ${shownImp}` + dupText,
              icon: 'success',
              confirmButtonText: 'OK',
              confirmButtonColor: '#3085d6'
            }).then(() => {
              closeExcelModal();
              window.location.reload();
            });
          } else {
            // Edge‐case: imported=0 tapi status “done” (seharusnya tidak terjadi),
            // tampilkan berhasil tanpa listing NIS
            Swal.fire({
              title: 'Berhasil!',
              text: '(Tidak ada NIS baru)',
              icon: 'success',
              confirmButtonText: 'OK',
              confirmButtonColor: '#3085d6'
            }).then(() => {
              closeExcelModal();
              window.location.reload();
            });
          }
          return;
        }

        // 4) Kalau masih pending, tunggu 1 detik lalu polling lagi
        await new Promise(r => setTimeout(r, 1000));
      }
    }

    // Helper untuk re‐enable tombol jika terjadi error
    function enableButtons() {
      if (submitButton)      submitButton.disabled = false;
      if (fileUploadButton)  fileUploadButton.disabled = false;
      if (closeButton)       closeButton.disabled = false;
    }
  });
</script>

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

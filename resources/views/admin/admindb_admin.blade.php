<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="requires-auth" content="true">
  <title>Admin Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.30.0/tabler-icons.min.css">
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
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
          <a href="#" class="nav-item" onclick="window.location.href='{{ route('dashboard') }}'">DASHBOARD</a>
          <a href="#" class="nav-item" onclick="window.location.href='{{ route('alumnidb_admin') }}'">ALUMNI</a>
          <a href="#" class="nav-item nav-item-active" >ADMIN</a>
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
        <h1 class="section-title">DAFTAR ADMIN</h1>


        <div style="display: flex; gap: 10px; align-items: center;">
        <button 
          id="deleteSelectedBtn" 
          class="delete-icon-btn"
          onclick="deleteSelectedAdmins()" 
          style="display: none;">
          <i class="ti ti-trash" title="Hapus Terpilih"></i>
        </button>

        <button class="add-admin-button" onclick="window.location.href='{{ route('addadmin') }}'">
            Tambah Admin
        </button>

        <button class="add-admin-button" onclick="openExcelModal()">
          Import Data
        </button>

<!-- Modal Overlay -->
<div id="excel-modal" class="modal-overlay" style="display: none;">
  <div class="modal-content">
    <!-- Tombol Close: Ganti <span> menjadi <button> -->
    <button type="button" class="modal-close" onclick="closeExcelModal()">&times;</button>
  
    <!-- Section Header -->
    <div class="modal-header">
      <h2>Upload File</h2>
    </div>
  
    <!-- Form Import Excel -->
    <form action="{{ route('import.admin.process') }}" method="POST" enctype="multipart/form-data" id="excel-upload-form" novalidate>
      @csrf
      <div class="modal-body">
        <!-- Choose File Button: Ganti <label> menjadi <button> -->
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
                <span>NAMA ADMIN</span>
              </th>
              <th class="table-header">
                <span>EMAIL</span>
              </th>
              <th class="table-header">Action</th>
            </tr>
          </thead>
          <tbody id="adminTableBody">

            @foreach ($admins as $admin)
                <tr>
                    <td class="table-cell" style="text-align: center;"><input type="checkbox" class="admin-checkbox" value="{{ $admin->id }}"></td>

                    <td class="table-cell" style="text-align: center;">{{ $loop->iteration }}</td>
                    <td class="table-cell">{{ $admin->name }}</td>
                    <td class="table-cell">{{ $admin->email }}</td>
                    <td class="action-cell" >
                        <i class="ti ti-edit action-icon" onclick="window.location.href='{{ route('editadmin' , $admin->id) }}'"></i>
                        <i class="ti ti-trash action-icon" onclick="deleteAdmin({{ $admin->id }})"></i>
                    </td>
                </tr>
            @endforeach


          </tbody>
        </table>

        <div class="pagination-wrapper">
            {{ $admins->links('pagination.custom') }}
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

    // Listener untuk menampilkan nama file & validasi ekstensi
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
      // Validasi: wajib ada file
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
      // Validasi sekali lagi ekstensi
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

      // Disable tombol agar user tidak tekan berulang
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
        console.log('Response dari server:', response);
        if (!response.ok) {
          throw new Error('HTTP ' + response.status);
        }

        const contentType = response.headers.get('content-type') || '';
        if (contentType.includes('application/json')) {
          const data = await response.json();
          if (data.job_id) {
            // Kalau berhasil dapat job_id, mulai polling
            await pollJobStatus(data.job_id);
            return;
          }
        }

        // Jika tidak JSON (mungkin langsung reload), reload halaman
        window.location.reload();

      } catch (err) {
        console.error(err);
        // Re‐enable tombol kalau error
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
      enableButtons(); // re‐enable tombol jika error
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

    // **PENTING**: di sini `json.status` harusnya sebuah string seperti "pending", "done", "no_new_data_admin", dll.
    const status     = json.status     || 'pending';
    const duplicates = Array.isArray(json.duplicates) ? json.duplicates : [];
    const imported   = Array.isArray(json.imported)   ? json.imported   : [];

    // console.log('Status import:', status, { duplicates, imported });

    // 1) Kasus error/failure yang sudah kita definisikan
    if (['missing_fields','invalid_email','no_data','import_failed'].includes(status)) {
      enableButtons();
      let title = 'Gagal Import', text = 'Terjadi kesalahan saat import.';
      switch (status) {
        case 'missing_fields':
          text = 'Kolom email atau nama tidak ditemukan di file Excel.';
          break;
        case 'invalid_email':
          text = 'Format email salah: semua harus berakhiran @gmail.com.';
          break;
        case 'no_data':
          text = 'File Excel valid, tetapi tidak ada data.';
          break;
        case 'import_failed':
          text = 'Terjadi kesalahan saat import. Silakan coba lagi.';
          break;
      }
      Swal.fire({ title, text, icon: 'error', confirmButtonText: 'OK', confirmButtonColor: '#d33' });
      return;
    }

    // 2) Kasus “hanya duplikat”: tidak ada imported, hanya duplicates
    if (status === 'no_new_data_admin') {
      enableButtons();
      if (duplicates.length > 0) {
        let shownDup = duplicates.slice(0, 3).join(', ');
        if (duplicates.length > 3) shownDup += ', ...';
        Swal.fire({
          title: 'Gagal Import',
          text: `Semua data sudah ada (duplicate): ${shownDup}`,
          icon: 'error',
          confirmButtonText: 'OK',
          confirmButtonColor: '#d33'
        });
      } else {
        // Edge‐case: kalau ternyata duplicates=0 (seharusnya tidak terjadi), fallback:
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

    // 3) Kasus “sukses”: imported minimal satu (bisa juga ada duplicates di samping itu)
    if (status === 'done') {
      enableButtons();
      if (imported.length > 0) {
        // Tampilkan maksimal 3 imported, sisanya “...”
        let shownImp = imported.slice(0, 3).join(', ');
        if (imported.length > 3) shownImp += ', ...';

        // Jika ada duplicates juga, buat bagian terpisah untuk duplicate
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
        // Edge‐case: kalau imported=0 tapi statusnya “done” (seharusnya tidak terjadi),
        // tetap tampilkan berhasil tanpa listing email
        Swal.fire({
          title: 'Berhasil!',
          text: '(Tidak ada email baru)',
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

    // 4) Kalau masih “pending”, tunggu 1 detik lalu polling lagi
      await new Promise(r => setTimeout(r, 1000));
    }
  }

  // Helper untuk meng‐enable kembali tombol & close button bila terjadi error
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

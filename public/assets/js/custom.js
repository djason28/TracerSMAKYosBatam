// toggle delete button banyak
  function updateDeleteButtonVisibility() {
    const checkboxes = document.querySelectorAll('.admin-checkbox');
    const deleteBtn = document.getElementById('deleteSelectedBtn');
    const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
    deleteBtn.style.display = anyChecked ? 'inline-block' : 'none';
  }

  // Select all
  function toggleAllCheckboxes(source) {
    const checkboxes = document.querySelectorAll('.admin-checkbox');
    checkboxes.forEach(checkbox => checkbox.checked = source.checked);

    updateDeleteButtonVisibility(); 
  }
  document.addEventListener('DOMContentLoaded', function () {
    const checkboxes = document.querySelectorAll('.admin-checkbox');
    checkboxes.forEach(cb => {
      cb.addEventListener('change', updateDeleteButtonVisibility);
    });
  });


  // Delete admin button
function deleteAdmin(id) {
    Swal.fire({
      title: 'Apakah Anda yakin untuk hapus?',
      text: "Data Admin akan dihapus secara permanen!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#e35d5d',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Hapus'
    }).then((result) => {
      if (result.isConfirmed) {
        const token = localStorage.getItem('token'); // atau ambil dari meta tag jika tidak pakai token

        fetch(`http://localhost:8000/api/admin/admin/${id}`, {
          method: 'DELETE',
          headers: {
            'Authorization': `Bearer ${token}`, // sesuaikan jika pakai Sanctum/jwt
            'Content-Type': 'application/json',
            'Accept': 'application/json',
          }
        })
        .then(response => response.json())
        .then(result => {
          if (result.status === 'delete complete') {
            Swal.fire({
              title: 'Terhapus!',
              text: 'Admin berhasil dihapus.',
              icon: 'success',
              confirmButtonText: 'OK',
              confirmButtonColor: '#3085d6'
            }).then(() => {
              window.location.reload();
            });
          } else {
            Swal.fire('Gagal!', result.message || 'Gagal menghapus admin.', 'error');
          }
        })
        .catch(err => {
          console.error(err);
          Swal.fire('Error!', 'Terjadi kesalahan saat menghapus.', 'error');
        });
      }
    });
}





// Delete alumni button
function deleteAlumni(id) {
    Swal.fire({
      title: 'Apakah Anda yakin untuk hapus?',
      text: "Data Alumni akan dihapus secara permanen!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#e35d5d',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Hapus'
    }).then((result) => {
      if (result.isConfirmed) {
        const token = localStorage.getItem('token'); // atau ambil dari meta tag jika tidak pakai token

        fetch(`http://localhost:8000/api/admin/alumni/${id}`, {
          method: 'DELETE',
          headers: {
            'Authorization': `Bearer ${token}`, // sesuaikan jika pakai Sanctum/jwt
            'Content-Type': 'application/json',
            'Accept': 'application/json',
          }
        })
        .then(response => response.json())
        .then(result => {
          if (result.status === 'delete complete') {
            Swal.fire({
              title: 'Terhapus!',
              text: 'Alumni berhasil dihapus.',
              icon: 'success',
              confirmButtonText: 'OK',
              confirmButtonColor: '#3085d6'
            }).then(() => {
              window.location.reload();
            });
          } else {
            Swal.fire('Gagal!', result.message || 'Gagal menghapus alumni.', 'error');
          }
        })
        .catch(err => {
          console.error(err);
          Swal.fire('Error!', 'Terjadi kesalahan saat menghapus.', 'error');
        });
      }
    });
}







document.addEventListener('DOMContentLoaded', function () {



// Add admin button
  if (document.body.classList.contains('admin-add-form-page')) {
    const form = document.getElementById('addAdminForm');
    if (form) {
      form.addEventListener('submit', async function (e) {
        e.preventDefault();

        const name = form.name.value;
        const email = form.email.value;
        const password = form.password.value;

        const token = localStorage.getItem('token');

        try {
          const response = await fetch('http://localhost:8000/api/admin/admin', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'Authorization': `Bearer ${token}`
            },
            body: JSON.stringify({ name, email, password })
          });

          const result = await response.json();

          if (!response.ok) {
            console.error('Error response:', result);

            let errorMessage = 'Gagal menambahkan alumni.';
            if (result.errors) {
              errorMessage = Object.values(result.errors).flat().join('\n');
            }

            Swal.fire({
              title: 'Gagal!',
              text: errorMessage,
              icon: 'error',
              confirmButtonText: 'OK',
              confirmButtonColor: '#3085d6'
            });
            return;
          }

          Swal.fire({
            title: "Berhasil!",
            text: "Admin berhasil ditambahkan!",
            icon: "success",
            confirmButtonText: "OK",
            confirmButtonColor: '#3085d6'
          }).then(() => {
            window.location.href = REDIRECT_URL;
          });

        } catch (err) {
          console.error('Network error:', err);
          Swal.fire({
            title: 'Kesalahan!',
            text: 'Terjadi kesalahan saat mengirim data.',
            icon: 'error',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
          });
        }
      });
    }
  }





// add alumni page
  if (document.body.classList.contains('alumni-add-form-page')) {
  const form = document.getElementById('addAlumniForm');

  form.addEventListener('submit', async function (e) {
    e.preventDefault();

    const name = form.name.value.trim();
    const password = form.password.value.trim();
    const nis = form.nis.value.trim();

    
    if (!name || !password || !nis) {
      Swal.fire({
        title: 'Peringatan!',
        text: 'Nama, NIS, dan Password wajib diisi.',
        icon: 'warning',
        confirmButtonText: 'OK',
        confirmButtonColor: '#3085d6'
      });
      return;
    }

    const data = {
      name,
      password,
      nis,
      email: form.email.value || null,
      birth_date: form.birth_date.value || null,
      insta: form.insta.value || null,
      university_name: form.university_name.value || null,
      major: form.major.value || null,
      job_title: form.job_title.value || null,
      work: form.work.value || null,
      city: form.city.value || null,
      graduation_year: form.graduation_year.value || null,
      phone: form.phone.value || null
    };

    const token = localStorage.getItem('token');

    try {
      const response = await fetch('http://localhost:8000/api/admin/alumni', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${token}`
        },
        body: JSON.stringify(data)
      });

      const result = await response.json();

      if (!response.ok) {
      let errorMessage = 'Gagal menambahkan alumni.';
      if (result.errors) {
        errorMessage = Object.values(result.errors).flat().join('\n');
      }

      Swal.fire({
        title: 'Gagal!',
        text: errorMessage,
        icon: 'error',
        confirmButtonText: 'OK',
        confirmButtonColor: '#3085d6'
      });
        return;
      }

      Swal.fire({
        title: 'Berhasil!',
        text: 'Data alumni berhasil ditambahkan.',
        icon: 'success',
        confirmButtonText: "OK",
        confirmButtonColor: '#3085d6'
      }).then(() => {
        window.location.href =  REDIRECT_URL;
      });

    } catch (err) {
      console.error(err);
      Swal.fire({
        title: 'Kesalahan!',
        text: 'Terjadi kesalahan saat mengirim data.',
        icon: 'error',
        confirmButtonText: 'OK',
        confirmButtonColor: '#3085d6'
      });
    }
  });
}

});


//Toggle Password
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


// Search alumni
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('searchInput');
    const searchButton = document.querySelector('.search-button');
    const tableBody = document.getElementById('alumniTableBody');

    function performSearch() {
        const query = searchInput.value.trim();

        fetch(`/dashboard/alumni/search?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                tableBody.innerHTML = '';

                if (data.length === 0) {
                    tableBody.innerHTML = '<tr><td class="table-cell" style="text-align: center;" colspan="13">No alumni found</td></tr>';
                    return;
                }

                data.forEach((alumni, index) => {
                    const row = `
                        <tr>
                            <td class="table-cell" style="text-align: center; width:60px;">
                                <input type="checkbox" class="admin-checkbox" value="${alumni.id}">
                            </td>
                            <td class="table-cell" style="text-align: center;">${index + 1}</td>
                            <td class="table-cell">${alumni.nis ?? ''}</td>
                            <td class="table-cell">${alumni.name}</td>
                            <td class="table-cell">${alumni.birth_date ?? ''}</td>
                            <td class="table-cell">${alumni.graduation_year ?? ''}</td>
                            <td class="table-cell">${alumni.email}</td>
                            <td class="table-cell">${alumni.university_name ?? ''}</td>
                            <td class="table-cell">${alumni.major ?? ''}</td>
                            <td class="table-cell">${alumni.work_place ?? ''}</td>
                            <td class="table-cell">${alumni.job_title ?? ''}</td>
                            <td class="table-cell">${alumni.insta ?? ''}</td>
                            <td class="table-cell">${alumni.phone ?? ''}</td>
                            <td class="action-cell">
                                <i class="ti ti-edit action-icon" onclick="window.location.href='/dashboard/alumni/editform/${alumni.id}'"></i>
                                <i class="ti ti-trash action-icon" onclick="deleteAlumni(${alumni.id})"></i>
                            </td>
                        </tr>
                    `;
                    tableBody.insertAdjacentHTML('beforeend', row);
                });
            })
            .catch(error => {
                console.error('Search error:', error);
            });
    }

    if (searchInput && searchButton && tableBody) {
        // Search via button click
        searchButton.addEventListener('click', performSearch);

        // Search via ENTER key
        searchInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });

        // Auto reset table when input is cleared
        searchInput.addEventListener('input', function () {
            if (searchInput.value.trim() === '') {
                performSearch(); // or fetch default data
            }
        });
    }
});





//search admin
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('searchInput');
    const searchButton = document.querySelector('.search-button');
    const tableBody = document.getElementById('adminTableBody');

    function performSearch() {
        const query = searchInput.value.trim();

        fetch(`/dashboard/admin/search?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                tableBody.innerHTML = '';

                if (data.length === 0) {
                    tableBody.innerHTML = '<tr><td class="table-cell" style="text-align: center;" colspan="6">No admin found</td></tr>';
                    return;
                }

                data.forEach((admin, index) => {
                    const row = `
                        <tr>
                            <td class="table-cell" style="text-align: center; width:60px;">
                                <input type="checkbox" class="admin-checkbox" value="${admin.id}">
                            </td>
                            <td class="table-cell" style="text-align: center;">${index + 1}</td>
                            <td class="table-cell">${admin.name ?? ''}</td>
                            <td class="table-cell">${admin.email ?? ''}</td>
                            <td class="action-cell">
                                <i class="ti ti-edit action-icon" onclick="window.location.href='/dashboard/admin/editform/${admin.id}'"></i>
                                <i class="ti ti-trash action-icon" onclick="deleteAdmin(${admin.id})"></i>
                            </td>
                        </tr>
                    `;
                    tableBody.insertAdjacentHTML('beforeend', row);
                });
            })
            .catch(error => {
                console.error('Search error (admin):', error);
            });
    }

    if (searchInput && searchButton && tableBody) {
        // Search via button click
        searchButton.addEventListener('click', performSearch);

        // Search via ENTER key
        searchInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });

        // Auto reset table when input is cleared
        searchInput.addEventListener('input', function () {
            if (searchInput.value.trim() === '') {
                performSearch(); // load all data again
            }
        });
    }
});




//dropdown 
if (typeof $ !== 'undefined' && $.fn.select2) {
    $(document).ready(function () {

        // === Dropdown City ===
        if ($('#city').length) {
            $('#city').select2({
                placeholder: 'Pilih atau ketik kota...',
                tags: true,
                ajax: {
                    url: '/data/cities.json',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data, params) {
                        const term = params.term ? params.term.toLowerCase() : '';
                        const filtered = data.filter(item => item.toLowerCase().includes(term));
                        return {
                            results: filtered.map(item => ({
                                id: item,
                                text: item
                            }))
                        };
                    },
                    cache: true
                },
                minimumInputLength: 0,
                containerCssClass: 'my-select2 form-input',
                dropdownCssClass: 'my-select2-dropdown'
            });

            const selectedCity = $('#city').data('selected');
            if (selectedCity) {
                const option = new Option(selectedCity, selectedCity, true, true);
                $('#city').append(option).trigger('change');
            }
        }

        // === Dropdown University ===
        if ($('#univ').length) {
            $('#univ').select2({
                placeholder: 'Pilih atau ketik universitas...',
                tags: true,
                ajax: {
                    url: '/data/universities.json',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data, params) {
                        const term = params.term ? params.term.toLowerCase() : '';
                        const filtered = data.filter(item => item.toLowerCase().includes(term));
                        return {
                            results: filtered.map(item => ({
                                id: item,
                                text: item
                            }))
                        };
                    },
                    cache: true
                },
                minimumInputLength: 0,
                containerCssClass: 'my-select2 form-input',
                dropdownCssClass: 'my-select2-dropdown'
            });

            const selectedUniv = $('#univ').data('selected');
            if (selectedUniv) {
                const option = new Option(selectedUniv, selectedUniv, true, true);
                $('#univ').append(option).trigger('change');
            }
        }

        // === Dropdown Major ===
        if ($('#major').length) {
            $('#major').select2({
                placeholder: 'Pilih atau ketik jurusan...',
                tags: true,
                ajax: {
                    url: '/data/majors.json',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data, params) {
                        const term = params.term ? params.term.toLowerCase() : '';
                        const filtered = data.filter(item => item.toLowerCase().includes(term));
                        return {
                            results: filtered.map(item => ({
                                id: item,
                                text: item
                            }))
                        };
                    },
                    cache: true
                },
                minimumInputLength: 0,
                containerCssClass: 'my-select2 form-input',
                dropdownCssClass: 'my-select2-dropdown'
            });

            const selectedMajor = $('#major').data('selected');
            if (selectedMajor) {
                const option = new Option(selectedMajor, selectedMajor, true, true);
                $('#major').append(option).trigger('change');
            }
        }

    });
}




//email entered must be in @gmail.com
const form = document.querySelector('form');
const emailInput = document.getElementById('emailInput');
const errorText = document.getElementById('emailError');

if (form && emailInput && errorText) {
  form.addEventListener('submit', function (e) {
    const email = emailInput.value.trim();

    if (email !== '' && !email.endsWith('@gmail.com')) {
      e.preventDefault(); // stop form submission
      errorText.style.display = 'block';
    } else {
      errorText.style.display = 'none';
    }
  });
}


//batch delete

function deleteSelectedAdmins() {
  const selected = Array.from(document.querySelectorAll('.admin-checkbox:checked'))
    .map(cb => cb.value);

  if (selected.length === 0) {
    Swal.fire('Tidak ada data', 'Pilih minimal satu admin untuk dihapus.', 'info');
    return;
  }

  Swal.fire({
    title: 'Yakin ingin hapus?',
    text: `Admin terpilih (${selected.length}) akan dihapus permanen!`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#e35d5d',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Hapus'
  }).then((result) => {
    if (result.isConfirmed) {
      const token = localStorage.getItem('token');

      fetch('http://localhost:8000/api/admin/admin/batch-delete', {
        method: 'POST',
        headers: {
          'Authorization': `Bearer ${token}`,
          'Content-Type': 'application/json',
          'Accept': 'application/json',
        },
        body: JSON.stringify({ ids: selected })
      })
      .then(res => res.json())
      .then(response => {
        if (response.status === 'success') {
          Swal.fire('Berhasil!', response.message, 'success')
            .then(() => window.location.reload());
        } else {
          Swal.fire('Gagal!', response.message || 'Gagal menghapus data.', 'error');
        }
      })

      .catch(err => {
        console.error(err);
        Swal.fire('Error!', 'Terjadi kesalahan saat menghapus.', 'error');
      });
    }
  });
}


function deleteSelectedAlumni() {
  const selected = Array.from(document.querySelectorAll('.admin-checkbox:checked'))
    .map(cb => cb.value);

  if (selected.length === 0) {
    Swal.fire('Tidak ada data', 'Pilih minimal satu alumni untuk dihapus.', 'info');
    return;
  }

  Swal.fire({
    title: 'Yakin ingin hapus?',
    text: `Alumni terpilih (${selected.length}) akan dihapus permanen!`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#e35d5d',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Hapus'
  }).then((result) => {
    if (result.isConfirmed) {
      const token = localStorage.getItem('token');

      fetch('http://localhost:8000/api/admin/alumni/batch-delete', {
        method: 'POST',
        headers: {
          'Authorization': `Bearer ${token}`,
          'Content-Type': 'application/json',
          'Accept': 'application/json',
        },
        body: JSON.stringify({ ids: selected })
      })
      .then(res => res.json())
      .then(response => {
        if (response.status === 'batch delete complete') {
          Swal.fire('Berhasil!', 'Alumni terpilih berhasil dihapus.', 'success')
            .then(() => window.location.reload());
        } else {
          Swal.fire('Gagal!', response.message || 'Gagal menghapus data.', 'error');
        }
      })
      .catch(err => {
        console.error(err);
        Swal.fire('Error!', 'Terjadi kesalahan saat menghapus.', 'error');
      });
    }
  });
}

// toggle menu responsif 
document.getElementById('toggleSidebar').addEventListener('click', function () {
  const sidebar = document.getElementById('sidebar');
  sidebar.classList.toggle('active');
});
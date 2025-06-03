<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="requires-auth" content="true">
  <title>Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.30.0/tabler-icons.min.css">
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
  <script src="{{ asset('assets/js/auth.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <div class="dashboard-container">
    <aside class="sidebar" id="sidebar">

        <div class="avatar-wrapper">
        <img src="{{ asset('assets/Ellipse 1.png') }}" alt="Profile Image" class="avatar-img">
        </div>

        <nav class="sidebar-nav">  
            <a href="#" class="nav-item nav-item-active" >DASHBOARD</a>
            <a href="#" class="nav-item" onclick="window.location.href='{{ route('alumnidb_admin') }}'">ALUMNI</a>
            <a href="#" class="nav-item" onclick="window.location.href='{{ route('admindb_admin') }}'" >ADMIN</a>
        </nav>
    </aside>

    <main class="main-content">
      <header class="top-bar">


        <section class="section-header">
        <button id="toggleSidebar" class="toggle-btn">☰</button>
        <h1 class="section-title" style="font-size:30px;">DASHBOARD ALUMNI</h1>
        </section>

        <div class="user-section" style="margin-bottom: 24px;">
          <div class="welcome-message">
            <i class="ti ti-user-circle"></i>
            <span>Welcome!</span>
          </div>
          <button class="logout-button" onclick="logout()">Log Out</button>
        </div>
      </header>



        
    <div class="dashboard-layout">

        <div class="column left">
            <div class="card-row">
                <div class="dashboard-card">
                    <h3>Total Alumni</h3>
                    <h2>{{ $totalAlumni }}</h2>
                </div>
                <div class="dashboard-card">
                    <h3>Top Universitas</h3>
                    <h2> {{ $topUniversitas->total ?? 0 }}</h2>
                    <h5>{{ $topUniversitas->university_name ?? '-' }}</h5>
                </div>
                <div class="dashboard-card">
                    <h3>Baris Tidak Lengkap</h3>
                    <h2>
                        {{ $rowsWithEmpty }} Baris
                    </h2>

                    @if ($rowsWithEmpty == 0)
                        <span>Semua data sudah lengkap</span>
                    @endif
                
                </div>
            </div>    
            
        <div class="chart-container" style="overflow-y: auto">
        <canvas id="jurusanChart"></canvas>
        <script>
            const jurusanLabels = {!! json_encode($jurusanData->pluck('major')) !!};
            const jurusanData = {!! json_encode($jurusanData->pluck('total')) !!};

            function stringToPastelColor(str) {
                let hash = 0;
                for (let i = 0; i < str.length; i++) {
                    hash = str.charCodeAt(i) + ((hash << 5) - hash);
                }
                const hue = Math.abs(hash) % 360;
                return `hsl(${hue}, 70%, 75%)`;
            }
            const jurusanColors = jurusanLabels.map(label => stringToPastelColor(label));

            new Chart(document.getElementById('jurusanChart'), {
            type: 'pie',
            data: {
                labels: jurusanLabels,
                datasets: [{
                label: 'Distribusi Jurusan',
                data: jurusanData,
                backgroundColor: jurusanColors
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                title: {
                    display: true,
                    text: 'Distribusi Alumni Berdasarkan Jurusan',
                    font: { size: 18 }
                },
                legend: {
                    display: true,
                    position: 'top',
                    align: 'center',
                    labels: {
                    boxWidth: 12,
                    padding: 20
                    }
                }
                }
            }
            });
        </script>
        </div>
        </div>

        <div class="column right">
        <div class="chart-container">        
            <canvas id="universitasBarChart" ></canvas>
                @php
                $top10Universities = $alumniPerUniv->sortByDesc('total')->take(10);
                @endphp
            <script>
                const univLabel = {!! json_encode($top10Universities->pluck('university_name')) !!};
                const univDatas = {!! json_encode($top10Universities->pluck('total')) !!};

                new Chart(document.getElementById('universitasBarChart'), {
                    type: 'bar',
                    data: {
                        labels: univLabel,
                            datasets: [{
                                label: 'Top 10 Distribusi Alumni Berdasarkan Universitas',
                                data: univDatas,
                            backgroundColor: 'rgba(189, 255, 135, 0.7)',
                        }]
                    },
                    options: {
                    responsive: true,
                    maintainAspectRatio: false,
                }
                });
            </script>
        </div>

        <div class="chart-container">        
            <canvas id="kotaChart" ></canvas>
            <script>
                const kotaLabels = {!! json_encode($alumniPerKota->pluck('kota')) !!};
                const kotaData = {!! json_encode($alumniPerKota->pluck('total')) !!};

                new Chart(document.getElementById('kotaChart'), {
                    type: 'bar',
                    data: {
                        labels: kotaLabels,
                        datasets: [{
                            label: 'Distribusi Alumni Berdasarkan Kota',
                            data: kotaData,
                            backgroundColor: 'rgba(135, 137, 255, 0.7)',
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false // allow canvas to stretch to container
                    }
                });
            </script>
        </div>
        <div class="chart-container">  
            <canvas id="angkatanChart" ></canvas>
            <script>
                const angkatanLabels = {!! json_encode($alumniPerAngkatan->pluck('graduation_year')) !!};
                const angkatanData = {!! json_encode($alumniPerAngkatan->pluck('total')) !!};

                new Chart(document.getElementById('angkatanChart'), {
                    type: 'bar',
                    data: {
                        labels: angkatanLabels,
                        datasets: [{
                            label: 'Jumlah Alumni per Angkatan',
                            data: angkatanData,
                            backgroundColor: 'rgba(44, 177, 255, 0.7)',
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false // allow canvas to stretch to container
                    }
                });
            </script>

        </div>
        </div>
    </div>
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Maintenance System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-blue': '#3b82f6',
                        'sidebar-blue': '#1e40af'
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .sidebar-gradient {
            background: linear-gradient(180deg, #3b82f6 0%, #1e40af 100%);
        }
        .material-symbols-outlined {
            font-variation-settings:
            'FILL' 0,
            'wght' 400,
            'GRAD' 0,
            'opsz' 24;
        }
        body {
            font-family: sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 sidebar-gradient text-white flex flex-col">
            <div class="p-6 border-b border-blue-400">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="w-8 h-8 object-contain" />
                    <div>
                        <h1 class="font-bold text-lg">Maintenance</h1>
                        <p class="text-sm text-blue-200">System</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4">
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('dashboard') }}"
                           class="flex items-center gap-4 p-3 rounded-lg bg-white bg-opacity-20 text-white font-medium">
                            <span class="material-symbols-outlined">dashboard</span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                           class="flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-10">
                            <span class="material-symbols-outlined">event_note</span>
                            <span>Jadwal</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Bar -->
            <header class="sidebar-gradient text-white shadow p-4 flex items-center justify-between">
                <div class="text-lg font-semibold">
                    Dashboard Pic
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-sm">{{ auth()->user()->name ?? 'Pic' }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-xs font-semibold px-3 py-1 rounded">
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 p-8 overflow-auto">
                <div class="max-w-7xl mx-auto">
                    <h2 class="text-xl font-bold mb-6">Selamat datang, {{ auth()->user()->name ?? 'Pic' }}</h2>

                    <!-- Cards -->
                    <div class="grid grid-cols-2 gap-6 mb-8">
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Statistik Jadwal</h3>
                            <div class="flex items-center justify-center mb-4">
                                <div class="relative w-24 h-24">
                                    <canvas id="jadwalChart"></canvas>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <div class="text-2xl font-bold text-blue-600">67%</div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 text-center">Terlaksana bulan ini</p>
                        </div>

                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Total Aset</h3>
                            <div class="grid grid-cols-2 gap-4 text-center">
                                <div>
                                    <p class="text-3xl text-blue-600 font-bold">165</p>
                                    <p class="text-sm text-gray-600">Komputer</p>
                                </div>
                                <div>
                                    <p class="text-3xl text-blue-600 font-bold">66</p>
                                    <p class="text-sm text-gray-600">Printer</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notifikasi -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Notifikasi</h3>
                        <ul class="space-y-3 text-sm text-gray-700">
                            <li class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                Jadwal maintenance untuk <strong>Printer EPSON L3120</strong> di <strong>Ruang ICU</strong> akan dilaksanakan pada tanggal <strong>24 Juli 2025</strong> pukul <strong>14:30 WIB</strong>.
                            </li>
                            <li class="bg-green-50 border border-green-200 rounded-lg p-4">
                                Semua aset di <strong>Farmasi</strong> telah melewati pemeriksaan rutin bulan ini.
                            </li>
                        </ul>
                    </div>

                </div>
            </main>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('jadwalChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [67, 33],
                    backgroundColor: ['#3b82f6', '#e5e7eb'],
                    borderWidth: 0,
                    cutout: '70%'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                }
            }
        });
    </script>
</body>
</html>

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
        @include('components.sidebar')

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
        const ctx = document.getElementById('jadwalChart')?.getContext('2d');
        if (ctx) {
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
        }
    </script>
</body>
</html>

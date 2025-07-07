{{-- resources/views/aset.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar Aset - Maintenance System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
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
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 sidebar-gradient text-white flex flex-col">
            <div class="p-6 border-b border-blue-400 flex items-center space-x-3">
                <img src="logo.png" alt="Logo" class="w-8 h-8 object-contain" />
                <div>
                    <h1 class="font-bold text-lg">Maintenance</h1>
                    <p class="text-sm text-blue-200">System</p>
                </div>
            </div>

            <nav class="flex-1 p-4">
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-10 text-white">
                            <span class="material-symbols-outlined">dashboard</span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.jadwal') }}" class="flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-10 text-white">
                            <span class="material-symbols-outlined">event_note</span>
                            <span>Jadwal</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.aset') }}" class="flex items-center gap-4 p-3 rounded-lg bg-white bg-opacity-20 text-white font-medium">
                            <span class="material-symbols-outlined">inventory_2</span>
                            <span>Aset</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-10 text-white">
                            <span class="material-symbols-outlined">tune</span>
                            <span>Parameter</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Bar -->
            <div class="sidebar-gradient text-white shadow w-sm border-b p-4 flex items-center justify-between">
                <div class="flex-1 max-w-md">
                    <div class="relative">
                        <input 
                            type="text" 
                            placeholder="Search..."
                            class="w-full px-4 py-2 rounded-lg bg-white bg-opacity-20 text-white placeholder-blue-200 border border-white border-opacity-30 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50"
                        >
                        <span class="material-symbols-outlined absolute right-3 top-2 text-blue-200">search</span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm">Admin</span>
                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="flex-1 p-8 overflow-auto">
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                        <h2 class="text-xl font-bold text-gray-800">DAFTAR ASET</h2>
                        <a href="#" class="bg-primary-blue hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg transition-colors duration-200 flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">add</span>
                            Tambah Aset
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-primary-blue text-white">
                                <tr>
                                    <th class="px-4 py-3 text-left text-sm font-medium">No</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium">Nama Aset</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium">Tag Aset</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium">Model</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium">Kategori</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium">Produsen</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium">Serial</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium">Lokasi</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium">Catatan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                {{-- Data statis langsung di blade --}}
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-4 text-sm text-gray-900">1</td>
                                    <td class="px-4 py-4 text-sm font-medium text-gray-900">Printer EPSON L3120</td>
                                    <td class="px-4 py-4 text-sm text-gray-600">L3120</td>
                                    <td class="px-4 py-4 text-sm text-gray-600">L3120</td>
                                    <td class="px-4 py-4 text-sm text-gray-600">Printer</td>
                                    <td class="px-4 py-4 text-sm text-gray-600">EPSON</td>
                                    <td class="px-4 py-4 text-sm text-gray-600">EP2024001</td>
                                    <td class="px-4 py-4 text-sm text-gray-600">Ruang ICU</td>
                                    <td class="px-4 py-4 text-sm text-gray-600">Warna Hitam</td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-4 text-sm text-gray-900">2</td>
                                    <td class="px-4 py-4 text-sm font-medium text-gray-900">Ventilator Medis</td>
                                    <td class="px-4 py-4 text-sm text-gray-600">VM001</td>
                                    <td class="px-4 py-4 text-sm text-gray-600">VM-2024</td>
                                    <td class="px-4 py-4 text-sm text-gray-600">Alat Medis</td>
                                    <td class="px-4 py-4 text-sm text-gray-600">Philips</td>
                                    <td class="px-4 py-4 text-sm text-gray-600">PH2024002</td>
                                    <td class="px-4 py-4 text-sm text-gray-600">Ruang ICU</td>
                                    <td class="px-4 py-4 text-sm text-gray-600">Normal</td>
                                </tr>
                                {{-- Tambah data lain sesuai kebutuhan --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

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
                        <a href="{{ route('pelaksana.dashboard') }}"
                           class="flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-10 ">
                            <span class="material-symbols-outlined">dashboard</span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pelaksana.daftarjadwal') }}"
                           class="flex items-center gap-4 p-3 rounded-lg bg-white bg-opacity-20 text-white font-medium">
                            <span class="material-symbols-outlined">event_note</span>
                            <span>Jadwal</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="p-4 border-t border-blue-400">
                <ul class="space-y-1">
                    <li>
                        <a href="#"
                           class="flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-10 text-white-500 font-medium">
                            <span class="material-symbols-outlined">logout</span>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Bar -->
            <header class="sidebar-gradient text-white shadow p-4 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input type="text" placeholder="Search..." class="bg-white bg-opacity-20 text-white placeholder-blue-200 px-4 py-2 rounded-lg w-80 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50">
                        <span class="material-symbols-outlined absolute right-3 top-2.5 text-blue-200">search</span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm">pelaksana</span>
                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 p-8 overflow-auto">
                <div class="bg-white shadow rounded-lg">
                    <!-- Header -->
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-800 text-center">JADWAL XXXXXXX</h2>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-primary-blue text-white">
                                <tr>
                                    <th class="px-6 py-3 text-center text-sm font-medium border-r border-blue-400">No</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium border-r border-blue-400">Tanggal</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium border-r border-blue-400">Aset</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium border-r border-blue-400">Lokasi</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium border-r border-blue-400">Tanggal Pelaksanaan</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <!-- Row 1 -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">1</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center">
                                        <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                            <span class="material-symbols-outlined text-sm">edit</span>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Row 2 -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">2</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center">
                                        <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                            <span class="material-symbols-outlined text-sm">edit</span>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Row 3 -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">3</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center">
                                        <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                            <span class="material-symbols-outlined text-sm">edit</span>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Row 4 -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">4</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center">
                                        <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                            <span class="material-symbols-outlined text-sm">edit</span>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Row 5 -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">5</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center">
                                        <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                            <span class="material-symbols-outlined text-sm">edit</span>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Row 6 -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">6</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center">
                                        <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                            <span class="material-symbols-outlined text-sm">edit</span>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Row 7 -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">7</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center">
                                        <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                            <span class="material-symbols-outlined text-sm">edit</span>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Row 8 -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">8</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center">
                                        <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                            <span class="material-symbols-outlined text-sm">edit</span>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Row 9 -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">9</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center">
                                        <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                            <span class="material-symbols-outlined text-sm">edit</span>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Row 10 -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">10</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 border-r border-gray-200">-</td>
                                    <td class="px-6 py-4 text-center">
                                        <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                            <span class="material-symbols-outlined text-sm">edit</span>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Add any JavaScript functionality here
        document.addEventListener('DOMContentLoaded', function() {
            // Add edit button functionality
            const editButtons = document.querySelectorAll('button[title="Edit"]');
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    alert('Edit functionality would be implemented here');
                });
            });
        });
    </script>

</body>
</html>
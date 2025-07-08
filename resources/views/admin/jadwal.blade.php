<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Jadwal - Admin</title>
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
                        <a href="{{ route('admin.dashboard') }}"
                           class="flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-10 text-white">
                            <span class="material-symbols-outlined">dashboard</span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.jadwal') }}"
                           class="flex items-center gap-4 p-3 rounded-lg bg-white bg-opacity-20 text-white font-medium">
                            <span class="material-symbols-outlined">event_note</span>
                            <span>Jadwal</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.aset') }}"
                           class="flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-10 text-white">
                            <span class="material-symbols-outlined">inventory_2</span>
                            <span>Aset</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                           class="flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-10 text-white">
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
            <div class="sidebar-gradient text-white shadow border-b p-4 flex items-center justify-end">
                <div class="flex items-center space-x-4">
                    <span class="text-sm">{{ auth()->user()->name ?? 'Admin' }}</span>
                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="flex-1 p-8 overflow-auto">
                <div class="max-w-7xl mx-auto bg-white shadow rounded-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-2xl font-semibold text-gray-800">Daftar Jadwal</h2>
                        <a href="{{ route('admin.jadwal.form') }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg transition-colors duration-200 flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">add</span>
                            Tambah Jadwal
                        </a>
                    </div>

                    <p class="text-gray-600 mb-6">Halaman ini akan menampilkan daftar jadwal maintenance.</p>

                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($jadwals->count() > 0)
                        <table class="min-w-full table-auto border-collapse border border-gray-300 text-left text-sm">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 px-4 py-2">#</th>
                                    <th class="border border-gray-300 px-4 py-2">Tanggal</th>
                                    <th class="border border-gray-300 px-4 py-2">Nama Jadwal</th>
                                    <th class="border border-gray-300 px-4 py-2">Lokasi</th>
                                    <th class="border border-gray-300 px-4 py-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jadwals as $index => $jadwal)
                                    <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }}">
                                        <td class="border border-gray-300 px-4 py-2">{{ $jadwals->firstItem() + $index }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ \Carbon\Carbon::parse($jadwal->schedule_date)->format('d M Y') }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $jadwal->nama_jadwal ?? '-' }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $jadwal->location_id }}</td>
                                        <td class="border border-gray-300 px-4 py-2 capitalize">{{ $jadwal->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $jadwals->links() }}
                        </div>
                    @else
                        <div class="mt-6 border rounded-lg p-4 text-sm text-gray-500 bg-blue-50">
                            Belum ada data jadwal yang ditampilkan. Silakan hubungkan dengan database nanti.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>

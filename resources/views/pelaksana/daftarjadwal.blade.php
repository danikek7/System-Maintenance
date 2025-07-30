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
                        <a href="{{ route('logout') }}"
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
                <div class="text-lg font-semibold">
                    <!-- Dashboard Pelaksana -->
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm">{{ auth()->user()->name ?? 'Admin' }}</span>
                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
                <!-- <div class="flex items-center gap-3">
                    <span class="text-sm">{{ auth()->user()->name ?? 'Pelaksana' }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-xs font-semibold px-3 py-1 rounded">
                            Logout
                        </button>
                    </form>
                </div> -->
            </header>

            <!-- Content -->
            <main class="flex-1 p-8 overflow-auto">
                <div class="bg-white shadow rounded-lg">
    <!-- Header -->
    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
        <h2 class="text-xl font-bold text-gray-800">DAFTAR JADWAL</h2>
        <!-- <a href="#" class="bg-primary-blue hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg transition-colors duration-200 flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">add</span>
            Tambah Jadwal
        </a> -->
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-primary-blue text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium">No</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Nama Jadwal</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
    @forelse ($jadwal_list as $index => $jadwal)
    <tr class="hover:bg-gray-50">
        <td class="px-6 py-4 text-sm text-gray-900">{{ $index + 1 }}</td>
        <td class="px-6 py-4">
            <div>
                <div class="text-sm font-medium text-gray-900">{{ $jadwal->nama_jadwal ?? '-' }}</div>
                <div class="text-sm text-gray-500">
                    {{ $jadwal->location?->lokasi ?? '-' }} • 
                    {{ \Carbon\Carbon::parse($jadwal->bulan_maintenance)->translatedFormat('F Y') ?? '-' }} • 
                    {{ $jadwal->assets?->count() ?? 0 }} aset
                </div>
            </div>
        </td>
        <td class="px-6 py-4">
    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $jadwal->scheduleStatus?->color ?? 'bg-gray-300 text-gray-800' }}">
        {{ $jadwal->scheduleStatus?->name ?? 'Tidak diketahui' }}
    </span>
</td>
        <td class="px-6 py-4">
            <div class="flex items-center space-x-2">
                <!-- View Button -->
                <!-- <a href="{{ route('pelaksana.jadwal.show', $jadwal) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                    <span class="material-symbols-outlined text-sm">visibility</span>
                </a> -->

                <!-- Edit Button -->
                <a href="{{ route('pelaksana.asetjadwal', $jadwal) }}" class="p-2 text-yellow-600 hover:bg-yellow-50 rounded-lg transition-colors" title="Edit">
                    <span class="material-symbols-outlined text-sm">edit</span>
                </a>

                <!-- Delete Button -->
                <!-- <button onclick="confirmDelete({{ $jadwal->id }}, '{{ $jadwal->nama_jadwal }}')" 
                        class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                    <span class="material-symbols-outlined text-sm">delete</span>
                </button> -->

                <!-- Approve Button -->
                @if($jadwal->statusLabel?->nama !== 'Aktif')
                <form method="POST" action="{{ route('pelaksana.jadwal.approve', $jadwal) }}" class="inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors" title="Approve">
                        <span class="material-symbols-outlined text-sm">check_circle</span>
                    </button>
                </form>
                @endif
            </div>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="4" class="text-center py-12">
            <span class="material-symbols-outlined text-6xl text-gray-300 mb-4 block">event_note</span>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada jadwal</h3>
            <p class="text-gray-500 mb-4">Mulai dengan membuat jadwal maintenance pertama Anda</p>
            <!-- <a href="#" class="bg-primary-blue hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg transition-colors duration-200 inline-flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">add</span>
                Tambah Jadwal
            </a> -->
        </td>
    </tr>
    @endforelse
</tbody>

        </table>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-md w-mx-auto mx-4">
        <div class="flex items-center mb-4">
            <span class="material-symbols-outlined text-red-600 text-2xl mr-3">warning</span>
            <h3 class="text-lg font-medium text-gray-900">Konfirmasi Hapus</h3>
        </div>
        <p class="text-gray-500 mb-6">Apakah Anda yakin ingin menghapus jadwal "<span id="deleteItemName" class="font-medium"></span>"? Tindakan ini tidak dapat dibatalkan.</p>
        <div class="flex justify-end space-x-3">
            <button onclick="closeDeleteModal()" class="px-4 py-2 text-gray-500 hover:text-gray-700 transition-colors">
                Batal
            </button>
            <form method="POST" action="" id="deleteForm" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id, name) {
        document.getElementById('deleteItemName').textContent = name;
        document.getElementById('deleteForm').action = `{{ route('pelaksana.daftarjadwal') }}/${id}`;
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteModal').classList.add('flex');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('deleteModal').classList.remove('flex');
    }

    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });
</script>

</body>
</html>

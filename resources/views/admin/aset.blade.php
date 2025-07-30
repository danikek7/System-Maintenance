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
            background: linear-gradient(180deg, #2563eb 0%, #1e40af 100%);
        }

        .material-symbols-outlined {
            font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24;
        }

        @media (max-width: 768px) {
            .responsive-hide {
                display: none;
            }
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 sidebar-gradient text-white flex flex-col">
            <div class="p-6 border-b border-blue-600 flex items-center space-x-3">
                <img src="{{ asset('logo.png') }}" alt="Logo" class="w-8 h-8 object-contain" />
                <div>
                    <h1 class="font-bold text-lg">Maintenance</h1>
                    <p class="text-sm text-blue-300">System</p>
                </div>
            </div>

            <nav class="flex-1 p-4">
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-20 text-white">
                            <span class="material-symbols-outlined">dashboard</span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.jadwal.index') }}"
                            class="flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-20 text-white">
                            <span class="material-symbols-outlined">event_note</span>
                            <span>Jadwal</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.aset.index') }}"
                            class="flex items-center gap-4 p-3 rounded-lg bg-white bg-opacity-25 text-white font-semibold shadow-md">
                            <span class="material-symbols-outlined">inventory_2</span>
                            <span>Aset</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.parameter.index') }}"
                            class="flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-20 text-white">
                            <span class="material-symbols-outlined">tune</span>
                            <span>Parameter</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="p-4 border-t border-blue-400">
                <ul class="space-y-1">
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-10">
                                <span class="material-symbols-outlined">logout</span>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="sidebar-gradient text-white shadow p-4 flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="w-full md:w-auto md:flex-1 md:flex md:justify-center">
                    <form method="GET" action="{{ route('admin.aset.index') }}" class="w-full max-w-lg">
                        <div class="relative">
                            <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}"
                                class="w-full px-4 py-2 rounded-lg bg-white bg-opacity-20 text-white placeholder-blue-200 border border-white border-opacity-40 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-60 transition" />
                            <button type="submit" class="absolute right-2 top-2 text-blue-200 hover:text-white">
                                <span class="material-symbols-outlined">search</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-sm">{{ auth()->user()->username ?? 'Admin' }}</span>
                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="flex-1 p-4 md:p-8 overflow-auto">
                <div class="bg-white shadow rounded-lg">
                    <div class="px-4 md:px-6 py-4 border-b border-gray-300 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                        <h2 class="text-lg md:text-xl font-bold text-gray-900">Daftar Aset</h2>
                        <a href="{{ route('admin.aset.create') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition flex items-center gap-2 shadow whitespace-nowrap">
                            <span class="material-symbols-outlined text-sm">add</span>
                            Tambah Aset
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead class="bg-blue-600 text-white">
                                <tr>
                                    <th class="px-3 md:px-4 py-3 text-center text-xs md:text-sm font-semibold border">No</th>
                                    <th class="px-3 md:px-4 py-3 text-center text-xs md:text-sm font-semibold border">Nama Aset</th>
                                    <th class="px-3 md:px-4 py-3 text-center text-xs md:text-sm font-semibold border responsive-hide">Tag Aset</th>
                                    <th class="px-3 md:px-4 py-3 text-center text-xs md:text-sm font-semibold border responsive-hide">Model</th>
                                    <th class="px-3 md:px-4 py-3 text-center text-xs md:text-sm font-semibold border responsive-hide">Kategori</th>
                                    <th class="px-3 md:px-4 py-3 text-center text-xs md:text-sm font-semibold border responsive-hide">Produsen</th>
                                    <th class="px-3 md:px-4 py-3 text-center text-xs md:text-sm font-semibold border responsive-hide">Serial</th>
                                    <th class="px-3 md:px-4 py-3 text-center text-xs md:text-sm font-semibold border">Lokasi</th>
                                    <th class="px-3 md:px-4 py-3 text-center text-xs md:text-sm font-semibold border responsive-hide">Catatan</th>
                                    <th class="px-3 md:px-4 py-3 text-center text-xs md:text-sm font-semibold border">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($assets as $asset)
                                    <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }} hover:bg-blue-50 transition">
                                        <td class="px-3 md:px-4 py-3 text-xs md:text-sm text-gray-900 border text-center">{{ $loop->iteration }}</td>
                                        <td class="px-3 md:px-4 py-3 text-xs md:text-sm text-gray-900 border">{{ $asset->name }}</td>
                                        <td class="px-3 md:px-4 py-3 text-xs md:text-sm text-gray-700 border responsive-hide">{{ $asset->asset_tag }}</td>
                                        <td class="px-3 md:px-4 py-3 text-xs md:text-sm text-gray-700 border responsive-hide">
                                            {{ $asset->model->name ?? '-' }}</td>
                                        <td class="px-3 md:px-4 py-3 text-xs md:text-sm text-gray-700 border responsive-hide">
                                            {{ $asset->kategori->name ?? '-' }}</td>
                                        <td class="px-3 md:px-4 py-3 text-xs md:text-sm text-gray-700 border responsive-hide">
                                            {{ $asset->produsen->name ?? '-' }}</td>
                                        <td class="px-3 md:px-4 py-3 text-xs md:text-sm text-gray-700 border responsive-hide">{{ $asset->serial ?? '-' }}
                                        </td>
                                        <td class="px-3 md:px-4 py-3 text-xs md:text-sm text-gray-700 border">
                                            {{ $asset->lokasi->lokasi ?? '-' }}</td>
                                        <td class="px-3 md:px-4 py-3 text-xs md:text-sm text-gray-700 border responsive-hide">{{ $asset->notes ?? '-' }}
                                        </td>
                                        <td class="px-3 md:px-4 py-3 text-xs md:text-sm text-gray-700 border text-center">
                                            <div class="flex justify-center items-center gap-2">
                                                <a href="{{ route('admin.aset.edit', $asset->id) }}"
                                                    class="text-blue-600 hover:text-blue-800" title="Edit">
                                                    <span class="material-symbols-outlined text-lg md:text-base">edit_square</span>
                                                </a>
                                                <form action="{{ route('admin.aset.destroy', $asset->id) }}" method="POST"
                                                    class="inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus aset ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800"
                                                        title="Hapus">
                                                        <span class="material-symbols-outlined text-lg md:text-base">delete</span>
                                                    </button>
                                                </form>
                                
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="px-4 py-4 text-center text-gray-500">Data aset tidak
                                            tersedia.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
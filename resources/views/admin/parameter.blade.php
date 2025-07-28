<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar Kategori Inspeksi - Maintenance System</title>
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
    </style>
</head>

<body class="bg-gray-50 min-h-screen">
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
                            class="flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-20 text-white">
                            <span class="material-symbols-outlined">inventory_2</span>
                            <span>Aset</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.parameter.index') }}"
                            class="flex items-center gap-4 p-3 rounded-lg bg-white bg-opacity-25 text-white font-semibold shadow-md">
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
                            <button type="submit"
                                class="w-full flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-10">
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
            <div class="sidebar-gradient text-white shadow p-4 flex items-center justify-between">
                <div class="text-lg font-semibold">
                    <!-- Daftar Kategori Inspeksi -->
                </div>
                <div class="flex items-center space-x-3">
                    <span class="text-sm">{{ auth()->user()->username ?? 'Admin' }}</span>
                    <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-700" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zM3 18a7 7 0 1114 0H3z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="flex-1 p-4 md:p-8 overflow-auto">
                <div class="bg-white shadow rounded-lg">
                    <div
                        class="px-4 md:px-6 py-4 border-b border-gray-300 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                        <h2 class="text-lg md:text-xl font-bold text-gray-900">Daftar Kategori Inspeksi</h2>
                        <a href="{{ route('admin.parameter.create') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition flex items-center gap-2 shadow">
                            <span class="material-symbols-outlined text-sm">add</span>
                            Tambah Kategori
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead class="bg-blue-600 text-white">
                                <tr>
                                    <th class="px-4 py-3 text-center text-sm font-semibold border">No</th>
                                    <th class="px-4 py-3 text-center text-sm font-semibold border">Kategori</th>
                                    <th class="px-4 py-3 text-center text-sm font-semibold border">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($parameters as $parameter)
                                    <tr
                                        class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }} hover:bg-blue-50 transition">
                                        <td class="px-4 py-4 text-sm text-gray-900 border text-center">
                                            {{ $loop->iteration }}</td>
                                        <td class="px-4 py-4 text-sm text-gray-900 border text-center">
                                            {{ $parameter->nama }}</td>
                                        <td class="px-4 py-4 text-sm text-gray-700 border text-center">
                                            <div class="flex justify-center items-center gap-3">
                                                <a href="{{ route('admin.parameter.show', $parameter->id) }}"
                                                    class="text-green-600 hover:text-green-800" title="Lihat">
                                                    <span class="material-symbols-outlined">visibility</span>
                                                </a>
                                                {{-- <a href="{{ route('admin.parameter.edit', $parameter->id) }}"
                                                   class="text-blue-600 hover:text-blue-800" title="Edit">
                                                   <span class="material-symbols-outlined">edit_square</span>
                                                </a> --}}
                                                <form action="{{ route('admin.parameter.destroy', $parameter->id) }}"
                                                    method="POST" class="inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800"
                                                        title="Hapus">
                                                        <span class="material-symbols-outlined">delete</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-4 py-4 text-center text-gray-500">Data kategori
                                            tidak tersedia.</td>
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

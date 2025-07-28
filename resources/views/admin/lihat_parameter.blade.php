<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Detail Parameter - Kategori {{ $typeInspeksi->nama }}</title>
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

        @media (max-width: 768px) {
            .responsive-hide {
                display: none;
            }
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
                            class="flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-10">
                            <span class="material-symbols-outlined">dashboard</span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.jadwal.index') }}"
                            class="flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-10">
                            <span class="material-symbols-outlined">event_note</span>
                            <span>Jadwal</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.aset.index') }}"
                            class="flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-10">
                            <span class="material-symbols-outlined">inventory_2</span>
                            <span>Aset</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.parameter.index') }}"
                            class="flex items-center gap-4 p-3 rounded-lg bg-white bg-opacity-20 text-white font-medium">
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

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header
                class="sidebar-gradient text-white shadow p-4 flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="w-full md:w-auto md:flex-1 md:flex md:justify-center">
                    <h2 class="text-lg md:text-xl font-bold">
                        {{-- Detail Parameter: {{ $typeInspeksi->nama }} --}}
                    </h2>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-sm">{{ auth()->user()->username ?? 'Admin' }}</span>
                    <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-700" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zM3 18a7 7 0 1114 0H3z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="flex-1 p-4 md:p-8 overflow-auto">
                <div class="bg-white shadow rounded-lg">
                    <div
                        class="px-4 md:px-6 py-4 border-b border-gray-300 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                        <h2 class="text-lg md:text-xl font-bold text-gray-900">Daftar Parameter
                            {{ $typeInspeksi->nama }}</h2>
                        <a href="{{ route('admin.detail.create', $typeInspeksi->id) }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition flex items-center gap-2 shadow whitespace-nowrap">
                            <span class="material-symbols-outlined text-sm">add</span>
                            Tambah Parameter
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead class="bg-blue-600 text-white">
                                <tr>
                                    <th class="px-3 md:px-4 py-3 text-center text-xs md:text-sm font-semibold border">No
                                    </th>
                                    <th class="px-3 md:px-4 py-3 text-center text-xs md:text-sm font-semibold border">
                                        Nama Parameter</th>
                                    <th class="px-3 md:px-4 py-3 text-center text-xs md:text-sm font-semibold border">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($detailParameters->isEmpty())
                                    <tr>
                                        <td colspan="3" class="px-4 py-4 text-center text-gray-500">Belum ada
                                            parameter untuk kategori ini.</td>
                                    </tr>
                                @else
                                    @foreach ($detailParameters as $detail)
                                        <tr
                                            class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }} hover:bg-blue-50 transition">
                                            <td
                                                class="px-3 md:px-4 py-3 text-xs md:text-sm text-gray-900 border text-center">
                                                {{ $loop->iteration }}</td>
                                            <td class="px-3 md:px-4 py-3 text-xs md:text-sm text-gray-900 border">
                                                {{ $detail->nama }}</td>
                                            <td
                                                class="px-3 md:px-4 py-3 text-xs md:text-sm text-gray-700 border text-center">
                                                <div class="flex justify-center items-center gap-2">
                                                    <a href="{{ route('admin.detail.edit', $detail->id) }}"
                                                        class="text-blue-600 hover:text-blue-800" title="Edit">
                                                        <span
                                                            class="material-symbols-outlined text-lg md:text-base">edit_square</span>
                                                    </a>
                                                    <form action="{{ route('admin.detail.destroy', $detail->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Yakin ingin menghapus parameter ini?')"
                                                        class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-800"
                                                            title="Hapus">
                                                            <span
                                                                class="material-symbols-outlined text-lg md:text-base">delete</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

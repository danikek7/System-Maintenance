<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tambah Kategori Inspeksi - Admin</title>
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
                    <li><a href="{{ route('admin.dashboard') }}"
                            class="flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-10"><span
                                class="material-symbols-outlined">dashboard</span><span>Dashboard</span></a></li>
                    <li><a href="{{ route('admin.jadwal.index') }}"
                            class="flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-10"><span
                                class="material-symbols-outlined">event_note</span><span>Jadwal</span></a></li>
                    <li><a href="{{ route('admin.aset.index') }}"
                            class="flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-10"><span
                                class="material-symbols-outlined">inventory_2</span><span>Aset</span></a></li>
                    <li><a href="{{ route('admin.parameter.index') }}"
                            class="flex items-center gap-4 p-3 rounded-lg bg-white bg-opacity-20 font-medium"><span
                                class="material-symbols-outlined">tune</span><span>Parameter</span></a></li>
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
        <div class="flex-1 flex flex-col">
            <!-- Top Bar -->
            <div class="sidebar-gradient text-white p-4 flex justify-between items-center shadow">
                <div class="text-lg font-semibold">
                    <!-- Tambah Kategori Inspeksi -->
                </div>
                <div class="flex items-center space-x-3">
                    <!-- <a href="{{ route('admin.parameter.index') }}"
                        class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white font-medium px-4 py-2 rounded-lg transition flex items-center gap-1">
                        <span class="material-symbols-outlined">arrow_back</span>
                        Kembali
                    </a> -->
                    <span class="text-sm">{{ auth()->user()->username ?? 'Admin' }}</span>
                    <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-700" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zM3 18a7 7 0 1114 0H3z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Form Tambah Kategori -->
            <div class="flex-1 p-8 overflow-auto">
                <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">
                    <h2 class="text-2xl font-semibold text-center text-gray-800 mb-4">Tambah Kategori Inspeksi</h2>

                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.parameter.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                Kategori</label>
                            <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Masukkan nama kategori inspeksi">
                        </div>

                        <div class="flex justify-end mt-6">
                            <a href="{{ route('admin.parameter.index') }}"
                                class="mr-4 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium px-4 py-2 rounded-lg transition">
                                Batal
                            </a>
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2 rounded-lg transition">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

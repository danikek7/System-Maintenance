<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tambah Jadwal Maintenance</title>
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
                        <a href="{{ route('admin.jadwal.index') }}"
                           class="flex items-center gap-4 p-3 rounded-lg bg-white bg-opacity-20 text-white font-medium">
                            <span class="material-symbols-outlined">event_note</span>
                            <span>Jadwal</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.aset.index') }}"
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
        <div class="flex-1 flex flex-col overflow-auto p-8">
            <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-8">
                <h1 class="text-2xl font-bold mb-6">Tambah Jadwal Maintenance</h1>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.jadwal.tambah') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="bulan" class="block font-medium mb-1">Bulan</label>
                        <input
                            type="month"
                            id="bulan"
                            name="bulan"
                            value="{{ old('bulan') }}"
                            required
                            class="w-full border border-gray-300 rounded px-3 py-2"
                        />
                    </div>

                    <div>
                        <label for="name_schedule" class="block font-medium mb-1">Nama Jadwal</label>
                        <input
                            type="text"
                            id="name_schedule"
                            name="name_schedule"
                            value="{{ old('name_schedule') }}"
                            placeholder="Masukkan nama jadwal"
                            required
                            class="w-full border border-gray-300 rounded px-3 py-2"
                        />
                    </div>

                    <div>
                        <label for="lokasi" class="block font-medium mb-1">Lokasi</label>
                        <select
                            id="lokasi"
                            name="lokasi"
                            required
                            class="w-full border border-gray-300 rounded px-3 py-2"
                        >
                            <option value="">-- Pilih Lokasi --</option>
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}" {{ old('lokasi') == $location->id ? 'selected' : '' }}>
                                    {{ $location->lokasi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-medium mb-1">Aset</label>
                        <div class="space-y-2 max-h-48 overflow-y-auto border border-gray-300 rounded p-3 bg-gray-50">
                            @foreach ($assets as $asset)
                                <label class="flex items-center space-x-2">
                                    <input
                                        type="checkbox"
                                        name="aset[]"
                                        value="{{ $asset->id }}"
                                        {{ is_array(old('aset')) && in_array($asset->id, old('aset')) ? 'checked' : '' }}
                                    />
                                    <span>{{ $asset->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex space-x-4">
                        <button
                            type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700"
                        >
                            Simpan Jadwal
                        </button>
                        <a href="{{ route('admin.jadwal.index') }}" class="inline-block px-6 py-2 border border-gray-300 rounded hover:bg-gray-100">
                            Kembali ke Daftar Jadwal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Laporan - PIC Maintenance</title>
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
        <!-- Sidebar PIC -->
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
                        <a href="{{ route('pic.dashboard') }}"
                            class="flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-10">
                            <span class="material-symbols-outlined">dashboard</span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pic.laporan.index') }}"
                            class="flex items-center gap-4 p-3 rounded-lg bg-white bg-opacity-20 font-medium">
                            <span class="material-symbols-outlined">event_note</span>
                            <span>Laporan</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="p-4 border-t border-blue-400">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-10">
                        <span class="material-symbols-outlined">logout</span>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content PIC -->
        <div class="flex-1 flex flex-col">
            <!-- Top Bar -->
            <div class="sidebar-gradient text-white p-4 flex justify-between items-center shadow">
                <div class="text-lg font-semibold">
                    {{-- Detail Laporan Jadwal: {{ $jadwal->nama }} - Aset:
                    {{ $detail->asset->nama_asset ?? $detail->nama_asset }} --}}
                </div>
                <div class="flex items-center space-x-3">
                    <span class="text-sm">{{ auth()->user()->username ?? 'PIC' }}</span>
                    <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-700" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zM3 18a7 7 0 1114 0H3z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="flex-1 p-8 overflow-auto">
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Rincian Laporan Inspeksi</h2>

                    @if ($laporans->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse">
                                <thead class="bg-blue-600 text-white">
                                    <tr>
                                        <th class="px-4 py-3 text-center text-sm font-semibold border">No</th>
                                        <th class="px-4 py-3 text-center text-sm font-semibold border">Parameter
                                        </th>
                                        <th class="px-4 py-3 text-center text-sm font-semibold border">Hasil Indikator
                                        </th>
                                        <th class="px-4 py-3 text-center text-sm font-semibold border">Catatan</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($laporans as $index => $item)
                                        <tr
                                            class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }} hover:bg-blue-50 transition">
                                            <td class="px-4 py-4 text-sm text-gray-900 border text-center">
                                                {{ $index + 1 }}</td>
                                            <td class="px-4 py-4 text-sm text-gray-900 border text-center">
                                                {{ $item->typeInspeksi->nama ?? '–' }}
                                            </td>
                                            <td class="px-4 py-4 text-sm text-gray-900 border text-center">
                                                {{ $item->hasil_indikator === 1 ? 'Baik' : ($item->hasil_indikator === 0 ? 'Buruk' : '-') }}
                                            </td>
                                            <td class="px-4 py-4 text-sm text-gray-900 border text-left">
                                                {{ $item->notes ?? '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="p-4 text-center text-gray-500">
                            Tidak ada data inspeksi pada laporan ini.
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Jadwal - Maintenance System</title>
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

            <!-- Navigation -->
            <nav class="flex-1 p-4">
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('manager.dashboard') }}"
                            class="flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-10">
                            <span class="material-symbols-outlined">dashboard</span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('manager.jadwal.index') }}"
                            class="flex items-center gap-4 p-3 rounded-lg bg-white bg-opacity-20 font-medium">
                            <span class="material-symbols-outlined">event_note</span>
                            <span>Jadwal</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('manager.laporan.index') }}"
                            class="flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-10">
                            <span class="material-symbols-outlined">event_note</span>
                            <span>Laporan</span>
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
        <div class="flex-1 flex flex-col">
            <!-- Top Bar -->
            <div class="sidebar-gradient text-white p-4 flex justify-between items-center shadow">
                <div class="text-lg font-semibold">
                    {{-- Detail Jadwal Maintenance --}}
                </div>
                <div class="flex items-center space-x-3">
                    <span class="text-sm">{{ auth()->user()->username ?? 'Manager' }}</span>
                    <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-700" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zM3 18a7 7 0 1114 0H3z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <main class="flex-1 p-8 overflow-auto">
                <div class="max-w-4xl mx-auto bg-white shadow rounded-lg p-6">
                    <!-- Header Section -->
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">Detail Jadwal: {{ $jadwal->nama }}</h1>

                    </div>

                    <!-- Info Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                            <h3 class="text-sm font-medium text-gray-500 mb-1">Bulan</h3>
                            @php
                                $bulanFinal = '-';
                                try {
                                    $bulanFinal = \Carbon\Carbon::createFromFormat(
                                        'Y-m',
                                        $jadwal->bulan,
                                    )->translatedFormat('F');
                                } catch (\Exception $e) {
                                    $bulanFinal = '-';
                                }
                            @endphp

                            <p class="text-lg font-semibold text-gray-800">{{ $bulanFinal }}</p>

                        </div>
                        <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                            <h3 class="text-sm font-medium text-gray-500 mb-1">Dibuat Pada</h3>
                            <p class="text-lg font-semibold text-gray-800">
                                {{ \Carbon\Carbon::parse($jadwal->created_at)->translatedFormat('d F Y H:i') }}
                            </p>
                        </div>
                    </div>

                    <!-- Assets Table -->
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Daftar Aset</h2>

                        @if ($jadwal->details->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="w-full border-collapse">
                                    <thead>
                                        <tr class="bg-blue-600 text-white">
                                            <th class="px-6 py-3 text-left text-sm font-medium">No</th>
                                            <th class="px-6 py-3 text-left text-sm font-medium">Nama Aset</th>
                                            <th class="px-6 py-3 text-left text-sm font-medium">Tag Aset</th>
                                            <th class="px-6 py-3 text-left text-sm font-medium">Lokasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jadwal->details as $index => $detail)
                                            <tr
                                                class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-blue-50' }} border-b border-gray-200">
                                                <td class="px-6 py-4 text-sm text-gray-700">{{ $index + 1 }}</td>
                                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                                    {{ $detail->asset->nama_asset ?? ($detail->nama_asset ?? '–') }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-700">
                                                    {{ $detail->asset->asset_tag ?? ($detail->asset_tag ?? '–') }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-700">
                                                    {{ $detail->location->nama_location ?? ($detail->nama_location ?? '–') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="bg-gray-50 rounded-lg p-4 text-center">
                                <p class="text-gray-500">Tidak ada rincian untuk jadwal ini.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Approval Section -->
                    <div class="flex justify-end">
                        <form action="{{ route('manager.jadwal.approve', $jadwal->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full md:w-auto bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-6 rounded-lg flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined">check_circle</span>
                                Setujui Jadwal
                            </button>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>

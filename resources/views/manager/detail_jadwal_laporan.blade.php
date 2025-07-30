<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Jadwal - Maintenance System</title>
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
            background: linear-gradient(180deg, #2563eb 0%, #1e40af 100%);
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
                            class="flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-10">
                            <span class="material-symbols-outlined">event_note</span>
                            <span>Jadwal</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('manager.laporan.index') }}"
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

        <!-- Main content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Bar -->
            <div class="sidebar-gradient text-white p-4 flex justify-between items-center shadow">
                <div class="text-lg font-semibold">
                    {{-- Detail Jadwal: {{ $jadwal->nama }} --}}
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
                <div class="bg-white shadow rounded-lg">
                    <div class="p-6">
                        @if (session('success'))
                            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="flex justify-between items-center mb-6">
                            <h1 class="text-2xl font-bold text-gray-900">Detail Jadwal: {{ $jadwal->nama }}</h1>
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
                                <p class="text-lg font-semibold text-gray-800"> {{ $bulanFinal }}</p>
                            </div>
                            <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                                <h3 class="text-sm font-medium text-gray-500 mb-1">Dibuat Pada</h3>
                                <p class="text-lg font-semibold text-gray-800">
                                    {{ $jadwal->create_at ? $jadwal->create_at->format('d F Y H:i') : '-' }}
                                </p>
                            </div>
                        </div>

                        <!-- Assets Table -->
                        <div class="mb-8">
                            <h2 class="text-xl font-bold text-gray-900 mb-4">Rincian Jadwal</h2>

                            @if ($jadwal->details->count() > 0)
                                <div class="overflow-x-auto">
                                    <table class="w-full border-collapse">
                                        <thead class="bg-blue-600 text-white">
                                            <tr>
                                                <th class="px-4 py-3 text-center text-sm font-semibold border">No</th>
                                                <th class="px-4 py-3 text-center text-sm font-semibold border">Nama Aset
                                                </th>
                                                <th class="px-4 py-3 text-center text-sm font-semibold border">Tag Aset
                                                </th>
                                                <th class="px-4 py-3 text-center text-sm font-semibold border">Lokasi
                                                </th>
                                                <th class="px-4 py-3 text-center text-sm font-semibold border">Status
                                                </th>
                                                <th class="px-4 py-3 text-center text-sm font-semibold border">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($jadwal->details as $index => $detail)
                                                <tr
                                                    class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }} hover:bg-blue-50 transition">
                                                    <td class="px-4 py-4 text-sm text-gray-900 border text-center">
                                                        {{ $index + 1 }}</td>
                                                    <td class="px-4 py-4 text-sm text-gray-900 border text-center">
                                                        {{ $detail->asset->nama_asset ?? ($detail->nama_asset ?? '–') }}
                                                    </td>
                                                    <td class="px-4 py-4 text-sm text-gray-900 border text-center">
                                                        {{ $detail->asset->asset_tag ?? ($detail->asset_tag ?? '–') }}
                                                    </td>
                                                    <td class="px-4 py-4 text-sm text-gray-900 border text-center">
                                                        {{ $detail->location->nama_location ?? ($detail->nama_location ?? '–') }}
                                                    </td>
                                                    <td class="px-4 py-4 text-sm text-gray-900 border text-center">
                                                        @if (!$detail->sudah_ada_laporan)
                                                            <span class="text-gray-500 italic">Laporan belum
                                                                dibuat</span>
                                                        @elseif ($detail->pic_status == 0 && $detail->manager_status == 0)
                                                            <span class="text-yellow-600 font-semibold">Belum diajukan
                                                                ke PIC</span>
                                                        @elseif ($detail->pic_status == 1 && $detail->manager_status == 0)
                                                            <span class="text-orange-600 font-semibold">Menunggu approve
                                                                PIC</span>
                                                        @elseif ($detail->pic_status == 2 && $detail->manager_status == 0)
                                                            <span class="text-blue-600 font-semibold">Menunggu
                                                                approval</span>
                                                        @elseif ($detail->pic_status == 2 && $detail->manager_status == 1)
                                                            <span class="text-green-600 font-semibold">Sudah
                                                                diapprove</span>
                                                        @else
                                                            <span class="text-gray-500">Status tidak diketahui</span>
                                                        @endif
                                                    </td>
                                                    <td class="px-4 py-4 text-sm text-gray-900 border text-center">
                                                        @if ($detail->pic_status == 2 && $detail->manager_status == 0)
                                                            <div class="flex justify-center gap-2">
                                                                <form
                                                                    action="{{ route('manager.laporan.approve', $detail->id) }}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('Setujui laporan ini?')">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded inline-flex items-center gap-1">
                                                                        <span
                                                                            class="material-symbols-outlined text-sm">check_circle</span>
                                                                        Approve
                                                                    </button>
                                                                </form>
                                                                <a href="{{ route('manager.laporan.detail_laporan', [$jadwal->id, $detail->id]) }}"
                                                                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded inline-flex items-center gap-1">
                                                                    <span
                                                                        class="material-symbols-outlined text-sm">visibility</span>
                                                                    Lihat
                                                                </a>
                                                            </div>
                                                        @elseif($detail->sudah_ada_laporan)
                                                            <a href="{{ route('manager.laporan.detail_laporan', [$jadwal->id, $detail->id]) }}"
                                                                class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded inline-flex items-center gap-1">
                                                                <span
                                                                    class="material-symbols-outlined text-sm">visibility</span>
                                                                Lihat
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="p-4 text-center text-gray-500">
                                    Tidak ada rincian aset untuk jadwal ini.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>

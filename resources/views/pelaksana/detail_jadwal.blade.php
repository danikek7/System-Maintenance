<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Jadwal - {{ $jadwal->nama }}</title>
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

        /* Status badge styles */
        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: capitalize;
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
                        <a href="{{ route('pelaksana.dashboard') }}"
                            class="flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-10">
                            <span class="material-symbols-outlined">dashboard</span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pelaksana.jadwal.index') }}"
                            class="flex items-center gap-4 p-3 rounded-lg bg-white bg-opacity-20 font-medium">
                            <span class="material-symbols-outlined">event_note</span>
                            <span>Jadwal</span>
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
                    <span class="text-sm">{{ auth()->user()->username ?? 'Pelaksana' }}</span>
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
                                {{ $jadwal->create_at ? $jadwal->create_at->format('d F Y H:i') : '-' }}
                            </p>
                        </div>
                    </div>

                    <!-- Assets Table -->
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Daftar Aset</h2>
                        @if ($jadwal->details->where('status_laporan_code', 0)->count() > 0)
                            <div class="flex justify-end">
                                <form action="{{ route('pelaksana.laporan.submit_all', $jadwal->id) }}" method="POST"
                                    onsubmit="return confirm('Ajukan semua laporan draft ke PIC?');">
                                    @csrf
                                    <button type="submit"
                                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm flex items-center gap-1">
                                        <span class="material-symbols-outlined text-sm">send</span>
                                        Ajukan Semua Laporan
                                    </button>
                                </form>
                            </div><br>
                        @endif
                        @if ($jadwal->details->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="w-full border-collapse">
                                    <thead>
                                        <tr class="bg-blue-600 text-white">
                                            <th class="px-6 py-3 text-left text-sm font-medium">No</th>
                                            <th class="px-6 py-3 text-left text-sm font-medium">Nama Aset</th>
                                            <th class="px-6 py-3 text-left text-sm font-medium">Lokasi</th>
                                            <th class="px-6 py-3 text-left text-sm font-medium">Pelaksana</th>
                                            <th class="px-6 py-3 text-left text-sm font-medium">Status</th>
                                            <th class="px-6 py-3 text-left text-sm font-medium">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jadwal->details as $index => $detail)
                                            <tr
                                                class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-blue-50' }} border-b border-gray-200">
                                                <td class="px-6 py-4 text-sm text-gray-700">{{ $index + 1 }}</td>
                                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                                    {{ $detail->asset->nama_asset ?? ($detail->nama_asset ?? '-') }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-700">
                                                    {{ $detail->location->nama_location ?? ($detail->nama_location ?? '-') }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-700">
    {{ ($detail->pelaksana->first_name ?? '') . ' ' . ($detail->pelaksana->last_name ?? '') ?: '-' }}
</td>
                                                <td class="px-6 py-4 text-sm text-gray-700">
                                                    @php
                                                        $statusCode = $detail->status_laporan_code;
                                                        $statusClass = match ($statusCode) {
                                                            null, -1 => 'bg-gray-100 text-gray-800', // Belum dibuat
                                                            0 => 'bg-yellow-100 text-yellow-800', // Draft
                                                            1
                                                                => 'bg-orange-100 text-orange-800', // Submit (menunggu PIC)
                                                            2
                                                                => 'bg-blue-100 text-blue-800', // Approved PIC, menunggu Manager
                                                            3 => 'bg-green-100 text-green-800', // Done
                                                            default => 'bg-gray-100 text-gray-800',
                                                        };

                                                        // Label sesuai status
                                                        $statusLabels = [
                                                            null => 'Belum dibuat',
                                                            -1 => 'Belum dibuat',
                                                            0 => 'Draft',
                                                            1 => 'Diajukan ke PIC',
                                                            2 => 'Disetujui PIC, menunggu Manager',
                                                            3 => 'Selesai',
                                                        ];
                                                    @endphp
                                                    <span class="status-badge {{ $statusClass }}">
                                                        {{ $statusLabels[$statusCode] ?? 'Tidak diketahui' }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-700">
                                                    <div class="flex gap-2">
                                                        @if (is_null($statusCode) || $statusCode === -1)
                                                            <!-- Belum buat laporan, tombol isi laporan saja -->
                                                            <a href="{{ route('pelaksana.form_laporan', [$jadwal->id, $detail->id]) }}"
                                                                class="bg-primary-blue hover:bg-blue-700 text-white px-3 py-1 rounded text-xs flex items-center gap-1">
                                                                <span
                                                                    class="material-symbols-outlined text-sm">edit_note</span>
                                                                Isi Laporan
                                                            </a>
                                                        @elseif ($statusCode === 0)
                                                            <!-- Draft: Bisa edit dan ajukan -->
                                                            <a href="{{ route('pelaksana.edit_laporan', [$jadwal->id, $detail->id]) }}"
                                                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs flex items-center gap-1">
                                                                <span
                                                                    class="material-symbols-outlined text-sm">edit</span>
                                                                Edit
                                                            </a>

                                                            <form
                                                                action="{{ route('pelaksana.laporan.submit', $detail->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Ajukan laporan ke PIC?');">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit"
                                                                    class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs flex items-center gap-1">
                                                                    <span
                                                                        class="material-symbols-outlined text-sm">send</span>
                                                                    Ajukan
                                                                </button>
                                                            </form>
                                                        @elseif ($statusCode === 1)
                                                            <!-- Sudah diajukan ke PIC, belum diapprove PIC -->
                                                            <span class="text-sm text-orange-600 italic">Menunggu
                                                                persetujuan PIC</span>
                                                        @elseif ($statusCode === 2)
                                                            <!-- Disetujui PIC, menunggu manager -->
                                                            <span class="text-sm text-blue-600 italic">Menunggu
                                                                persetujuan Manager</span>
                                                        @elseif ($statusCode === 3)
                                                            <!-- Selesai, tampil tombol print -->
                                                            <a href="{{ route('pelaksana.laporan.print', [$jadwal->id, $detail->id]) }}"
                                                                target="_blank"
                                                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded text-xs flex items-center gap-1">
                                                                <span
                                                                    class="material-symbols-outlined text-sm">print</span>
                                                                Print
                                                            </a>
                                                        @else
                                                            <span class="text-sm text-gray-500 italic">Status tidak
                                                                diketahui</span>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="bg-gray-50 rounded-lg p-4 text-center">
                                <p class="text-gray-500">Tidak ada aset yang ditemukan dalam jadwal ini.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>

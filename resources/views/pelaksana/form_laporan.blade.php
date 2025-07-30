<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Form Inspeksi - Maintenance System</title>
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

        input[type="radio"] {
            accent-color: #1d4ed8;
        }

        textarea {
            background-color: white;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            padding: 0.5rem;
            font-size: 0.875rem;
            resize: vertical;
            min-height: 3rem;
            width: 100%;
            height: 100%;
            box-sizing: border-box;
            transition: all 0.2s ease;
        }

        textarea:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        .border-red-500 {
            border-color: #ef4444 !important;
        }

        .radio-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
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
                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('warning'))
                    <div class="mb-4 p-4 bg-yellow-100 text-yellow-700 rounded">
                        {{ session('warning') }}
                    </div>
                @endif
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
                    {{-- Form Inspeksi --}}
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
                    <h1 class="text-2xl font-bold text-gray-800 text-center mb-8">FORM INSPEKSI</h1>

                    <form action="{{ route('pelaksana.form_laporan.store', [$jadwal->id, $detail_jadwal->id]) }}"
                        method="POST" class="space-y-6" id="formInspeksi">
                        @csrf

                        <!-- Input pelaksana hidden -->
                        <input type="hidden" name="pelaksana" value="{{ auth()->user()->id }}">

                        <!-- Form Fields -->
                        <div class="grid grid-cols-1 gap-6">
                            <!-- Tanggal -->
                            <div class="flex items-center gap-4">
                                <label class="w-36 text-right text-base font-medium text-gray-700">Dibuat
                                    tanggal</label>
                                <span>:</span>
                                <input type="date" name="tanggal"
                                    class="flex-1 border border-gray-300 rounded px-3 py-2 text-base focus:ring-blue-500 focus:border-blue-500"
                                    value="{{ old('tanggal') ?? ($laporan->tanggal ?? date('Y-m-d')) }}" required />
                            </div>

                            <!-- Lokasi -->
                            <div class="flex items-center gap-4">
                                <label class="w-36 text-right text-base font-medium text-gray-700">Lokasi</label>
                                <span>:</span>
                                <input type="text" name="lokasi" value="{{ $detail_jadwal->nama_location ?? '-' }}"
                                    readonly
                                    class="flex-1 border border-gray-300 rounded px-3 py-2 text-base bg-gray-100" />
                            </div>

                            <!-- Serial Asset -->
                            <div class="flex items-center gap-4">
                                <label class="w-36 text-right text-base font-medium text-gray-700">Type (Serial)</label>
                                <span>:</span>
                                <input type="text" name="scanner[{{ $detail_jadwal->id }}]"
                                    value="{{ $detail_jadwal->asset->serial ?? '-' }}" readonly
                                    class="flex-1 border border-gray-300 rounded px-3 py-2 text-base bg-gray-100" />
                            </div>

                            <!-- Type Form Dropdown -->
                            <div class="flex items-center gap-4">
                                <label class="w-36 text-right text-base font-medium text-gray-700" for="typeform">Type
                                    Form</label>
                                <span>:</span>
                                <select id="typeform" name="typeform"
                                    class="flex-1 border border-gray-300 rounded px-3 py-2 text-base focus:ring-blue-500 focus:border-blue-500"
                                    required>
                                    <option value="">-- Pilih Type Form --</option>
                                    @foreach ($typeInspeksis as $type)
                                        <option value="{{ $type->id }}"
                                            {{ old('typeform') == $type->id || $jadwal->type_inspeksis_id == $type->id ? 'selected' : '' }}>
                                            {{ $type->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Tabel Detail -->
                        <div class="overflow-x-auto mt-8">
                            <table id="tabel-detail"
                                class="w-full border border-gray-200 rounded-md border-collapse hidden">
                                <thead>
                                    <tr class="bg-blue-600 text-white text-base font-medium">
                                        <th class="border border-gray-200 w-12 text-center py-2" rowspan="2">NO</th>
                                        <th class="border border-gray-200 w-72 text-center py-2" rowspan="2">Jenis
                                            Pemeliharaan</th>
                                        <th class="border border-gray-200 text-center py-2" colspan="2">Kondisi</th>
                                        <th class="border border-gray-200 w-72 text-center py-2" rowspan="2">Catatan
                                        </th>
                                    </tr>
                                    <tr class="bg-blue-600 text-white text-base font-medium">
                                        <th class="border border-gray-200 py-2 w-16 text-center">Baik</th>
                                        <th class="border border-gray-200 py-2 w-16 text-center">Buruk</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-detail">
                                    {{-- Isi data via JavaScript AJAX --}}
                                </tbody>
                            </table>
                        </div>

                        <!-- Button Section -->
                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md text-base font-medium transition">
                                Simpan
                            </button>
                        </div>
                    </form>

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mt-6">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </div>

    <script>
        function toggleCatatan(radio, textareaId) {
            const textarea = document.getElementById(textareaId);
            if (radio.value === 'buruk' && radio.checked) {
                textarea.required = true;
                textarea.classList.add('border-red-500');
                textarea.placeholder = 'Catatan harus diisi untuk kondisi buruk';
            } else {
                textarea.required = false;
                textarea.classList.remove('border-red-500');
                textarea.placeholder = 'Tambahkan catatan (opsional)';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const typeFormSelect = document.getElementById('typeform');
            if (typeFormSelect.value) loadDetailType(typeFormSelect.value);

            typeFormSelect.addEventListener('change', function() {
                loadDetailType(this.value);
            });
        });

        function loadDetailType(typeId) {
            if (!typeId) {
                document.getElementById('tbody-detail').innerHTML = '';
                document.getElementById('tabel-detail').classList.add('hidden');
                return;
            }

            fetch(`/pelaksana/get-detail-type/${typeId}`)
                .then(res => res.json())
                .then(data => {
                    const tbody = document.getElementById('tbody-detail');
                    tbody.innerHTML = '';

                    data.forEach((item, i) => {
                        tbody.innerHTML += `
                            <tr class="border-b border-gray-200">
                                <td class="border border-gray-200 text-center py-4">${i + 1}</td>
                                <td class="border border-gray-200 px-4 py-4">${item.nama}</td>
                                <td class="border border-gray-200 py-4">
                                    <div class="radio-container">
                                        <input type="radio" name="detail_inspeksi[${item.id}][hasil_indikator]" value="baik" checked onchange="toggleCatatan(this, 'catatan${item.id}')" />
                                    </div>
                                </td>
                                <td class="border border-gray-200 py-4">
                                    <div class="radio-container">
                                        <input type="radio" name="detail_inspeksi[${item.id}][hasil_indikator]" value="buruk" onchange="toggleCatatan(this, 'catatan${item.id}')" />
                                    </div>
                                </td>
                                <td class="border border-gray-200">
                                    <textarea id="catatan${item.id}" name="detail_inspeksi[${item.id}][notes]" class="border border-gray-300 rounded" placeholder="Tambahkan catatan (opsional)"></textarea>
                                </td>
                            </tr>
                        `;
                    });

                    document.getElementById('tabel-detail').classList.remove('hidden');
                });
        }

        // Validasi sebelum submit
        document.getElementById('formInspeksi').addEventListener('submit', function(e) {
            let hasError = false;
            const textareas = document.querySelectorAll('textarea');

            textareas.forEach(textarea => {
                const radioBuruk = textarea.closest('tr').querySelector('input[value="buruk"]');
                if (radioBuruk.checked && textarea.value.trim() === '') {
                    textarea.classList.add('border-red-500');
                    hasError = true;
                } else {
                    textarea.classList.remove('border-red-500');
                }
            });

            if (hasError) {
                alert('Catatan harus diisi untuk semua item yang kondisinya buruk');
                e.preventDefault();
            }
        });
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Parameter Inspeksi - Admin</title>
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
                            class="flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-10 text-white">
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
                        <a href="{{ route('admin.parameter.index') }}"
                            class="flex items-center gap-4 p-3 rounded-lg bg-white bg-opacity-20 text-white font-medium">
                            <span class="material-symbols-outlined">tune</span>
                            <span>Parameter</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Bar -->
            <div class="sidebar-gradient text-white shadow border-b p-4 flex items-center justify-end">
                <div class="flex items-center space-x-4">
                    <span class="text-sm">{{ auth()->user()->name ?? 'Admin' }}</span>
                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="flex-1 p-8 overflow-auto">
                <div class="max-w-7xl mx-auto bg-white shadow rounded-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-2xl font-semibold text-gray-800">Daftar Parameter Inspeksi</h2>
                        <a href="#parameterSetupForm"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg transition-colors duration-200 flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">add</span>
                            Tambah Parameter
                        </a>
                    </div>

                    <p class="text-gray-600 mb-6">Halaman ini digunakan untuk menambahkan dan menyimpan parameter inspeksi secara dinamis.</p>

                    <!-- Success Message -->
                    <div id="successMessage"
                        class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 hidden">
                        <span id="successText"></span>
                    </div>

                    <!-- Form -->
                    <form id="parameterSetupForm" onsubmit="handleFormSubmit(event)">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                                <input type="text" id="kategoriInput"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                    placeholder="Masukkan kategori">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Parameter</label>
                                <input type="number" id="jumlahParameter" min="1" max="10"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                    placeholder="Masukkan jumlah" onchange="generateParameterForms(this.value)">
                            </div>
                        </div>

                        <div id="parameterForms" class="space-y-4 mb-6"></div>

                        <div id="submitButtonContainer" class="flex justify-end hidden">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2 rounded-lg transition-colors duration-200">
                                Simpan
                            </button>
                        </div>
                    </form>

                    <!-- Saved Parameters -->
                    <div id="savedParametersSection" class="mt-10 hidden">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Parameter yang Tersimpan</h3>
                        <div id="savedParametersList" class="space-y-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let savedParameterSets = [];

        function generateParameterForms(count) {
            const container = document.getElementById('parameterForms');
            const submitContainer = document.getElementById('submitButtonContainer');
            container.innerHTML = '';
            if (count > 0) {
                for (let i = 1; i <= count; i++) {
                    container.innerHTML += `
                        <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                            <h4 class="font-medium text-gray-800 mb-3">Parameter ${i}</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Parameter</label>
                                    <input type="text" name="parameter_name_${i}" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                        placeholder="Masukkan nama parameter">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                                    <input type="text" name="parameter_desc_${i}" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                        placeholder="Masukkan deskripsi parameter">
                                </div>
                            </div>
                        </div>
                    `;
                }
                submitContainer.classList.remove('hidden');
            } else {
                submitContainer.classList.add('hidden');
            }
        }

        function handleFormSubmit(e) {
            e.preventDefault();
            const kategori = document.getElementById('kategoriInput').value.trim();
            const jumlah = parseInt(document.getElementById('jumlahParameter').value);
            if (!kategori || jumlah <= 0) return alert('Isi semua data!');
            const data = [];
            for (let i = 1; i <= jumlah; i++) {
                const name = document.querySelector(`[name="parameter_name_${i}"]`).value.trim();
                const desc = document.querySelector(`[name="parameter_desc_${i}"]`).value.trim();
                if (!name || !desc) return alert(`Parameter ${i} belum lengkap`);
                data.push({ name, description: desc });
            }
            savedParameterSets.push({ id: Date.now(), kategori, jumlah, parameters: data });
            document.getElementById('parameterSetupForm').reset();
            document.getElementById('parameterForms').innerHTML = '';
            document.getElementById('submitButtonContainer').classList.add('hidden');
            displaySavedParameters();
            showSuccessMessage('Parameter berhasil disimpan!');
        }

        function displaySavedParameters() {
            const section = document.getElementById('savedParametersSection');
            const list = document.getElementById('savedParametersList');
            section.classList.toggle('hidden', savedParameterSets.length === 0);
            list.innerHTML = savedParameterSets.map(set => `
                <div class="border border-gray-200 rounded-lg p-4 bg-white">
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <h4 class="font-semibold text-gray-800">${set.kategori}</h4>
                            <p class="text-sm text-gray-600">${set.jumlah} parameter</p>
                        </div>
                        <button onclick="deleteParameterSet(${set.id})"
                            class="text-red-500 hover:text-red-700 p-1 rounded hover:bg-red-50 transition-colors">
                            <span class="material-symbols-outlined text-lg">delete</span>
                        </button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        ${set.parameters.map((p, i) => `
                            <div class="bg-gray-50 p-3 rounded-md">
                                <p class="font-medium text-sm text-gray-800">${i + 1}. ${p.name}</p>
                                <p class="text-xs text-gray-600 mt-1">${p.description}</p>
                            </div>
                        `).join('')}
                    </div>
                </div>
            `).join('');
        }

        function deleteParameterSet(id) {
            if (confirm('Yakin ingin menghapus?')) {
                savedParameterSets = savedParameterSets.filter(s => s.id !== id);
                displaySavedParameters();
                showSuccessMessage('Parameter berhasil dihapus!');
            }
        }

        function showSuccessMessage(msg) {
            const box = document.getElementById('successMessage');
            const text = document.getElementById('successText');
            text.textContent = msg;
            box.classList.remove('hidden');
            setTimeout(() => box.classList.add('hidden'), 3000);
        }
    </script>
</body>

</html>

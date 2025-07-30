<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Form Jadwal - Maintenance System</title>
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

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            border-radius: 0.5rem;
            width: 90%;
            max-width: 800px;
            max-height: 90vh;
            overflow-y: auto;
        }

        /* Animation for modal */
        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal.show {
            display: flex;
            animation: modalFadeIn 0.3s ease-out;
        }

        /* New Table Styles */
        .table-container {
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-container thead {
            background-color: #3b82f6;
        }

        .table-container th {
            padding: 12px 16px;
            text-align: center;
            color: white;
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table-container td {
            padding: 12px 16px;
            text-align: center;
            border-bottom: 1px solid #e5e7eb;
            font-size: 0.875rem;
        }

        .table-container tr:nth-child(even) {
            background-color: #f9fafb;
        }

        /* .table-container tr:hover {
            background-color: #f0f7ff;
        } */

        /* Badge Status */
        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* Loading Spinner */
        .loading-spinner {
            display: inline-block;
            width: 1.5rem;
            height: 1.5rem;
            border: 3px solid rgba(59, 130, 246, 0.3);
            border-radius: 50%;
            border-top-color: #3b82f6;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Scrollbar styling */
        .scrollable-table {
            max-height: 50vh;
            overflow-y: auto;
        }

        .scrollable-table::-webkit-scrollbar {
            width: 8px;
        }

        .scrollable-table::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .scrollable-table::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }

        .scrollable-table::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
        
        /* Notes cell styling */
        .notes-cell {
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        /* Checkbox styling */
        .asset-checkbox {
            width: 16px;
            height: 16px;
        }
        
        /* Select all checkbox styling */
        .select-all-checkbox {
            width: 16px;
            height: 16px;
            margin-right: 8px;
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
                            class="flex items-center gap-4 p-3 rounded-lg bg-white bg-opacity-20 font-medium"><span
                                class="material-symbols-outlined">event_note</span><span>Jadwal</span></a></li>
                    <li><a href="{{ route('admin.aset.index') }}"
                            class="flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-10"><span
                                class="material-symbols-outlined">inventory_2</span><span>Aset</span></a></li>
                    <li><a href="{{ route('admin.parameter.index') }}"
                            class="flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-10"><span
                                class="material-symbols-outlined">tune</span><span>Parameter</span></a></li>
                </ul>
            </nav>
 <div class="p-4 border-t border-blue-400">
                <ul class="space-y-1">
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-10">
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
            <div class="sidebar-gradient text-white p-4 flex justify-between items-center shadow">
                <div class="text-lg font-semibold">
                    <!-- Form Jadwal Maintenance -->
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

            <div class="flex-1 p-8 overflow-auto">
                <?php if (isset($success_message)): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    <?php echo htmlspecialchars($success_message); ?>
                </div>
                <?php endif; ?>

                <div class="max-w-4xl mx-auto bg-white shadow rounded-lg p-6">
                    <form action="{{ route('admin.jadwal.store') }}" method="POST">
                        @csrf

                        <h2 class="text-center text-xl font-bold text-gray-800">FORM JADWAL</h2><br>

                        <!-- Flash message -->
                        @if (session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Error validation -->
                        @if ($errors->any()))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Bulan -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Untuk Bulan :</label>
                            <div class="relative">
                                <input type="month" name="bulan" required
                                    class="w-full md:w-80 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-blue focus:border-transparent outline-none"
                                    value="{{ old('bulan') ?? date('Y-m') }}">
                            </div>
                        </div>

                        <!-- Nama Jadwal -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Jadwal :</label>
                            <input type="text" name="nama" required placeholder="Masukkan nama jadwal"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-blue focus:border-transparent outline-none"
                                value="{{ old('nama') }}">
                        </div>

                        <!-- Lokasi dan Aset Section -->
                        <div class="mb-8">
                            <div class="flex justify-between items-center mb-4">
                                <label class="block text-sm font-medium text-gray-700">Lokasi dan Aset :</label>
                                <button type="button" onclick="openLocationModal()"
                                    class="bg-primary-blue hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg transition-colors duration-200 focus:ring-4 focus:ring-blue-300 focus:outline-none flex items-center">
                                    <span class="material-symbols-outlined mr-2">add</span>
                                    Tambah Lokasi
                                </button>
                            </div>

                            <!-- Selected Assets Table -->
                            <div id="selected-assets-container">
                                <div id="no-assets-message" class="text-gray-500 text-sm italic">
                                    Belum ada aset yang dipilih
                                </div>
                                <div id="assets-table-container" class="hidden">
                                    <div class="table-container">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Aset</th>
                                                    <th>Tag Aset</th>
                                                    <th>Lokasi</th>
                                                    <th>Notes</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="selected-assets-body">
                                                <!-- Selected assets will be added here -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden input fields for form submission -->
                        <div id="form-data-container">
                            <!-- Will be populated with hidden inputs for selected assets -->
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-primary-blue hover:bg-blue-700 text-white font-medium px-8 py-3 rounded-lg transition-colors duration-200 focus:ring-4 focus:ring-blue-300 focus:outline-none">
                                Simpan Jadwal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Location Selection Modal -->
    <div id="locationModal" class="modal">
        <div class="modal-content">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Pilih Lokasi dan Aset</h3>
                    <button onclick="closeLocationModal()" class="text-gray-500 hover:text-gray-700">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>

                <!-- Location Selection -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi :</label>
                    <select name="modal_lokasi" id="modal_lokasi" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-blue focus:border-transparent outline-none bg-white"
                        onchange="loadAssetsForModal(this.value)">
                        <option value="">Pilih Lokasi</option>
                        @foreach ($locations as $lok)
                            <option value="{{ $lok->id }}" data-lokasi-name="{{ $lok->lokasi }}"
                                @selected(old('lokasi') == $lok->id)>
                                {{ $lok->lokasi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Assets for Selected Location -->
                <div id="modal-assets-container" class="hidden">
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-sm font-medium text-gray-700">Pilih Aset :</label>
                        <button type="button" onclick="toggleSelectAll()" class="text-sm text-primary-blue hover:text-blue-700 flex items-center">
                            <input type="checkbox" id="select-all-checkbox" class="select-all-checkbox">
                            <span>Pilih Semua</span>
                        </button>
                    </div>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Aset</th>
                                    <th>Tag Aset</th>
                                    <th>Lokasi</th>
                                    <th>Notes</th>
                                    <th>Pilih</th>
                                </tr>
                            </thead>
                            <tbody id="modal-assets-list" class="scrollable-table">
                                <!-- Assets will be loaded here via AJAX -->
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 flex justify-end">
                        <button type="button" onclick="saveSelectedAssets()"
                            class="bg-primary-blue hover:bg-blue-700 text-white font-medium px-6 py-2 rounded-lg transition-colors duration-200">
                            Simpan Pilihan
                        </button>
                    </div>
                </div>

                <div id="modal-no-location-message" class="text-gray-500 text-sm italic">
                    Pilih lokasi terlebih dahulu untuk melihat daftar aset
                </div>
            </div>
        </div>
    </div>

    <script>
        // Global variables to track selections
        let selectedAssets = []; // Array of {id, name, asset_tag, locationId, locationName, notes}
        let currentModalLocationId = null;
        let currentModalLocationName = '';
        let currentModalAssets = [];
        let selectedAssetsForModal = [];

        // Modal functions
        function openLocationModal() {
            // Reset modal state
            currentModalLocationId = null;
            currentModalLocationName = '';
            currentModalAssets = [];
            selectedAssetsForModal = [];
            document.getElementById('modal_lokasi').value = '';
            document.getElementById('modal-assets-container').classList.add('hidden');
            document.getElementById('modal-no-location-message').classList.remove('hidden');
            document.getElementById('modal-assets-list').innerHTML = '';
            document.getElementById('select-all-checkbox').checked = false;

            // Show modal
            document.getElementById('locationModal').classList.add('show');
        }

        function closeLocationModal() {
            document.getElementById('locationModal').classList.remove('show');
        }

        // Load assets for the selected location in modal
        function loadAssetsForModal(locationId) {
            const modalAssetsContainer = document.getElementById('modal-assets-container');
            const modalAssetsList = document.getElementById('modal-assets-list');
            const modalNoLocationMessage = document.getElementById('modal-no-location-message');

            // Reset selections
            selectedAssetsForModal = [];
            document.getElementById('select-all-checkbox').checked = false;

            if (!locationId) {
                modalAssetsContainer.classList.add('hidden');
                modalNoLocationMessage.classList.remove('hidden');
                return;
            }

            // Get the location name
            const selectedOption = document.querySelector(`#modal_lokasi option[value="${locationId}"]`);
            currentModalLocationName = selectedOption.getAttribute('data-lokasi-name');
            currentModalLocationId = locationId;

            // Show loading state
            modalAssetsList.innerHTML = `
                <tr>
                    <td colspan="6" class="py-8 text-center">
                        <div class="flex justify-center items-center gap-2">
                            <div class="loading-spinner"></div>
                            <span class="text-gray-500">Memuat aset...</span>
                        </div>
                    </td>
                </tr>
            `;
            modalAssetsContainer.classList.remove('hidden');
            modalNoLocationMessage.classList.add('hidden');

            // Fetch assets via AJAX
            fetch(`/admin/jadwal/get-assets/${locationId}`)
                .then(response => response.json())
                .then(assets => {
                    // Filter out assets that are already selected
                    const availableAssets = assets.filter(asset =>
                        !selectedAssets.some(selected => selected.id === asset.id)
                    );

                    currentModalAssets = availableAssets;
                    renderModalAssetsList(availableAssets);
                })
                .catch(error => {
                    console.error('Error loading assets:', error);
                    modalAssetsList.innerHTML = `
                        <tr>
                            <td colspan="6" class="py-8 text-center text-red-500">
                                Gagal memuat aset. Silakan coba lagi.
                            </td>
                        </tr>
                    `;
                });
        }

        function renderModalAssetsList(assets) {
            const modalAssetsList = document.getElementById('modal-assets-list');

            if (assets.length === 0) {
                modalAssetsList.innerHTML = `
                    <tr>
                        <td colspan="6" class="py-8 text-center text-gray-500">
                            Tidak ada aset yang tersedia di lokasi ini atau semua aset sudah dipilih
                        </td>
                    </tr>
                `;
                return;
            }

            let html = '';
            assets.forEach((asset, index) => {
                html += `
                    <tr class="transition-colors">
                        <td class="text-center">${index + 1}</td>
                        <td class="font-medium">${asset.name}</td>
                        <td class="font-mono text-blue-600">${asset.asset_tag || '-'}</td>
                        <td>${currentModalLocationName}</td>
                        <td class="notes-cell" title="${asset.notes || ''}">${asset.notes ? asset.notes.substring(0, 20) + (asset.notes.length > 20 ? '...' : '') : '-'}</td>
                        <td class="text-center">
                            <input type="checkbox" id="asset_${asset.id}" value="${asset.id}"
                                class="asset-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                onchange="toggleAssetSelection(${asset.id})">
                        </td>
                    </tr>
                `;
            });

            modalAssetsList.innerHTML = html;
        }

        function toggleSelectAll() {
            const selectAllCheckbox = document.getElementById('select-all-checkbox');
            const checkboxes = document.querySelectorAll('#modal-assets-list input[type="checkbox"]');
            const isChecked = selectAllCheckbox.checked;
            
            checkboxes.forEach(cb => {
                cb.checked = isChecked;
                // Trigger change event to update selectedAssetsForModal
                const event = new Event('change');
                cb.dispatchEvent(event);
            });
        }

        function toggleAssetSelection(assetId) {
            const checkbox = document.getElementById(`asset_${assetId}`);
            const asset = currentModalAssets.find(a => a.id === assetId);
            const selectAllCheckbox = document.getElementById('select-all-checkbox');

            if (checkbox.checked) {
                // Add to selected assets if not already there
                if (!selectedAssetsForModal.some(a => a.id === assetId)) {
                    selectedAssetsForModal.push({
                        id: assetId,
                        name: asset.name,
                        asset_tag: asset.asset_tag,
                        notes: asset.notes
                    });
                }
            } else {
                // Remove from selected assets
                selectedAssetsForModal = selectedAssetsForModal.filter(a => a.id !== assetId);
                // Uncheck select all if any checkbox is unchecked
                selectAllCheckbox.checked = false;
            }

            // Update select all checkbox state
            const checkboxes = document.querySelectorAll('#modal-assets-list input[type="checkbox"]');
            const allChecked = Array.from(checkboxes).every(cb => cb.checked);
            selectAllCheckbox.checked = allChecked;
        }

        function saveSelectedAssets() {
            if (!currentModalLocationId || selectedAssetsForModal.length === 0) {
                alert('Pilih setidaknya satu aset untuk disimpan');
                return;
            }

            // Add selected assets to the main list
            selectedAssetsForModal.forEach(asset => {
                // Check if asset is already selected (shouldn't happen due to filtering)
                if (!selectedAssets.some(a => a.id === asset.id)) {
                    selectedAssets.push({
                        ...asset,
                        locationId: currentModalLocationId,
                        locationName: currentModalLocationName
                    });
                }
            });

            // Update the UI
            updateSelectedAssetsUI();

            // Update hidden form fields
            updateFormData();

            // Close the modal
            closeLocationModal();
        }

        function updateSelectedAssetsUI() {
            const container = document.getElementById('selected-assets-container');
            const noAssetsMessage = document.getElementById('no-assets-message');
            const tableContainer = document.getElementById('assets-table-container');
            const tableBody = document.getElementById('selected-assets-body');

            if (selectedAssets.length === 0) {
                tableContainer.classList.add('hidden');
                noAssetsMessage.classList.remove('hidden');
                return;
            }

            noAssetsMessage.classList.add('hidden');
            tableContainer.classList.remove('hidden');

            let html = '';
            selectedAssets.forEach((asset, index) => {
                html += `
                    <tr class="${index % 2 === 0 ? 'bg-white' : 'bg-gray-50'} hover:bg-blue-50 transition">
                        <td class="text-center">${index + 1}</td>
                        <td class="font-medium">${asset.name}</td>
                        <td class="font-mono text-blue-600">${asset.asset_tag || '-'}</td>
                        <td>${asset.locationName}</td>
                        <td class="notes-cell" title="${asset.notes || ''}">${asset.notes ? asset.notes.substring(0, 30) + (asset.notes.length > 30 ? '...' : '') : '-'}</td>
                        <td class="text-center">
                            <button 
                                type="button" 
                                onclick="removeAsset(${index})"
                                class="text-red-600 hover:text-red-800 transition-colors"
                                title="Hapus aset ini"
                            >
                                <span class="material-symbols-outlined text-sm">delete</span>
                            </button>
                        </td>
                    </tr>
                `;
            });

            tableBody.innerHTML = html;
        }

        function removeAsset(assetIndex) {
            selectedAssets.splice(assetIndex, 1);
            updateSelectedAssetsUI();
            updateFormData();
        }

        function updateFormData() {
            const formDataContainer = document.getElementById('form-data-container');
            formDataContainer.innerHTML = '';

            if (selectedAssets.length === 0) return;

            // Buat set lokasi unik
            const lokasiSet = new Set(selectedAssets.map(asset => asset.locationId));

            // Input lokasi sebagai array lokasi[]
            lokasiSet.forEach(lokasiId => {
                const lokasiInput = document.createElement('input');
                lokasiInput.type = 'hidden';
                lokasiInput.name = 'lokasi[]'; // harus array []
                lokasiInput.value = lokasiId;
                formDataContainer.appendChild(lokasiInput);
            });

            // Input aset sebagai aset[<lokasiId>][]
            lokasiSet.forEach(lokasiId => {
                const asetFiltered = selectedAssets.filter(asset => asset.locationId === lokasiId);
                asetFiltered.forEach(asset => {
                    const asetInput = document.createElement('input');
                    asetInput.type = 'hidden';
                    asetInput.name = `aset[${lokasiId}][]`; // nama harus ada [] untuk array
                    asetInput.value = asset.id;
                    formDataContainer.appendChild(asetInput);
                });
            });
        }
    </script>
</body>

</html>
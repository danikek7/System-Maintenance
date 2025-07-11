<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Jadwal - Maintenance System</title>
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
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 sidebar-gradient text-white flex flex-col">
            <!-- Header -->
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
                    <!-- Dashboard -->
                    <li>
                        <a href="#"
                           class="flex items-center gap-4 p-3 rounded-lg transition-colors hover:bg-white hover:bg-opacity-10 text-white">
                            <span class="material-symbols-outlined">dashboard</span>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <!-- Jadwal (active item) -->
                    <li>
                        <a href="#"
                           class="flex items-center gap-4 p-3 rounded-lg bg-white bg-opacity-20 text-white font-medium">
                            <span class="material-symbols-outlined">event_note</span>
                            <span>Jadwal</span>
                        </a>
                    </li>

                    <!-- Aset -->
                    <li>
                        <a href="#"
                           class="flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-10 text-white">
                            <span class="material-symbols-outlined">inventory_2</span>
                            <span>Aset</span>
                        </a>
                    </li>

                    <!-- Parameter -->
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
        <div class="flex-1 flex flex-col">
            <!-- Top Bar -->
            <div class="sidebar-gradient text-white shadow w-sm border-b p-4 flex items-center justify-end">
                <div class="flex items-center space-x-4">
                    <span class="text-sm">Admin</span>
                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <div class="flex-1 p-8 overflow-auto">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="max-w-4xl mx-auto bg-white shadow rounded-lg p-6">
                    <form action="{{ route('admin.jadwal.store') }}" method="POST">
                        @csrf
                        
                        <!-- Untuk Bulan -->
                        <div class="mb-6">
                            <h2 class="text-center text-xl font-bold text-gray-800">FORM JADWAL</h2><br>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Untuk Bulan :</label>
                            <div class="relative">
                                <input 
                                    type="month" 
                                    name="bulan" 
                                    id="bulan"
                                    required
                                    class="w-full md:w-80 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-blue focus:border-transparent outline-none"
                                    value="{{ old('bulan') ?? date('Y-m') }}"
                                >
                            </div>
                        </div>

                        <!-- Nama Jadwal -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Jadwal :</label>
                            <input 
                                type="text" 
                                name="nama" 
                                id="nama"
                                required
                                placeholder="Masukkan nama jadwal"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-blue focus:border-transparent outline-none"
                                value="{{ old('nama') }}"
                            >
                        </div>

                        <!-- Lokasi -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi :</label>
                            <select 
                                name="lokasi" 
                                id="lokasi"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-blue focus:border-transparent outline-none bg-white"
                                onchange="filterAssets()"
                            >
                                <option value="">Pilih Lokasi</option>
                                @foreach ($locations as $lok)
                                    <option value="{{ $lok->id }}" @selected(old('lokasi') == $lok->id)>{{ $lok->lokasi }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Aset -->
                        <div class="mb-8">
                            <label class="block text-sm font-medium text-gray-700 mb-4">Aset :</label>
                            <div id="assets-container" class="hidden">
                                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                                    <!-- Table Header -->
                                    <div class="bg-gray-50 px-6 py-3 border-b border-gray-200">
                                        <div class="grid grid-cols-12 gap-4 text-sm font-medium text-gray-700">
                                            <div class="col-span-1"></div>
                                            <div class="col-span-5">Nama Aset</div>
                                            <div class="col-span-3">Kode</div>
                                            <div class="col-span-3">Status</div>
                                        </div>
                                    </div>
                                    
                                    <!-- Table Body -->
                                    <div id="assets-list" class="divide-y divide-gray-200">
                                        @foreach ($assets as $index => $aset)
                                            <div class="px-6 py-4 aset-item hidden" data-lokasi="{{ $aset->location_id }}">
                                                <div class="grid grid-cols-12 gap-4 items-center">
                                                    <div class="col-span-1">
                                                        <div class="flex items-center">
                                                            <input 
                                                                type="checkbox" 
                                                                name="aset[]" 
                                                                value="{{ $aset->id }}"
                                                                class="w-4 h-4 text-primary-blue border-gray-300 rounded focus:ring-primary-blue focus:ring-2"
                                                                onchange="updateSelectedAssetsList()"
                                                                @if(is_array(old('aset')) && in_array($aset->id, old('aset'))) checked @endif
                                                            >
                                                        </div>
                                                    </div>
                                                    <div class="col-span-1 text-sm text-gray-600">
                                                        {{ $loop->iteration }}.
                                                    </div>
                                                    <div class="col-span-4 text-sm font-medium text-gray-900">
                                                        {{ $aset->name }}
                                                    </div>
                                                    <div class="col-span-3 text-sm text-gray-600">
                                                        {{ $aset->code }}
                                                    </div>
                                                    <div class="col-span-3">
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            Normal
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            
                            <div id="no-location-message" class="text-gray-500 text-sm italic">
                                Pilih lokasi terlebih dahulu untuk melihat daftar aset
                            </div>
                        </div>

                        <!-- Daftar Aset Terpilih -->
                        <div id="selected-assets-container" class="mb-8 hidden">
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                    <span class="material-symbols-outlined text-blue-600 mr-2">checklist</span>
                                    Daftar Aset Terpilih
                                </h3>
                                <div id="selected-assets-list" class="space-y-2">
                                    <!-- Selected assets will be displayed here -->
                                </div>
                                <div id="no-selected-assets" class="text-gray-500 text-sm italic">
                                    Belum ada aset yang dipilih
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button 
                                type="submit"
                                class="bg-primary-blue hover:bg-blue-700 text-white font-medium px-8 py-3 rounded-lg transition-colors duration-200 focus:ring-4 focus:ring-blue-300 focus:outline-none"
                            >
                                Simpan Jadwal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const lokasiSelect = document.getElementById('lokasi');
        const asetItems = document.querySelectorAll('.aset-item');
        const assetsContainer = document.getElementById('assets-container');
        const noLocationMessage = document.getElementById('no-location-message');
        
        function filterAssets() {
            const selectedLokasi = lokasiSelect.value;
            let hasVisibleAssets = false;
            
            asetItems.forEach((item, index) => {
                const checkbox = item.querySelector('input[type="checkbox"]');
                const numberSpan = item.querySelector('.col-span-1.text-sm');
                
                if (item.dataset.lokasi === selectedLokasi) {
                    item.classList.remove('hidden');
                    hasVisibleAssets = true;
                    // Update numbering
                    if (numberSpan) {
                        const visibleItems = Array.from(asetItems).filter(i => 
                            i.dataset.lokasi === selectedLokasi && 
                            Array.from(asetItems).indexOf(i) <= Array.from(asetItems).indexOf(item)
                        );
                        numberSpan.textContent = visibleItems.length + '.';
                    }
                } else {
                    item.classList.add('hidden');
                    checkbox.checked = false;
                }
            });
            
            if (selectedLokasi && hasVisibleAssets) {
                assetsContainer.classList.remove('hidden');
                noLocationMessage.classList.add('hidden');
            } else {
                assetsContainer.classList.add('hidden');
                noLocationMessage.classList.remove('hidden');
            }
            
            updateSelectedAssetsList();
        }
        
        function updateSelectedAssetsList() {
            const selectedAssetsContainer = document.getElementById('selected-assets-container');
            const selectedAssetsList = document.getElementById('selected-assets-list');
            const noSelectedAssets = document.getElementById('no-selected-assets');
            
            const checkedBoxes = document.querySelectorAll('input[name="aset[]"]:checked');
            
            if (checkedBoxes.length === 0) {
                selectedAssetsContainer.classList.add('hidden');
                selectedAssetsList.innerHTML = '';
                noSelectedAssets.classList.remove('hidden');
                return;
            }
            
            selectedAssetsContainer.classList.remove('hidden');
            noSelectedAssets.classList.add('hidden');
            
            let html = '';
            checkedBoxes.forEach((checkbox, index) => {
                const row = checkbox.closest('.aset-item');
                const assetName = row.querySelector('.col-span-4').textContent.trim();
                const assetCode = row.querySelector('.col-span-3.text-sm').textContent.trim();
                
                html += `
                    <div class="flex items-center justify-between bg-white p-4 rounded-lg border border-gray-200">
                        <div class="flex items-center space-x-4">
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                ${index + 1}
                            </span>
                            <div>
                                <h4 class="font-medium text-gray-900">${assetName}</h4>
                                <p class="text-sm text-gray-600">Kode: ${assetCode}</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Normal
                            </span>
                            <button 
                                type="button" 
                                onclick="removeAsset('${checkbox.value}')"
                                class="text-red-500 hover:text-red-700 transition-colors"
                                title="Hapus dari daftar"
                            >
                                <span class="material-symbols-outlined text-sm">close</span>
                            </button>
                        </div>
                    </div>
                `;
            });
            
            selectedAssetsList.innerHTML = html;
        }
        
        function removeAsset(assetId) {
            const checkbox = document.querySelector(input[name="aset[]"][value="${assetId}"]);
            if (checkbox) {
                checkbox.checked = false;
                updateSelectedAssetsList();
            }
        }
        
        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            filterAssets();
        });
        
        // Add event listener for location change
        lokasiSelect.addEventListener('change', filterAssets);
    </script>

</body>
</html>
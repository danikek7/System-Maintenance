<?php
session_start();

// Sample data - replace with your database queries
$locations = [
    1 => 'Ruang ICU',
    2 => 'Ruang Operasi',
    3 => 'Laboratorium',
    4 => 'Radiologi',
    5 => 'Farmasi'
];

$assets = [
    1 => [ // Ruang ICU
        ['id' => 1, 'name' => 'Printer EPSON L3120', 'code' => 'L3120'],
        ['id' => 2, 'name' => 'Ventilator Medis', 'code' => 'VM001'],
        ['id' => 3, 'name' => 'Monitor Pasien', 'code' => 'MP001']
    ],
    2 => [ // Ruang Operasi
        ['id' => 4, 'name' => 'Mesin Anestesi', 'code' => 'MA001'],
        ['id' => 5, 'name' => 'Lampu Operasi', 'code' => 'LO001']
    ],
    3 => [ // Laboratorium
        ['id' => 6, 'name' => 'Mikroskop Digital', 'code' => 'MD001'],
        ['id' => 7, 'name' => 'Centrifuge', 'code' => 'CF001']
    ],
    4 => [ // Radiologi
        ['id' => 8, 'name' => 'CT Scan', 'code' => 'CT001'],
        ['id' => 9, 'name' => 'X-Ray Machine', 'code' => 'XR001']
    ],
    5 => [ // Farmasi
        ['id' => 10, 'name' => 'CPU Rakitan', 'code' => '-'],
        ['id' => 11, 'name' => 'Printer Thermal', 'code' => 'PT001']
    ]
];

// AJAX handler for loading assets
if (isset($_GET['ajax']) && $_GET['ajax'] === 'load_assets' && isset($_GET['location_id'])) {
    header('Content-Type: application/json');
    $location_id = (int)$_GET['location_id'];
    echo json_encode($assets[$location_id] ?? []);
    exit;
}

// Form submission handler
if ($_POST) {
    $bulan = $_POST['bulan'] ?? '';
    $nama_jadwal = $_POST['nama_jadwal'] ?? '';
    $lokasi = $_POST['lokasi'] ?? '';
    $selected_assets = $_POST['assets'] ?? [];
    
    // Process form data here
    $success_message = "Jadwal berhasil disimpan!";
}
?>

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
         //ini
        <div class="w-64 sidebar-gradient text-white flex flex-col">
            <!-- Header -->
            <div class="p-6 border-b border-blue-400">
                <div class="flex items-center space-x-3">
                    <!-- <div class="w-8 h-8 bg-white bg-opacity-20 rounded-lg flex items-center justify-center" "> -->
                        <img src="logo.png" alt="Logo" class="w-8 h-8 object-contain" />
                    <!-- </div> -->
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
        //ini

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
                <?php if (isset($success_message)): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        <?php echo htmlspecialchars($success_message); ?>
                    </div>
                <?php endif; ?>

                <div class="max-w-4xl mx-auto bg-white shadow rounded-lg p-6">
                <form method="POST">
                    <!-- <form method="POST" class="max-w-4xl"> -->
                    <!-- Untuk Bulan -->
                    <div class="mb-6">
                        <h2 class="text-center text-xl font-bold text-gray-800">FORM JADWAL</h2><br>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Untuk Bulan :</label>
                        <div class="relative">
                            <input 
                                type="month" 
                                name="bulan" 
                                required
                                class="w-full md:w-80 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-blue focus:border-transparent outline-none"
                                value="<?php echo date('Y-m'); ?>"
                            >
                        </div>
                    </div>

                    <!-- Nama Jadwal -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Jadwal :</label>
                        <input 
                            type="text" 
                            name="nama_jadwal" 
                            required
                            placeholder="Masukkan nama jadwal"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-blue focus:border-transparent outline-none"
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
                            onchange="loadAssets(this.value)"
                        >
                            <option value="">Pilih Lokasi</option>
                            <?php foreach ($locations as $id => $name): ?>
                                <option value="<?php echo $id; ?>"><?php echo htmlspecialchars($name); ?></option>
                            <?php endforeach; ?>
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
                                        <div class="col-span-3">Catatan</div>
                                    </div>
                                </div>
                                
                                <!-- Table Body -->
                                <div id="assets-list" class="divide-y divide-gray-200">
                                    <!-- Assets will be loaded here via AJAX -->
                                </div>
                            </div>
                        </div>
                        
                        <div id="no-location-message" class="text-gray-500 text-sm italic">
                            Pilih lokasi terlebih dahulu untuk melihat daftar aset
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
        function loadAssets(locationId) {
            const assetsContainer = document.getElementById('assets-container');
            const assetsList = document.getElementById('assets-list');
            const noLocationMessage = document.getElementById('no-location-message');
            
            if (!locationId) {
                assetsContainer.classList.add('hidden');
                noLocationMessage.classList.remove('hidden');
                return;
            }
            
            // Show loading state
            assetsList.innerHTML = `
                <div class="px-6 py-8 text-center">
                    <div class="inline-block animate-spin rounded-full h-6 w-6 border-b-2 border-primary-blue"></div>
                    <p class="mt-2 text-sm text-gray-500">Memuat aset...</p>
                </div>
            `;
            assetsContainer.classList.remove('hidden');
            noLocationMessage.classList.add('hidden');
            
            // Fetch assets via AJAX
            fetch(`?ajax=load_assets&location_id=${locationId}`)
                .then(response => response.json())
                .then(assets => {
                    if (assets.length === 0) {
                        assetsList.innerHTML = `
                            <div class="px-6 py-8 text-center">
                                <p class="text-sm text-gray-500">Tidak ada aset di lokasi ini</p>
                            </div>
                        `;
                        return;
                    }
                    
                    let html = '';
                    assets.forEach((asset, index) => {
                        const status = getAssetStatus(asset.name);
                        html += `
                            <div class="px-6 py-4">
                                <div class="grid grid-cols-12 gap-4 items-center">
                                    <div class="col-span-1">
                                        <div class="flex items-center">
                                            <input 
                                                type="checkbox" 
                                                name="assets[]" 
                                                value="${asset.id}"
                                                class="w-4 h-4 text-primary-blue border-gray-300 rounded focus:ring-primary-blue focus:ring-2"
                                            >
                                        </div>
                                    </div>
                                    <div class="col-span-1 text-sm text-gray-600">
                                        ${index + 1}.
                                    </div>
                                    <div class="col-span-4 text-sm font-medium text-gray-900">
                                        ${asset.name}
                                    </div>
                                    <div class="col-span-3 text-sm text-gray-600">
                                        ${asset.code}
                                    </div>
                                    <div class="col-span-3">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${status.class}">
                                            ${status.text}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    
                    assetsList.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error loading assets:', error);
                    assetsList.innerHTML = `
                        <div class="px-6 py-8 text-center">
                            <p class="text-sm text-red-500">Gagal memuat aset. Silakan coba lagi.</p>
                        </div>
                    `;
                });
        }
        
        function getAssetStatus(assetName) {
            // Simple logic to determine asset status based on name
            if (assetName.toLowerCase().includes('cpu')) {
                return {
                    text: 'CPU Rakitan Bapak Amin',
                    class: 'bg-yellow-100 text-yellow-800'
                };
            } else if (assetName.toLowerCase().includes('printer')) {
                return {
                    text: 'Warna Hitam',
                    class: 'bg-gray-100 text-gray-800'
                };
            } else {
                return {
                    text: 'Normal',
                    class: 'bg-green-100 text-green-800'
                };
            }
        }
    </script>

</body>
</html>
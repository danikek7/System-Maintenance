<?php
session_start();

// Sample data - replace with your database queries
$aset_list = [
    [
        'id' => 1,
        'nama_aset' => 'Printer EPSON L3120',
        'tag_aset' => 'L3120',
        'model' => 'L3120',
        'kategori' => 'Printer',
        'produsen' => 'EPSON',
        'serial' => 'EP2024001',
        'lokasi' => 'Ruang ICU',
        'catatan' => 'Warna Hitam'
    ],
    [
        'id' => 2,
        'nama_aset' => 'Ventilator Medis',
        'tag_aset' => 'VM001',
        'model' => 'VM-2024',
        'kategori' => 'Alat Medis',
        'produsen' => 'Philips',
        'serial' => 'PH2024002',
        'lokasi' => 'Ruang ICU',
        'catatan' => 'Normal'
    ],
    [
        'id' => 3,
        'nama_aset' => 'Monitor Pasien',
        'tag_aset' => 'MP001',
        'model' => 'MP-Pro',
        'kategori' => 'Alat Medis',
        'produsen' => 'GE Healthcare',
        'serial' => 'GE2024003',
        'lokasi' => 'Ruang ICU',
        'catatan' => 'Normal'
    ],
    [
        'id' => 4,
        'nama_aset' => 'Mesin Anestesi',
        'tag_aset' => 'MA001',
        'model' => 'Anes-Pro',
        'kategori' => 'Alat Medis',
        'produsen' => 'Dräger',
        'serial' => 'DR2024004',
        'lokasi' => 'Ruang Operasi',
        'catatan' => 'Normal'
    ],
    [
        'id' => 5,
        'nama_aset' => 'Lampu Operasi',
        'tag_aset' => 'LO001',
        'model' => 'LED-500',
        'kategori' => 'Alat Medis',
        'produsen' => 'Trumpf',
        'serial' => 'TR2024005',
        'lokasi' => 'Ruang Operasi',
        'catatan' => 'Normal'
    ],
    [
        'id' => 6,
        'nama_aset' => 'Mikroskop Digital',
        'tag_aset' => 'MD001',
        'model' => 'DM-1000',
        'kategori' => 'Alat Lab',
        'produsen' => 'Olympus',
        'serial' => 'OL2024006',
        'lokasi' => 'Laboratorium',
        'catatan' => 'Normal'
    ],
    [
        'id' => 7,
        'nama_aset' => 'Centrifuge',
        'tag_aset' => 'CF001',
        'model' => 'CF-3000',
        'kategori' => 'Alat Lab',
        'produsen' => 'Hettich',
        'serial' => 'HT2024007',
        'lokasi' => 'Laboratorium',
        'catatan' => 'Normal'
    ],
    [
        'id' => 8,
        'nama_aset' => 'CT Scan',
        'tag_aset' => 'CT001',
        'model' => 'CT-128',
        'kategori' => 'Radiologi',
        'produsen' => 'Siemens',
        'serial' => 'SM2024008',
        'lokasi' => 'Radiologi',
        'catatan' => 'Normal'
    ],
    [
        'id' => 9,
        'nama_aset' => 'X-Ray Machine',
        'tag_aset' => 'XR001',
        'model' => 'XR-Pro',
        'kategori' => 'Radiologi',
        'produsen' => 'Canon',
        'serial' => 'CN2024009',
        'lokasi' => 'Radiologi',
        'catatan' => 'Normal'
    ],
    [
        'id' => 10,
        'nama_aset' => 'CPU Rakitan',
        'tag_aset' => '-',
        'model' => 'Custom Build',
        'kategori' => 'Komputer',
        'produsen' => 'Local Assembly',
        'serial' => 'LA2024010',
        'lokasi' => 'Farmasi',
        'catatan' => 'CPU Rakitan Bapak Amin'
    ],
    [
        'id' => 11,
        'nama_aset' => 'Printer Thermal',
        'tag_aset' => 'PT001',
        'model' => 'TH-200',
        'kategori' => 'Printer',
        'produsen' => 'Zebra',
        'serial' => 'ZB2024011',
        'lokasi' => 'Farmasi',
        'catatan' => 'Normal'
    ]
];

// Handle delete action (you can implement this)
if (isset($_POST['delete_id'])) {
    $delete_id = (int)$_POST['delete_id'];
    // Implement delete logic here
    $success_message = "Aset berhasil dihapus!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Aset - Maintenance System</title>
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
                    <img src="logo.png" alt="Logo" class="w-8 h-8 object-contain" />
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
                           class="flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:bg-opacity-10 text-white">
                            <span class="material-symbols-outlined">event_note</span>
                            <span>Jadwal</span>
                        </a>
                    </li>

                    <!-- Aset -->
                    <li>
                        <a href="#"
                           class="flex items-center gap-4 p-3 rounded-lg bg-white bg-opacity-20 text-white font-medium">
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
            <div class="sidebar-gradient text-white shadow w-sm border-b p-4 flex items-center justify-between">
                <!-- Search Bar -->
                <div class="flex-1 max-w-md">
                    <div class="relative">
                        <input 
                            type="text" 
                            placeholder="Search..."
                            class="w-full px-4 py-2 rounded-lg bg-white bg-opacity-20 text-white placeholder-blue-200 border border-white border-opacity-30 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50"
                        >
                        <span class="material-symbols-outlined absolute right-3 top-2 text-blue-200">search</span>
                    </div>
                </div>
                
                <!-- Admin Profile -->
                <div class="flex items-center space-x-4">
                    <span class="text-sm">Admin</span>
                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="flex-1 p-8 overflow-auto">
                <?php if (isset($success_message)): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        <?php echo htmlspecialchars($success_message); ?>
                    </div>
                <?php endif; ?>

                <div class="bg-white shadow rounded-lg">
                    <!-- Header -->
                    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                        <h2 class="text-xl font-bold text-gray-800">DAFTAR ASET</h2>
                        <a href="form_aset.php" class="bg-primary-blue hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg transition-colors duration-200 flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">add</span>
                            Tambah Aset
                        </a>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-primary-blue text-white">
                                <tr>
                                    <th class="px-4 py-3 text-left text-sm font-medium">No</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium">Nama Aset</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium">Tag Aset</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium">Model</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium">Kategori</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium">Produsen</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium">Serial</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium">Lokasi</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium">Catatan</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <?php foreach ($aset_list as $index => $aset): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-4 text-sm text-gray-900"><?php echo $index + 1; ?></td>
                                    <td class="px-4 py-4 text-sm font-medium text-gray-900"><?php echo htmlspecialchars($aset['nama_aset']); ?></td>
                                    <td class="px-4 py-4 text-sm text-gray-600"><?php echo htmlspecialchars($aset['tag_aset']); ?></td>
                                    <td class="px-4 py-4 text-sm text-gray-600"><?php echo htmlspecialchars($aset['model']); ?></td>
                                    <td class="px-4 py-4 text-sm text-gray-600"><?php echo htmlspecialchars($aset['kategori']); ?></td>
                                    <td class="px-4 py-4 text-sm text-gray-600"><?php echo htmlspecialchars($aset['produsen']); ?></td>
                                    <td class="px-4 py-4 text-sm text-gray-600"><?php echo htmlspecialchars($aset['serial']); ?></td>
                                    <td class="px-4 py-4 text-sm text-gray-600"><?php echo htmlspecialchars($aset['lokasi']); ?></td>
                                    <td class="px-4 py-4 text-sm text-gray-600">
                                        <?php 
                                        $catatan = $aset['catatan'];
                                        $catatan_class = '';
                                        if (strpos(strtolower($catatan), 'cpu rakitan') !== false) {
                                            $catatan_class = 'bg-yellow-100 text-yellow-800';
                                        } elseif (strpos(strtolower($catatan), 'hitam') !== false) {
                                            $catatan_class = 'bg-gray-100 text-gray-800';
                                        } else {
                                            $catatan_class = 'bg-green-100 text-green-800';
                                        }
                                        ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo $catatan_class; ?>">
                                            <?php echo htmlspecialchars($catatan); ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center space-x-1">
                                            <!-- View Button -->
                                            <button class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                                <span class="material-symbols-outlined text-sm">visibility</span>
                                            </button>
                                            
                                            <!-- Edit Button -->
                                            <button class="p-1.5 text-yellow-600 hover:bg-yellow-50 rounded-lg transition-colors" title="Edit">
                                                <span class="material-symbols-outlined text-sm">edit</span>
                                            </button>
                                            
                                            <!-- Delete Button -->
                                            <button onclick="confirmDelete(<?php echo $aset['id']; ?>, '<?php echo htmlspecialchars($aset['nama_aset']); ?>')" 
                                                    class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                                <span class="material-symbols-outlined text-sm">delete</span>
                                            </button>
                                            
                                            <!-- Copy Button -->
                                            <button class="p-1.5 text-gray-600 hover:bg-gray-50 rounded-lg transition-colors" title="Salin">
                                                <span class="material-symbols-outlined text-sm">content_copy</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Empty State (uncomment if no data) -->
                    <?php if (empty($aset_list)): ?>
                    <div class="text-center py-12">
                        <span class="material-symbols-outlined text-6xl text-gray-300 mb-4">inventory_2</span>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada aset</h3>
                        <p class="text-gray-500 mb-4">Mulai dengan menambahkan aset pertama Anda</p>
                        <a href="form_aset.php" class="bg-primary-blue hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg transition-colors duration-200 inline-flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">add</span>
                            Tambah Aset
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 max-w-md w-mx-auto mx-4">
            <div class="flex items-center mb-4">
                <span class="material-symbols-outlined text-red-600 text-2xl mr-3">warning</span>
                <h3 class="text-lg font-medium text-gray-900">Konfirmasi Hapus</h3>
            </div>
            <p class="text-gray-500 mb-6">Apakah Anda yakin ingin menghapus aset "<span id="deleteItemName" class="font-medium"></span>"? Tindakan ini tidak dapat dibatalkan.</p>
            <div class="flex justify-end space-x-3">
                <button onclick="closeDeleteModal()" class="px-4 py-2 text-gray-500 hover:text-gray-700 transition-colors">
                    Batal
                </button>
                <form method="POST" class="inline">
                    <input type="hidden" name="delete_id" id="deleteId" value="">
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id, name) {
            document.getElementById('deleteId').value = id;
            document.getElementById('deleteItemName').textContent = name;
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteModal').classList.add('flex');
        }
        
        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.getElementById('deleteModal').classList.remove('flex');
        }
        
        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });
    </script>

</body>
</html>
<?php
session_start();

// Sample data - replace with your database queries
$jadwal_list = [
    [
        'id' => 1,
        'nama_jadwal' => 'Maintenance Rutin ICU',
        'bulan' => '2025-01',
        'lokasi' => 'Ruang ICU',
        'status' => 'Aktif',
        'jumlah_aset' => 3,
        'tanggal_dibuat' => '2025-01-15'
    ],
    [
        'id' => 2,
        'nama_jadwal' => 'Pemeriksaan Operasi',
        'bulan' => '2025-01',
        'lokasi' => 'Ruang Operasi',
        'status' => 'Selesai',
        'jumlah_aset' => 2,
        'tanggal_dibuat' => '2025-01-10'
    ],
    [
        'id' => 3,
        'nama_jadwal' => 'Maintenance Lab',
        'bulan' => '2025-02',
        'lokasi' => 'Laboratorium',
        'status' => 'Aktif',
        'jumlah_aset' => 2,
        'tanggal_dibuat' => '2025-01-20'
    ],
    [
        'id' => 4,
        'nama_jadwal' => 'Pemeriksaan Radiologi',
        'bulan' => '2025-02',
        'lokasi' => 'Radiologi',
        'status' => 'Pending',
        'jumlah_aset' => 2,
        'tanggal_dibuat' => '2025-01-25'
    ],
    [
        'id' => 5,
        'nama_jadwal' => 'Maintenance Farmasi',
        'bulan' => '2025-02',
        'lokasi' => 'Farmasi',
        'status' => 'Aktif',
        'jumlah_aset' => 2,
        'tanggal_dibuat' => '2025-01-28'
    ]
];

// Handle delete action (you can implement this)
if (isset($_POST['delete_id'])) {
    $delete_id = (int)$_POST['delete_id'];
    // Implement delete logic here
    $success_message = "Jadwal berhasil dihapus!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Jadwal - Maintenance System</title>
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
                        <h2 class="text-xl font-bold text-gray-800">DAFTAR JADWAL</h2>
                        <a href="formjadwal.php" class="bg-primary-blue hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg transition-colors duration-200 flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">add</span>
                            Tambah Jadwal
                        </a>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-primary-blue text-white">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-medium">No</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium">Nama Jadwal</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium">Status</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <?php foreach ($jadwal_list as $index => $jadwal): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-900"><?php echo $index + 1; ?></td>
                                    <td class="px-6 py-4">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($jadwal['nama_jadwal']); ?></div>
                                            <div class="text-sm text-gray-500">
                                                <?php echo htmlspecialchars($jadwal['lokasi']); ?> • 
                                                <?php echo date('M Y', strtotime($jadwal['bulan'] . '-01')); ?> • 
                                                <?php echo $jadwal['jumlah_aset']; ?> aset
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php 
                                        $status_class = '';
                                        switch($jadwal['status']) {
                                            case 'Aktif':
                                                $status_class = 'bg-green-100 text-green-800';
                                                break;
                                            case 'Selesai':
                                                $status_class = 'bg-blue-100 text-blue-800';
                                                break;
                                            case 'Pending':
                                                $status_class = 'bg-yellow-100 text-yellow-800';
                                                break;
                                            default:
                                                $status_class = 'bg-gray-100 text-gray-800';
                                        }
                                        ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo $status_class; ?>">
                                            <?php echo htmlspecialchars($jadwal['status']); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-2">
                                            <!-- View Button -->
                                            <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                                <span class="material-symbols-outlined text-sm">visibility</span>
                                            </button>
                                            
                                            <!-- Edit Button -->
                                            <button class="p-2 text-yellow-600 hover:bg-yellow-50 rounded-lg transition-colors" title="Edit">
                                                <span class="material-symbols-outlined text-sm">edit</span>
                                            </button>
                                            
                                            <!-- Delete Button -->
                                            <button onclick="confirmDelete(<?php echo $jadwal['id']; ?>, '<?php echo htmlspecialchars($jadwal['nama_jadwal']); ?>')" 
                                                    class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                                <span class="material-symbols-outlined text-sm">delete</span>
                                            </button>
                                            
                                            <!-- Copy Button -->
                                            <button class="p-2 text-gray-600 hover:bg-gray-50 rounded-lg transition-colors" title="Salin">
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
                    <?php if (empty($jadwal_list)): ?>
                    <div class="text-center py-12">
                        <span class="material-symbols-outlined text-6xl text-gray-300 mb-4">event_note</span>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada jadwal</h3>
                        <p class="text-gray-500 mb-4">Mulai dengan membuat jadwal maintenance pertama Anda</p>
                        <a href="formjadwal.php" class="bg-primary-blue hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg transition-colors duration-200 inline-flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">add</span>
                            Tambah Jadwal
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
            <p class="text-gray-500 mb-6">Apakah Anda yakin ingin menghapus jadwal "<span id="deleteItemName" class="font-medium"></span>"? Tindakan ini tidak dapat dibatalkan.</p>
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
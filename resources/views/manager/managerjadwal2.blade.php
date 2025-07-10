<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>Maintenance System - Jadwal</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <style>
    .sidebar-gradient {
      background: linear-gradient(to bottom, #0057B8, #7DB9E8);
    }
    ::-webkit-scrollbar {
      width: 6px;
    }
    ::-webkit-scrollbar-thumb {
      background-color: rgba(255, 255, 255, 0.3);
      border-radius: 3px;
    }
  </style>
</head>
<body class="min-h-screen flex bg-white font-sans">

  <!-- Sidebar -->
  <aside class="w-64 sidebar-gradient text-white flex flex-col">
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
        <li>
          <a href="#" class="flex items-center gap-4 p-3 rounded-lg transition-colors hover:bg-white hover:bg-opacity-10 text-white">
            <span class="material-symbols-outlined">dashboard</span>
            <span>Dashboard</span>
          </a>
        </li>
      
        <li>
          <a href="#" class="flex items-center gap-4 p-3 rounded-lg bg-white bg-opacity-20 text-white font-medium">
            <span class="material-symbols-outlined">inventory_2</span>
            <span>Jadwal</span>
          </a>
        </li>
        
      </ul>
    </nav>
  </aside>

  <!-- Main content -->
  <div class="flex-1 flex flex-col">
    <!-- Top bar -->
    <header class="flex items-center justify-between bg-[#0057B8] px-6 py-4 text-white">
      <form class="flex-1 max-w-lg mx-auto relative">
        <input class="w-full rounded-full py-2 px-4 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-white"
               placeholder="Cari" type="search" />
        <button aria-label="Search" type="submit"
                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-200">
          <i class="fas fa-search"></i>
        </button>
      </form>
      <div class="flex items-center gap-2">
        <span class="font-semibold text-sm">Manager</span>
        <div class="w-8 h-8 rounded-full bg-[#C4B9F7] flex items-center justify-center text-[#5A4DB2]">
          <i class="fas fa-user"></i>
        </div>
      </div>
    </header>

    <!-- Content area -->
    <main class="flex-1 overflow-auto p-8">
      <h1 class="text-center font-semibold text-xl mb-8">JADWAL XXXXXXX</h1>
      <form class="max-w-5xl mx-auto mb-8 flex items-center gap-2 text-base">
        <label class="w-20" for="lokasi">Lokasi</label>
        <span>:</span>
        <select class="flex-1 rounded-md border border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-[#0057B8]" id="lokasi" name="lokasi">
          <option disabled selected value=""></option>
        </select>
      </form>
      <div class="max-w-5xl mx-auto overflow-x-auto">
        <table class="w-full border-collapse border border-[#0057B8] text-center text-sm">
          <thead>
            <tr class="bg-[#0057B8] text-white">
              <th class="border border-[#0057B8] px-3 py-2">No</th>
              <th class="border border-[#0057B8] px-3 py-2">Bulan</th>
              <th class="border border-[#0057B8] px-3 py-2">Aset</th>
              <th class="border border-[#0057B8] px-3 py-2">Lokasi</th>
              <th class="border border-[#0057B8] px-3 py-2">Status</th>
              <th class="border border-[#0057B8] px-3 py-2">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <!-- Repeat rows as needed -->
            <tr class="bg-[#add8e6]/60 h-12">
              <td class="border border-[#0057B8]"></td>
              <td class="border border-[#0057B8]"></td>
              <td class="border border-[#0057B8]"></td>
              <td class="border border-[#0057B8]"></td>
              <td class="border border-[#0057B8]"></td>
              <td class="border border-[#0057B8] text-[#0057B8] cursor-pointer"><i class="fas fa-eye"></i></td>
            </tr>
            <!-- Tambahkan baris lainnya sesuai kebutuhan -->
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>
</html>

<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Maintenance System Form Inspeksi
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
   /* Custom scrollbar for sidebar */
    ::-webkit-scrollbar {
      width: 6px;
    }
    ::-webkit-scrollbar-thumb {
      background-color: rgba(255, 255, 255, 0.3);
      border-radius: 3px;
    }
  </style>
 </head>
 <body class="flex min-h-screen font-sans">
  <!-- Sidebar -->
  <aside class="flex flex-col w-72 bg-gradient-to-b from-[#0D4DA1] to-[#7DB7E8] text-white select-none">
   <div class="flex items-center gap-3 px-6 py-6 border-b border-white/30">
    <img alt="Maintenance system icon with house and wrench" class="w-10 h-10" height="40" src="logo.png" width="40"/>
    <div class="font-semibold text-lg leading-tight">
     Maintenance
     <br/>
     System
    </div>
   </div>
   <hr class="border-white/50 mx-6"/>
   <nav class="flex flex-col mt-6 space-y-6 px-6 text-lg">
    <a class="flex items-center gap-3 hover:text-white transition-colors duration-200" href="#">
     <i class="fas fa-home text-xl">
     </i>
     Dashboard
    </a>
    <a class="flex items-center gap-3 hover:text-white transition-colors duration-200" href="#">
     <i class="fas fa-calendar-alt text-xl">
     </i>
     Jadwal
    </a>
   </nav>
  </aside>
  <!-- Main content -->
  <main class="flex-1 flex flex-col">
   <!-- Top bar -->
   <header class="flex items-center justify-between bg-[#0D4DA1] px-6 py-4 text-white">
    <div>
    </div>
    <div class="flex items-center gap-3">
     <span class="text-sm font-semibold">
      PIC Unit
     </span>
     <div aria-label="User profile icon" class="w-8 h-8 rounded-full bg-purple-300 flex items-center justify-center text-purple-700 text-lg">
      <i class="fas fa-user-circle">
      </i>
     </div>
    </div>
   </header>
   <!-- Form content -->
   <section class="flex-1 overflow-auto p-8 bg-white">
    <h2 class="text-center text-xl font-semibold mb-10">
     FORM INSPEKSI
    </h2>
    <form class="max-w-5xl mx-auto space-y-6">
     <div class="flex items-center gap-4 max-w-full">
      <label class="w-36 text-right" for="tanggal">
       Dibuat tanggal
      </label>
      <span>
       :
      </span>
      <input class="flex-1 border border-gray-300 rounded px-4 py-2" id="tanggal" type="text"/>
     </div>
     <div class="flex items-center gap-4 max-w-full">
      <label class="w-36 text-right" for="unit">
       Unit
      </label>
      <span>
       :
      </span>
      <input class="flex-1 border border-gray-300 rounded px-4 py-2" id="unit" type="text" value="xxxxxx"/>
     </div>
     <div class="flex items-center gap-4 max-w-full">
      <label class="w-36 text-right" for="type-scanner">
       Type scanner
      </label>
      <span>
       :
      </span>
      <input class="flex-1 border border-gray-300 rounded px-4 py-2" id="type-scanner" type="text" value="xxxxxx"/>
     </div>
    <div class="overflow-x-auto mt-8">
  <table class="w-full border border-black border-collapse rounded-md overflow-hidden">
    <thead>
      <tr class="bg-[#4299E1] text-center text-sm">
        <th class="border border-black w-12 py-3 align-middle" rowspan="2">NO</th>
        <th class="border border-black w-72 py-3 align-middle" rowspan="2">Jenis Pemeliharaan</th>
        <th class="border border-black py-3" colspan="2">Jenis Pemeliharaan</th>
        <th class="border border-black w-72 py-3 align-middle" rowspan="2">Catatan</th>
      </tr>
      <tr class="bg-[#4299E1] text-center text-sm">
        <th class="border border-black py-2 px-4">Baik</th>
        <th class="border border-black py-2 px-4">Buruk</th>
      </tr>
    </thead>
    <tbody class="text-sm">
      <tr>
        <td class="border border-black text-center py-3 px-2">1</td>
        <td class="border border-black py-3 px-4">Mengecek roll karet</td>
        <td class="border border-black text-center py-3 px-4">
          <input type="radio" name="pemeliharaan1" value="baik" aria-label="Baik untuk item 1" checked />
        </td>
        <td class="border border-black text-center py-3 px-4">
          <input type="radio" name="pemeliharaan1" value="buruk" aria-label="Buruk untuk item 1" />
        </td>
        <td class="border border-black py-3 px-4 text-center"></td>
      </tr>
      <tr>
        <td class="border border-black text-center py-3 px-2">2</td>
        <td class="border border-black py-3 px-4">
          penarik kertas<br />Cek hasil scanner
        </td>
        <td class="border border-black text-center py-3 px-4">
          <input type="radio" name="pemeliharaan2" value="baik" aria-label="Baik untuk item 2" />
        </td>
        <td class="border border-black text-center py-3 px-4">
          <input type="radio" name="pemeliharaan2" value="buruk" aria-label="Buruk untuk item 2" checked />
        </td>
        <td class="border border-black py-3 px-4 text-center">sudah jelek harus diganti</td>
      </tr>
    </tbody>
    </table>
    </div>
     <div class="flex justify-end mt-8">
      <button class="bg-purple-600 hover:bg-purple-700 text-black rounded-full px-8 py-2 w-40" type="button">
       Approve
      </button>
     </div>
    </form>
   </section>
  </main>
 </body>
</html>
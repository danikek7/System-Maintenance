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
   @import url("https://fonts.googleapis.com/css2?family=Poppins&display=swap");
    body {
      font-family: "Poppins", sans-serif;
    }
  </style>
 </head>
 <body class="flex min-h-screen bg-white">
  <!-- Sidebar -->
  <aside class="flex flex-col w-72 bg-gradient-to-b from-[#0052CC] to-[#7DB9E8] text-white">
   <div class="flex items-center gap-3 px-6 py-6">
    <img alt="White icon of a house with wrench and screwdriver around it" class="w-10 h-10" height="40" src="logo.png" width="40"/>
    <div class="font-semibold text-lg leading-tight">
     Maintenance
     <br/>
     System
    </div>
   </div>
   <hr class="border-white/50 mx-6"/>
   <nav class="mt-6 flex flex-col gap-6 px-6 text-white text-base font-normal">
    <a class="flex items-center gap-3 hover:text-white/80 transition-colors" href="#">
     <i class="fas fa-home text-lg">
     </i>
     Dashboard
    </a>
    <a class="flex items-center gap-3 hover:text-white/80 transition-colors" href="#">
     <i class="fas fa-calendar-alt text-lg">
     </i>
     Jadwal
    </a>
   </nav>
  </aside>
  <!-- Main content -->
  <main class="flex-1 flex flex-col">
   <!-- Header -->
   <header class="bg-[#0052CC] flex justify-end items-center gap-4 px-6 py-4 text-white text-sm font-semibold">
    <span>
     Manager
    </span>
    <div aria-label="User profile icon" class="w-8 h-8 rounded-full bg-[#C4B9F5] flex justify-center items-center text-[#4B3B94]">
     <i class="fas fa-user-circle text-2xl">
     </i>
    </div>
   </header>
   <!-- Form content -->
   <section class="flex-1 overflow-auto p-8">
    <h2 class="text-center text-xl font-semibold mb-10">
     FORM INSPEKSI
    </h2>
    <form class="max-w-5xl mx-auto space-y-6">
     <div class="flex items-center gap-4 max-w-full">
      <label class="w-40 text-right" for="tanggal">
       Dibuat tanggal
      </label>
      <span>
       :
      </span>
      <input class="flex-1 border border-gray-300 rounded px-4 py-2" id="tanggal" type="text"/>
     </div>
     <div class="flex items-center gap-4 max-w-full">
      <label class="w-40 text-right" for="unit">
       Unit
      </label>
      <span>
       :
      </span>
      <input class="flex-1 border border-gray-300 rounded px-4 py-2" id="unit" type="text" value="xxxxxx"/>
     </div>
     <div class="flex items-center gap-4 max-w-full">
      <label class="w-40 text-right" for="scanner">
       Type scanner
      </label>
      <span>
       :
      </span>
      <input class="flex-1 border border-gray-300 rounded px-4 py-2" id="scanner" type="text" value="xxxxxx"/>
     </div>
     <!-- Table -->
     <div class="overflow-x-auto">
      <table class="w-full border border-black border-collapse text-sm" style="border-radius: 0.375rem; overflow: hidden">
 <thead>
  <tr class="bg-[#4A90E2] text-black text-center">
    <th class="border border-black w-12 py-3" rowspan="2">NO</th>
    <th class="border border-black w-[320px] py-3 px-4" rowspan="2">Jenis Pemeliharaan</th>
    <th class="border border-black w-24 py-3" colspan="2">Jenis Pemeliharaan</th>
    <th class="border border-black w-48 py-3" rowspan="2">Catatan</th>
  </tr>
  <tr class="bg-[#4A90E2] text-black text-center">
    <th class="border border-black w-12 py-2">Baik</th>
    <th class="border border-black w-12 py-2">Buruk</th>
  </tr>
</thead>


<tbody>
 <tr>
  <td class="border border-black text-center align-top py-2">1</td>
  <td class="border border-black px-4 py-2 align-top">Mengecek roll karet penarik kertas</td>
  <td class="border border-black text-center align-top py-2">
   <input type="radio" name="check1" aria-label="Baik 1">
  </td>
  <td class="border border-black text-center align-top py-2">
   <input type="radio" name="check1" aria-label="Buruk 1">
  </td>
  <td class="border border-black text-center align-top py-2"></td>
 </tr>
 <tr>
  <td class="border border-black text-center align-top py-2">2</td>
  <td class="border border-black px-4 py-2 align-top">Cek hasil scanner</td>
  <td class="border border-black text-center align-top py-2">
   <input type="radio" name="check2" aria-label="Baik 2">
  </td>
  <td class="border border-black text-center align-top py-2">
   <input type="radio" name="check2" aria-label="Buruk 2" checked>
  </td>
  <td class="border border-black text-center align-top py-2">Sudah jelek harus diganti</td>
 </tr>
</tbody>

      </table>
     </div>
     <!-- Buttons -->
     <div class="flex justify-end gap-6 mt-8 max-w-5xl mx-auto">
      <button class="bg-[#6B63E6] text-black rounded-full px-8 py-2" type="button">
       Kembalikan
      </button>
      <button class="bg-[#6B63E6] text-black rounded-full px-8 py-2" type="submit">
       Approve
      </button>
     </div>
    </form>
   </section>
  </main>
 </body>
</html>
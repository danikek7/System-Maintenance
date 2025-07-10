<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Maintenance System - Daftar Jadwal
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
 </head>
 <body class="flex min-h-screen bg-white">
  <!-- Sidebar -->
  <aside class="flex flex-col w-56 bg-gradient-to-b from-[#0057B8] to-[#7DB9E8] text-white">
   <div class="flex items-center gap-3 px-6 py-6">
    <img alt="White icon of a house with wrench and screwdriver crossed behind it, representing maintenance" class="w-8 h-8" height="32" src="https://storage.googleapis.com/a1aa/image/e68315d2-ff80-4fef-0d23-dfda24a1bb6c.jpg" width="32"/>
    <div class="font-semibold text-base leading-tight">
     Maintenance
     <br/>
     System
    </div>
   </div>
   <hr class="border-white/50 mx-6"/>
   <nav class="mt-6 flex flex-col gap-6 px-6 text-white text-sm font-normal">
    <a class="flex items-center gap-3 hover:text-white/80 transition-colors duration-200" href="#">
     <i class="fas fa-home text-lg">
     </i>
     Dashboard
    </a>
    <a class="flex items-center gap-3 hover:text-white/80 transition-colors duration-200" href="#">
     <i class="far fa-calendar-alt text-lg">
     </i>
     Jadwal
    </a>
   </nav>
  </aside>
  <!-- Main content -->
  <main class="flex-1">
   <!-- Top bar -->
   <header class="flex items-center justify-between bg-[#0057B8] px-6 py-3 text-white fixed top-0 left-56 right-0 z-10">
    <div class="flex-1 max-w-lg mx-auto">
     <div class="relative">
      <input class="w-full rounded-full py-2 px-4 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-white" placeholder="Cari" type="search"/>
      <i class="fas fa-search absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
      </i>
     </div>
    </div>
    <div class="flex items-center gap-3">
     <span class="text-sm font-semibold">
      Manager
     </span>
     <div class="w-8 h-8 rounded-full bg-purple-200 border border-purple-400 flex items-center justify-center text-purple-700">
      <i class="fas fa-user">
      </i>
     </div>
    </div>
   </header>
   <!-- Content -->
   <section class="mt-20 max-w-5xl px-8">
    <h1 class="text-black text-xl font-semibold tracking-wide mb-6">
     DAFTAR JADWAL
    </h1>
    <table class="w-full border-collapse rounded-md overflow-hidden">
     <thead>
      <tr class="bg-[#0057B8] text-white text-sm font-normal">
       <th class="py-3 px-4 border-r border-blue-700 text-left w-14">
        No
       </th>
       <th class="py-3 px-4 border-r border-blue-700 text-left">
        Nama Jadwal
       </th>
       <th class="py-3 px-4 border-r border-blue-700 text-left w-32">
        Status
       </th>
       <th class="py-3 px-4 text-left w-24">
        Aksi
       </th>
      </tr>
     </thead>
     <tbody>
      <tr>
       <td colspan="4" class="border-b border-blue-300">
        <div class="flex justify-end gap-6 pr-6 text-[#0057B8] text-lg py-2">
         <i class="fas fa-eye cursor-pointer">
         </i>
         <i class="fas fa-check-square cursor-pointer">
         </i>
        </div>
       </td>
      </tr>
     </tbody>
    </table>
   </section>
  </main>
 </body>
</html>
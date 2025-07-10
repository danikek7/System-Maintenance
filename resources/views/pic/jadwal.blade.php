<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>Maintenance System</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body class="bg-white">
<div class="flex min-h-screen">
  <!-- Sidebar -->
  @include('components.sidebar')

  <!-- Main content -->
  <main class="flex-1 flex flex-col">
    <!-- Top bar -->
    <header class="flex items-center justify-between bg-[#0057B8] px-6 py-4">
      <form class="flex items-center w-full max-w-md mx-auto">
        <input class="w-full rounded-full py-2 px-4 text-gray-700 placeholder-gray-400 focus:outline-none" placeholder="Cari" type="text"/>
        <button class="ml-2 text-gray-400 hover:text-gray-200" type="submit">
          <i class="fas fa-search"></i>
        </button>
      </form>
      <div class="flex items-center space-x-3 ml-auto text-white text-sm font-semibold">
        <span>{{ auth()->user()->name ?? 'PIC UNIT' }}</span>
        <div class="w-8 h-8 rounded-full bg-purple-300 flex items-center justify-center">
          <i class="far fa-user text-purple-700"></i>
        </div>
      </div>
    </header>

    <!-- Content -->
    <section class="flex-1 p-10">
      <h1 class="text-center text-black text-xl font-semibold mb-10 tracking-wide">
        JADWAL MAINTENANCE
      </h1>
      <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-[#0057B8] text-center">
          <thead>
          <tr class="bg-[#0057B8] text-white">
            <th class="py-3 px-4 border border-[#0057B8]">No</th>
            <th class="py-3 px-4 border border-[#0057B8]">Bulan</th>
            <th class="py-3 px-4 border border-[#0057B8]">Aset</th>
            <th class="py-3 px-4 border border-[#0057B8]">Lokasi</th>
            <th class="py-3 px-4 border border-[#0057B8] w-32">Status</th>
            <th class="py-3 px-4 border border-[#0057B8] w-32">Aksi</th>
          </tr>
          </thead>
          <tbody>
          @forelse ($jadwal as $item)
            <tr class="h-12">
              <td class="border border-[#0057B8] bg-white">{{ $loop->iteration }}</td>
              <td class="border border-[#0057B8] bg-white">
                {{ \Carbon\Carbon::parse($item->schedule_date)->translatedFormat('F Y') }}
              </td>
              <td class="border border-[#0057B8] bg-white">{{ $item->asset->name ?? '-' }}</td>
              <td class="border border-[#0057B8] text-left px-4 bg-white">{{ $item->location->lokasi ?? '-' }}</td>
              <td class="border border-[#0057B8] text-center bg-white">{{ $item->statusLabel->name ?? '-' }}</td>
              <td class="border border-[#0057B8] bg-white">
                <div class="flex justify-center items-center gap-2 text-[#0057B8] text-lg">
                  <a href="{{ route('pic.jadwal.detail', $item->id) }}"><i class="far fa-eye cursor-pointer"></i></a>
                  <a href="{{ route('pic.jadwal.approve', $item->id) }}"><i class="fas fa-check-square cursor-pointer"></i></a>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="py-4 text-gray-500">Belum ada jadwal maintenance.</td>
            </tr>
          @endforelse
          </tbody>
        </table>
      </div>
    </section>
  </main>
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>Form Laporan Maintenance</title>
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
      <h1 class="text-white font-semibold text-lg">Form Laporan Maintenance</h1>
      <div class="flex items-center space-x-3 ml-auto text-white text-sm font-semibold">
        <span>{{ auth()->user()->name ?? 'PIC UNIT' }}</span>
        <div class="w-8 h-8 rounded-full bg-purple-300 flex items-center justify-center">
          <i class="far fa-user text-purple-700"></i>
        </div>
      </div>
    </header>

    <!-- Content -->
    <section class="flex-1 p-10">
      <form method="POST" action="{{ route('pic.laporan.store', $jadwal->id) }}">
        @csrf

        <div class="mb-4">
          <label class="block text-gray-700 font-semibold mb-2">Tanggal Laporan</label>
          <input type="date" name="report_date" class="w-full border border-gray-300 rounded px-4 py-2" required>
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 font-semibold mb-2">Catatan</label>
          <textarea name="notes" class="w-full border border-gray-300 rounded px-4 py-2" rows="4"></textarea>
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 font-semibold mb-2">Status</label>
          <select name="status" class="w-full border border-gray-300 rounded px-4 py-2">
            <option value="">Pilih status</option>
            @foreach($statuses as $status)
              <option value="{{ $status->id }}">{{ $status->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="text-right">
          <button type="submit" class="bg-[#0057B8] hover:bg-blue-700 text-white px-6 py-2 rounded-full">
            Simpan Laporan
          </button>
        </div>
      </form>
    </section>
  </main>
</div>
</body>
</html>

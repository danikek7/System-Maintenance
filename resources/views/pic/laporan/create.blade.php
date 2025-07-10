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
    input[readonly], select[disabled] {
      background-color: #f3f3f3;
      color: #555;
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
      <form>
        <div class="mb-6">
          <label class="block text-gray-700 font-semibold mb-2">Tanggal Laporan</label>
          <input type="date" class="w-full border border-gray-300 rounded px-4 py-2" value="{{ $laporan->report_date ?? '' }}" readonly>
        </div>

        <div class="mb-6">
          <label class="block text-gray-700 font-semibold mb-2">Unit</label>
          <input type="text" class="w-full border border-gray-300 rounded px-4 py-2" value="{{ $jadwal->asset->name ?? '' }}" readonly>
        </div>

        <div class="mb-6">
          <label class="block text-gray-700 font-semibold mb-2">Type Scanner</label>
          <input type="text" class="w-full border border-gray-300 rounded px-4 py-2" value="{{ $jadwal->asset->model->name ?? '' }}" readonly>
        </div>

        <div class="overflow-x-auto mt-8">
          <table class="w-full border border-black border-collapse rounded-md overflow-hidden">
            <thead>
              <tr class="bg-[#4299E1] text-center text-sm">
                <th class="border border-black w-12 py-3" rowspan="2">NO</th>
                <th class="border border-black w-72 py-3" rowspan="2">Jenis Pemeliharaan</th>
                <th class="border border-black py-3" colspan="2">Kondisi</th>
                <th class="border border-black w-72 py-3" rowspan="2">Catatan</th>
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
                  <input type="radio" name="pemeliharaan1" value="baik" {{ $laporan->parameter1 == 'baik' ? 'checked' : '' }} disabled />
                </td>
                <td class="border border-black text-center py-3 px-4">
                  <input type="radio" name="pemeliharaan1" value="buruk" {{ $laporan->parameter1 == 'buruk' ? 'checked' : '' }} disabled />
                </td>
                <td class="border border-black py-3 px-4 text-center">
                  <input type="text" name="catatan1" class="w-full px-2 py-1 border border-gray-300 rounded" value="{{ $laporan->catatan1 ?? '' }}" readonly>
                </td>
              </tr>
              <tr>
                <td class="border border-black text-center py-3 px-2">2</td>
                <td class="border border-black py-3 px-4">Penarik kertas / Cek hasil scanner</td>
                <td class="border border-black text-center py-3 px-4">
                  <input type="radio" name="pemeliharaan2" value="baik" {{ $laporan->parameter2 == 'baik' ? 'checked' : '' }} disabled />
                </td>
                <td class="border border-black text-center py-3 px-4">
                  <input type="radio" name="pemeliharaan2" value="buruk" {{ $laporan->parameter2 == 'buruk' ? 'checked' : '' }} disabled />
                </td>
                <td class="border border-black py-3 px-4 text-center">
                  <input type="text" name="catatan2" class="w-full px-2 py-1 border border-gray-300 rounded" value="{{ $laporan->catatan2 ?? '' }}" readonly>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="mt-8">
          <label class="block text-gray-700 font-semibold mb-2">Status</label>
          <input type="text" class="w-full border border-gray-300 rounded px-4 py-2" value="{{ $laporan->statusLabel->name ?? '' }}" readonly>
        </div>

        <div class="flex justify-end mt-8 space-x-4">
          <a href="{{ route('pic.jadwal.approve', $jadwal->id) }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-full">Approve</a>
          <a href="{{ route('pic.jadwal') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-full">Kembali</a>
        </div>
      </form>
    </section>
  </main>
</div>
</body>
</html>

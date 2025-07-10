<aside class="flex flex-col bg-gradient-to-b from-[#0057B8] to-[#8FC9F0] w-64 p-6 text-white">
  <div class="flex items-center mb-8">
    <img src="{{ asset('logo.png') }}" alt="Logo" class="w-10 h-10 mr-3">
    <div class="font-semibold text-lg leading-tight">
      <div>Maintenance</div>
      <div>System</div>
    </div>
  </div>
  <hr class="border-white border-opacity-50 mb-8">
  <nav class="flex flex-col space-y-6 text-lg">
    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 hover:underline">
      <i class="fas fa-home text-white text-xl"></i>
      <span>Dashboard</span>
    </a>
    <a href="{{ route('pic.jadwal') }}" class="flex items-center space-x-3 hover:underline">
      <i class="far fa-calendar-alt text-white text-xl"></i>
      <span>Jadwal</span>
    </a>
  </nav>
</aside>

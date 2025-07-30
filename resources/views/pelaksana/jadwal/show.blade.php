<div class="p-8">
    <h1 class="text-2xl font-bold mb-4">Detail Jadwal</h1>

    <div class="bg-white p-6 rounded shadow">
        <p><strong>Nama Jadwal:</strong> {{ $jadwal->nama_jadwal }}</p>
        <p><strong>Lokasi:</strong> {{ $jadwal->location?->nama ?? '-' }}</p>
        <p><strong>Bulan Maintenance:</strong> {{ \Carbon\Carbon::parse($jadwal->bulan_maintenance)->translatedFormat('F Y') }}</p>
        <p><strong>Jumlah Aset:</strong> {{ $jadwal->assets?->count() ?? 0 }}</p>
        <p><strong>Status:</strong> {{ $jadwal->statusLabel?->nama ?? 'Tidak diketahui' }}</p>
    </div>
</div>
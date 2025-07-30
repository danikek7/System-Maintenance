@if(session('success_message'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success_message') }}
    </div>
@endif


<div class="container">
    <h2>Edit Jadwal Maintenance</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pelaksana.jadwal.update', $jadwal->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_jadwal">Nama Jadwal</label>
            <input type="text" name="nama_jadwal" class="form-control" id="nama_jadwal"
                   value="{{ old('nama_jadwal', $jadwal->nama_jadwal) }}" required>
        </div>

        <div class="form-group">
            <label for="bulan_maintenance">Bulan Maintenance</label>
            <input type="month" name="bulan_maintenance" class="form-control" id="bulan_maintenance"
                   value="{{ old('bulan_maintenance', \Carbon\Carbon::parse($jadwal->bulan_maintenance)->format('Y-m')) }}"
                   required>
        </div>

        <div class="form-group">
            <label for="location_id">Lokasi</label>
            <select name="location_id" id="location_id" class="form-control" required>
                <option value="">-- Pilih Lokasi --</option>
                @foreach ($locations as $location)
                    <option value="{{ $location->id }}"
                        {{ $jadwal->location_id == $location->id ? 'selected' : '' }}>
                        {{ $location->lokasi }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('pelaksana.daftarjadwal') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>


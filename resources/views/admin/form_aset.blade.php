{{-- resources/views/admin/form_aset.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tambah Aset - Maintenance System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>

<body class="bg-gray-50 min-h-screen">
    <div class="max-w-3xl mx-auto p-6 bg-white rounded shadow mt-10">
        <h2 class="text-2xl font-bold mb-6">Tambah Aset</h2>

        {{-- Tampilkan error validasi --}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.aset.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block font-semibold mb-1">Nama Aset</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                    required />
            </div>

            <div class="mb-4">
                <label for="asset_tag" class="block font-semibold mb-1">Tag Aset</label>
                <input type="text" name="asset_tag" id="asset_tag" value="{{ old('asset_tag') }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                    required />
            </div>

            <div class="mb-4">
                <label for="model_id" class="block font-semibold mb-1">Model</label>
                <select name="model_id" id="model_id"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <option value="">-- Pilih Model --</option>
                    @foreach ($models as $model)
                        <option value="{{ $model->id }}" {{ old('model_id') == $model->id ? 'selected' : '' }}>
                            {{ $model->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="kategori_id" class="block font-semibold mb-1">Kategori</label>
                <select name="kategori_id" id="kategori_id"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('kategori_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="produsen_id" class="block font-semibold mb-1">Produsen</label>
                <select name="produsen_id" id="produsen_id"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <option value="">-- Pilih Produsen --</option>
                    @foreach ($manufactures as $manufacture)
                        <option value="{{ $manufacture->id }}" {{ old('produsen_id') == $manufacture->id ? 'selected' : '' }}>
                            {{ $manufacture->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="serial" class="block font-semibold mb-1">Serial</label>
                <input type="text" name="serial" id="serial" value="{{ old('serial') }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600" />
            </div>

            <div class="mb-4">
                <label for="location_id" class="block font-semibold mb-1">Lokasi</label>
                <select name="location_id" id="location_id"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <option value="">-- Pilih Lokasi --</option>
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
                            {{ $location->name ?? ($location->lokasi ?? 'Lokasi ' . $location->id) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="notes" class="block font-semibold mb-1">Catatan</label>
                <textarea name="notes" id="notes" rows="3"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">{{ old('notes') }}</textarea>
            </div>

            <div class="flex space-x-4">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Simpan</button>
                <a href="{{ route('admin.aset.index') }}"
                    class="px-6 py-2 rounded border border-gray-400 hover:bg-gray-100 transition">Batal</a>
            </div>
        </form>
    </div>
</body>

</html>

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Asset;
use App\Models\Location;
use App\Models\DetailJadwal;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $jadwals = Jadwal::with('createdBy')
            ->orderBy('create_at', 'desc')
            ->paginate(10);

        return view('admin.jadwal', compact('jadwals'));
    }

    public function create(Request $request)
    {
        $locations = Location::all();
        $assets = collect();

        if ($request->has('lokasi') && $request->lokasi) {
            $assets = Asset::where('location_id', $request->lokasi)->get();
        }

        return view('admin.form_jadwal', compact('locations', 'assets'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bulan'   => 'required|date_format:Y-m',
            'nama'    => 'required|string|max:255',
            'lokasi'  => 'required|array',
            'lokasi.*' => 'integer|exists:locations,id',
            'aset'    => 'required|array',
            'aset.*'  => 'array',
            'aset.*.*' => 'integer|exists:assets,id',
        ]);

        $userId = Auth::id();
        if (!$userId) {
            return redirect()->route('login')->withErrors('User tidak valid, silakan login ulang.');
        }

        $jadwal = Jadwal::create([
            'bulan'      => $validated['bulan'],
            'nama'       => $validated['nama'],
            'status_jadwal' => 0, // default = pending
            'create_by'  => 1,
            'create_at'  => now(),
        ]);

        // Simpan detail jadwal untuk tiap lokasi dan asetnya
        foreach ($validated['lokasi'] as $lokasiId) {
            $asetIds = $validated['aset'][$lokasiId] ?? [];

            foreach ($asetIds as $asetId) {
                DetailJadwal::create([
                    'jadwal_id'     => $jadwal->id,
                    'asset_id'      => $asetId,
                    'nama_asset'    => Asset::find($asetId)?->name ?? null,
                    'location_id'   => $lokasiId,
                    'nama_location' => Location::find($lokasiId)?->lokasi ?? null,
                    'inspeksi_at'   => now(),
                ]);
            }
        }

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil disimpan dan menunggu persetujuan.');
    }

    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $locations = Location::all();

        $firstDetail = $jadwal->details()->first();
        $selectedLocationId = $firstDetail?->location_id;

        $assets = $selectedLocationId
            ? Asset::where('location_id', $selectedLocationId)->get()
            : collect();

        $jadwalAssets = $jadwal->details()->pluck('asset_id')->toArray();

        return view('admin.edit_jadwal', compact('jadwal', 'locations', 'assets', 'selectedLocationId', 'jadwalAssets'));
    }

    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);
        // dd($request->all());
        $validated = $request->validate([
            'bulan'         => 'required|date_format:Y-m',
            'nama'          => 'required|string|max:255',
            'lokasi'        => 'required|array',
            'lokasi.*'      => 'integer|exists:locations,id',
            'aset'          => 'required|array',
            // 'aset.*'        => 'array',
            'aset.*'      => 'integer|exists:assets,id',
            // 'status_jadwal' => 'required|integer',
        ]);

        $userId = Auth::id();
        if (!$userId) {
            return redirect()->route('login')->withErrors('User tidak valid, silakan login ulang.');
        }

        $jadwal->update([
            'bulan'          => $validated['bulan'],
            'nama'           => $validated['nama'],
            // 'status_jadwal'  => $validated['status_jadwal'],
            'update_by'      => 1,
            'update_at'      => now(),
        ]);

        // Hapus dulu detail lama
        DetailJadwal::where('jadwal_id', $jadwal->id)->delete();

        // Simpan detail baru
        foreach ($validated['lokasi'] as $lokasiId) {
            foreach ($validated['aset'] as $asetId) {
                DetailJadwal::create([
                    'jadwal_id'     => $jadwal->id,
                    'asset_id'      => $asetId,
                    'nama_asset'    => Asset::find($asetId)?->name ?? null,
                    'location_id'   => $lokasiId,
                    'nama_location' => Location::find($lokasiId)?->lokasi ?? null,
                    'inspeksi_at'   => now(),
                ]);
            }
        }

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }

    public function getAssets($lokasi_id)
    {
        $assets = Asset::where('location_id', $lokasi_id)->get();
        return response()->json($assets);
    }

    public function approve($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update([
            'status_inspeksi'     => 2, // Selesai
            'approve_at' => now(),
        ]);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diaktifkan.');
    }
    // Fungsi untuk admin mengajukan jadwal (ubah status 0 ke 1)
    public function ajukan($id)
    {
        $jadwal = Jadwal::findOrFail($id);

        if ($jadwal->status_jadwal !== 0) {
            return redirect()->route('admin.jadwal.index')
                ->withErrors('Jadwal hanya dapat diajukan jika statusnya Draf (0).');
        }

        $jadwal->status_jadwal = 1; // Submit
        $jadwal->update_at = now();
        $jadwal->save();

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diajukan untuk persetujuan manager.');
    }


    public function ubahStatus(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $request->validate([
            'status_jadwal' => 'required|integer|between:0,4'
        ]);

        $jadwal->status_jadwal = $request->status_jadwal;
        $jadwal->update_at = now();
        $jadwal->save();

        return redirect()->route('admin.jadwal.index')->with('success', 'Status jadwal berhasil diperbarui.');
    }
}

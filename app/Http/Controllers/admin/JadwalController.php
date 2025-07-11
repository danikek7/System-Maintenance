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
        $jadwals = Jadwal::orderBy('create_at', 'desc')->paginate(10);
        return view('admin.jadwal', compact('jadwals'));
    }

    public function create(Request $request)
    {
        $locations = Location::all();

        $assets = collect(); // default kosong

        if ($request->has('lokasi') && $request->lokasi) {
            $assets = Asset::where('location_id', $request->lokasi)->get();
        }

        return view('admin.form_jadwal', compact('locations', 'assets'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bulan'  => 'required|date_format:Y-m',
            'nama'   => 'required|string|max:255',
            'lokasi' => 'required|integer|exists:locations,id',
            'aset'   => 'nullable|array',
            'aset.*' => 'integer|exists:assets,id',
        ]);

        $userId = Auth::id();
        if (!$userId) {
            return redirect()->route('login')->withErrors('User tidak valid, silakan login ulang.');
        }

        // Simpan ke jadwals (tanpa kolom lokasi & assets)
        $jadwal = Jadwal::create([
            'bulan'     => $validated['bulan'],
            'nama'      => $validated['nama'],
            'status'    => 1,
            'create_by' => $userId,
            'create_at' => now(),
        ]);

        // Simpan detail_jadwals: satu record per aset
        $asetIds = $validated['aset'] ?? [];
        foreach ($asetIds as $asetId) {
            DetailJadwal::create([
                'jadwal_id'    => $jadwal->id,
                'asset_id'     => $asetId,
                'nama_asset'   => Asset::find($asetId)?->nama ?? null,
                'location_id'  => $validated['lokasi'],
                'nama_location'=> Location::find($validated['lokasi'])?->nama ?? null,
                'inspeksi_at'  => now(),
            ]);
        }

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil disimpan.');
    }

    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $locations = Location::all();

        // Ambil lokasi dari detail_jadwals (asumsi satu lokasi)
        $firstDetail = $jadwal->details()->first();
        $selectedLocationId = $firstDetail ? $firstDetail->location_id : null;

        // Ambil aset sesuai lokasi yang dipilih (default ke lokasi dari detail)
        $assets = $selectedLocationId ? Asset::where('location_id', $selectedLocationId)->get() : collect();

        // Ambil daftar aset yang terkait di detail_jadwals
        $jadwalAssets = $jadwal->details()->pluck('asset_id')->toArray();

        return view('admin.edit_jadwal', compact('jadwal', 'locations', 'assets', 'selectedLocationId', 'jadwalAssets'));
    }

    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $validated = $request->validate([
            'bulan'  => 'required|date_format:Y-m',
            'nama'   => 'required|string|max:255',
            'lokasi' => 'required|integer|exists:locations,id',
            'aset'   => 'nullable|array',
            'aset.*' => 'integer|exists:assets,id',
            'status' => 'required|integer',
        ]);

        $userId = Auth::id();
        if (!$userId) {
            return redirect()->route('login')->withErrors('User tidak valid, silakan login ulang.');
        }

        // Update jadwals (tanpa kolom lokasi & assets)
        $jadwal->update([
            'bulan'     => $validated['bulan'],
            'nama'      => $validated['nama'],
            'status'    => $validated['status'],
            'update_by' => $userId,
            'update_at' => now(),
        ]);

        // Hapus dulu detail lama
        DetailJadwal::where('jadwal_id', $jadwal->id)->delete();

        // Simpan detail baru
        $asetIds = $validated['aset'] ?? [];
        foreach ($asetIds as $asetId) {
            DetailJadwal::create([
                'jadwal_id'    => $jadwal->id,
                'asset_id'     => $asetId,
                'nama_asset'   => Asset::find($asetId)?->nama ?? null,
                'location_id'  => $validated['lokasi'],
                'nama_location'=> Location::find($validated['lokasi'])?->nama ?? null,
                'inspeksi_at'  => now(),
            ]);
        }

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}

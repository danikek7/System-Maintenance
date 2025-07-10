<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceSchedule;
use App\Models\Location;
use Illuminate\Http\Request;

class MaintenanceScheduleController extends Controller
{
    public function index()
    {
        $jadwal_list = MaintenanceSchedule::with(['asset', 'location', 'statusLabel'])->get();
        return view('pelaksana.daftarjadwal', compact('jadwal_list'));
    }

    public function show(MaintenanceSchedule $jadwal)
    {
        return view('pelaksana.jadwal.show', compact('jadwal'));
    }

    public function edit(MaintenanceSchedule $jadwal)
    {
        $locations = Location::all(); // ambil semua lokasi
        return view('pelaksana.asetjadwal', compact('jadwal', 'locations'));
    }

    public function update(Request $request, MaintenanceSchedule $jadwal)
    {
        $request->validate([
            'nama_jadwal' => 'required|string|max:255',
            'bulan_maintenance' => 'required|date',
            'location_id' => 'nullable|exists:locations,id', // validasi location_id
        ]);

        $jadwal->update([
            'nama_jadwal' => $request->nama_jadwal,
            'bulan_maintenance' => $request->bulan_maintenance,
            'location_id' => $request->location_id,
        ]);

        return redirect()->route('pelaksana.jadwal.show', $jadwal)->with('success_message', 'Jadwal berhasil diperbarui.');
    }

    public function approve(MaintenanceSchedule $jadwal)
    {
        $jadwal->status = 'approved'; // sesuaikan value status jika ada enum atau model relasi
        $jadwal->save();

        return redirect()->route('pelaksana.daftarjadwal')->with('success_message', 'Jadwal berhasil disetujui.');
    }

    public function destroy(MaintenanceSchedule $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('pelaksana.daftarjadwal')->with('success_message', 'Jadwal berhasil dihapus.');
    }
}

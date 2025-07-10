<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceSchedule;
use App\Models\MaintenanceReport;
use App\Models\StatusLabel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PicController extends Controller
{
    // Halaman dashboard PIC
    public function dashboard()
    {
        return view('pic.dashboard');
    }

    // Menampilkan daftar jadwal maintenance
    public function jadwal()
    {
        $jadwal = MaintenanceSchedule::with(['asset.model', 'location', 'statusLabel'])->get();
        return view('pic.jadwal', compact('jadwal'));
    }

    // Menampilkan form laporan maintenance (readonly jika sudah dibuat)
    public function lihatJadwal($id)
    {
        $jadwal = MaintenanceSchedule::with(['asset.model', 'location', 'statusLabel'])->findOrFail($id);
        $statuses = StatusLabel::all();

        // Cek apakah laporan sudah ada
        $laporan = MaintenanceReport::with('statusLabel')->where('schedule_id', $id)->first();

        return view('pic.laporan.create', compact('jadwal', 'statuses', 'laporan'));
    }

    // Menyimpan laporan baru (jika belum ada)
    public function simpanLaporan(Request $request, $id)
    {
        $request->validate([
            'report_date' => 'required|date',
            'parameter1' => 'required|string',
            'parameter2' => 'required|string',
            'catatan1' => 'nullable|string',
            'catatan2' => 'nullable|string',
            'status' => 'required|integer',
        ]);

        MaintenanceReport::create([
            'schedule_id' => $id,
            'report_date' => $request->report_date,
            'parameter1' => $request->parameter1,
            'parameter2' => $request->parameter2,
            'catatan1' => $request->catatan1,
            'catatan2' => $request->catatan2,
            'status' => $request->status,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('pic.jadwal')->with('success', 'Laporan berhasil disimpan.');
    }

    // Menyetujui jadwal
    public function approve($id)
    {
        $jadwal = MaintenanceSchedule::findOrFail($id);
        $jadwal->status = 2; // 2 = Disetujui
        $jadwal->save();

        return redirect()->route('pic.jadwal')->with('success', 'Jadwal berhasil disetujui.');
    }

    // Mengembalikan jadwal
    public function reject($id)
    {
        $jadwal = MaintenanceSchedule::findOrFail($id);
        $jadwal->status = 3; // 3 = Dikembalikan
        $jadwal->save();

        return redirect()->route('pic.jadwal')->with('error', 'Jadwal dikembalikan untuk perbaikan.');
    }

    // Menampilkan laporan detail
    public function lihatLaporan($id)
    {
        $laporan = MaintenanceReport::with(['statusLabel', 'schedule.asset.model'])->where('schedule_id', $id)->firstOrFail();
        return view('pic.laporan.show', compact('laporan'));
    }

    // Form edit laporan
    public function editLaporan($id)
    {
        $laporan = MaintenanceReport::findOrFail($id);
        $statuses = StatusLabel::all();
        return view('pic.laporan.edit', compact('laporan', 'statuses'));
    }

    // Update laporan
    public function updateLaporan(Request $request, $id)
    {
        $laporan = MaintenanceReport::findOrFail($id);

        $request->validate([
            'report_date' => 'required|date',
            'parameter1' => 'required|string',
            'parameter2' => 'required|string',
            'catatan1' => 'nullable|string',
            'catatan2' => 'nullable|string',
            'status' => 'required|integer',
        ]);

        $laporan->update([
            'report_date' => $request->report_date,
            'parameter1' => $request->parameter1,
            'parameter2' => $request->parameter2,
            'catatan1' => $request->catatan1,
            'catatan2' => $request->catatan2,
            'status' => $request->status,
        ]);

        return redirect()->route('pic.jadwal')->with('success', 'Laporan berhasil diperbarui.');
    }
}

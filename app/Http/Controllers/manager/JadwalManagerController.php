<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\DetailJadwal;

class JadwalManagerController extends Controller
{
    // Tampilkan semua jadwal dengan status submit
    public function index()
    {
        $jadwals = Jadwal::where('status_jadwal', 1)->paginate(10);
        return view('manager.jadwal', compact('jadwals'));
    }

    // Tampilkan detail jadwal
    public function detail($id)
    {
        $jadwal = Jadwal::with(['details.asset', 'details.location'])->findOrFail($id);
        return view('manager.detail_jadwal', compact('jadwal'));
    }

    // Approve jadwal yang statusnya masih submit
    public function approve($id)
    {
        $jadwal = Jadwal::findOrFail($id);

        if ($jadwal->status_jadwal !== 1) {
            return redirect()->route('manager.jadwal.index')
                ->withErrors('Jadwal hanya bisa di-approve jika statusnya Submit.');
        }

        $jadwal->status_jadwal = 2; // Diubah ke status "Waiting"
        $jadwal->save();

        return redirect()->route('manager.jadwal.index')
            ->with('success', 'Jadwal berhasil disetujui dan status berubah menjadi Waiting.');
    }

    // Tampilkan daftar laporan yang disetujui PIC tapi belum disetujui Manager
    public function laporan()
    {
        $laporan = DetailJadwal::with(['jadwal', 'asset', 'location'])
            ->where('pic_status', 2)         // Sudah disetujui PIC
            ->where('manager_status', 0)     // Belum disetujui Manager
            ->paginate(10);

        return view('manager.laporan', compact('laporan'));
    }

    // Approve satu laporan oleh Manager
    public function approveLaporan($id)
    {
        $detail = DetailJadwal::findOrFail($id);

        if ($detail->pic_status != 2 || $detail->manager_status != 0) {
            return back()->with('error', 'Laporan tidak dapat disetujui.');
        }

        $detail->manager_status = 1;
        $detail->manager_approve_at = now();
        $detail->manager_id = 2; // Ambil ID user manager yang login
        $detail->save();

        return back()->with('success', 'Laporan berhasil disetujui oleh Manager.');
    }

    // Tampilkan detail laporan berdasarkan ID jadwal dan ID detail
    public function detailLaporan($jadwalId, $detailId)
    {
        $jadwal = Jadwal::findOrFail($jadwalId);
        $detail = DetailJadwal::with(['asset', 'location'])->findOrFail($detailId);

        return view('manager.detail_jadwal_laporan', compact('jadwal', 'detail'));
    }
    public function detailLaporanLengkap($jadwalId, $detailId)
    {
        $jadwal = Jadwal::findOrFail($jadwalId);
        $detail = DetailJadwal::with(['asset', 'location', 'detailJadwalInspeksis.detailType'])
            ->findOrFail($detailId);

        $laporans = $detail->detailJadwalInspeksis; // Ambil relasi inspeksi

        return view('manager.detail_laporan', compact('jadwal', 'detail', 'laporans'));
    }


    // Approve satu detail laporan
    public function approveDetail($detailId)
    {
        $detail = DetailJadwal::findOrFail($detailId);
        $detail->manager_status = 1;
        $detail->manager_approve_at = now();
        $detail->manager_id = 2;
        $detail->save();

        return redirect()->back()->with('success', 'Detail laporan berhasil disetujui oleh Manager.');
    }
}

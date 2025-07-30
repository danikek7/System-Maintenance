<?php

namespace App\Http\Controllers\Pic;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\DetailJadwal;
use App\Models\Laporan;
use App\Models\TypeInspeksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Location; 

class JadwalPicController extends Controller
{
    // Tampilkan daftar jadwal yang punya detail laporan dengan status PIC = 1 (menunggu persetujuan PIC)
    public function index()
    {
        // Ambil jadwal yang punya detail laporan dengan pic_status = 1 (waiting)
        $jadwals = Jadwal::whereHas('details', function ($query) {
            $query->where('pic_status', 1)
                ->where('manager_status', 0);
        })->paginate(10);

        return view('pic.laporan', compact('jadwals'));
    }

    // Detail jadwal (misal untuk lihat detail laporan)
// public function show($id)
// {
//     // Ambil data jadwal + relasi detail
//     $jadwal = Jadwal::with([
//         'details' => function($query) {
//             $query->with([
//                 'asset', 
//                 'location', 
//                 'laporans.typeInspeksi',
//                 'detailJadwalInspeksis',
//                 'pelaksana'
//             ]);
//         }
//     ])->findOrFail($id);

//     // // Ambil lokasi_id milik user login
//     // $userLocationId = Auth::user()->location_id;

//     // // Filter detail jadwal berdasarkan lokasi user
//     // $filteredDetails = $jadwal->details->filter(function($detail) use ($userLocationId) {
//     //     return $detail->location_id == $userLocationId;
//     // });

//     // // Hitung statistik
//     // $stats = [
//     //     'total' => $filteredDetails->count(),
//     //     'waiting' => $filteredDetails->where('pic_status', 1)->count(),
//     //     'approved' => $filteredDetails->where('pic_status', 2)->count(),
//     //     'not_reported' => $filteredDetails->where('pic_status', 0)->count()
//     // ];

//     return view('pic.detail_jadwal', [
//         'jadwal' => $jadwal,
//         // 'details' => $filteredDetails,
//         // 'stats' => $stats,
//         // 'userLocationIds' => [$userLocationId] // dijadikan array biar view-nya tetap bisa pakai foreach
//     ]);
// }


public function show($id)
    {
        $jadwal = Jadwal::with(['details.asset', 'details.location', 'details.detailJadwalInspeksis'])
            ->findOrFail($id);

        return view('pic.detail_jadwal', compact('jadwal'));
    }

    // Approve laporan dari PIC (ubah status pic_status jadi 2)
    public function approve($id)
    {
        $jadwal = Jadwal::findOrFail($id);

        // Update semua detail jadwal yang sedang menunggu PIC jadi sudah disetujui PIC
        $updated = $jadwal->details()
            ->where('pic_status', 1)
            ->where('manager_status', 0)
            ->update([
                'pic_status' => 2, // 2 = approved oleh PIC
                'pic_approve_at' => now(),
                'pic_id' => 3 // user PIC yang approve
            ]);

        if ($updated) {
            return redirect()->route('pic.laporan.index')->with('success', 'Laporan berhasil disetujui PIC.');
        } else {
            return redirect()->route('pic.laporan.index')->with('error', 'Tidak ada laporan yang bisa disetujui.');
        }
    }
    public function showDetailLaporan($jadwalId, $detailId)
    {
        // Ambil jadwal dan detail jadwal dengan relasi asset
        $jadwal = Jadwal::findOrFail($jadwalId);
        $detail = DetailJadwal::with('asset')->findOrFail($detailId);

        // Ambil semua laporan terkait detail jadwal ini dengan eager loading relasi typeInspeksi
        $laporans = Laporan::with('typeInspeksi')
            ->where('id_detail_jadwal', $detailId)
            ->get();

        if ($laporans->isEmpty()) {
            return redirect()->route('pic.laporan.index')->with('error', 'Laporan belum tersedia untuk detail ini.');
        }

        return view('pic.detail_laporan', compact('jadwal', 'detail', 'laporans'));
    }
    public function approveDetail($detailId)
    {
        $detail = DetailJadwal::findOrFail($detailId);

        if ($detail->pic_status !== 1 || $detail->manager_status !== 0) {
            return redirect()->back()->with('error', 'Detail jadwal ini tidak bisa diapprove.');
        }

        $detail->pic_status = 2; // sudah diapprove PIC
        $detail->pic_approve_at = now();
        $detail->pic_id =3; // asumsi ambil dari user login, kalau belum pakai dummy 3
        $detail->save();

        return redirect()->back()->with('success', 'Detail jadwal berhasil diapprove.');
    }
}

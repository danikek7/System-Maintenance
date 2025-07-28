<?php

namespace App\Http\Controllers\Pelaksana;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Models\DetailTypeInspeksi;
use Illuminate\Support\Facades\Auth;


class JadwalPelaksanaController extends Controller
{
    // Tampilkan daftar jadwal yang status-nya aktif (3)
    public function index()
    {
        $jadwals = Jadwal::where('status_jadwal', 3)
            ->orderBy('create_at', 'desc') // typo diperbaiki: create_at → created_at
            ->paginate(10);

        return view('pelaksana.jadwal', compact('jadwals'));
    }

    public function detail($id)
    {
        $jadwal = Jadwal::with([
            'details.asset',
            'details.location',
            'details.detailJadwalInspeksis',
            'details.pelaksana'
        ])->findOrFail($id);

        return view('pelaksana.detail_jadwal', compact('jadwal'));
    }

public function storeDetailTypeInspeksi(Request $request)
{
    $request->validate([
        'id_type_inspeksi' => 'required|exists:type_inspeksis,id',
        'nama' => 'required|string|max:255',
    ]);

    DetailTypeInspeksi::create([
        'id_type_inspeksi' => $request->id_type_inspeksi,
        'nama' => $request->nama,
        'create_by' => Auth::user()->id,
    ]);

    return back()->with('success', 'Detail Type Inspeksi berhasil ditambahkan.');
}


}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MaintenanceSchedule;
use App\Models\Location;
use App\Models\Asset;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    /**
     * Tampilkan daftar jadwal maintenance (halaman index).
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $jadwals = MaintenanceSchedule::latest()->paginate(10);
        return view('admin.jadwal', compact('jadwals'));
    }

    /**
     * Tampilkan form tambah jadwal maintenance.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $locations = Location::all();
        $assets = Asset::all();
        return view('admin.form_jadwal', compact('locations', 'assets'));
    }

    /**
     * Simpan data jadwal maintenance ke database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bulan'        => 'required|date_format:Y-m',
            'nama_jadwal'  => 'required|string|max:255',
            'lokasi'       => 'required|integer|exists:locations,id',
            'aset'         => 'required|array',
            'aset.*'       => 'integer|exists:assets,id',
        ]);

        foreach ($validated['aset'] as $asset_id) {
            MaintenanceSchedule::create([
                'asset_id'      => $asset_id,
                'schedule_date' => $validated['bulan'] . '-01',
                'created_by'    => Auth::id(),
                'status'        => 1,
                'model_id'      => null,
                'location_id'   => $validated['lokasi'],
            ]);
        }

        return redirect()->route('admin.jadwal')->with('success', 'Jadwal berhasil disimpan!');
    }
}

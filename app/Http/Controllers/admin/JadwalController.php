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
    public function index()
    {
        $jadwals = MaintenanceSchedule::latest()->paginate(10);
        return view('admin.jadwal', compact('jadwals'));
    }

    public function create()
    {
        $locations = Location::all();
        $assets = Asset::all();
        return view('admin.form_jadwal', compact('locations', 'assets'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bulan'          => 'required|date_format:Y-m',
            'name_schedule'  => 'required|string|max:255',
            'lokasi'         => 'required|integer|exists:locations,id',
            'aset'           => 'required|array',
            'aset.*'         => 'integer|exists:assets,id',
        ]);

        foreach ($validated['aset'] as $asset_id) {
            MaintenanceSchedule::create([
                'asset_id'      => $asset_id,
                'schedule_date' => $validated['bulan'] . '-01',
                'name_schedule' => $validated['name_schedule'],
                'created_by'    => Auth::id(),
                'status'        => 1,
                'model_id'      => null,
                'location_id'   => $validated['lokasi'],
            ]);
        }

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil disimpan!');
    }

    public function edit($id)
    {
        $jadwal = MaintenanceSchedule::findOrFail($id);
        $locations = Location::all();
        $assets = Asset::all();
        return view('admin.edit_jadwal', compact('jadwal', 'locations', 'assets'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'bulan'         => 'required|date_format:Y-m',
            'name_schedule' => 'required|string|max:255',
            'location_id'   => 'required|integer|exists:locations,id',
            'asset_id'      => 'required|integer|exists:assets,id',
            'status'        => 'required|integer',
        ]);

        $jadwal = MaintenanceSchedule::findOrFail($id);
        $jadwal->update([
            'schedule_date' => $validated['bulan'] . '-01',
            'name_schedule' => $validated['name_schedule'],
            'location_id'   => $validated['location_id'],
            'asset_id'      => $validated['asset_id'],
            'status'        => $validated['status'],
        ]);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $jadwal = MaintenanceSchedule::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus!');
    }
}

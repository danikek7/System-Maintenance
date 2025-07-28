<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Location;
use App\Models\ModelAssets;
use App\Models\Category;
use App\Models\Manufacture;

class AsetController extends Controller
{
    public function index(Request $request)
    {
        $query = Asset::with(['model', 'lokasi', 'kategori', 'produsen']);

        // Jika ada input pencarian, filter data
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('asset_tag', 'like', "%{$search}%");
            });
        }

        $assets = $query->get();

        return view('admin.aset', compact('assets'));
    }


    public function create()
    {
        $locations = Location::all();
        $models = ModelAssets::withTrashed()->get();
        $categories = Category::all();
        $manufactures = Manufacture::all();

        return view('admin.form_aset', compact('locations', 'models', 'categories', 'manufactures'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'asset_tag'    => 'required|string|max:100|unique:assets,asset_tag',
            'model_id'     => 'nullable|exists:models,id',
            'serial'       => 'nullable|string|max:100',
            'notes'        => 'nullable|string',
            'location_id'  => 'nullable|exists:locations,id',
            'kategori_id'  => 'nullable|exists:categories,id',
            'produsen_id'  => 'nullable|exists:manufactures,id',
        ]);

        Asset::create($validated);

        return redirect()->route('admin.aset.index')->with('success', 'Aset berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $asset = Asset::findOrFail($id);
        $locations = Location::all();
        $models = ModelAssets::withTrashed()->get();
        $categories = Category::all();
        $manufactures = Manufacture::all();

        return view('admin.edit_aset', compact('asset', 'locations', 'models', 'categories', 'manufactures'));
    }

    public function update(Request $request, $id)
    {
        $asset = Asset::findOrFail($id);

        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'asset_tag'    => 'required|string|max:100|unique:assets,asset_tag,' . $asset->id,
            'model_id'     => 'nullable|exists:models,id',
            'serial'       => 'nullable|string|max:100',
            'notes'        => 'nullable|string',
            'location_id'  => 'nullable|exists:locations,id',
            'kategori_id'  => 'nullable|exists:categories,id',
            'produsen_id'  => 'nullable|exists:manufactures,id',
        ]);

        $asset->update($validated);

        return redirect()->route('admin.aset.index')->with('success', 'Aset berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $asset = Asset::findOrFail($id);
        $asset->delete();

        return redirect()->route('admin.aset.index')->with('success', 'Aset berhasil dihapus.');
    }

    public function byLokasi($lokasi)
    {
        $assets = Asset::where('location_id', $lokasi)
            ->select('id', 'name')
            ->get();

        return response()->json($assets);
    }
}

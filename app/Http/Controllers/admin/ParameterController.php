<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TypeInspeksi;
use App\Models\DetailTypeInspeksi;

class ParameterController extends Controller
{
    // TAMPILKAN DAFTAR KATEGORI
    public function index()
    {
        $parameters = TypeInspeksi::all();
        return view('admin.parameter', compact('parameters'));
    }

    // TAMPILKAN DETAIL DARI SUATU KATEGORI
    public function show($id)
    {
        $typeInspeksi = TypeInspeksi::findOrFail($id);
        $detailParameters = DetailTypeInspeksi::where('id_type_inspeksi', $id)->get();
        return view('admin.lihat_parameter', compact('typeInspeksi', 'detailParameters'));
    }

    // FORM TAMBAH KATEGORI
    public function create()
    {
        return view('admin.form_parameter');
    }

    // SIMPAN KATEGORI BARU
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        TypeInspeksi::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('admin.parameter.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    // HAPUS KATEGORI
    public function destroy($id)
    {
        $typeInspeksi = TypeInspeksi::findOrFail($id);
        $typeInspeksi->delete();

        return redirect()->route('admin.parameter.index')->with('success', 'Kategori berhasil dihapus.');
    }

    // =============================
    // DETAIL PARAMETER (CRUD)
    // =============================

    // FORM TAMBAH DETAIL PARAMETER UNTUK KATEGORI TERTENTU
    public function createDetail($id)
    {
        $typeInspeksi = TypeInspeksi::findOrFail($id);
        return view('admin.form_detail_parameter', compact('typeInspeksi'));
    }

    // SIMPAN DETAIL PARAMETER BARU
    public function storeDetail(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        DetailTypeInspeksi::create([
            'id_type_inspeksi' => $id,
            'nama' => $request->nama,
        ]);

        return redirect()->route('admin.parameter.show', $id)->with('success', 'Parameter berhasil ditambahkan.');
    }

    // FORM EDIT DETAIL PARAMETER
    public function editDetail($id)
    {
        $detail = DetailTypeInspeksi::findOrFail($id);
        $typeInspeksi = $detail->typeInspeksi;
        return view('admin.edit_detail_parameter', compact('detail', 'typeInspeksi'));
    }

    // UPDATE DETAIL PARAMETER
    public function updateDetail(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $detail = DetailTypeInspeksi::findOrFail($id);
        $detail->nama = $request->nama;
        $detail->save();

        return redirect()->route('admin.parameter.show', $detail->id_type_inspeksi)->with('success', 'Parameter berhasil diperbarui.');
    }

    // HAPUS DETAIL PARAMETER
    public function destroyDetail($id)
    {
        $detail = DetailTypeInspeksi::findOrFail($id);
        $kategoriId = $detail->id_type_inspeksi;
        $detail->delete();

        return redirect()->route('admin.parameter.show', $kategoriId)->with('success', 'Parameter berhasil dihapus.');
    }

}

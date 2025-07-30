<?php

namespace App\Http\Controllers\Pelaksana;

use App\Http\Controllers\Controller;
use App\Models\TypeInspeksi;
use App\Models\DetailTypeInspeksi;
use App\Models\Jadwal;
use App\Models\DetailJadwal;
use App\Models\DetailJadwalInspeksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\PDF;

class LaporanController extends Controller
{
    public function create($jadwalId, $detailJadwalId)
    {
        $jadwal = Jadwal::with(['details.pelaksana'])->findOrFail($jadwalId); // Eager load pelaksana
        $detail_jadwal = $jadwal->details()
            ->with(['asset', 'location', 'pelaksana']) // Tambahkan pelaksana
            ->findOrFail($detailJadwalId);

        $types = TypeInspeksi::with('detailTypeInspeksis')->get();
        $laporanDetails = DetailJadwalInspeksi::where('id_detail_jadwal', $detailJadwalId)->get();
        $typeInspeksis = TypeInspeksi::all();

        return view('pelaksana.form_laporan', compact('jadwal', 'detail_jadwal', 'types', 'laporanDetails', 'typeInspeksis'));
    }

    public function getDetailType($id)
    {
        $details = DetailTypeInspeksi::where('id_type_inspeksi', $id)->get();
        return response()->json($details);
    }

    public function store(Request $request, $jadwalId, $detailJadwalId)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'lokasi' => 'required|string',
            'scanner' => 'required|array',
            'scanner.*' => 'string',
            'typeform' => 'required|exists:type_inspeksis,id',
            'detail_inspeksi' => 'required|array',
            'detail_inspeksi.*.hasil_indikator' => 'required|in:baik,buruk',
            'detail_inspeksi.*.notes' => 'nullable|string',
        ]);

        $now = now();
        $user = Auth::user();

        foreach ($request->input('detail_inspeksi') as $idDetailTypeInspeksi => $item) {
            $hasil_indikator = ($item['hasil_indikator'] === 'baik') ? 1 : 0;
            $notes = $item['notes'] ?? null; // simpan catatan jika diisi, baik buruk maupun baik

            DetailJadwalInspeksi::updateOrCreate(
                [
                    'id_detail_jadwal' => $detailJadwalId,
                    'id_detail_type_inspeksi' => $idDetailTypeInspeksi,
                ],
                [
                    'hasil_indikator' => $hasil_indikator,
                    'notes' => $notes,
                    'create_by' => $user->id,
                    'updated_at' => $now,
                    'created_at' => $now,
                ]
            );
        }


        // Simpan status draft (pic_status=0, manager_status=0)
        $detail = DetailJadwal::findOrFail($detailJadwalId);
        $detail->pic_status = 0;
        $detail->manager_status = 0;
        $detail->inspeksi_at = $now;
        $detail->inspeksi_by = $user->id;
        $detail->save();

        return redirect()->route('pelaksana.jadwal.detail', $jadwalId)
            ->with('success', 'Laporan inspeksi berhasil disimpan sebagai draft.');
    }

    public function edit($jadwalId, $detailJadwalId)
    {
        $jadwal = Jadwal::findOrFail($jadwalId);
        $detail_jadwal = $jadwal->details()->with('asset', 'location')->findOrFail($detailJadwalId);
        $types = TypeInspeksi::all();

        $laporanDetails = DetailJadwalInspeksi::where('id_detail_jadwal', $detailJadwalId)
            ->get()
            ->keyBy('id_detail_type_inspeksi');

        $firstDetailTypeId = $laporanDetails->keys()->first();
        $typeInspeksiSelected = null;

        if ($firstDetailTypeId) {
            $detailType = DetailTypeInspeksi::find($firstDetailTypeId);
            if ($detailType) {
                $typeInspeksiSelected = $detailType->id_type_inspeksi;
            }
        }

        return view('pelaksana.edit_laporan', compact('jadwal', 'detail_jadwal', 'types', 'laporanDetails', 'typeInspeksiSelected'));
    }

    public function update(Request $request, $jadwalId, $detailJadwalId)
    {
        $request->validate([
            'detail_inspeksi' => 'required|array',
            'detail_inspeksi.*.hasil_indikator' => 'required|in:baik,buruk',
            'detail_inspeksi.*.notes' => 'nullable|string',
        ]);

        $now = now();
        $user = Auth::user();

        foreach ($request->input('detail_inspeksi') as $idDetailTypeInspeksi => $item) {
            $hasil_indikator = ($item['hasil_indikator'] === 'baik') ? 1 : 0;
            $notes = $hasil_indikator === 0 ? $item['notes'] : null;

            DetailJadwalInspeksi::updateOrCreate(
                [
                    'id_detail_jadwal' => $detailJadwalId,
                    'id_detail_type_inspeksi' => $idDetailTypeInspeksi,
                ],
                [
                    'hasil_indikator' => $hasil_indikator,
                    'notes' => $notes,
                    'create_by' => $user->id,
                    'updated_at' => $now,
                    'created_at' => $now,
                ]
            );
        }

        // Tetap status draft saat update
        $detail = DetailJadwal::findOrFail($detailJadwalId);
        $detail->pic_status = 0;
        $detail->manager_status = 0;
        $detail->save();

        return redirect()->route('pelaksana.jadwal.detail', $jadwalId)
            ->with('success', 'Laporan berhasil diperbarui (draft).');
    }

    // Fungsi submit laporan ke PIC (status waiting PIC)
    public function submit($id)
    {
        $detail = DetailJadwal::findOrFail($id);

        // Pastikan ada laporan dan masih draft
        if ($detail->pic_status == 0 && $detail->manager_status == 0 && $detail->detailJadwalInspeksis()->exists()) {
            $detail->pic_status = 1; // waiting PIC
            $detail->save();

            return redirect()->back()->with('success', 'Laporan berhasil diajukan ke PIC.');
        }

        return redirect()->back()->with('error', 'Laporan tidak dapat diajukan (sudah diajukan atau belum dibuat).');
    }

    // Fungsi approve oleh PIC
    public function approveByPIC($id)
    {
        $detail = DetailJadwal::findOrFail($id);

        if ($detail->pic_status == 1 && $detail->manager_status == 0) {
            $detail->pic_status = 2; // approved PIC
            $detail->pic_approve_at = now();
            $detail->pic_id = Auth::id();
            $detail->save();

            return redirect()->back()->with('success', 'Laporan berhasil disetujui PIC.');
        }

        return redirect()->back()->with('error', 'Laporan belum diajukan oleh pelaksana atau sudah disetujui PIC.');
    }

    // Fungsi approve oleh Manager
    public function approveByManager($id)
    {
        $detail = DetailJadwal::findOrFail($id);

        if ($detail->pic_status == 2 && $detail->manager_status == 0) {
            $detail->manager_status = 1; // approved Manager
            $detail->manager_approve_at = now();
            $detail->manager_id = Auth::id();
            $detail->save();

            return redirect()->back()->with('success', 'Laporan berhasil disetujui oleh Manager.');
        }

        return redirect()->back()->with('error', 'Laporan belum disetujui oleh PIC atau sudah disetujui Manager.');
    }
    public function print($jadwalId, $detailId)
    {
        $jadwal = Jadwal::findOrFail($jadwalId);
        $detail = DetailJadwal::with(['asset', 'location'])->findOrFail($detailId);

        if ($detail->jadwal_id != $jadwal->id) {
            abort(404);
        }

        // Ambil semua data inspeksi untuk detail tersebut
        $laporans = DetailJadwalInspeksi::with('indikator') // pastikan ada relasi indikator
            ->where('id_detail_jadwal', $detail->id)
            ->get();

        // Kamu bisa pakai $laporan sebagai data utama jika ada, contoh ambil tanggal
        $laporan = $laporans->first(); // contoh ambil satu data untuk ambil tanggal

        return view('pelaksana.pdf', compact('jadwal', 'detail', 'laporan', 'laporans'));
    }

    public function submitAll(Request $request, $jadwalId)
    {
        $jadwal = Jadwal::findOrFail($jadwalId);

        // Ambil semua detail jadwal yang masih draft (status 0)
        $draftDetails = $jadwal->details()
            ->where('pic_status', 0)
            ->where('manager_status', 0)
            ->get();

        if ($draftDetails->isEmpty()) {
            return redirect()->back()
                ->with('warning', 'Tidak ada laporan draft yang bisa diajukan.');
        }

        $now = now();
        $updatedCount = 0;

        foreach ($draftDetails as $detail) {
            // Pastikan detail memiliki laporan
            if ($detail->detailJadwalInspeksis()->exists()) {
                $detail->pic_status = 1; // waiting PIC
                $detail->save();
                $updatedCount++;
            }
        }

        if ($updatedCount > 0) {
            return redirect()->back()
                ->with('success', "Berhasil mengajukan $updatedCount laporan ke PIC.");
        }

        return redirect()->back()
            ->with('error', 'Tidak ada laporan yang memenuhi syarat untuk diajukan.');
    }
}

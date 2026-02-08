<?php

namespace App\Http\Controllers;

use App\Models\IDM;
use Illuminate\Http\Request;


class IDMController extends Controller
{
    public function index()
    {
        $idmData = IDM::orderBy('tahun', 'desc')->get();
        $totalIDM = $idmData->count();
        
        $latestActiveIDM = IDM::where('status', true)
            ->orderBy('tahun', 'desc')
            ->first();
        $nilaiIDM = $latestActiveIDM ? $latestActiveIDM->skor : 0;

        $chartData = IDM::where('status', true)
            ->orderBy('tahun', 'desc')
            ->limit(5)
            ->get();
        
        $chartYears = $chartData->pluck('tahun')->toArray();
        $chartScores = $chartData->pluck('skor')->toArray();

        return view('admin.idm.index', compact(
            'idmData', 
            'totalIDM', 
            'nilaiIDM', 
            'chartYears', 
            'chartScores'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahun' => 'required|integer|min:2020|max:2030',
            'skor' => 'required|numeric|min:0|max:100',
            'deskripsi' => 'nullable|string|max:1000',
        ]);

        $validated['status'] = $request->has('status');

        IDM::create($validated);

        return redirect()->route('admin.idm.index')
            ->with('success', 'Data IDM berhasil ditambahkan!');
    }

    // METHOD INI YANG MISSING! TAMBAHKAN INI!
    public function edit(IDM $idm)
    {
        return response()->json([
            'id' => $idm->id,
            'tahun' => $idm->tahun,
            'skor' => $idm->skor,
            'deskripsi' => $idm->deskripsi,
            'status' => $idm->status,
        ]);
    }

    public function update(Request $request, IDM $idm)
    {
        $validated = $request->validate([
            'tahun' => 'required|integer|min:2020|max:2030',
            'skor' => 'required|numeric|min:0|max:100',
            'deskripsi' => 'nullable|string|max:1000',
        ]);

        $validated['status'] = $request->has('status');

        $idm->update($validated);

        return redirect()->route('admin.idm.index')
            ->with('success', 'Data IDM berhasil diperbarui!');
    }

    public function destroy(IDM $idm)
    {
        $idm->delete();

        return redirect()->route('admin.idm.index')
            ->with('success', 'Data IDM berhasil dihapus!');
    }
}

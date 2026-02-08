<?php

namespace App\Http\Controllers;

use App\Models\PPID;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PPIDController extends Controller
{
    public function index()
    {
        $ppidData = PPID::orderBy('tanggal_publikasi', 'desc')->paginate(10);
        $totalPPID = PPID::count();
        $totalBerkala = PPID::where('kategori', 'informasiBerkala')->count();
        $totalSertaMerta = PPID::where('kategori', 'informasiSertaMerta')->count();

        return view('admin.ppid.index', compact(
            'ppidData',
            'totalPPID',
            'totalBerkala', 
            'totalSertaMerta'
        ));
    }

    public function store(Request $request)
    {
        // Debug untuk cek data yang masuk
        // dd($request->all());

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|in:informasiBerkala,informasiSertaMerta,informasiSetiapSaat,informasiDikecualikan,laporan,dokumen',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
            'tanggal_publikasi' => 'nullable|date'
        ]);

        // Set status dari checkbox (true jika dicentang, false jika tidak)
        $validated['status'] = $request->has('status') ? true : false;
        
        // Set tanggal publikasi, gunakan input atau default ke hari ini
        $validated['tanggal_publikasi'] = $request->tanggal_publikasi ?? now();

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $validated['file_path'] = $file->storeAs('ppid', $filename, 'public');
        }

        PPID::create($validated);

        return redirect()->route('admin.ppid.index')
            ->with('success', 'Data PPID berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $ppid = PPID::findOrFail($id);
        return response()->json($ppid);
    }

    public function update(Request $request, PPID $ppid)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|in:informasiBerkala,informasiSertaMerta,informasiSetiapSaat,informasiDikecualikan,laporan,dokumen',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
            'tanggal_publikasi' => 'nullable|date'
        ]);

        // Set status dari checkbox
        $validated['status'] = $request->has('status') ? true : false;

        // Handle file upload
        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($ppid->file_path) {
                Storage::disk('public')->delete($ppid->file_path);
            }
            
            $file = $request->file('file');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $validated['file_path'] = $file->storeAs('ppid', $filename, 'public');
        }

        $ppid->update($validated);

        return redirect()->route('admin.ppid.index')
            ->with('success', 'Data PPID berhasil diperbarui!');
    }

    public function destroy(PPID $ppid)
    {
        // Delete file if exists
        if ($ppid->file_path) {
            Storage::disk('public')->delete($ppid->file_path);
        }

        $ppid->delete();

        return redirect()->route('admin.ppid.index')
            ->with('success', 'Data PPID berhasil dihapus!');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\JenisDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DokumenController extends Controller
{
    public function index()
    {
        $dokumens = Dokumen::with('jenisDokumen')->paginate(10);
        return view('admin.dokumen.index', compact('dokumens'));
    }

    /**
     * Display the specified resource (detail view for admin)
     */
    public function show($id)
    {
        $dokumen = Dokumen::with('jenisDokumen')->findOrFail($id);
        return view('admin.dokumen.show', compact('dokumen'));
    }

    // ============================================================
    // FRONTEND METHODS
    // ============================================================

    /**
     * Frontend index - menampilkan daftar dokumen untuk publik
     */
    public function frontendIndex(Request $request)
    {
        $jenisDokumenId = $request->get('jenis');
        $jenisDokumens = JenisDokumen::all();

        $dokumens = Dokumen::with('jenisDokumen')
            ->when($jenisDokumenId, function ($query) use ($jenisDokumenId) {
                return $query->where('jenis_dokumen_id', $jenisDokumenId);
            })
            ->published()
            ->latest()
            ->paginate(12);

        return view('pages.dokumen.index', compact('dokumens', 'jenisDokumens', 'jenisDokumenId'));
    }

    /**
     * Frontend show - menampilkan detail dokumen untuk publik
     */
    public function frontendShow($id)
    {
        $dokumen = Dokumen::with('jenisDokumen')
            ->published()
            ->findOrFail($id);

        // Get related documents (same type)
        $relatedDokumens = Dokumen::with('jenisDokumen')
            ->published()
            ->where('jenis_dokumen_id', $dokumen->jenis_dokumen_id)
            ->where('id', '!=', $dokumen->id)
            ->latest()
            ->take(4)
            ->get();

        return view('pages.dokumen.show', compact('dokumen', 'relatedDokumens'));
    }

    public function create()
    {
        $jenisDokumens = JenisDokumen::all();
        return view('admin.dokumen.create', compact('jenisDokumens'));
    }

    // 🔥 INI YANG HILANG
    public function edit($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $jenisDokumens = JenisDokumen::all();

        return view('admin.dokumen.edit', compact('dokumen', 'jenisDokumens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_dokumen' => 'required',
            'jenis_dokumen_id' => 'required',
            'file' => 'required|file|max:20480',
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();

        $path = public_path('uploads/dokumen');
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $file->move($path, $fileName);

        Dokumen::create([
            'nama_dokumen' => $request->nama_dokumen,
            'deskripsi' => $request->deskripsi,
            'jenis_dokumen_id' => $request->jenis_dokumen_id,
            'file_path' => 'uploads/dokumen/' . $fileName,
            'nama_file_asli' => $file->getClientOriginalName(),
            'ukuran_file' => filesize($path . '/' . $fileName),
            'tipe_file' => $file->getClientMimeType(),
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('admin.dokumen.index')
            ->with('success', 'Dokumen berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $dokumen = Dokumen::findOrFail($id);

        $request->validate([
            'nama_dokumen' => 'required',
            'jenis_dokumen_id' => 'required',
            'file' => 'nullable|file|max:20480',
        ]);

        if ($request->hasFile('file')) {
            if (File::exists(public_path($dokumen->file_path))) {
                File::delete(public_path($dokumen->file_path));
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = public_path('uploads/dokumen');
            $file->move($path, $fileName);

            $dokumen->file_path = 'uploads/dokumen/' . $fileName;
            $dokumen->nama_file_asli = $file->getClientOriginalName();
            $dokumen->ukuran_file = filesize($path . '/' . $fileName);
            $dokumen->tipe_file = $file->getClientMimeType();
        }

        $dokumen->update([
            'nama_dokumen' => $request->nama_dokumen,
            'deskripsi' => $request->deskripsi,
            'jenis_dokumen_id' => $request->jenis_dokumen_id,
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('admin.dokumen.index')
            ->with('success', 'Dokumen berhasil diperbarui');
    }

    public function destroy($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        if (File::exists(public_path($dokumen->file_path))) {
            File::delete(public_path($dokumen->file_path));
        }

        $dokumen->delete();

        return back()->with('success', 'Dokumen berhasil dihapus');
    }

    /**
     * Download dokumen dan increment download count
     */
    public function download($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        // Increment download count
        $dokumen->incrementDownloadCount();

        // Get file path
        $filePath = public_path($dokumen->file_path);

        // Check if file exists
        if (!File::exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }

        // Get file extension for content type
        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        $contentTypes = [
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'xls' => 'application/vnd.ms-excel',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'ppt' => 'application/vnd.ms-powerpoint',
            'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
        ];

        $contentType = $contentTypes[$extension] ?? 'application/octet-stream';

        // Return file download response
        return response()->download($filePath, $dokumen->nama_file_asli, [
            'Content-Type' => $contentType,
        ]);
    }
}

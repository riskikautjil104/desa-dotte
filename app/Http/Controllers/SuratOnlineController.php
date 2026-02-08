<?php

namespace App\Http\Controllers;

use App\Models\SuratOnline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratOnlineController extends Controller
{
    /**
     * Frontend: Display form pengajuan surat
     */
    public function index()
    {
        // Get user's surat if authenticated
        $mySurat = collect();
        if (auth('masyarakat')->check()) {
            $mySurat = SuratOnline::where('nik', auth('masyarakat')->user()->nik)
                ->orWhere('email', auth('masyarakat')->user()->email)
                ->latest()
                ->get();
        }

        // Statistics
        $totalSurat = SuratOnline::count();
        $suratMenunggu = SuratOnline::status('menunggu')->count();
        $suratDiproses = SuratOnline::status('diproses')->count();
        $suratSelesai = SuratOnline::status('selesai')->count();

        return view('pages.surat-online.index', compact(
            'mySurat',
            'totalSurat',
            'suratMenunggu',
            'suratDiproses',
            'suratSelesai'
        ));
    }

    /**
     * Frontend: Store pengajuan surat
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pemohon' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'email' => 'nullable|email',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'jenis_surat' => 'required|in:keterangan_tinggal,skck,keterangan_usaha,keterangan_tidak_mampu,keterangan_domisili,keterangan_lain',
            'keterangan' => 'required|string'
        ]);

        // Generate nomor surat
        $validated['nomor_surat'] = SuratOnline::generateNomorSurat();
        $validated['status'] = 'menunggu';

        SuratOnline::create($validated);

        return redirect()->route('frontend.surat-online')
            ->with('success', 'Pengajuan surat berhasil dikirim! Nomor surat: ' . $validated['nomor_surat']);
    }

    /**
     * Frontend: Show detail surat
     */
    public function show(SuratOnline $suratOnline)
    {
        return view('pages.surat-online.detail', compact('suratOnline'));
    }

    /**
     * Admin: Display all surat
     */
    public function adminIndex(Request $request)
    {
        $query = SuratOnline::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nomor_surat', 'like', "%{$search}%")
                  ->orWhere('nama_pemohon', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%")
                  ->orWhere('no_hp', 'like', "%{$search}%");
            });
        }

        // Filter by jenis surat
        if ($request->filled('jenis_surat')) {
            $query->where('jenis_surat', $request->jenis_surat);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $suratOnline = $query->latest()->paginate(15);

        // Statistics for dashboard
        $totalSurat = SuratOnline::count();
        $suratMenunggu = SuratOnline::status('menunggu')->count();
        $suratDiproses = SuratOnline::status('diproses')->count();
        $suratSelesai = SuratOnline::status('selesai')->count();

        return view('admin.surat-online.index', compact(
            'suratOnline',
            'totalSurat',
            'suratMenunggu',
            'suratDiproses',
            'suratSelesai'
        ));
    }

    /**
     * Admin: Show detail surat (for modal)
     */
    public function adminShow(SuratOnline $suratOnline)
    {
        return response()->json([
            'success' => true,
            'surat' => $suratOnline,
            'jenis_surat_label' => $suratOnline->jenis_surat_label,
            'status_text' => $suratOnline->status_text
        ]);
    }

    /**
     * Admin: Update status surat
     */
    public function updateStatus(Request $request, SuratOnline $suratOnline)
    {
        $validated = $request->validate([
            'nama_pemohon' => 'required|string|max:255',
            'nik' => 'required|string|size:16|regex:/^[0-9]+$/', // Harus 16 digit angka
            'email' => 'nullable|email',
            'no_hp' => 'required|string|max:20|regex:/^[0-9+\-\s()]+$/',
            'alamat' => 'required|string|max:500',
            'jenis_surat' => 'required|in:keterangan_tinggal,skck,keterangan_usaha,keterangan_tidak_mampu,keterangan_domisili,keterangan_lain',
            'keterangan' => 'required|string|max:1000'
        ]);

        // Handle file upload
        if ($request->hasFile('file_hasil')) {
            // Delete old file
            if ($suratOnline->file_hasil) {
                Storage::delete('public/surat/' . $suratOnline->file_hasil);
            }

            $file = $request->file('file_hasil');
            $fileName = time() . '_' . $suratOnline->nomor_surat . '.pdf';
            $file->storeAs('public/surat', $fileName);
            $validated['file_hasil'] = $fileName;
        }

        // Set tanggal selesai if status is selesai
        if ($validated['status'] === 'selesai' && !$suratOnline->tanggal_selesai) {
            $validated['tanggal_selesai'] = now();
        }

        $suratOnline->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Status surat berhasil diperbarui!'
        ]);
    }

    /**
     * Admin: Delete surat
     */
    public function destroy(SuratOnline $suratOnline)
    {
        // Delete file if exists
        if ($suratOnline->file_hasil) {
            Storage::delete('public/surat/' . $suratOnline->file_hasil);
        }

        $suratOnline->delete();

        return redirect()->route('admin.surat-online.index')
            ->with('success', 'Surat berhasil dihapus!');
    }

    /**
     * Download file hasil surat
     */
    public function downloadFile(SuratOnline $suratOnline)
    {
        if (!$suratOnline->file_hasil) {
            return back()->with('error', 'File tidak ditemukan!');
        }

        $filePath = storage_path('app/public/surat/' . $suratOnline->file_hasil);

        if (!file_exists($filePath)) {
            return back()->with('error', 'File tidak ditemukan!');
        }

        return response()->download($filePath, 'Surat_' . $suratOnline->nomor_surat . '.pdf');
    }
}
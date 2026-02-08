<?php

namespace App\Http\Controllers;

use App\Models\JenisBansos;
use App\Models\PenerimaBansos;
use App\Models\DistribusiBansos;
use App\Models\PengajuanBansos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BansosController extends Controller
{
    // ============================================
    // ADMIN - JENIS BANSOS
    // ============================================
    
    public function adminJenisBansos(Request $request)
    {
        $query = JenisBansos::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_bantuan', 'like', "%{$search}%")
                  ->orWhere('kode_bantuan', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $jenisBansos = $query->latest()->paginate(15);

        $totalJenis = JenisBansos::count();
        $totalAktif = JenisBansos::active()->count();
        $totalPenerima = PenerimaBansos::verified()->count();
        $totalDistribusi = DistribusiBansos::where('status_penerimaan', 'diterima')->count();

        return view('admin.bansos.jenis.index', compact(
            'jenisBansos',
            'totalJenis',
            'totalAktif',
            'totalPenerima',
            'totalDistribusi'
        ));
    }

    public function storeJenisBansos(Request $request)
    {
        $validated = $request->validate([
            'nama_bantuan' => 'required|string|max:255',
            'kode_bantuan' => 'required|string|max:50|unique:jenis_bansos',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|in:reguler,darurat,khusus,musiman',
            'sumber_dana' => 'required|in:apbd,apbn,desa,lainnya',
            'nominal_bantuan' => 'nullable|numeric|min:0',
            'jenis_bantuan' => 'required|in:uang,barang,campuran',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');

        JenisBansos::create($validated);

        return redirect()->route('admin.bansos.jenis.index')
            ->with('success', 'Jenis bantuan berhasil ditambahkan!');
    }

    public function updateJenisBansos(Request $request, JenisBansos $jenisBansos)
    {
        $validated = $request->validate([
            'nama_bantuan' => 'required|string|max:255',
            'kode_bantuan' => 'required|string|max:50|unique:jenis_bansos,kode_bantuan,' . $jenisBansos->id,
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|in:reguler,darurat,khusus,musiman',
            'sumber_dana' => 'required|in:apbd,apbn,desa,lainnya',
            'nominal_bantuan' => 'nullable|numeric|min:0',
            'jenis_bantuan' => 'required|in:uang,barang,campuran',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');

        $jenisBansos->update($validated);

        return redirect()->route('admin.bansos.jenis.index')
            ->with('success', 'Jenis bantuan berhasil diperbarui!');
    }

    public function destroyJenisBansos(JenisBansos $jenisBansos)
    {
        $jenisBansos->delete();

        return redirect()->route('admin.bansos.jenis.index')
            ->with('success', 'Jenis bantuan berhasil dihapus!');
    }

    // ============================================
    // ADMIN - PENERIMA BANSOS
    // ============================================
    
    public function adminPenerimaBansos(Request $request)
    {
        $query = PenerimaBansos::with('jenisBansos');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nik', 'like', "%{$search}%")
                  ->orWhere('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('no_kk', 'like', "%{$search}%");
            });
        }

        if ($request->filled('jenis_bansos_id')) {
            $query->where('jenis_bansos_id', $request->jenis_bansos_id);
        }

        if ($request->filled('status_verifikasi')) {
            $query->where('status_verifikasi', $request->status_verifikasi);
        }

        $penerimaBansos = $query->latest()->paginate(15);
        $jenisBansos = JenisBansos::active()->get();

        $totalPenerima = PenerimaBansos::count();
        $penerimaVerified = PenerimaBansos::verified()->count();
        $penerimaMenunggu = PenerimaBansos::where('status_verifikasi', 'menunggu')->count();

        return view('admin.bansos.penerima.index', compact(
            'penerimaBansos',
            'jenisBansos',
            'totalPenerima',
            'penerimaVerified',
            'penerimaMenunggu'
        ));
    }

    public function storePenerimaBansos(Request $request)
    {
        $validated = $request->validate([
            'jenis_bansos_id' => 'required|exists:jenis_bansos,id',
            'nik' => 'required|string|max:16',
            'nama_lengkap' => 'required|string|max:255',
            'no_kk' => 'nullable|string|max:16',
            'alamat' => 'required|string',
            'rt_rw' => 'nullable|string|max:20',
            'no_hp' => 'nullable|string|max:20',
            'jumlah_tanggungan' => 'required|integer|min:0',
            'status_ekonomi' => 'required|in:sangat_miskin,miskin,rentan_miskin',
            'status_verifikasi' => 'required|in:menunggu,diverifikasi,ditolak',
            'keterangan' => 'nullable|string',
            'foto_rumah' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('foto_rumah')) {
            $foto = $request->file('foto_rumah');
            $namaFoto = time() . '_' . Str::slug($validated['nama_lengkap']) . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('public/bansos/penerima', $namaFoto);
            $validated['foto_rumah'] = $namaFoto;
        }

        PenerimaBansos::create($validated);

        return redirect()->route('admin.bansos.penerima.index')
            ->with('success', 'Data penerima berhasil ditambahkan!');
    }

    public function updatePenerimaBansos(Request $request, PenerimaBansos $penerimaBansos)
    {
        $validated = $request->validate([
            'jenis_bansos_id' => 'required|exists:jenis_bansos,id',
            'nik' => 'required|string|max:16',
            'nama_lengkap' => 'required|string|max:255',
            'no_kk' => 'nullable|string|max:16',
            'alamat' => 'required|string',
            'rt_rw' => 'nullable|string|max:20',
            'no_hp' => 'nullable|string|max:20',
            'jumlah_tanggungan' => 'required|integer|min:0',
            'status_ekonomi' => 'required|in:sangat_miskin,miskin,rentan_miskin',
            'status_verifikasi' => 'required|in:menunggu,diverifikasi,ditolak',
            'keterangan' => 'nullable|string',
            'foto_rumah' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('foto_rumah')) {
            if ($penerimaBansos->foto_rumah) {
                Storage::delete('public/bansos/penerima/' . $penerimaBansos->foto_rumah);
            }

            $foto = $request->file('foto_rumah');
            $namaFoto = time() . '_' . Str::slug($validated['nama_lengkap']) . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('public/bansos/penerima', $namaFoto);
            $validated['foto_rumah'] = $namaFoto;
        }

        $penerimaBansos->update($validated);

        return redirect()->route('admin.bansos.penerima.index')
            ->with('success', 'Data penerima berhasil diperbarui!');
    }

    public function destroyPenerimaBansos(PenerimaBansos $penerimaBansos)
    {
        if ($penerimaBansos->foto_rumah) {
            Storage::delete('public/bansos/penerima/' . $penerimaBansos->foto_rumah);
        }

        $penerimaBansos->delete();

        return redirect()->route('admin.bansos.penerima.index')
            ->with('success', 'Data penerima berhasil dihapus!');
    }

    // ============================================
    // ADMIN - DISTRIBUSI BANSOS
    // ============================================
    
    public function adminDistribusiBansos(Request $request)
    {
        $query = DistribusiBansos::with(['penerimaBansos', 'jenisBansos']);

        if ($request->filled('periode')) {
            $query->periode($request->periode);
        }

        if ($request->filled('jenis_bansos_id')) {
            $query->where('jenis_bansos_id', $request->jenis_bansos_id);
        }

        if ($request->filled('status_penerimaan')) {
            $query->where('status_penerimaan', $request->status_penerimaan);
        }

        $distribusiBansos = $query->latest('tanggal_distribusi')->paginate(15);
        $jenisBansos = JenisBansos::active()->get();

        $totalDistribusi = DistribusiBansos::count();
        $totalDiterima = DistribusiBansos::where('status_penerimaan', 'diterima')->count();
        $totalNominal = DistribusiBansos::where('status_penerimaan', 'diterima')->sum('nominal_diterima');
        $terjadwal = DistribusiBansos::where('status_penerimaan', 'terjadwal')->count();

        return view('admin.bansos.distribusi.index', compact(
            'distribusiBansos',
            'jenisBansos',
            'totalDistribusi',
            'totalDiterima',
            'totalNominal',
            'terjadwal'
        ));
    }

    public function storeDistribusiBansos(Request $request)
    {
        $validated = $request->validate([
            'penerima_bansos_id' => 'required|exists:penerima_bansos,id',
            'jenis_bansos_id' => 'required|exists:jenis_bansos,id',
            'periode' => 'required|string|max:20',
            'tanggal_distribusi' => 'required|date',
            'nominal_diterima' => 'nullable|numeric|min:0',
            'barang_diterima' => 'nullable|string',
            'status_penerimaan' => 'required|in:terjadwal,diterima,ditunda,dibatalkan',
            'catatan' => 'nullable|string',
            'petugas' => 'nullable|string|max:255'
        ]);

        DistribusiBansos::create($validated);

        return redirect()->route('admin.bansos.distribusi.index')
            ->with('success', 'Distribusi bantuan berhasil dijadwalkan!');
    }

    public function updateStatusDistribusi(Request $request, DistribusiBansos $distribusiBansos)
    {
        $validated = $request->validate([
            'status_penerimaan' => 'required|in:terjadwal,diterima,ditunda,dibatalkan',
            'tanggal_diterima' => 'nullable|date',
            'catatan' => 'nullable|string',
            'bukti_penerimaan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('bukti_penerimaan')) {
            $foto = $request->file('bukti_penerimaan');
            $namaFoto = time() . '_bukti_' . $distribusiBansos->id . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('public/bansos/bukti', $namaFoto);
            $validated['bukti_penerimaan'] = $namaFoto;
        }

        if ($validated['status_penerimaan'] === 'diterima' && !$distribusiBansos->tanggal_diterima) {
            $validated['tanggal_diterima'] = now();
        }

        $distribusiBansos->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Status distribusi berhasil diperbarui!'
        ]);
    }

    // ============================================
    // FRONTEND - PENGAJUAN BANSOS
    // ============================================
    
    public function frontendIndex()
    {
        $jenisBansos = JenisBansos::active()->get();
        
        $totalBantuan = JenisBansos::active()->count();
        $totalPenerima = PenerimaBansos::verified()->count();

        return view('pages.bansos.index', compact(
            'jenisBansos',
            'totalBantuan',
            'totalPenerima'
        ));
    }

    public function storePengajuan(Request $request)
    {
        $validated = $request->validate([
            'jenis_bansos_id' => 'required|exists:jenis_bansos,id',
            'nik' => 'required|string|max:16',
            'nama_lengkap' => 'required|string|max:255',
            'no_kk' => 'required|string|max:16',
            'alamat' => 'required|string',
            'rt_rw' => 'required|string|max:20',
            'no_hp' => 'required|string|max:20',
            'jumlah_tanggungan' => 'required|integer|min:0',
            'penghasilan_perbulan' => 'nullable|numeric|min:0',
            'alasan_pengajuan' => 'required|string',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_kk' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_rumah' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Upload files
        foreach (['foto_ktp', 'foto_kk', 'foto_rumah'] as $field) {
            if ($request->hasFile($field)) {
                $foto = $request->file($field);
                $namaFoto = time() . '_' . $field . '_' . $validated['nik'] . '.' . $foto->getClientOriginalExtension();
                $foto->storeAs('public/bansos/pengajuan', $namaFoto);
                $validated[$field] = $namaFoto;
            }
        }

        PengajuanBansos::create($validated);

        return redirect()->route('frontend.bansos')
            ->with('success', 'Pengajuan bantuan berhasil dikirim! Tunggu proses verifikasi dari petugas.');
    }
     /**
     * Show detail jenis bansos (JSON for modal)
     */
    public function showJenisBansos(JenisBansos $jenisBansos)
    {
        return response()->json([
            'success' => true,
            'jenisBansos' => $jenisBansos,
            'jumlah_penerima' => $jenisBansos->jumlah_penerima,
            'total_nominal' => $jenisBansos->total_nominal_distribusi
        ]);
    }

    /**
     * Show detail penerima bansos (JSON for modal)
     */
    public function showPenerimaBansos(PenerimaBansos $penerimaBansos)
    {
        $penerimaBansos->load('jenisBansos', 'distribusiBansos');
        
        return response()->json([
            'success' => true,
            'penerima' => $penerimaBansos,
            'total_penerimaan' => $penerimaBansos->total_penerimaan
        ]);
    }

    /**
     * Verify penerima bansos
     */
    public function verifyPenerima(Request $request, PenerimaBansos $penerimaBansos)
    {
        $validated = $request->validate([
            'status_verifikasi' => 'required|in:diverifikasi,ditolak',
            'keterangan' => 'nullable|string'
        ]);

        $penerimaBansos->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Status verifikasi berhasil diperbarui!'
        ]);
    }

    /**
     * Show detail distribusi (JSON for modal)
     */
    public function showDistribusiBansos(DistribusiBansos $distribusiBansos)
    {
        $distribusiBansos->load('penerimaBansos', 'jenisBansos');
        
        return response()->json([
            'success' => true,
            'distribusi' => $distribusiBansos
        ]);
    }

    /**
     * Delete distribusi
     */
    public function destroyDistribusiBansos(DistribusiBansos $distribusiBansos)
    {
        if ($distribusiBansos->bukti_penerimaan) {
            Storage::delete('public/bansos/bukti/' . $distribusiBansos->bukti_penerimaan);
        }

        $distribusiBansos->delete();

        return redirect()->route('admin.bansos.distribusi.index')
            ->with('success', 'Data distribusi berhasil dihapus!');
    }

    /**
     * Admin - Kelola Pengajuan Bansos dari Warga
     */
    public function adminPengajuanBansos(Request $request)
    {
        $query = PengajuanBansos::with('jenisBansos');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nik', 'like', "%{$search}%")
                  ->orWhere('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('no_kk', 'like', "%{$search}%");
            });
        }

        if ($request->filled('jenis_bansos_id')) {
            $query->where('jenis_bansos_id', $request->jenis_bansos_id);
        }

        if ($request->filled('status_pengajuan')) {
            $query->where('status_pengajuan', $request->status_pengajuan);
        }

        $pengajuanBansos = $query->latest()->paginate(15);
        $jenisBansos = JenisBansos::active()->get();

        $totalPengajuan = PengajuanBansos::count();
        $menunggu = PengajuanBansos::where('status_pengajuan', 'menunggu')->count();
        $disetujui = PengajuanBansos::where('status_pengajuan', 'disetujui')->count();
        $ditolak = PengajuanBansos::where('status_pengajuan', 'ditolak')->count();

        return view('admin.bansos.pengajuan.index', compact(
            'pengajuanBansos',
            'jenisBansos',
            'totalPengajuan',
            'menunggu',
            'disetujui',
            'ditolak'
        ));
    }

    /**
     * Show detail pengajuan (JSON for modal)
     */
    public function showPengajuanBansos(PengajuanBansos $pengajuanBansos)
    {
        $pengajuanBansos->load('jenisBansos');
        
        return response()->json([
            'success' => true,
            'pengajuan' => $pengajuanBansos
        ]);
    }

    /**
     * Verify pengajuan bansos
     */
    public function verifyPengajuan(Request $request, PengajuanBansos $pengajuanBansos)
    {
        $validated = $request->validate([
            'status_pengajuan' => 'required|in:diverifikasi,disetujui,ditolak',
            'catatan_verifikasi' => 'nullable|string'
        ]);

        $validated['tanggal_verifikasi'] = now();
        $validated['verifikator'] = auth()->user()->name ?? 'Admin';

        $pengajuanBansos->update($validated);

        // Jika disetujui, otomatis tambahkan ke penerima bansos
        if ($validated['status_pengajuan'] === 'disetujui') {
            PenerimaBansos::create([
                'jenis_bansos_id' => $pengajuanBansos->jenis_bansos_id,
                'nik' => $pengajuanBansos->nik,
                'nama_lengkap' => $pengajuanBansos->nama_lengkap,
                'no_kk' => $pengajuanBansos->no_kk,
                'alamat' => $pengajuanBansos->alamat,
                'rt_rw' => $pengajuanBansos->rt_rw,
                'no_hp' => $pengajuanBansos->no_hp,
                'jumlah_tanggungan' => $pengajuanBansos->jumlah_tanggungan,
                'status_ekonomi' => 'miskin',
                'status_verifikasi' => 'diverifikasi',
                'keterangan' => 'Dari pengajuan online',
                'foto_rumah' => $pengajuanBansos->foto_rumah
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Pengajuan berhasil diverifikasi!'
        ]);
    }

    /**
     * Delete pengajuan
     */
    public function destroyPengajuanBansos(PengajuanBansos $pengajuanBansos)
    {
        // Delete files
        foreach (['foto_ktp', 'foto_kk', 'foto_rumah'] as $field) {
            if ($pengajuanBansos->$field) {
                Storage::delete('public/bansos/pengajuan/' . $pengajuanBansos->$field);
            }
        }

        $pengajuanBansos->delete();

        return redirect()->route('admin.bansos.pengajuan.index')
            ->with('success', 'Pengajuan berhasil dihapus!');
    }

    /**
     * Frontend - Riwayat pengajuan user
     */
    public function myPengajuan()
    {
        $user = auth('masyarakat')->user();
        
        $pengajuanSaya = PengajuanBansos::with('jenisBansos')
            ->where('nik', $user->nik)
            ->orWhere('no_hp', $user->no_hp)
            ->latest()
            ->get();

        return view('pages.bansos.my-pengajuan', compact('pengajuanSaya'));
    }

    /**
     * Admin - Laporan Bansos
     */
    public function adminLaporan(Request $request)
    {
        $tahun = $request->filled('tahun') ? $request->tahun : date('Y');
        $jenisBansosId = $request->jenis_bansos_id;

        // Query distribusi berdasarkan filter
        $query = DistribusiBansos::with(['jenisBansos', 'penerimaBansos'])
            ->tahun($tahun)
            ->where('status_penerimaan', 'diterima');

        if ($jenisBansosId) {
            $query->where('jenis_bansos_id', $jenisBansosId);
        }

        $distribusi = $query->get();

        // Statistik
        $totalDistribusi = $distribusi->count();
        $totalNominal = $distribusi->sum('nominal_diterima');
        $totalPenerima = $distribusi->unique('penerima_bansos_id')->count();

        // Data per jenis bantuan
        $dataPerJenis = JenisBansos::withCount([
            'distribusiBansos' => function ($query) use ($tahun) {
                $query->tahun($tahun)->where('status_penerimaan', 'diterima');
            }
        ])->get();

        $jenisBansos = JenisBansos::active()->get();
        $tahunList = DistribusiBansos::selectRaw('YEAR(tanggal_distribusi) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('admin.bansos.laporan.index', compact(
            'distribusi',
            'totalDistribusi',
            'totalNominal',
            'totalPenerima',
            'dataPerJenis',
            'jenisBansos',
            'tahunList',
            'tahun',
            'jenisBansosId'
        ));
    }

    /**
     * Export Laporan ke Excel/PDF
     */
    public function exportLaporan(Request $request)
    {
        // Implementasi export sesuai kebutuhan
        // Bisa menggunakan package seperti maatwebsite/excel atau barryvdh/laravel-dompdf
        
        return redirect()->back()->with('info', 'Fitur export sedang dalam pengembangan');
    }
}
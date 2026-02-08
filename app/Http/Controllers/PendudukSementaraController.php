<?php

namespace App\Http\Controllers;

use App\Models\PendudukSementara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PendudukSementaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendudukSementaras = PendudukSementara::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.kependudukan.sementara.index', compact('pendudukSementaras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kependudukan.sementara.create');    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|max:20|unique:penduduk_sementaras,nik',
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:LAKI-LAKI,PEREMPUAN',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string|max:20',
            'status_perkawinan' => 'required|in:BELUM KAWIN,KAWIN,CERAI HIDUP,CERAI MATI',
            'pendidikan_terakhir' => 'required|string|max:50',
            'jenis_pekerjaan' => 'required|string|max:50',
            'alamat_asal' => 'required',
            'alamat_sementara' => 'required',
            'tujuan_tinggal' => 'required|string|max:50',
            'estimasi_waktu' => 'required|string|max:50',
            'ktp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'kk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'surat_pengantar' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'pas_foto' => 'nullable|file|mimes:jpg,jpeg,png|max:1024',
        ]);

        $data = $request->except(['ktp', 'kk', 'surat_pengantar', 'pas_foto']);

        // Handle file uploads
        if ($request->hasFile('ktp')) {
            $data['ktp_path'] = $request->file('ktp')->store('dokumen/penduduk-sementara/ktp', 'public');
        }
        if ($request->hasFile('kk')) {
            $data['kk_path'] = $request->file('kk')->store('dokumen/penduduk-sementara/kk', 'public');
        }
        if ($request->hasFile('surat_pengantar')) {
            $data['surat_pengantar_path'] = $request->file('surat_pengantar')->store('dokumen/penduduk-sementara/surat-pengantar', 'public');
        }
        if ($request->hasFile('pas_foto')) {
            $data['pas_foto_path'] = $request->file('pas_foto')->store('dokumen/penduduk-sementara/pas-foto', 'public');
        }

        PendudukSementara::create($data);

        Log::info("Penduduk Sementara baru ditambahkan: {$request->nama} (NIK: {$request->nik})");

        return redirect()->route('penduduk-sementara.index')
            ->with('success', 'Data penduduk sementara berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PendudukSementara $sementara)
    {
        return view('admin.kependudukan.sementara.show', compact('sementara'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PendudukSementara $sementara)
    {
        return view('admin.kependudukan.sementara.edit', compact('sementara'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PendudukSementara $sementara)
    {
        $rules = [
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:LAKI-LAKI,PEREMPUAN',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string|max:20',
            'status_perkawinan' => 'required|in:BELUM KAWIN,KAWIN,CERAI HIDUP,CERAI MATI',
            'pendidikan_terakhir' => 'required|string|max:50',
            'jenis_pekerjaan' => 'required|string|max:50',
            'alamat_asal' => 'required',
            'alamat_sementara' => 'required',
            'tujuan_tinggal' => 'required|string|max:50',
            'estimasi_waktu' => 'required|string|max:50',
            'ktp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'kk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'surat_pengantar' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'pas_foto' => 'nullable|file|mimes:jpg,jpeg,png|max:1024',
        ];

        // Unique rule jika NIK berubah
        if ($request->nik != $sementara->nik) {
            $rules['nik'] = 'required|string|max:20|unique:penduduk_sementaras,nik';
        } else {
            $rules['nik'] = 'required|string|max:20';
        }

        $request->validate($rules);

        $data = $request->except(['ktp', 'kk', 'surat_pengantar', 'pas_foto']);

        // Handle file uploads
        if ($request->hasFile('ktp')) {
            // Delete old file
            if ($sementara->ktp_path) {
                Storage::disk('public')->delete($sementara->ktp_path);
            }
            $data['ktp_path'] = $request->file('ktp')->store('dokumen/penduduk-sementara/ktp', 'public');
        }
        if ($request->hasFile('kk')) {
            if ($sementara->kk_path) {
                Storage::disk('public')->delete($sementara->kk_path);
            }
            $data['kk_path'] = $request->file('kk')->store('dokumen/penduduk-sementara/kk', 'public');
        }
        if ($request->hasFile('surat_pengantar')) {
            if ($sementara->surat_pengantar_path) {
                Storage::disk('public')->delete($sementara->surat_pengantar_path);
            }
            $data['surat_pengantar_path'] = $request->file('surat_pengantar')->store('dokumen/penduduk-sementara/surat-pengantar', 'public');
        }
        if ($request->hasFile('pas_foto')) {
            if ($sementara->pas_foto_path) {
                Storage::disk('public')->delete($sementara->pas_foto_path);
            }
            $data['pas_foto_path'] = $request->file('pas_foto')->store('dokumen/penduduk-sementara/pas-foto', 'public');
        }

        $sementara->update($data);

        Log::info("Penduduk Sementara diperbarui: {$sementara->nama} (NIK: {$sementara->nik})");

        return redirect()->route('penduduk-sementara.index')
            ->with('success', 'Data penduduk sementara berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PendudukSementara $sementara)
    {
        // Delete files
        if ($sementara->ktp_path) {
            Storage::disk('public')->delete($sementara->ktp_path);
        }
        if ($sementara->kk_path) {
            Storage::disk('public')->delete($sementara->kk_path);
        }
        if ($sementara->surat_pengantar_path) {
            Storage::disk('public')->delete($sementara->surat_pengantar_path);
        }
        if ($sementara->pas_foto_path) {
            Storage::disk('public')->delete($sementara->pas_foto_path);
        }

        $nama = $sementara->nama;
        $nik = $sementara->nik;
        
        $sementara->delete();

        Log::info("Penduduk Sementara dihapus: {$nama} (NIK: {$nik})");

        return redirect()->route('penduduk-sementara.index')
            ->with('success', 'Data penduduk sementara berhasil dihapus!');
    }
}
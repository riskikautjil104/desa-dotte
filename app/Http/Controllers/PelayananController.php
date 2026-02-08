<?php

namespace App\Http\Controllers;

use App\Models\JenisPelayanan;
use App\Models\Pelayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PelayananController extends Controller
{
    public function front()
    {
        return view('pages.pelayannan.index', [
            'jenis_pelayanan' => JenisPelayanan::all()
        ]);
    }

    public function store(Request $request)
    {

        // dd($request->all());
        $rules = $request->validate([
            'fc_kk' => 'required|mimes:doc,docx,pdf|max:2048',
            'fc_ktp' => 'required|mimes:doc,docx,pdf|max:2048',
            'pengantar_rt_rw' => 'required|mimes:doc,docx,pdf|max:2048',
            'surat_pernyataan' => 'mimes:doc,docx,pdf|max:2048',
            'masyarakat_id' => 'required',
            'jenis_pelayanan_id' => 'required',
        ]);

        $rules['fc_kk'] = $request->file('fc_kk')->store('pelyananFile');
        $rules['fc_ktp'] = $request->file('fc_ktp')->store('pelyananFile');
        $rules['pengantar_rt_rw'] = $request->file('pengantar_rt_rw')->store('pelyananFile');

        if ($request->file('surat_pernyataan')) {
            $rules['surat_pernyataan'] = $request->file('surat_pernyataan')->store('pelyananFile');
        }

        Pelayanan::create($rules);
        return redirect()->route('pelayanan')->with('success', 'Berhasil Di Kirim');
    }

    public function index()
    {
        return view('admin.pelayanan.index', [
            'pelayanan' => Pelayanan::with(['masyarakat', 'jenisPelayanan'])->get()
        ]);
    }

    public function show(Pelayanan $pelayanan)
    {
        return view('admin.pelayanan.detail', [
            'pelayanan' => $pelayanan
        ]);
    }

    public function destroy(Pelayanan $pelayanan)
    {
        if ($pelayanan->fc_kk) {
            Storage::delete($pelayanan->fc_kk);
        }
        if ($pelayanan->fc_ktp) {
            Storage::delete($pelayanan->fc_ktp);
        }
        if ($pelayanan->surat_pernyataan) {
            Storage::delete($pelayanan->surat_pernyataan);
        }
        if ($pelayanan->pengantar_rt_rw) {
            Storage::delete($pelayanan->pengantar_rt_rw);
        }

        Pelayanan::destroy($pelayanan->id);
        return redirect()->route('pelayanan.index')->with('success', 'Pelayanan Berhasil Di Hapus');
    }
}

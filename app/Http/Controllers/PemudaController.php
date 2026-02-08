<?php

namespace App\Http\Controllers;

use App\Models\Pemuda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PemudaController extends Controller
{
    public function index() {
        return view('admin.profilKelurahan.strukturorganisasiPemuda',[
            'struktur_organisasi' => Pemuda::latest()->get()
        ]);
    }

    public function create() {
        return view('admin.profilKelurahan.strukturorganisasiPemuda');
    }

    public function store(Request $request) {

        // dd($request);
        $rules = $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        if ($request->file('gambar')) {
            $rules['gambar'] = $request->file('gambar')->store('struktur_organisasiGambar');
        }


        Pemuda::create($rules);
        return redirect()->route('strukturorganisasiPemuda.index')->with('success',$request->nama.' Berhasil Di Tambahkan');
    }


    public function update(Request $request, Pemuda $struktur_organisasi)
    {
        // dd($request->gambar);
        $rules = $request->validate([
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->file('gambar')) {
            if ($request->gambar) {
                Storage::delete($request->gambarlama);
            }
            
            $rules['gambar'] = $request->file('gambar')->store('struktur_organisasiGambar');
        }



        $struktur_organisasi->where('id', $struktur_organisasi->id)->update($rules);
        return redirect()->route('strukturorganisasiPemuda.index')->with('success',$struktur_organisasi->nama.' Berhasil Di Ubah');
    }

}

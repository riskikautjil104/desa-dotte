<?php

namespace App\Http\Controllers;

use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StrukturOrganisasiController extends Controller
{
    public function index() {
        return view('admin.profilKelurahan.strukturorganisasi',[
            'struktur_organisasi' => StrukturOrganisasi::latest()->get()
        ]);
    }

    public function create() {
        return view('admin.profilKelurahan.strukturorganisasi');
    }

    public function store(Request $request) {

        // dd($request);
        $rules = $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        if ($request->file('gambar')) {
            $rules['gambar'] = $request->file('gambar')->store('struktur_organisasiGambar');
        }


        StrukturOrganisasi::create($rules);
        return redirect()->route('organisasi.index')->with('success',$request->nama.' Berhasil Di Tambahkan');
    }


    public function update(Request $request, StrukturOrganisasi $struktur_organisasi)
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
        return redirect()->route('organisasi.index')->with('success',$struktur_organisasi->nama.' Berhasil Di Ubah');
    }

   
}

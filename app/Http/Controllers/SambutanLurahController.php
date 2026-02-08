<?php

namespace App\Http\Controllers;

use App\Models\SambutanLurah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SambutanLurahController extends Controller
{
    public function edit() {
        return view('admin.berita.sambutanlurah',[
            "sambutan" => SambutanLurah::all()
        ]);
    }

    public function update(Request $request, SambutanLurah $sambutan)
    {
        // dd([$request]);
        $rules = $request->validate([
            'nama_lurah'=>['required'],
            'sambutan_lurah' => 'required',
            'gambar_lurah' => 'image|mimes:jpeg,png,jpg|max:2048|unique:sambutan_lurah',
        ]);

        if ($request->file('gambar_lurah')) {
            if ($request->gambar_lurah) {
                Storage::delete($request->gambarlama);
            }
            
            $rules['gambar_lurah'] = $request->file('gambar_lurah')->store('GambarLurah');
        }


        $rules['slug'] = Str::slug($request->nama_lurah, '-');

        $sambutan->where('id', $sambutan->id)->update($rules);
        return redirect()->route('lurah.index')->with('success','Sambutan Lurah Berhasil Di Ubah');
    }

    public function store(Request $request)
    {
        // dd([$request]);
        $rules = $request->validate([
            'nama_lurah'=>['required'],
            'sambutan_lurah' => 'required',
            'gambar_lurah' => 'required|image|mimes:jpeg,png,jpg|max:2048|unique:sambutan_lurah',
        ]);

        if ($request->file('gambar_lurah')) {
          
            $rules['gambar_lurah'] = $request->file('gambar_lurah')->store('GambarLurah');
        }


        $rules['slug'] = Str::slug($request->nama_lurah, '-');
        
        SambutanLurah::create($rules);
        return redirect()->route('lurah.index')->with('success','Sambutan Lurah Berhasil Di Tambahkan');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {

        return view('admin.berita.index', [
            'beritas' => Berita::with([])->latest()->get()
        ]);
    }

    public function create()
    {
        return view('admin.berita.tambah');
    }

    public function store(Request $request)
    {

        // dd($request);
        $rules = $request->validate([
            'judul' => ['required', 'unique:beritas'],
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'isi' => 'required',
        ]);

        if ($request->file('gambar')) {
            $rules['gambar'] = $request->file('gambar')->store('beritaGambar');
        }
        $rules['slug'] = Str::slug($request->judul, '-');
        $rules['excerp'] = Str::limit(strip_tags($request->isi), 150);


        Berita::create($rules);
        return redirect()->route('berita.index')->with('success', 'Berita Berhasil Di Tambahkan');
    }

    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', [
            'berita' => $berita
        ]);
    }

    public function update(Request $request, Berita $berita)
    {
        // dd($request->gambar);
        $rules = $request->validate([
            'judul' => ['required'],
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048|unique:beritas',
            'isi' => 'required',
        ]);

        if ($request->file('gambar')) {
            if ($request->gambar) {
                Storage::delete($request->gambarlama);
            }

            $rules['gambar'] = $request->file('gambar')->store('beritaGambar');
        }

        $rules['slug'] = Str::slug($request->judul, '-');
        $rules['excerp'] = Str::limit(strip_tags($request->isi), 150);


        $berita->where('id', $berita->id)->update($rules);
        return redirect()->route('berita.index')->with('success', 'Berita Berhasil Di Ubah');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->gambar) {
            Storage::delete($berita->gambar);
        }

        Berita::destroy($berita->id);
        return redirect()->route('berita.index')->with('success', 'Berita Berhasil Di Hapus');
    }
}

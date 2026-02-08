<?php

// app/Http/Controllers/GaleriController.php
namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galleries = Galeri::latest()->get();
        return view('admin.publikasi.galeri', compact('galleries'));
    }

    public function create()
    {
        return view('galeri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image_path' => 'required|image',
        ]);

        $path = $request->file('image_path')->store('galeri', 'public');

        Galeri::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image_path' => $path,
        ]);

        return redirect()->route('galeris.index')->with('success', 'Galeri created successfully.');
    }

    // Metode untuk menghapus video
    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);
        
        // Menghapus file galeri dari storage
        if (Storage::disk('public')->exists($galeri->image_path)) {
            Storage::disk('public')->delete($galeri->image_path);
        }

        $galeri->delete();

        return redirect()->route('galeris.index')->with('success', 'galeri berhasil dihapus.');
    }

    public function front()
    {
        $galleries = Galeri::latest()->get(); // Ambil semua item galeri

        return view('pages.publikasi.galeri', compact('galleries'));
    }
}
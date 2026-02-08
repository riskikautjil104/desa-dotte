<?php

namespace App\Http\Controllers;

use App\Models\Pembiayaan;
use Illuminate\Http\Request;

class PembiayaanController extends Controller
{
    // Menampilkan halaman pembiayaan
    public function index()
    {
        $pembiayaan = Pembiayaan::all(); // Ambil semua data pembiayaan
        return view('admin.pembiayaan.index', compact('pembiayaan')); // Menampilkan ke view
    }

    // Menyimpan data pembiayaan baru
    public function store(Request $request)
    {
        // Menghilangkan simbol 'Rp', titik ribuan, dan spasi ekstra
        $jumlah = str_replace(['Rp', '.'], '', $request->jumlah);
        $jumlah = trim($jumlah); // Menghapus spasi tambahan
        
        // Validasi inputan
        $request->validate([
            'kategori_pembiayaan' => 'required|string|max:255',
            'jumlah' => 'required|numeric',  // Validasi sebagai angka
            'uraian' => 'nullable|string',
        ]);

        // Menyimpan data baru ke dalam database
        Pembiayaan::create([
            'kategori_pembiayaan' => $request->kategori_pembiayaan,
            'jumlah' => $jumlah,  // Menyimpan jumlah yang sudah dibersihkan dan valid
            'uraian' => $request->uraian,
        ]);

        return redirect()->route('pembiayaan.index')->with('success', 'Pembiayaan berhasil ditambahkan');
    }

    // Menghapus pembiayaan berdasarkan ID
    public function destroy($id)
    {
        $pembiayaan = Pembiayaan::findOrFail($id); // Menemukan pembiayaan berdasarkan ID
        $pembiayaan->delete(); // Menghapus pembiayaan

        return redirect()->route('pembiayaan.index')->with('success', 'Pembiayaan berhasil dihapus');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Belanja; // Pastikan model Belanja ada
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BelanjaController extends Controller
{
    // Menampilkan halaman belanja
    public function index()
    {
        $belanja = Belanja::all(); // Ambil semua data belanja
        return view('admin.belanja.index', compact('belanja')); // Menampilkan ke view
    }

    // Menyimpan data belanja baru
    public function store(Request $request)
    {
        // Menghilangkan simbol 'Rp', titik ribuan, dan spasi ekstra
        $jumlah = str_replace(['Rp', '.'], '', $request->jumlah);
        $jumlah = trim($jumlah); // Menghapus spasi tambahan
        
        // Validasi inputan
        $request->validate([
            'kategori_belanja' => [
        'required',
        'string',
                Rule::in([
                    'Penyelenggaraan Pemerintahan Desa',
                    'Pelaksanaan Pembangunan Desa',
                    'Pembinaan Kemasyarakatan Desa',
                    'Pemberdayaan Masyarakat Desa',
                    'Penanggulangan Bencana, Keadaan Darurat, dan Keadaan Mendesak Desa'
                ])
            ],
            'jumlah' => 'required|numeric',  // Validasi sebagai angka
            'uraian' => 'nullable|string',
        ]);

        // Menyimpan data baru ke dalam database
        Belanja::create([
            'kategori_belanja' => $request->kategori_belanja,
            'jumlah' => $jumlah,  // Menyimpan jumlah yang sudah dibersihkan dan valid
            'uraian' => $request->uraian,
        ]);

        return redirect()->route('belanja.index')->with('success', 'Belanja berhasil ditambahkan');
    }

    // Menghapus belanja berdasarkan ID
    public function destroy($id)
    {
        $belanja = Belanja::findOrFail($id); // Menemukan belanja berdasarkan ID
        $belanja->delete(); // Menghapus belanja

        return redirect()->route('belanja.index')->with('success', 'Belanja berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Pendapatan;
use Illuminate\Http\Request;

class PendapatanController extends Controller
{
    // Menampilkan halaman pendapatan
    public function index()
    {
        $pendapatan = Pendapatan::all(); // Ambil semua data pendapatan
        return view('admin.pendapatan.index', compact('pendapatan')); // Menampilkan ke view
    }

    // Menyimpan data pendapatan baru
    public function store(Request $request)
    {
        // Menghilangkan simbol 'Rp', titik ribuan, dan spasi ekstra
        $jumlah = str_replace(['Rp', '.'], '', $request->jumlah);
        $jumlah = trim($jumlah); // Menghapus spasi tambahan
        
        // Pastikan nilai jumlah adalah angka yang valid
        // $jumlah = is_numeric($jumlah) ? floatval($jumlah) : 0; // Ubah menjadi float jika valid, atau 0 jika tidak valid

    
            // Validasi inputan
            $request->validate([
                'kategori_pendapatan' => 'required|string|max:255',
                'jumlah' => 'required|numeric',  // Validasi sebagai angka
                'uraian' => 'nullable|string',
            ]);

            // Menyimpan data baru ke dalam database
            Pendapatan::create([
                'kategori_pendapatan' => $request->kategori_pendapatan,
                'jumlah' => $jumlah,  // Menyimpan jumlah yang sudah dibersihkan dan valid
                'uraian' => $request->uraian,
            ]);

            return redirect()->route('pendapatan.index')->with('success', 'Pendapatan berhasil ditambahkan');
    
    }



    // Menghapus pendapatan berdasarkan ID
    public function destroy($id)
    {
        $pendapatan = Pendapatan::findOrFail($id); // Menemukan pendapatan berdasarkan ID
        $pendapatan->delete(); // Menghapus pendapatan

        return redirect()->route('pendapatan.index')->with('success', 'Pendapatan berhasil dihapus');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Belanja extends Model
{
    use HasFactory;
    // Tentukan tabel yang digunakan (jika berbeda dengan nama default)
    protected $table = 'belanja';

    // Tentukan kolom yang dapat diisi (mass assignment)
    protected $fillable = [
        'kategori_belanja', // Kategori pendapatan (e.g., Pendapatan Asli Desa)
        'jumlah',              // Jumlah pendapatan
        'uraian',              // Deskripsi pendapatan
    ];

    // Jika Anda ingin memformat kolom 'jumlah' dengan format tertentu, misalnya:
    protected $casts = [
        'jumlah' => 'decimal:2',
    ];

    // Jika Anda memiliki relasi lain, misalnya ke model lain (contohnya: User atau Desa), Anda bisa menambahkannya di sini.
}

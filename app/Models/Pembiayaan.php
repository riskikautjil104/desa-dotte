<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembiayaan extends Model
{
    use HasFactory;

    protected $table = 'pembiayaan';
    protected $fillable = [
        'kategori_pembiayaan', // Kategori pendapatan (e.g., Pendapatan Asli Desa)
        'jumlah',              // Jumlah pendapatan
        'uraian',              // Deskripsi pendapatan
    ];
}

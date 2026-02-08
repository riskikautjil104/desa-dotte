<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendudukPindah extends Model
{
    use HasFactory;

    protected $table = 'penduduk_pindah';

    protected $fillable = [
        'nik',
        'nama',
        'tanggal_pindah',
        'alamat_asal',
        'tujuan_pindah',
        'alasan_pindah',
        'jenis_pindah',
    ];
}


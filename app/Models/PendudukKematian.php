<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendudukKematian extends Model
{
    use HasFactory;

    protected $table = 'penduduk_kematian';

    protected $fillable = [
        'nik',
        'nama',
        'tanggal_kematian',
        'sebab_kematian',
        'tempat_kematian',
        'yang_melaporkan',
        'hub_dengan_almarhum',
    ];
}


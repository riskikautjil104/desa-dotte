<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemuda extends Model
{
    use HasFactory;
    protected $table = 'struktur_organisasi_pemuda';

    protected $guarded = ['id'];
}

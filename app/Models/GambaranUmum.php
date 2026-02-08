<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambaranUmum extends Model
{
    use HasFactory;

    protected $table = 'gambaran_umum';

    protected $guarded = ['id'];
}

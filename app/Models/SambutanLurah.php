<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SambutanLurah extends Model
{
    use HasFactory;

    protected $table = 'sambutan_lurah';

    protected $guarded = ['id'];
}

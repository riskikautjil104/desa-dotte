<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pendidikan extends Model
{
    use HasFactory;

    protected $table = 'pendidikan';

    protected $guarded = ['id'];

    public function datapenduduk(): HasMany
    {
        return $this->hasMany(Datapenduduk::class,'id_pendidikan','id');
    }
}

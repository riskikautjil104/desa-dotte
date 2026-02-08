<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pekerjaan extends Model
{
    use HasFactory;

    protected $table = 'pekerjaan';

    protected $guarded = ['id'];

    public function datapenduduk(): HasMany
    {
        return $this->hasMany(Datapenduduk::class,'id_pekerjaan','id');
    }
}

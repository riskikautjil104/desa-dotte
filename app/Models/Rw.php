<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rw extends Model
{
    use HasFactory;

    protected $table = 'rw';

    protected $guarded = ['id'];

    protected $fillable = ['nama_rw', 'latitude', 'longitude'];

    public function datapenduduk(): HasMany
    {
        return $this->hasMany(Datapenduduk::class,'id_rw','id');
    }
}

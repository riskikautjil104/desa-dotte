<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rt extends Model
{
    use HasFactory;

    protected $table = 'rt';

    protected $guarded = ['id'];

    protected $fillable = ['nama_rt', 'latitude', 'longitude'];

    public function datapenduduk(): HasMany
    {
        return $this->hasMany(Datapenduduk::class,'id_rt','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Datapenduduk extends Model
{
    use HasFactory;

    protected $table = 'datapenduduks';

    protected $guarded = ['id'];

    public function rt(): BelongsTo
    {
        return $this->belongsTo(Rt::class,'id_rt','id');
    }
    
    public function rw(): BelongsTo
    {
        return $this->belongsTo(Rw::class,'id_rw','id');
    }
    
    public function pekerjaan(): BelongsTo
    {
        return $this->belongsTo(Pekerjaan::class,'id_pekerjaan','id');
    }

    public function pendidikan(): BelongsTo
    {
        return $this->belongsTo(Pendidikan::class,'id_pendidikan','id');
    }
}

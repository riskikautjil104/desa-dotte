<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class PengantarSKCK extends Model
{
    use HasFactory;

    protected $tabel = 'pengantar_skck';

    protected $fillable = [
        'fc_kk',
        'fc_ktp',
        'pengantar_rt_rw',
        'masyarakat_id',
    ];

    public function masyarakat(): BelongsTo
    {
        return $this->belongsTo(Masyarakat::class,'masyarakat_id','id');
    }
}

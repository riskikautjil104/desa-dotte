<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pelayanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'fc_kk',
        'fc_ktp',
        'surat_pernyataan',
        'pengantar_rt_rw',
        'masyarakat_id',
        'jenis_pelayanan_id',
    ];

    public function masyarakat(): BelongsTo
    {
        return $this->belongsTo(Masyarakat::class,'masyarakat_id','id');
    }

    public function jenisPelayanan(): BelongsTo
    {
        return $this->belongsTo(JenisPelayanan::class,'jenis_pelayanan_id','id');
    }
}

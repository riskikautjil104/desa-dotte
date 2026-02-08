<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendudukSementara extends Model
{
    use HasFactory;

    protected $table = 'penduduk_sementaras';

    // Gunakan 'id' sebagai route key
    public function getRouteKeyName()
    {
        return 'id';
    }

    protected $fillable = [
        'nik',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'status_perkawinan',
        'pendidikan_terakhir',
        'jenis_pekerjaan',
        'alamat_asal',
        'alamat_sementara',
        'tujuan_tinggal',
        'estimasi_waktu',
        'ktp_path',
        'kk_path',
        'surat_pengantar_path',
        'pas_foto_path',
        'status',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'status' => 'boolean',
    ];

    // Accessor untuk usia
    public function getUsiaAttribute()
    {
        return $this->tanggal_lahir ? $this->tanggal_lahir->age : null;
    }

    // Scope untuk data aktif
    public function scopeAktif($query)
    {
        return $query->where('status', true);
    }

    // Scope berdasarkan tujuan tinggal
    public function scopeByTujuan($query, $tujuan)
    {
        return $query->where('tujuan_tinggal', $tujuan);
    }
}

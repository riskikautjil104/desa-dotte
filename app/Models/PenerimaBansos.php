<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaBansos extends Model
{
    use HasFactory;

    protected $table = 'penerima_bansos';

    protected $fillable = [
        'jenis_bansos_id',
        'nik',
        'nama_lengkap',
        'no_kk',
        'alamat',
        'rt_rw',
        'no_hp',
        'jumlah_tanggungan',
        'status_ekonomi',
        'status_verifikasi',
        'keterangan',
        'foto_rumah'
    ];

    protected $casts = [
        'jumlah_tanggungan' => 'integer'
    ];

    // Relationships
    public function jenisBansos()
    {
        return $this->belongsTo(JenisBansos::class);
    }

    public function distribusiBansos()
    {
        return $this->hasMany(DistribusiBansos::class);
    }

    // Scopes
    public function scopeVerified($query)
    {
        return $query->where('status_verifikasi', 'diverifikasi');
    }

    public function scopeStatusEkonomi($query, $status)
    {
        return $query->where('status_ekonomi', $status);
    }

    // Accessors
    public function getStatusEkonomiLabelAttribute()
    {
        $labels = [
            'sangat_miskin' => 'Sangat Miskin',
            'miskin' => 'Miskin',
            'rentan_miskin' => 'Rentan Miskin'
        ];
        return $labels[$this->status_ekonomi] ?? ucfirst($this->status_ekonomi);
    }

    public function getStatusVerifikasiLabelAttribute()
    {
        $labels = [
            'menunggu' => 'Menunggu Verifikasi',
            'diverifikasi' => 'Terverifikasi',
            'ditolak' => 'Ditolak'
        ];
        return $labels[$this->status_verifikasi] ?? ucfirst($this->status_verifikasi);
    }

    public function getTotalPenerimaanAttribute()
    {
        return $this->distribusiBansos()
            ->where('status_penerimaan', 'diterima')
            ->sum('nominal_diterima');
    }
}
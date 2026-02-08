<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistribusiBansos extends Model
{
    use HasFactory;

    protected $table = 'distribusi_bansos';

    protected $fillable = [
        'penerima_bansos_id',
        'jenis_bansos_id',
        'periode',
        'tanggal_distribusi',
        'nominal_diterima',
        'barang_diterima',
        'status_penerimaan',
        'bukti_penerimaan',
        'catatan',
        'tanggal_diterima',
        'petugas'
    ];

    protected $casts = [
        'nominal_diterima' => 'decimal:2',
        'tanggal_distribusi' => 'date',
        'tanggal_diterima' => 'datetime',
        'barang_diterima' => 'array'
    ];

    // Relationships
    public function penerimaBansos()
    {
        return $this->belongsTo(PenerimaBansos::class);
    }

    public function jenisBansos()
    {
        return $this->belongsTo(JenisBansos::class);
    }

    // Scopes
    public function scopePeriode($query, $periode)
    {
        return $query->where('periode', $periode);
    }

    public function scopeStatusPenerimaan($query, $status)
    {
        return $query->where('status_penerimaan', $status);
    }

    public function scopeTahun($query, $tahun)
    {
        return $query->where('periode', 'like', "$tahun%");
    }

    // Accessors
    public function getStatusPenerimaanLabelAttribute()
    {
        $labels = [
            'terjadwal' => 'Terjadwal',
            'diterima' => 'Sudah Diterima',
            'ditunda' => 'Ditunda',
            'dibatalkan' => 'Dibatalkan'
        ];
        return $labels[$this->status_penerimaan] ?? ucfirst($this->status_penerimaan);
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'terjadwal' => 'badge-info',
            'diterima' => 'badge-success',
            'ditunda' => 'badge-warning',
            'dibatalkan' => 'badge-danger'
        ];
        return $badges[$this->status_penerimaan] ?? 'badge-secondary';
    }
}
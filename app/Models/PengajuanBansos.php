<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanBansos extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_bansos';

    protected $fillable = [
        'jenis_bansos_id',
        'nik',
        'nama_lengkap',
        'no_kk',
        'alamat',
        'rt_rw',
        'no_hp',
        'jumlah_tanggungan',
        'penghasilan_perbulan',
        'alasan_pengajuan',
        'status_pengajuan',
        'catatan_verifikasi',
        'tanggal_verifikasi',
        'verifikator',
        'foto_ktp',
        'foto_kk',
        'foto_rumah'
    ];

    protected $casts = [
        'jumlah_tanggungan' => 'integer',
        'penghasilan_perbulan' => 'decimal:2',
        'tanggal_verifikasi' => 'datetime'
    ];

    // Relationships
    public function jenisBansos()
    {
        return $this->belongsTo(JenisBansos::class);
    }

    // Scopes
    public function scopeStatusPengajuan($query, $status)
    {
        return $query->where('status_pengajuan', $status);
    }

    // Accessors
    public function getStatusPengajuanLabelAttribute()
    {
        $labels = [
            'menunggu' => 'Menunggu Verifikasi',
            'diverifikasi' => 'Sedang Diverifikasi',
            'disetujui' => 'Disetujui',
            'ditolak' => 'Ditolak'
        ];
        return $labels[$this->status_pengajuan] ?? ucfirst($this->status_pengajuan);
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'menunggu' => 'badge-warning',
            'diverifikasi' => 'badge-info',
            'disetujui' => 'badge-success',
            'ditolak' => 'badge-danger'
        ];
        return $badges[$this->status_pengajuan] ?? 'badge-secondary';
    }
}
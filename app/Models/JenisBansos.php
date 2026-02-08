<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// ============================================
// Model JenisBansos
// ============================================
class JenisBansos extends Model
{
    use HasFactory;

    protected $table = 'jenis_bansos';

    protected $fillable = [
        'nama_bantuan',
        'kode_bantuan',
        'deskripsi',
        'kategori',
        'sumber_dana',
        'nominal_bantuan',
        'jenis_bantuan',
        'is_active'
    ];

    protected $casts = [
        'nominal_bantuan' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    // Relationships
    public function penerimaBansos()
    {
        return $this->hasMany(PenerimaBansos::class);
    }

    public function distribusiBansos()
    {
        return $this->hasMany(DistribusiBansos::class);
    }

    public function pengajuanBansos()
    {
        return $this->hasMany(PengajuanBansos::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    // Accessors
    public function getKategoriLabelAttribute()
    {
        $labels = [
            'reguler' => 'Bantuan Reguler',
            'darurat' => 'Bantuan Darurat',
            'khusus' => 'Bantuan Khusus',
            'musiman' => 'Bantuan Musiman'
        ];
        return $labels[$this->kategori] ?? ucfirst($this->kategori);
    }

    public function getSumberDanaLabelAttribute()
    {
        $labels = [
            'apbd' => 'APBD Kabupaten',
            'apbn' => 'APBN',
            'desa' => 'APBDes',
            'lainnya' => 'Lainnya'
        ];
        return $labels[$this->sumber_dana] ?? ucfirst($this->sumber_dana);
    }

    public function getJumlahPenerimaAttribute()
    {
        return $this->penerimaBansos()->where('status_verifikasi', 'diverifikasi')->count();
    }

    public function getTotalNominalDistribusiAttribute()
    {
        return $this->distribusiBansos()
            ->where('status_penerimaan', 'diterima')
            ->sum('nominal_diterima');
    }
}
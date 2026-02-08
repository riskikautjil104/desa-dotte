<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PPID extends Model
{
    use HasFactory;

    // PENTING: Tentukan nama tabel yang benar
    // Jika migration membuat tabel 'ppid', uncomment baris ini
    protected $table = 'ppids'; // Laravel default: pluralize nama model

    protected $fillable = [
        'judul',
        'kategori',
        'deskripsi',
        'file_path',
        'status',
        'tanggal_publikasi'
    ];

    protected $casts = [
        'status' => 'boolean',
        'tanggal_publikasi' => 'datetime',
    ];

    // Scope untuk data aktif
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    // Scope berdasarkan kategori
    public function scopeByCategory($query, $category)
    {
        return $query->where('kategori', $category);
    }

    // Accessor untuk kategori label
    public function getKategoriLabelAttribute()
    {
        $labels = [
            'informasiBerkala' => 'Informasi Berkala',
            'informasiSertaMerta' => 'Informasi Serta Merta',
            'informasiSetiapSaat' => 'Informasi Setiap Saat',
            'informasiDikecualikan' => 'Informasi Dikecualikan',
            'laporan' => 'Laporan',
            'dokumen' => 'Dokumen'
        ];

        return $labels[$this->kategori] ?? $this->kategori;
    }

    // Accessor untuk icon kategori
    public function getKategoriIconAttribute()
    {
        $icons = [
            'informasiBerkala' => 'bi-clock',
            'informasiSertaMerta' => 'bi-lightning',
            'informasiSetiapSaat' => 'bi-cloud-download',
            'informasiDikecualikan' => 'bi-shield-lock',
            'laporan' => 'bi-file-earmark-text',
            'dokumen' => 'bi-file-earmark'
        ];

        return $icons[$this->kategori] ?? 'bi-file-earmark';
    }
}
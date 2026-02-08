<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UMKM extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_usaha',
        'pemilik',
        'kategori',
        'deskripsi',
        'alamat',
        'no_hp',
        'email',
        'instagram',
        'facebook',
        'gambar_utama',
        'galeri',
        'status',
        'latitude',
        'longitude',
        'views',
        'is_featured'
    ];

    protected $casts = [
        'galeri' => 'array',           // Otomatis convert JSON ke array
        'is_featured' => 'boolean',
        'views' => 'integer',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    // Scope untuk UMKM yang aktif
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    // Scope untuk UMKM featured
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Scope untuk UMKM berdasarkan kategori
    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    // Accessor untuk kategori dengan label yang lebih user-friendly
    public function getKategoriLabelAttribute()
    {
        $labels = [
            'makanan' => 'Makanan & Minuman',
            'minuman' => 'Minuman',
            'fashion' => 'Fashion & Pakaian',
            'jasa' => 'Jasa',
            'kerajinan' => 'Kerajinan Tangan',
            'teknologi' => 'Teknologi',
            'lainnya' => 'Lainnya'
        ];

        return $labels[$this->kategori] ?? ucfirst($this->kategori);
    }

    // Accessor untuk status dengan badge class
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'aktif' => 'bg-success',
            'nonaktif' => 'bg-secondary',
            'verifikasi' => 'bg-warning'
        ];

        return $badges[$this->status] ?? 'bg-primary';
    }

    // Method untuk mendapatkan UMKM terdekat berdasarkan koordinat
    public function scopeTerdekat($query, $latitude, $longitude, $radius = 10)
    {
        return $query->selectRaw('*, 
            (6371 * acos(cos(radians(' . $latitude . ')) * 
            cos(radians(latitude)) * 
            cos(radians(longitude) - radians(' . $longitude . ')) + 
            sin(radians(' . $latitude . ')) * 
            sin(radians(latitude)))) AS distance')
            ->having('distance', '<', $radius)
            ->orderBy('distance');
    }
}

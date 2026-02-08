<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'jam_mulai',
        'jam_selesai',
        'lokasi',
        'pembicara',
        'kategori',
        'status',
        'gambar',
        'views',
        'is_published'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'jam_mulai' => 'datetime:H:i:s',   // atau 'time' jika hanya jam
        'jam_selesai' => 'datetime:H:i:s',
        'is_published' => 'boolean',
    ];

    // Scope untuk agenda yang sudah dipublish
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    // Scope untuk agenda berdasarkan status
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Scope untuk agenda berdasarkan kategori
    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    // Accessor untuk format tanggal
    public function getTanggalFormattedAttribute()
    {
        if ($this->tanggal_selesai && $this->tanggal_mulai != $this->tanggal_selesai) {
            return $this->tanggal_mulai->format('d M') . ' - ' . $this->tanggal_selesai->format('d M Y');
        }
        return $this->tanggal_mulai->format('d M Y');
    }

    // Accessor untuk format jam
    public function getJamFormattedAttribute()
    {
        if ($this->jam_mulai && $this->jam_selesai) {
            return $this->jam_mulai->format('H:i') . ' - ' . $this->jam_selesai->format('H:i');
        } elseif ($this->jam_mulai) {
            return $this->jam_mulai->format('H:i');
        }
        return null;
    }
}

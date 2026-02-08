<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'alamat',
        'kategori',
        'judul',
        'deskripsi',
        'status',
        'views',
        'votes',
        'tanggapan',
        'tanggal_tanggapan',
        'foto'
    ];

    protected $casts = [
        'tanggal_tanggapan' => 'datetime',
    ];

    // Scope untuk aspirai berdasarkan status
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Scope untuk aspirai berdasarkan kategori
    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    // Scope untuk aspirai yang sudah direspon
    public function scopeResponded($query)
    {
        return $query->whereNotNull('tanggapan');
    }

    // Accessor untuk kategori dengan label yang lebih user-friendly
    public function getKategoriLabelAttribute()
    {
        $labels = [
            'infrastruktur' => 'Infrastruktur',
            'pendidikan' => 'Pendidikan',
            'kesehatan' => 'Kesehatan',
            'ekonomi' => 'Ekonomi',
            'sosial' => 'Sosial',
            'lingkungan' => 'Lingkungan',
            'lainnya' => 'Lainnya'
        ];

        return $labels[$this->kategori] ?? ucfirst($this->kategori);
    }

    // Accessor untuk status dengan badge class
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'baru' => 'bg-primary',
            'diproses' => 'bg-warning',
            'selesai' => 'bg-success',
            'ditolak' => 'bg-danger'
        ];

        return $badges[$this->status] ?? 'bg-secondary';
    }

    // Accessor untuk status dengan teks yang lebih deskriptif
    public function getStatusTextAttribute()
    {
        $texts = [
            'baru' => 'Baru',
            'diproses' => 'Dalam Proses',
            'selesai' => 'Selesai',
            'ditolak' => 'Ditolak'
        ];

        return $texts[$this->status] ?? ucfirst($this->status);
    }

    // Method untuk memberikan vote
    public function addVote()
    {
        $this->increment('votes');
    }

    // Method untuk menghapus vote
    public function removeVote()
    {
        if ($this->votes > 0) {
            $this->decrement('votes');
        }
    }

    // Method untuk increment views
    public function incrementViews()
    {
        $this->increment('views');
    }
}

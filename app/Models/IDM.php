<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IDM extends Model
{
    use HasFactory;

    protected $table = 'idms'; // PENTING: Tambahkan ini!

    protected $fillable = [
        'tahun',
        'skor',
        'deskripsi',
        'status'
    ];

    protected $casts = [
        'tahun' => 'integer',
        'skor' => 'decimal:2',
        'status' => 'boolean',
    ];

    // Scope untuk data aktif
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    // Scope untuk tahun tertentu
    public function scopeByYear($query, $year)
    {
        return $query->where('tahun', $year);
    }

    // Accessor untuk kategori
    public function getKategoriAttribute()
    {
        if ($this->skor >= 80) {
            return 'Mandiri';
        } elseif ($this->skor >= 60) {
            return 'Berkembang';
        } else {
            return 'Tertinggal';
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infografis extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'jenis_infografis',
        'data_json',
        'gambar_path',
        'status',
        'urutan'
    ];

    protected $casts = [
        'status' => 'boolean',
        'data_json' => 'array',
    ];

    // Scope untuk data aktif
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    // Scope berdasarkan jenis infografis
    public function scopeByType($query, $type)
    {
        return $query->where('jenis_infografis', $type);
    }

    // Scope berdasarkan urutan
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc');
    }

    // Accessor untuk jenis infografis label
    public function getJenisLabelAttribute()
    {
        $labels = [
            'penduduk' => 'Data Penduduk',
            'ekonomi' => 'Data Ekonomi',
            'sosial' => 'Data Sosial',
            'geografis' => 'Data Geografis',
            'umum' => 'Data Umum',
            'program' => 'Program Desa'
        ];

        return $labels[$this->jenis_infografis] ?? $this->jenis_infografis;
    }

    // Accessor untuk icon jenis infografis
    public function getJenisIconAttribute()
    {
        $icons = [
            'penduduk' => 'bi-people',
            'ekonomi' => 'bi-graph-up',
            'sosial' => 'bi-heart',
            'geografis' => 'bi-geo-alt',
            'umum' => 'bi-info-circle',
            'program' => 'bi-gear'
        ];

        return $icons[$this->jenis_infografis] ?? 'bi-bar-chart';
    }

    // Method untuk mendapatkan warna berdasarkan jenis
    public function getJenisColorAttribute()
    {
        $colors = [
            'penduduk' => '#0D92F4',
            'ekonomi' => '#28a745',
            'sosial' => '#dc3545',
            'geografis' => '#6f42c1',
            'umum' => '#ffc107',
            'program' => '#17a2b8'
        ];

        return $colors[$this->jenis_infografis] ?? '#6c757d';
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_dokumen',
        'deskripsi',
        'jenis_dokumen_id',
        'file_path',
        'nama_file_asli',
        'ukuran_file',
        'tipe_file',
        'is_published',
        'download_count',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    protected $attributes = [
        'is_published' => true,
    ];

    public function jenisDokumen()
    {
        return $this->belongsTo(JenisDokumen::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function getUkuranFileFormattedAttribute()
    {
        $bytes = $this->ukuran_file;

        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        }

        return $bytes . ' B';
    }

    /**
     * Get formatted download count
     */
    public function getFormattedDownloadCountAttribute()
    {
        $count = $this->download_count ?? 0;

        if ($count >= 1000000) {
            return number_format($count / 1000000, 1) . 'M';
        } elseif ($count >= 1000) {
            return number_format($count / 1000, 1) . 'K';
        }

        return (string) $count;
    }

    /**
     * Increment download count
     */
    public function incrementDownloadCount()
    {
        $this->increment('download_count');
    }
}

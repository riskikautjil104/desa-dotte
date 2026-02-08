<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratOnline extends Model
{
    use HasFactory;

    // PENTING: Sesuaikan dengan nama tabel di migration Anda
    protected $table = 'surat_onlines';

    protected $fillable = [
        'nomor_surat',
        'nama_pemohon',
        'nik',
        'email',
        'no_hp',
        'alamat',
        'jenis_surat',
        'keterangan',
        'status',
        'catatan_admin',
        'file_hasil',
        'tanggal_selesai'
    ];

    protected $casts = [
        'tanggal_selesai' => 'datetime',
    ];

    /**
     * Generate nomor surat otomatis
     */
    public static function generateNomorSurat()
    {
        $prefix = 'SO'; // Surat Online
        $year = date('Y');
        $month = date('m');
        
        // Get last number for this month
        $lastSurat = self::whereYear('created_at', $year)
                        ->whereMonth('created_at', $month)
                        ->orderBy('id', 'desc')
                        ->first();
        
        $number = 1;
        if ($lastSurat) {
            // Extract number from last nomor_surat
            $parts = explode('/', $lastSurat->nomor_surat);
            if (count($parts) > 0) {
                $number = intval($parts[0]) + 1;
            }
        }
        
        // Format: 001/SO/XI/2024
        return sprintf('%03d/%s/%s/%s', $number, $prefix, self::getRomanMonth($month), $year);
    }

    /**
     * Convert month number to Roman numeral
     */
    private static function getRomanMonth($month)
    {
        $romans = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI',
            7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
        ];
        return $romans[intval($month)];
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Get jenis surat label
     */
    public function getJenisSuratLabelAttribute()
    {
        $labels = [
            'keterangan_tinggal' => 'Surat Keterangan Tinggal',
            'skck' => 'Pengantar SKCK',
            'keterangan_usaha' => 'Surat Keterangan Usaha',
            'keterangan_tidak_mampu' => 'Surat Keterangan Tidak Mampu',
            'keterangan_domisili' => 'Surat Keterangan Domisili',
            'keterangan_lain' => 'Keterangan Lainnya'
        ];

        return $labels[$this->jenis_surat] ?? $this->jenis_surat;
    }

    /**
     * Get status text
     */
    public function getStatusTextAttribute()
    {
        $statuses = [
            'menunggu' => 'Menunggu Verifikasi',
            'diproses' => 'Sedang Diproses',
            'selesai' => 'Selesai',
            'ditolak' => 'Ditolak'
        ];

        return $statuses[$this->status] ?? $this->status;
    }

    /**
     * Get status badge color
     */
    public function getStatusColorAttribute()
    {
        $colors = [
            'menunggu' => 'warning',
            'diproses' => 'info',
            'selesai' => 'success',
            'ditolak' => 'danger'
        ];

        return $colors[$this->status] ?? 'secondary';
    }
}
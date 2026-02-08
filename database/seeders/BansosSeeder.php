<?php

namespace Database\Seeders;

use App\Models\JenisBansos;
use Illuminate\Database\Seeder;

class BansosSeeder extends Seeder
{
    public function run(): void
    {
        // Use firstOrCreate to avoid duplicate errors
        JenisBansos::firstOrCreate(
            ['kode_bantuan' => 'BLT-001'],
            [
                'nama_bantuan' => 'Bantuan Langsung Tunai (BLT)',
                'kategori' => 'reguler',
                'sumber_dana' => 'apbn',
                'nominal_bantuan' => 300000,
                'jenis_bantuan' => 'uang',
                'deskripsi' => 'Bantuan tunai untuk keluarga tidak mampu',
                'is_active' => true
            ]
        );

        JenisBansos::firstOrCreate(
            ['kode_bantuan' => 'SEMBAKO-001'],
            [
                'nama_bantuan' => 'Bantuan Sembako',
                'kategori' => 'reguler',
                'sumber_dana' => 'desa',
                'jenis_bantuan' => 'barang',
                'deskripsi' => 'Paket sembako bulanan untuk warga kurang mampu',
                'is_active' => true
            ]
        );

        JenisBansos::firstOrCreate(
            ['kode_bantuan' => 'DARURAT-001'],
            [
                'nama_bantuan' => 'Bantuan Darurat Bencana',
                'kategori' => 'darurat',
                'sumber_dana' => 'apbd',
                'nominal_bantuan' => 500000,
                'jenis_bantuan' => 'campuran',
                'deskripsi' => 'Bantuan untuk korban bencana alam',
                'is_active' => true
            ]
        );
    }
}

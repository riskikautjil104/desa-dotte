<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SambutanLurahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sambutan_lurah')->insert([
            'nama_lurah' => 'H. Muhammad Yusuf, S.Pd',
            'sambutan_lurah' => '<p><strong>Assalamu\'alaikum Wr. Wb.</strong></p>
            <p>Segala puji bagi Allah SWT yang telah melimpahkan rahmat dan karuniaNya kepada kita semua. Sholawat serta salam kita sampaikan kepada Nabi Muhammad SAW, keluarga, para sahabat, dan seluruh umat muslimin.</p>
            <p>Dengan penuh rasa syukur, saya sampaikan selamat datang di website resmi Desa Dotte. Website ini merupakan wujud komitmen kami dalam meningkatkan transparansi dan keterbukaan informasi kepada masyarakat.</p>
            <p>Kami menyadari bahwa pembangunan desa tidak dapat terwujud tanpa partisipasi aktif seluruh warga. Melalui media ini, kami berharap dapat memberikan informasi yang akurat, cepat, dan terpercaya mengenai berbagai program dan kegiatan pembangunan di desa kita.</p>
            <p>Saya mengajak seluruh warga untuk bersama-sama membangun desa yang lebih maju, sejahtera, dan berakhlak mulia. Mari kita tingkatkan gotong royong dan saling bergotong royong untuk mewujudkan Desa Dotte yang lebih baik.</p>
            <p><strong>Wassalamu\'alaikum Wr. Wb.</strong></p>',
            'gambar_lurah' => 'GambarLurah/iKiqqvDo5dbdEnl8xe3t0UV4vr6KVcGyiHyJ0kCf.png',
            'slug' => 'sambutan-kepala-desa-dotte',
            'views' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}


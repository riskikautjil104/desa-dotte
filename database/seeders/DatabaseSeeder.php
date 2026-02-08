<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed roles dan admin users terlebih dahulu
        $this->call([
            // AdminSeeder::class,
            BansosSeeder::class, 
            BeritaSeeder::class, 
            // DatapendudukSeeder::class,
        ]);

        // Seed data lainnya
        // $this->call([
        //     BeritaSeeder::class,
        // ]);
    }
}

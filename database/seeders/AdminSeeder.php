<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles (use firstOrCreate to avoid duplicates)
        $roles = [
            ['nama' => 'Admin'],
            ['nama' => 'Lurah'],
            ['nama' => 'Staff'],
            ['nama' => 'Masyarakat'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['nama' => $role['nama']], $role);
        }

        // Create admin user
        $adminRole = Role::where('nama', 'Admin')->first();

        User::firstOrCreate(
            ['email' => 'admin@desa-sabala.com'],
            [
                'name' => 'Administrator Desa',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
                'role_id' => $adminRole->id,
            ]
        );

        // Create lurah user
        $lurahRole = Role::where('nama', 'Lurah')->first();

        User::firstOrCreate(
            ['email' => 'lurah@desa-kotalo.com'],
            [
                'name' => 'Kepala Desa Kotalo',
                'password' => Hash::make('lurah123'),
                'email_verified_at' => now(),
                'role_id' => $lurahRole->id,
            ]
        );

        // Create sample masyarakat user
        $masyarakatRole = Role::where('nama', 'Masyarakat')->first();

        User::firstOrCreate(
            ['email' => 'warga@contoh.com'],
            [
                'name' => 'Warga Contoh',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role_id' => $masyarakatRole->id,
            ]
        );

        $this->command->info('Roles and users created successfully!');
    }
}

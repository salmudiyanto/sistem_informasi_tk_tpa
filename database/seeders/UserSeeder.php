<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guru;
use App\Models\User;
use App\Models\Wali;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    // Tambah guru
    $guru = Guru::create([
        'nama' => 'Ustadzah Aisyah',
        'jenis_kelamin' => 'P',
        'alamat' => 'Jl. Pesantren 12',
        'telepon' => '081234567890',
        'email' => 'guru@tk-tpa.com',
        'bidang' => 'TPA',
    ]);

    // Tambah wali
    $wali = Wali::create([
        'nama' => 'Bapak Ahmad',
        'alamat' => 'Jl. Masjid Raya 23',
        'telepon' => '082212345678',
        'email' => 'wali@tk-tpa.com',
        'pekerjaan' => 'Pegawai Negeri',
    ]);

    // Admin
    User::create([
        'name' => 'Super Admin',
        'email' => 'admin@tk-tpa.com',
        'password' => Hash::make('admin123'),
        'role' => 'admin',
        'related_id' => null,
    ]);

    // Guru
    User::create([
        'name' => $guru->nama,
        'email' => $guru->email,
        'password' => Hash::make('guru123'),
        'role' => 'guru',
        'related_id' => $guru->id,
    ]);

    // Wali
    User::create([
        'name' => $wali->nama,
        'email' => $wali->email,
        'password' => Hash::make('wali123'),
        'role' => 'wali',
        'related_id' => $wali->id,
    ]);
}
}

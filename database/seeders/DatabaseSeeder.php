<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@tk-tpa.com',
                'password' => bcrypt('admin123'),
                'role' => 'admin',
            ],
            [
                'name' => 'Ustadzah Aisyah',
                'email' => 'guru@tk-tpa.com',
                'password' => bcrypt('guru123'),
                'role' => 'guru',
                'related_id' => 1, // id dari tabel guru
            ],
            [
                'name' => 'Bapak Ahmad',
                'email' => 'wali@tk-tpa.com',
                'password' => bcrypt('wali123'),
                'role' => 'wali',
                'related_id' => 2, // id dari tabel wali
            ],
        ]);
        
    }
}

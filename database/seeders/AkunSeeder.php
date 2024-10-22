<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $akun  = [
            [
                'username' => 'admin',
                'password' => password_hash('admin', PASSWORD_DEFAULT),
                'level' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'petugas',
                'password' => password_hash('petugas', PASSWORD_DEFAULT),
                'level' => 'petugas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'peserta',
                'password' => password_hash('peserta', PASSWORD_DEFAULT),
                'level' => 'peserta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('akun')->insert($akun);
    }
}

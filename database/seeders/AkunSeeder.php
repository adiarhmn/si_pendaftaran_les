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
                'password' => password_hash('pelaihari', PASSWORD_DEFAULT),
                'level' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'petugas1',
                'password' => password_hash('pelaihari', PASSWORD_DEFAULT),
                'level' => 'petugas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'petugas2',
                'password' => password_hash('pelaihari', PASSWORD_DEFAULT),
                'level' => 'petugas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'peserta1',
                'password' => password_hash('pelaihari', PASSWORD_DEFAULT),
                'level' => 'peserta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'peserta2',
                'password' => password_hash('pelaihari', PASSWORD_DEFAULT),
                'level' => 'peserta',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];

        DB::table('akun')->insert($akun);
    }
}

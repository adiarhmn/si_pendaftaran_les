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
            [
                'username' => 'petugas1',
                'password' => password_hash('petugas1', PASSWORD_DEFAULT),
                'level' => 'petugas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'petugas2',
                'password' => password_hash('petugas2', PASSWORD_DEFAULT),
                'level' => 'petugas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'petugas3',
                'password' => password_hash('petugas3', PASSWORD_DEFAULT),
                'level' => 'petugas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'petugas4',
                'password' => password_hash('petugas4', PASSWORD_DEFAULT),
                'level' => 'petugas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'petugas5',
                'password' => password_hash('petugas5', PASSWORD_DEFAULT),
                'level' => 'petugas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'petugas6',
                'password' => password_hash('petugas6', PASSWORD_DEFAULT),
                'level' => 'petugas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'petugas7',
                'password' => password_hash('petugas7', PASSWORD_DEFAULT),
                'level' => 'petugas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'peserta01',
                'password' => password_hash('peserta01', PASSWORD_DEFAULT),
                'level' => 'peserta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'peserta02',
                'password' => password_hash('peserta02', PASSWORD_DEFAULT),
                'level' => 'peserta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'peserta03',
                'password' => password_hash('peserta03', PASSWORD_DEFAULT),
                'level' => 'peserta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'peserta04',
                'password' => password_hash('peserta04', PASSWORD_DEFAULT),
                'level' => 'peserta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'peserta05',
                'password' => password_hash('peserta05', PASSWORD_DEFAULT),
                'level' => 'peserta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'peserta06',
                'password' => password_hash('peserta06', PASSWORD_DEFAULT),
                'level' => 'peserta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'peserta07',
                'password' => password_hash('peserta07', PASSWORD_DEFAULT),
                'level' => 'peserta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'peserta08',
                'password' => password_hash('peserta08', PASSWORD_DEFAULT),
                'level' => 'peserta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'peserta09',
                'password' => password_hash('peserta09', PASSWORD_DEFAULT),
                'level' => 'peserta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('akun')->insert($akun);
    }
}

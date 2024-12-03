<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $petugas = [
            [
                'nama_petugas' => 'Petugas 1',
                'telp' => '0812345678977',
                'alamat' => 'Jl. Petugas 1',
                'id_akun' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_petugas' => 'Petugas 2',
                'telp' => '0812345678955',
                'alamat' => 'Jl. Petugas 2',
                'id_akun' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('petugas')->insert($petugas);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PesertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $peserta = [
            [
                'nama_peserta' => 'Peserta 1',
                'telp' => '0812345678922',
                'alamat' => 'Jl. Peserta 1',
                'id_akun' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_peserta' => 'Peserta 2',
                'telp' => '0812345678933',
                'alamat' => 'Jl. Peserta 2',
                'id_akun' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('peserta')->insert($peserta);
    }
}

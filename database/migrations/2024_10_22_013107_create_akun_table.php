<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('akun', function (Blueprint $table) {
            //Membuat Primary Key id_akun
            $table->id('id_akun'); 

            //Membuat kolom username
            $table->string('username', 100)->unique();

            //Membuat kolom password
            $table->string('password', 100);

            //Membuat kolom level
            $table->enum('level', ['admin', 'petugas', 'peserta']);

            //Membuat created_at dan updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akun');
    }
};

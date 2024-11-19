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
        Schema::create('peserta', function (Blueprint $table) {
            // Membuat Primary Key
            $table->id('id_peserta');

            // Membuat kolom nama_peserta
            $table->string('nama_peserta', 100);

            // Membuat kolom telp
            $table->string('telp', 25);

            // Membuat kolom alamat
            $table->text('alamat');

            // Membuat Foreign Key
            $table->unsignedBigInteger('id_akun');
            $table->foreign('id_akun')
                ->references('id_akun')
                ->on('akun')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            // Membuat created_at dan updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta');
    }
};

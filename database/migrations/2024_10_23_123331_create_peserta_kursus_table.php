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
        Schema::create('peserta_kursus', function (Blueprint $table) {
            // Membuat Primary Key id_peserta_kursus
            $table->id('id_peserta_kursus');

            // Membuat kolom status_peserta_kursus
            $table->enum('status_peserta_kursus', ['pending', 'approved', 'rejected'])->default('pending');

            // Membuat Foreign Key dari id_peserta table peserta
            $table->unsignedBigInteger('id_peserta');
            $table->foreign('id_peserta')
                ->references('id_peserta')
                ->on('peserta')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            // Membuat Foreign Key dari id_kursus table kursus
            $table->unsignedBigInteger('id_kursus');
            $table->foreign('id_kursus')
                ->references('id_kursus')
                ->on('kursus')
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
        Schema::dropIfExists('peserta_kursus');
    }
};

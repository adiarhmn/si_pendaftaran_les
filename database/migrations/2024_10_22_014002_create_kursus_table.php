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
        Schema::create('kursus', function (Blueprint $table) {
            // Membuat Primary Key id_kursus
            $table->id('id_kursus');

            // Membuat kolom nama_kursus
            $table->string('nama_kursus', 100);

            // Membuat kolom harga
            $table->integer('harga');

            // Membuat kolom deskripsi
            $table->text('deskripsi')->nullable();

            // Membuat kolom tanggal_mulai
            $table->date('tanggal_mulai');

            // Membuat kolom tanggal_selesai
            $table->date('tanggal_selesai');

            // Membuat kolom jumlah_peserta
            $table->integer('jumlah_peserta_max')->default(0);

            // Status kursus
            $table->enum('status_kursus', ['open', 'close'])->default('open');

            // Membuat kolom gambar_cover
            $table->string('gambar_cover', 100)->nullable();

            // Membuat Foreign Key dari id_petugas
            $table->unsignedBigInteger('id_petugas');
            $table->foreign('id_petugas')
                ->references('id_petugas')
                ->on('petugas')
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
        Schema::dropIfExists('kursus');
    }
};

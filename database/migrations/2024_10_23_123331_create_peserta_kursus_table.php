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
            $table->enum('status_peserta_kursus', ['pending', 'diterima', 'ditolak'])->default('pending');

            // Membuat kolom status_pelatihan
            $table->enum('status_pelatihan', ['belum dimulai', 'berlangsung', 'selesai'])->default('belum dimulai');

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

            // Membuat Status Pembayaran
            $table->enum('status_pembayaran', ['lunas', 'belum lunas'])->default('belum lunas');

            // Membuat Total Tagihan
            $table->string('total_tagihan')->default(0);

            // Membuat Total Pembayaran
            $table->string('total_pembayaran')->default(0);

            // Membuat kolom tanggal_tenggat_pembayaran
            $table->date('tgl_tenggat_pembayaran')->nullable();

            // Membuat Sertifikat
            $table->string('status_sertifikat')->default('belum terbit');

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

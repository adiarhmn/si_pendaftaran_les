<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KursusModel extends Model
{
    protected $table = 'kursus';
    protected $primaryKey = 'id_kursus';
    protected $fillable = [
        'nama_kursus',
        'harga',
        'deskripsi',
        'durasi',
        'tanggal_mulai',
        'tanggal_selesai',
        'jumlah_peserta',
        'status_kursus',
        'gambar_cover',
        'id_petugas',
    ];

    public $timestamps = true;

    public function petugas()
    {
        return $this->belongsTo(PetugasModel::class, 'id_petugas', 'id_petugas');
    }
}

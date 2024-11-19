<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesertaKursusModel extends Model
{
    protected $table = 'peserta_kursus';
    protected $primaryKey = 'id_peserta_kursus';
    protected $fillable = [
        'status_peserta_kursus',
        'status_pelatihan',
        'id_peserta',
        'id_kursus',
        'status_pembayaran',
        'total_tagihan',
        'total_pembayaran',
        'tgl_tenggat_pembayaran',
        'status_sertifikat'
    ];

    public $timestamps = true;

    public function peserta()
    {
        return $this->belongsTo(PesertaModel::class, 'id_peserta', 'id_peserta');
    }

    public function kursus()
    {
        return $this->belongsTo(KursusModel::class, 'id_kursus', 'id_kursus');
    }
}

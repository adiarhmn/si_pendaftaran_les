<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembayaranModel extends Model
{
    protected $table = 'pembayaran';

    protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
        'id_peserta_kursus',
        'total_pembayaran',
        'status_pembayaran',
        'bukti_pembayaran'
    ];

    public function pesertaKursus()
    {
        return $this->belongsTo(PesertaKursusModel::class, 'id_peserta_kursus', 'id_peserta_kursus');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesertaModel extends Model
{
    protected $table = 'peserta';
    protected $primaryKey = 'id_peserta';
    protected $fillable = [
        'nama_peserta',
        'telp',
        'alamat',
        'id_akun',
    ];

    public $timestamps = true;

    public function akun()
    {
        return $this->belongsTo(AkunModel::class, 'id_akun', 'id_akun');
    }

    public function peserta_kursus()
    {
        return $this->hasMany(PesertaKursusModel::class, 'id_peserta', 'id_peserta');
    }
}

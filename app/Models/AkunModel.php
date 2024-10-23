<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AkunModel extends Model
{
    protected $table = 'akun';
    protected $primaryKey = 'id_akun';
    protected $fillable = [
        'username',
        'password',
        'level'
    ];

    public $timestamps = true;

    public function petugas()
    {
        return $this->hasOne(PetugasModel::class, 'id_akun', 'id_akun');
    }

    public function peserta()
    {
        return $this->hasOne(PesertaModel::class, 'id_akun', 'id_akun');
    }
}

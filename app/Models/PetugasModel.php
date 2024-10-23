<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetugasModel extends Model
{
    protected $table = 'petugas';
    protected $primaryKey = 'id_petugas';
    protected $fillable = [
        'nama_petugas',
        'telp',
        'alamat',
        'id_akun',
    ];

    public $timestamps = true;

    public function akun()
    {
        return $this->belongsTo(AkunModel::class, 'id_akun', 'id_akun');
    }
}

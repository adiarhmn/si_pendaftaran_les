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
}
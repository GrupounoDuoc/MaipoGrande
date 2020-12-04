<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
    use HasFactory;
    protected $table ='usuario';

    protected $fillable = [
        'ID_PERFIL ', 'CONTRASENIA'
    ];
    
    protected $primaryKey = 'ID_USUARIO';
    public $timestamps = false;
}

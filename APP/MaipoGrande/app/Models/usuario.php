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

    public function profile()
    {
        return $this->hasOne('App\Models\perfil','ID_PERFIL','ID_PERFIL');
    }

    public function person()
    {
        return $this->hasOne('App\Models\persona','ID_USUARIO','ID_USUARIO');
    }
}

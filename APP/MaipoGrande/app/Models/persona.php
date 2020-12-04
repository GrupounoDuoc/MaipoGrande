<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class persona extends Model
{
    use HasFactory;
    protected $table ='persona';

    public $fillable = [
        "ID_USUARIO",
        "RUT" ,
        "NOMBRE" ,
        "APELLIDO" ,
        //"tipocomprador" ,
        //"tipopersona" ,
        "NOMBRE_FANTASIA" ,
        "ID_COMUNA" ,
        "CODIGO_POSTAL" ,
        "TELEFONO" ,
    ];

    protected $primaryKey = 'RUT';

    public function usuario()
    {
        return $this->belongsTo('App\Models\usuario', 'ID_USUARIO', 'ID_USUARIO');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_fruta extends Model
{
    use HasFactory;
    protected $table ='tipo_fruta';

    protected $fillable = [
        'ID_TIPO_FRUTA',
        'NOMBRE',
        'DESCRIPCION',
        'FOTO'
    ];

    protected $primaryKey = 'ID_TIPO_FRUTA';
    public $timestamps = false;
}

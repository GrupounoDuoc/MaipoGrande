<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_persona_legal extends Model
{
    use HasFactory;
    protected $table ='tipo_persona_legal';

    protected $primaryKey = 'ID_TIPO_PERSONA_LEGAL';
    public $incrementing = false;
    protected $fillable = ['NOMBRE','DESCRIPCION'];
}

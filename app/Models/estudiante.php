<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estudiante extends Model
{
    public $timestamps = false;
    protected $fillable = ['nombres','apellidos','email','password','cod_sis','carrera','grupo_id','grupoempresa_id'];
}

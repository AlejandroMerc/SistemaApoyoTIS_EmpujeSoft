<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var string[]
    */
   protected $fillable = [
       'sigla_grupo',
       'codigo_inscripcion',
       'semestre_id',
       'asesor_id'
   ];

   public $timestamps = false;
   
}

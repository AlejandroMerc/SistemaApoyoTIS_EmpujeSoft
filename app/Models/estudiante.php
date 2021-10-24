<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var string[]
    */
   protected $fillable = [
       'cod_sis',
       'carrera',
       'user_id',
       'grupo_id',
       'grupoempresa_id'
   ];

   public $timestamps = false;
   
}

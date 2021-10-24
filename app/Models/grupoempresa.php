<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupoempresa extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var string[]
    */
   protected $fillable = [
       'asesor_id',
       'rep_legal_id',
       'nombre_largo',
       'nombre_corto',
       'tipo_sociedad',
       'direccion_ge',
       'telefono_ge'
   ];

   public $timestamps = false;
   
}

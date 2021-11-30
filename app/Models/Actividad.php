<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var string[]
    */
    protected $fillable = [
        'fecha_inicio_actividad',
        'fecha_fin_actividad',
        'cantidad_archivos_perm',
        'tipo_archivos_perm',
        'publicacion_id'
    ];

    public $timestamps = false;

    public function publicacion(){
        return $this->belongsTo(Publicacion::Class);
    }
}

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

    /**
     * Obtener el semestre al que pertenece el grupo.
     */
    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }

    /**
     * Obtener el asesor a cargo del grupo.
     */
    public function asesor()
    {
        return $this->belongsTo(Asesor::class);
    }

    /**
     * Obtener los estudiantes inscritos en el grupo.
     */
    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class);
    }

    public function pubs_asignada_grupo(){
        return $this->hasMany(Publicacion_asignada_grupo::class);
    }
   
}

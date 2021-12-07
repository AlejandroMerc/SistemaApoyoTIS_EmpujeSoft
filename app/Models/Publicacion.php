<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;

    protected $table = 'publicaciones';

    /**
    * The attributes that are mass assignable.
    *
    * @var string[]
    */
    protected $fillable = [
        'titulo_publicacion',
        'fecha_publicacion',
        'descripcion_publicacion',
        'asesor_id'
    ];

    public $timestamps = false;

    public function actividad(){
        return $this->hasOne(Actividad::Class);
    }

    public function asesor(){
        return $this->belongsTo(Asesor::Class);
    }

    public function grupos_asignados(){
        return $this->hasMany(Publicacion_grupo::Class);
    }

    public function ge_asignados(){
        return $this->hasMany(Publicacion_grupoempresa::Class);
    }

    public function semestre_asignados(){
        return $this->hasMany(Publicacion_semestre::Class);
    }

    public function adjuntos(){
        return $this->hasMany(Adjunto_publicacion::Class);
    }
}

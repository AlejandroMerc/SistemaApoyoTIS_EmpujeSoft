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
   
    /**
     * Obtener el asesor a cargo de la grupoempresa.
     */
    public function asesor()
    {
        return $this->belongsTo(Asesor::class);
    }

    /**
     * Obtener el representante legal de la grupoempresa.
     */
    public function rep_legal()
    {
        return $this->belongsTo(Estudiante::class, 'rep_legal_id');
    }

    /**
     * Obtener los estudiantes miembros de la grupoempresa.
     */
    public function miembros()
    {
        return $this->hasMany(Estudiante::class);
    }
}

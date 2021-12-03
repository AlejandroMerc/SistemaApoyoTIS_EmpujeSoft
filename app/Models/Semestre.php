<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'year',
        'periodo',
        'fecha_inicio',
        'fecha_fin'
    ];

    public $timestamps = false;
   
    /**
     * Obtener los grupos registrados en el semestre.
     */
    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }

    public function semestreActual()
    {
        $currentDate = date('Y-m-d');
        $semestre = Semestre::where('fecha_inicio','<=',$currentDate)
                    ->where('fecha_fin','>=',$currentDate)->first();
        return $semestre;
    }

    public function pubs_asignada_semestre()
    {
        return $this->hasMany(Publicacion_semestres::class);
    }

}

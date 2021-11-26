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
   
    /**
     * Obtener el usuario asociado al estudiante.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtener el grupo en el que esta inscrito el estudiante.
     */
    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    /**
     * Obtener la grupoempresa a la que pertenece el estudiante.
     */
    public function grupoempresa()
    {
        return $this->belongsTo(Grupoempresa::class);
    }

}

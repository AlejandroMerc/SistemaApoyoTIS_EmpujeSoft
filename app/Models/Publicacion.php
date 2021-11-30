<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;

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
}

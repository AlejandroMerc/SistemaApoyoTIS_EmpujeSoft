<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asesor extends Model
{
    use HasFactory;
    
    protected $table = 'asesores';
    
    /**
    * The attributes that are mass assignable.
    *
    * @var string[]
    */
    protected $fillable = [
        'user_id'
    ];

    public $timestamps = false;
   
    /**
     * Obtener el usuario asociado al asesor.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtener los grupos que pertenecen al asesor.
     */
    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }

    public function publicaciones(){
        return $this->hasMany(Publicacion::class);
    }
}

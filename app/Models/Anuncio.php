<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var string[]
    */
    protected $fillable = [
        'publicacion_id',
    ];

    public $timestamps = false;

    public function publicacion(){
        return $this->belongsTo(Publicacion::Class);
    }
}

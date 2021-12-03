<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion_semestre extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
    * The attributes that are mass assignable.
    *
    * @var string[]
    */
    protected $fillable = [
        'publicacion_id',
        'semestre_id'
     ];
}

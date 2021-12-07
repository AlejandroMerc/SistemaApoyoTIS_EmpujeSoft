<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adjunto_publicacion extends Model
{
    use HasFactory;

    protected $table = 'adjunto_publicaciones';

    /**
    * The attributes that are mass assignable.
    *
    * @var string[]
    */
    protected $fillable = [
        'publicacion_id',
        'adjunto_id'
    ];

    public $timestamps = false;

}

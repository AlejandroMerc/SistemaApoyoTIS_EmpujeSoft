<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adjunto_logo extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
    * The attributes that are mass assignable.
    *
    * @var string[]
    */
    protected $fillable = [
        'grupoempresa_id',
        'adjunto_id'
    ];
}

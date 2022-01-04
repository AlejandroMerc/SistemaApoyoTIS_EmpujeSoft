<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    use HasFactory;
    
    protected $table = 'revisiones';
    
    /**
    * The attributes that are mass assignable.
    *
    * @var string[]
    */
    protected $fillable = [
        'actividad_id',
        'grupoempresa_id',
        'fecha_revision',
        'estado'
    ];

    public $timestamps = false;

    public function actividad()
    {
        return $this->belongsTo(Actividad::class);
    }

    public function grupoempresa()
    {
        return $this->belongsTo(Grupoempresa::class);
    }
}

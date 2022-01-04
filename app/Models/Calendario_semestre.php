<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendario_semestre extends Model
{
    use HasFactory;

    protected $fillable = ['calendario_id', 'semestre_id'];

    public $timestamps = false;

    public function calendario()
    {
        return $this->belongsTo(Calendario::class);
    }

    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }
}

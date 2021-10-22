<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class semestre extends Model
{
    public $timestamps = false;
    protected $fillable = ['anio','periodo','fecha_inicio','fecha_fin'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendario_grupoempresa extends Model
{
    use HasFactory;
    
    protected $fillable = ['calendario_id','grupoempresa_id'];

    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grupoempresa extends Model
{
    public $timestamps = false;
    protected $fillable = ['nombre_largo','nombre_corto','tipo_sociedad','direccion_ge','telefono_ge','asesor_tis_id','rep_legal_id'];
}

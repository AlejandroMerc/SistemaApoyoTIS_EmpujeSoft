<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asesor_tis extends Model
{

    public $timestamps = false;
    protected $fillable = ['nombres','apellidos','email','password'];

}

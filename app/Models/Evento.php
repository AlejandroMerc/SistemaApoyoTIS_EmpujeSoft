<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;
    
    //protected $table= 'evento';

    static $rules=[
        'title'=>'required',
        'description'=>'required',
        'start'=>'required',
        'end'=>'required',
    ];
    protected $fillable = ['title','description','start','end','calendario_id'];

    public $timestamps = false;

    public function calendario()
    {
        return $this->belongsTo(Calendario::class);
    }
}

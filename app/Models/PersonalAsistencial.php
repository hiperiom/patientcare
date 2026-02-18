<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalAsistencial extends Model
{
    protected $table = "personal_asistencial";
    protected $fillable=[
        'id',
        'description',
        'color',
        'instrumentista_id',
        'anestesia_id',
        'cirugia_id',
       
    ];
}

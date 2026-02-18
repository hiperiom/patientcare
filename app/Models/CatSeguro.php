<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatSeguro extends Model
{
    public $fillable = [
        'id',
        'name',
        'active',
        'created_at',
        'updated_at'
    ];
    protected $table = "cat_seguro";
}

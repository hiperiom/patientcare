<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public $fillable = [
        'id',
        'name',
        'shortname',
        'active',
        'created_at',
        'updated_at'
    ];
}

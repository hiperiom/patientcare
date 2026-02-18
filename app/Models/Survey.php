<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = ['name', 'description'];
    public function dischargeds()
    {
        return $this->belongsToMany('App\Models\Discharged')->withPivot('dateInit', 'dateSent', 'status', 'comment')->withTimestamps();
    }

    public function sections()
    {
        return $this->hasMany('App\Models\Section');
    }

}

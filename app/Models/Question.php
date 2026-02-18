<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['description', 'order', 'options', 'section_id'];
    public function answers()
    {
        return $this->hasMany('App\Models\Answer');
    }

    public function Section()
    {
        return $this->belongsToMany('App\Models\Section');
    }

    public function answersMN()
    {
        return $this->belongsToMany('App\Models\Answer', 'answer_discharged_question')->withPivot('discharged_id', 'comment')->withTimestamps();
    }

    public function dischargeds()
    {
        return $this->belongsToMany('App\Models\Discharged', 'answer_discharged_question')->withPivot('answer_id', 'comment')->withTimestamps();
    }

}

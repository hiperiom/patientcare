<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['description', 'value', 'question_id'];
    public function question()
    {
        return $this->belongsToMany('App\Models\Question');
    }

    public function questionsMN()
    {
        return $this->belongsToMany('App\Models\Question', 'answer_discharged_question')->withPivot('discharged_id', 'comment')->withTimestamps();
    }

    public function dischargeds()
    {
        return $this->belongsToMany('App\Models\Discharged', 'answer_discharged_question')->withPivot('question_id', 'comment')->withTimestamps();
    }

}

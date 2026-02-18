<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['name','description', 'survey_id', 'area_id'];
    public function questions()
    {
        return $this->hasMany('App\Models\Question');
    }

    public function Survey()
    {
        return $this->belongsTo('App\Models\Survey');
    }

    public function area(){
        return $this->belongsTo('App\Models\Area');
    }

}

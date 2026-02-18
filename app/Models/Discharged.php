<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discharged extends Model
{
    protected $fillable = ['close_by_user','user_id','token','user_cuest_episodio_id', 'ubicacion', 'sent_mail','sent_whatsapp','egress_date','created_at','updates-at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function episodio()
    {
        return $this->belongsTo('App\Models\UserCuestEpisodio','user_cuest_episodio_id', 'id');
    }

    public function surveys()
    {
        return $this->belongsToMany('App\Models\Survey')->withPivot('dateInit', 'dateSent', 'status', 'comment')->withTimestamps();
    }

    public function questions()
    {
        return $this->belongsToMany('App\Models\Question', 'answer_discharged_question')->withPivot('answer_id', 'comment')->withTimestamps();
    }

    public function answers()
    {
        return $this->belongsToMany('App\Models\Answer', 'answer_discharged_question')->withPivot('question_id', 'comment')->withTimestamps();
    }

}

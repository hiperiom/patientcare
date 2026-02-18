<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterconsultationRequest extends Model
{
    protected $table="interconsultation_request";
    protected $fillable = [
        'start_date',
        'end_date',
        'episode_id',
        'doctor_id',
        'patient_id',
        'create_user_id',
    ];
}
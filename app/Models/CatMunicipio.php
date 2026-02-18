<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatMunicipio extends Model
{
    public $table = 'cat_municipio';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function auxEstado()
    {
        return $this->belongsTo(\App\Models\AuxEstado::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function auxParroquia()
    {
        return $this->hasMany(\App\Models\AuxParroquia::class);
    }
}

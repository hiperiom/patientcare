<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitudQuirofano extends Model
{
    protected $table="solicitud_quirofano";
    protected $fillable = [
        'fecha_reservacion',
        'h_inicio',
        'h_real_inicio',
        'n_quirofano',
        'h_fin',
        'h_aprox_fin',
        'n_cubiculo',
        'episodio_id',
        'circulante_anestesia',
        'circulante_cirugia',
        'instrumentista',
        'anestesia_sugerida',

        'intervencion',
        'diagnostico_preoperatorio',
        'tipo_reservacion',
        'status_id',
        'destino',
        'n_presupuesto',
        'tipo_cupo',
        'dias_hospitalizacion',
        'fase_ubicacion',
        'ayudante_1',
        'ayudante_2',
        'ayudante_3',
        'dias_uti',
        'area_intervencion',
    ];
}

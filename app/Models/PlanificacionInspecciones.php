<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanificacionInspecciones extends Model
{
    use HasFactory;

    protected $table = 'planificacion_inspeccion'; 
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id_recepcion', 'id_comisionado',];

    public function recepcion()
    {
        return $this->belongsTo(Recepcion::class, 'id_recepcion');
    }

    public function comisionado()
    {
        return $this->belongsTo(Comisionados::class, 'id_comisionado');
    }

}

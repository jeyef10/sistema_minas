<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planificacion extends Model
{
    use HasFactory;
    protected $table = 'planificacion'; 
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id_recepcion', 'id_comisionado', 'id_municipio', 'fecha_incial','fecha_final', 'estatus'];

    public function recepcion()
    {
        return $this->belongsTo(Recepcion::class, 'id_recepcion');
    }

    public function comisionados()
    {
        return $this->belongsTo(Comisionados::class,  'id_comisionado');
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'id_municipio');
    }

    public function planificacioncomisionados()
    {
        return $this->belongsTo(PlanificacionComisionados::class, 'id_planificacion', 'id', 'id_comisionado');
    }

}

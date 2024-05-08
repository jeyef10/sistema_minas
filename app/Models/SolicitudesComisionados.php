<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudesComisionados extends Model
{
    use HasFactory;

    protected $table = 'solicitudes_comisionados'; 
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id_solicitud', 'id_comisionado', 'funcionario_acomp', 'direccion_lugar','observaciones','conclusiones','latitud','longitud',
    'foto','estatus'];

    public function comisionado()
    {
        return $this->belongsTo(Comisionados::class, 'id_comisionado');
    }

    public function solicitud()
    {
        return $this->belongsTo(Solicitudes::class, 'id_solicitud');
    }

}

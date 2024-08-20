<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspecciones extends Model
{
    use HasFactory;
    protected $table = 'inspecciones';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id_planificacion', 'funcionario_acomp', 'lugar_direccion', 'observaciones', 'conclusiones', 'latitud',
    'longitud', 'utm_norte', 'utm_este', 'longitud_terreno', 'res_fotos', 'fecha_inspeccion', 'ancho', 'profundidad', 'volumen', 
    'lindero_norte', 'lindero_sur', 'lindero_este', 'lindero_oeste', 'superficie', 'estatus'];

    public function planificacion()
    {
        return $this->belongsTo(Planificacion::class, 'id_planificacion');
    }

}

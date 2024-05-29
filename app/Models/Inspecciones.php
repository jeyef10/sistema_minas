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
    protected $fillable = ['id_solicitud', 'id_municipio', 'id_comisionado', 'funcionario_acomp', 'lugar_direccion', 'fecha_inspeccion', 'observaciones', 'conclusiones', 'latitud',
    'longitud', 'res_fotos', 'estatus'];
}

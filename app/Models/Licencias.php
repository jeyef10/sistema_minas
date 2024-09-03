<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licencias extends Model
{
    use HasFactory;
    protected $table = 'licencias';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id_inspeccion','resolucion_apro', 'resolucion_hpc', 'catastro_la', 'catastro_lp','providencia',
    'num_territorio', 'fecha_oficio', 'id_plazo', 'talonario'];

    public function inspeccion()
    {
        return $this->belongsTo(Inspecciones::class, 'id_inspeccion');
    }

    public function  plazo()
    {
        return $this->belongsTo(Plazos::class, 'id_plazo');
    }
}

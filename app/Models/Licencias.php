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
    protected $fillable = ['id_comprobante_pago','resolucion_apro', 'resolucion_hpc', 'catastro_la', 'catastro_lp','providencia',
    'num_territorio', 'metodo_licencia_apro', 'metodo_licencia_pro' , 'nro_cuotas',  'metodo_control_pro', 'fecha_oficio', 
    'fecha_incial_ope', 'fecha_final_ope', 'id_plazo', 'talonario'];

    public function comprobante_pago()
    {
        return $this->belongsTo(ComprobantePago::class, 'id_comprobante_pago');
    }

    public function  plazo()
    {
        return $this->belongsTo(Plazos::class, 'id_plazo');
    }

    public function control_regalia()
    {
        return $this->belongsToMany(ControlRegalia::class, 'id_licencia', 'id', 'id_pago_regalia');
    }

// NO ELIMINAR ESTA RELACION PORQUE DAR UN ERROR QUE LA INSPECCION NO ESTA DEFINIDA EN EL MODELO LICENCIAS 

    public function inspeccion()
    {
        return $this->belongsTo(Inspecciones::class);
    }
}

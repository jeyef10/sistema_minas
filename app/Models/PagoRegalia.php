<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoRegalia extends Model
{
    use HasFactory;
    protected $table = 'pago_regalias';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id_licencia', 'id_mineral', 'metodo_apro', 'metodo_pro', 'monto_apro', 'monto_pro', 'tasa_convenio',
    'pago_realizar', 'monto_decl', 'resultado_apro', 'resultado_pro', 'comprobante', 'fecha_pago' , 'fecha_venci'];

    public function licencia()
    {
        return $this->belongsTo(Licencias::class, 'id_licencia');
    }

    public function mineral()
    {
        return $this->belongsTo(Minerales::class, 'id_mineral');
    }

    public function control_regalia()
    {
        return $this->belongsToMany(ControlRegalia::class, 'id_licencia', 'id', 'id_pago_regalia');
    }
}

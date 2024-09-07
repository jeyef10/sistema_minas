<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComprobantePago extends Model
{
    use HasFactory;
    protected $table = 'comprobante_pagos';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id_inspeccion', 'id_tipo_pago', 'fecha_pago', 'comprobante_pdf', 'estatus_pago'];

    public function inspeccion()
    {
        return $this->belongsTo(Inspecciones::class, 'id_inspeccion');
    }

    public function tipo_pago()
    {
        return $this->belongsTo(TipoPago::class, 'id_tipo_pago');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitudes extends Model
{
    use HasFactory;

    protected $table = 'solicitudes'; 
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id_solicitante', 'fecha'];

    public function solicitante()
    {
        return $this->morphTo(Solicitante::class, 'id_solicitante');
    }

    public function solicitudesrecaudos()
    {
        return $this->belongsTo(SolicitudesRecaudos::class, 'id_solicitud', 'id', 'id_recaudo');
    }
    // public function mineral()
    // {
    //     return $this->belongsTo(Minerales::class, 'id_mineral');
    // }

    // public function regalia()
    // {
    //     return $this->belongsTo(Regalia::class, 'id_regalia');
    // }

    // public function plazo()
    // {
    //     return $this->belongsTo(Plazos::class, 'id_plazo');
    // }

    // public function municipio()
    // {
    //     return $this->belongsTo(Municipio::class, 'id_municipio');
    // }

    // public function parroquia()
    // {
    //     return $this->belongsTo(Parroquia::class, 'id_parroquia');
    // }

    
}

    

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
    protected $fillable = ['id_solicitante','id_mineral','id_regalia','id_plazo','id_municipio','id_parroquia',
    'tipo_mineral','nom_mineral','tasa_reaglias','num_regalias', 'plazo', 'volumen', 'direccion', 'fecha', 'observaciones', 'estatus',];

    public function solicitante()
    {
        return $this->belongsTo(Solicitante::class, 'id_solicitante');
    }

    public function mineral()
    {
        return $this->belongsTo(Mineral::class, 'id_mineral');
    }

    public function tipoRegalia()
    {
        return $this->belongsTo(TipoRegalia::class, 'id_regalia');
    }

    public function plazo()
    {
        return $this->belongsTo(Plazo::class, 'id_plazo');
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'id_municipio');
    }

    public function parroquia()
    {
        return $this->belongsTo(Parroquia::class, 'id_parroquia');
    }

}

    

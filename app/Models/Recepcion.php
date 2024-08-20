<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recepcion extends Model
{
    use HasFactory;

    protected $table = 'recepcion'; 
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id_solicitante', 'id_municipio', 'id_mineral', 'latitud', 'longitud', 'direccion', 'categoria', 'fecha'];

    public function solicitante()
    {
        return $this->belongsTo(Solicitante::class, 'id_solicitante');
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'id_municipio');
    }

    public function mineral()
    {
        return $this->belongsTo(Minerales::class, 'id_mineral');
    }

    public function recepcionrecaudos()
    {
        return $this->belongsTo(RecepcionRecaudos::class, 'id_recepcion', 'id', 'id_recaudo');
    }

    public function recaudos()
    {
        return $this->belongsTo(Recaudos::class, 'id_recaudo', 'id', 'nombre', 'categoria_recaudos');
    }
    
}

    

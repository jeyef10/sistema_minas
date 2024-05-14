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
        return $this->belongsTo(Solicitante::class, 'id_solicitante');
    }

    public function solicitudesrecaudos()
    {
        return $this->belongsTo(SolicitudesRecaudos::class, 'id_solicitud', 'id', 'id_recaudo');
    }

    public function recaudo()
    {
        return $this->belongsTo(Recaudos::class, 'id_recaudo', 'id', 'nombre');
    }

    
}

    

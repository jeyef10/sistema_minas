<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudesRecaudos extends Model
{
    use HasFactory;
    protected $table = 'solicitudes_recaudos';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id_solicitud','id_recaudo'];

    public function recaudo()
    {
        return $this->belongsTo(Recaudos::class, 'id_recaudo', 'id', 'nombre');
    }

    public function solicitud()
    {
        return $this->belongsTo(Solicitudes::class, 'id_solicitud');
    }
}

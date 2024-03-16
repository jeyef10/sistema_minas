<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignar extends Model
{
    protected $table = 'asignar';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id_persona', 'id_equipo', 'id_periferico', 'estatus', 'observacion'];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }

    public function equipo()
    {
        return $this->belongsTo(Equipos::class, 'id_equipo');
    }

    public function periferico()
    {
        return $this->belongsTo(Perifericos::class, 'id_periferico');
    }
}

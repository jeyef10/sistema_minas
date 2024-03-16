<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonaDivisionSede extends Model
{
    protected $table = 'persona_division_sede';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id_persona', 'id_division_sede'];

    // Relación con Persona
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona', 'id');
    }

    // Relación con DivisionSede
    public function divisionSede()
    {
        return $this->belongsTo(DivisionSede::class, 'id_division_sede', 'id');
    
    }

    
    
}

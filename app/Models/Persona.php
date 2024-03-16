<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['nombre', 'apellido', 'cedula', 'id_usuario', 'id_cargo', 'telefono'];

    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'id_cargo');
    }
    public function PersonaDivisionSede()
    {
        return $this->belongsToMany(PersonaDivisionSede::class, 'persona_division_sede', 'id_persona', 'id_division_sede');
    }
    public function divisionesSedes()
    {
        return $this->belongsToMany(DivisionSede::class, 'persona_division_sede', 'id_persona', 'id_division_sede');
    }
    public function asignaciones() {
        return $this->hasMany(Asignar::class,'id_persona');
    } 
}


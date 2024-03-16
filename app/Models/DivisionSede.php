<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DivisionSede extends Model
{

    protected $table = 'division_sede';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id_division', 'id_sede'];


    public function division()
    {
        return $this->belongsTo(Division::class, 'id_division', 'id', 'nombre_division');
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class, 'id_sede', 'id', 'nombre_sede');
    }

    public function personasDivision() {
        return $this->hasMany(PersonaDivisionSede::class,'id_division_sede'); 
    }
}
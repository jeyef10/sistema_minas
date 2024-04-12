<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonaNatural extends Model
{
    use HasFactory;

    protected $table = 'personas_naturales';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['cedula', 'nombre', 'apellido'];

    public function solicitante()
    {
        return $this->morphOne(Solicitante::class, 'solicitanteEspecifico');
    }
}
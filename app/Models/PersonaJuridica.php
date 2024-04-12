<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonaJuridica extends Model
{
    use HasFactory;

    protected $table = 'personas_juridicas';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['rif', 'nombre', 'correo'];

    public function solicitante()
    {
        return $this->morphOne(Solicitante::class, 'solicitanteEspecifico');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Municipio;

class Comisionados extends Model
{
    use HasFactory;

    protected $table = 'comisionados'; 
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['cedula', 'nombres', 'apellidos', 'id_usuario'];

    public function municipios()
    {
        return $this->belongsToMany(Municipio::class, 'municipio_comisionados', 'id_comisionado', 'id_municipio');
    }
    
    public function planificacioncomisionados()
    {
        return $this->hasMany(PlanificacionComisionados::class, 'id_planificacion', 'id', 'id_comisionado');
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}

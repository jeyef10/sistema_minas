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
    protected $fillable = ['cedula', 'nombres', 'apellidos', 'id_municipio', 'id_usuario'];

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'id_municipio');
    }
    
    public function planificacioncomisionados()
    {
        return $this->hasMany(PlanificacionComisionados::class, 'id_planificacion', 'id', 'id_comisionado');
    }

    /* public function users()
    {
        return $this->hasOne(User::class, 'id', 'id_usuario');
    } */

    public function user()
    {
        return $this->hasOne(User::class);
    }
}

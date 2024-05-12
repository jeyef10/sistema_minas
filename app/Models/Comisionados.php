<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Municipio;
use App\Models\Parroquia;

class Comisionados extends Model
{
    use HasFactory;

    protected $table = 'comisionados'; 
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['cedula', 'nombres', 'apellidos', 'id_municipio'];

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'id_municipio');
    }
    
    public function solicitudesinspecciones()
    {
        return $this->hasMany(SolicitudesInspecciones::class, 'id_solicitud', 'id', 'id_comisionado');
    }
}

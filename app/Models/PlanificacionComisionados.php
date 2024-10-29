<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanificacionComisionados extends Model
{
    use HasFactory;

    protected $table = 'planificacion_comisionados'; 
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id_planificacion', 'id_comisionado',];

}

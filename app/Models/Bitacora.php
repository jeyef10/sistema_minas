<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class Bitacora extends Model
{
	protected $table = 'historico_sidi';
    protected $fillable = ['id','tablaafectada','operacion','fecha','usuario_bd','usuario','datos_nuevos','datos_viejos'];

}

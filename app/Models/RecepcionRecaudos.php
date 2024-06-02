<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecepcionRecaudos extends Model
{
    use HasFactory;
    protected $table = 'recepcion_recaudos';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id_recepcion','id_recaudo'];

    public function recaudo()
    {
        return $this->belongsTo(Recaudos::class, 'id_recaudo', 'id', 'nombre', 'categoria_recuados');
    }

    public function recepcion()
    {
        return $this->belongsTo(Recepcion::class, 'id_recepcion');
    }
}

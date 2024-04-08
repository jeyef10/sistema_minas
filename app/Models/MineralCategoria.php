<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MineralCategoria extends Model
{
    use HasFactory;

    protected $table = 'mineral_categoria';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id_mineral', 'id_categoria'];


    public function mineral()
    {
        return $this->belongsTo(Minerales::class, 'id_mineral', 'id', 'nombre', 'tipo');
    }

    public function categorias()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id', 'tipo_categoria');
    }
}

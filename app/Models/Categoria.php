<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['tipo_categoria'];

    // Relación con MineralCategoria
    public function mineral()
      {
          return $this->belongsToMany(Minerales::class, 'mineral_categoria', 'id_categoria', 'id_mineral');
      }

      public function mineralcategoria() {
        return $this->hasMany(MineralCategoria::class,'id_categoria');
      }
}
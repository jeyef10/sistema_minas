<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Minerales extends Model
{
    use HasFactory;

    protected $table = 'minerales';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['tipo', 'nombre', 'categoria', 'tasa', 'valor_tasa', 'moneda_longitud'];

    
   //  // Relación con MineralCategoria
   //  public function categorias()
   //  {
   //     return $this->belongsToMany(Categoria::class, 'mineral_categoria', 'id_mineral', 'id_categoria'); 
   //  }

   //  public function mineralcategoria() {
   //      return $this->hasMany(MineralCategoria::class);
   //   }

   public function pago_regalia()
    {
        return $this->hasMany(PagoRegalia::class);
    }
}

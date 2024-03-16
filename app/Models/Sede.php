<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Division;

class Sede extends Model
{
    use HasFactory;
    protected $table = 'sedes';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['nombre_sede'];

      // Relación con DivisionSede
      public function division()
      {
          return $this->belongsToMany(Division::class, 'division_sede', 'id_sede', 'id_division'
          );
      }

      public function divisionesSede() {
        return $this->hasMany(DivisionSede::class,'id_sede');
      }
}
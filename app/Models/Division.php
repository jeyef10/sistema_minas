<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $table = 'divisions';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['nombre_division'];


     // Relación con DivisionSede
     public function sedes()
     {
        return $this->belongsToMany(Sede::class, 'division_sede', 'id_division', 'id_sede'); 
     }

     public function divisionesSede() {
         return $this->hasMany(DivisionSede::class);
      }
}
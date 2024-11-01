<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Parroquia;

class Municipio extends Model
{
    use HasFactory;

    protected $table = 'municipios';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id', 'nom_municipio'];

    public function comisionados()
    {
        return $this->belongsToMany(Comisionados::class, 'municipio_comisionados' , 'id_comisionado', 'id_municipio');
    }

}

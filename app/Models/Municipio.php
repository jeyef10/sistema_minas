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

    public function municipio()
    {
        return $this->hasmany(Parroquia::class, 'id_municipio');
    }
}

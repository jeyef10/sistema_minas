<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MunicipioComisionado extends Model
{
    use HasFactory;

    protected $table = 'municipio_comisionados';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id_comisionado', 'id_municipio'];

}

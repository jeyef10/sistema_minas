<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Municipio;


class Parroquia extends Model
{
    use HasFactory;

    protected $table = 'parroquias';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id_parroquia', 'id_municipio', 'nom_parroquia'];


    public function parroquia()
    {
        return $this->belongsTo(Municipio::class, 'id');
    }

}

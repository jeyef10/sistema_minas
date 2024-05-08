<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitante extends Model
{
    use HasFactory;

    protected $table = 'solicitantes';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['tipo', 'solicitante_especifico_id', 'solicitante_especifico_type'];

    public function solicitanteEspecifico()
    {
        return $this->morphTo();
    }
}
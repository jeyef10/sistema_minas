<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPeriferico extends Model
{
    protected $table = 'tipo_perifericos';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['tipo'];
}

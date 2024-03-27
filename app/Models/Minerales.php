<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Minerales extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'nombre',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPago extends Model
{
    use HasFactory;
    protected $table = 'tipo_pagos';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['forma_pago'];

}

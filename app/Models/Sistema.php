<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sistema extends Model
{
    protected $table = 'sistemas';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['tipo', 'nombre', 'version'];
}
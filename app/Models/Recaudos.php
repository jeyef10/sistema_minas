<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recaudos extends Model
{
    use HasFactory;
    protected $table = 'recaudos';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['nombre'];
}

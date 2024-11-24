<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlRegalia extends Model
{
    use HasFactory;

    protected $table = 'control_regalias';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id_licencia', 'id_pago_regalia'];

}

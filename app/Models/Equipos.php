<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class Equipos extends Model
{
    protected $table = 'equipos';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id_marca', 'id_modelo', 'id_so', 'serial', 'serialA', 'cpu', 'velocidad', 'ram', 'disco'];

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'id_marca');
    }

    public function modelo()
    {
        return $this->belongsTo(Modelo::class, 'id_modelo');
    }
    public function sistema()
    {
        return $this->belongsTo(Sistema::class, 'id_so');
    }
    public function asignars()
    {
        return $this->hasMany(Asignar::class, 'id_equipo');
    }


    // public static function boot()
    // {
    //     parent::boot(); //dd('intro');

    //     static::created(function ($model) {
    //       // dd('123');
    //         $model->logEvent('created');
    //     });

    //     static::updated(function ($model) {
    //         // dd('123');
    //         $model->logEvent('updated'); //dd('123');
    //     });

    //     static::deleted(function ($model) {
    //         $model->logEvent('deleted');
    //     });
    // }

    // public function logEvent($event)
    // {
    //     $oldData = $this->getOriginal();
    //     $newData = $this->getAttributes();
    //     $user_id = Auth::id();

    //     $model = $this;

    //     Bitacora::create([
    //       'model' => $this,
    //       'user_id' => $user_id,
    //       'model_id' => $this->id,
    //       'event' => $event, 
    //       'old_values' => json_encode($oldData),
    //       'new_values' => json_encode($newData),
    //     ]);
    // }
}

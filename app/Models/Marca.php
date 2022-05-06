<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;
    public function vehiculo()
    {
      return $this->hasMany('App\Models\Vehiculo', 'marca_id', 'id'); //se debe referenciar a la otra tabla externa y al campo local
        //return $this->hasMany(Vehiculo::class,'marca_id');
    }

}

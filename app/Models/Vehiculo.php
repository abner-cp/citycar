<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;
    public function marca () {

        return $this->belongsTo('App\Models\Marca', 'marca_id'); //se debe referenciar a la otra tabla externa y al campo local
    }

}

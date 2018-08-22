<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
 
class Partida extends Model
{
    public function materiales()
    {
        return $this->hasMany(Partidamaterial::class);
    }

    public function mano()
    {
        return $this->belongsTo(Mano::class);
    }

    public function indirecto()
    {
        return $this->belongsTo(Indirecto::class);
    }
}

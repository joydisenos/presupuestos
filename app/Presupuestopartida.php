<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presupuestopartida extends Model
{
    public function presupuesto()
    {
        return $this->belongsTo(Presupuesto::class);
    }

    public function partida()
    {
        return $this->belongsTo(Partida::class);
    }

    public function materiales()
    {
    	return $this->hasMany(SubMaterial::class);
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

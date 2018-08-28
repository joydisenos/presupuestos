<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
    public function partidas()
    {
        return $this->hasMany(Presupuestopartida::class);
    }

    public function materiales()
    {
    	return $this->hasMany(PresupuestoMaterial::class);
    }
}

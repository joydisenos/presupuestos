<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PresupuestoMaterial extends Model
{
    public function presupuesto()
    {
        return $this->belongsTo(Presupuesto::class);
    }

    public function partida()
    {
        return $this->belongsTo(Partida::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }
}

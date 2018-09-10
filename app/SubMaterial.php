<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubMaterial extends Model
{
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function presupuestopartida()
    {
        return $this->belongsTo(Presupuestopartida::class);
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoMaterial extends Model
{
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }
}

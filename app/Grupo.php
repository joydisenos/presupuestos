<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    public function materiales()
    {
        return $this->hasMany(GrupoMaterial::class);
    }

    public function materialespartida()
    {
        return $this->hasMany(Partidamaterial::class);
    }

    public function materialespresupuesto()
    {
        return $this->hasMany(SubMaterial::class);
    }
}

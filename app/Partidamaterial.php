<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partidamaterial extends Model
{
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function partida()
    {
        return $this->belongsTo(Partida::class);
    }
}

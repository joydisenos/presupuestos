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
}

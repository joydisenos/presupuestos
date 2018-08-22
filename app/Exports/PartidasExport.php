<?php

namespace App\Exports;

use App\Partida;
use Maatwebsite\Excel\Concerns\FromCollection;

class PartidasExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Partida::all();
    }
}

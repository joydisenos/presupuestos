<?php

namespace App\Exports;

use App\Unidad;
use Maatwebsite\Excel\Concerns\FromCollection;

class UnidadExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Unidad::all();
    }
}

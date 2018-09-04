<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Indirecto;

class IndirectoExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Indirecto::all();
    }
}

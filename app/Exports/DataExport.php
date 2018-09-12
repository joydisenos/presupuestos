<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;


class DataExport implements WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    public function sheets(): array
    {
    	$sheets = [];
        $sheets[] = new ManoExport;
        $sheets[] = new IndirectoExport;
        $sheets[] = new UnidadExport;
        $sheets[] = new MaterialExport; 
        $sheets[] = new PartidaExport;
        $sheets[] = new PartidaMaterialExport;
        $sheets[] = new PresupuestosExport;
        $sheets[] = new PresupuestoPartidasExport;
        $sheets[] = new SubmaterialExport;
        $sheets[] = new MarcasExport;
        $sheets[] = new GruposExport;
        $sheets[] = new GruposMaterialesExport;

        return $sheets;
    }
}

<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Config;
use App\Presupuesto;

class PresupuestoExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
   	
    private $presupuesto;
   	private $configuraciones;

	public function __construct($presupuesto)
	{
        $this->presupuesto = $presupuesto;
	}

    public function view(): View
    {
		$configuraciones = Config::first();

        return view('export.presupuesto', [
        	'configuraciones' => $configuraciones,
            'presupuesto' => $this->presupuesto,
        ]);
    }
}

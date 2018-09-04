<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Config;
use App\Presupuesto;

class MaterialesExport implements FromView
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

        return view('export.materiales', [
        	'configuraciones' => $configuraciones,
            'presupuesto' => $this->presupuesto,
        ]);
    }
}

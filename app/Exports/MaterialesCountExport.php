<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Config;
use App\Presupuesto;

class MaterialesCountExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
   	
    private $materiales;

	public function __construct($materiales)
	{
        $this->materiales = $materiales;
	}

    public function view(): View
    {
		$configuraciones = Config::first();

        return view('export.materialescount', [
        	'configuraciones' => $configuraciones,
            'materiales' => $this->materiales,
        ]);
    }
}

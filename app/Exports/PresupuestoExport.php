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
   	
   	public $id;

	public function __construct($id)
	{
	    $this->id = $id;
	}

    public function view(): View
    {
		   	
        return view('exports.presupuesto', [
        	'configuraciones' => Config::first(),
            'presupuesto' => Presupuesto::findOrFail($id),
        ]);
    }
}

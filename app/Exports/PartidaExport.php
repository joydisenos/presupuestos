<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Partida;

class PartidaExport implements Fromview, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $partidas = Partida::all();

        return view('export.partidas', [
        	'partidas' => $partidas,
        ]);
    }
}

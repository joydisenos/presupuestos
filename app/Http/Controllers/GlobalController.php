<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partida;
use App\Config;
use App\Mano;
use App\Indirecto;
use App\Partidamaterial;
use App\Presupuestopartida;
use App\Material;
use App\Presupuesto;
use App\Exports\PartidasExport;
use App\Exports\PresupuestoExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
class GlobalController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index ()
    {
        $partidas   = Partida::count();
        $materiales = Material::count();

        return view('home',compact('partidas','materiales'));

    }
    public function partidas()
    {
    	
        $partidas = Partida::all();
        $manos = Mano::all();
    	$indirectos = Indirecto::all();

		return view('partidas',compact('partidas','manos','indirectos'));
	}

    public function partida($id)
    {
        
        $partida    = Partida::findOrFail($id);
        $materiales = Material::all();
        $presupuestopartidas = Presupuestopartida::where('partida_id','=',$id)->get();

        return view('partida',compact('partida','materiales','presupuestopartidas'));
    }



	public function storepartidas(Request $request)
    {
    	$mano = Mano::findOrFail($request->mano_id);
        $indirecto = Indirecto::findOrFail($request->indirecto_id);
        $total = 0;
        $total = $total + $mano->precio;
        $total = $total + $indirecto->precio;

        $partida               = new Partida();
        $partida->nombre       = $request->nombre;
        $partida->mano_id      = $request->mano_id;
        $partida->indirecto_id = $request->indirecto_id;
        $partida->total = $total;
        $partida->save();


        Excel::store(new PartidasExport,'partidas.xlsx');

        return redirect()->back()->with('status','Partida Registrada con éxito');
		
	}

    
    public function materiales()

    {
        $materiales = Material::all();

        return view('materiales',compact('materiales'));
    }

    public function storemateriales(Request $request)
    {

         $validatedData = $request->validate([
                'nombre' => 'required|string|min:3|unique:materials',
                'precio' => 'required|numeric',
                ]);

        $material         = new Material();
        $material->nombre = $request->nombre;
        $material->precio = $request->precio;
        $material->tipo   = $request->tipo;
        $material->save();


        return redirect()->back()->with('status','Material registrado con éxito');
    }

    public function agregarmateriales(Request $request)
    {

        
        $materiales = $request->input('material');


        
        foreach ($materiales as $key=>$material) 
        {

        $materialselect        = Material::findOrFail($material);
        
        $material              = new Partidamaterial();
        $material->partida_id  = (int) $request->partida_id;
        $material->material_id = $materialselect->id;
        $material->formula = '';
        $material->cantidad    = 0;
        $material->save();
        
        }

        return redirect()->back()->with('status','Materiales asignados correctamente');
    }

    public function actualizarmateriales(Request $request)
    {
        $materialId = $request->input('material_id');
        $cantidades = $request->input('cantidad');
        $formulas = $request->input('formula');
        $arreglo    = array_combine($materialId , $cantidades);
        $arreglo2 = array_combine($materialId , $formulas);
        $acumular = 0;

        foreach ($arreglo2 as $material_id => $formula) {
            $material           = Partidamaterial::findOrFail($material_id);
            if($formula==null)
            {
                $material->formula = '';
            }else{
                $material->formula = $formula;
            }
            $material->save();
        }

        foreach ($arreglo as $material_id => $cantidad) 
        {
            $material           = Partidamaterial::findOrFail($material_id);
            $material->cantidad = $cantidad;
            $material->save();
            
            $suma     = Material::findOrFail($material->material_id);
            $precio   = (float)$suma->precio * $cantidad;
            $acumular = $acumular + (float)$precio;
        }

        $partida        = Partida::findOrFail($request->partida_id);
        $mano       = $acumular * (((float)$partida->mano->precio)/100);
        $indirecto       = $acumular * (((float)$partida->indirecto->precio)/100);
        $partida->total = $acumular + $mano + $indirecto;
        $partida->save();

        Excel::store(new PartidasExport,'partidas.xlsx');

        return redirect()
                ->back()
                ->with('status','Materiales actualizados correctamente');
    }

    public function presupuesto($id)
    {
        $presupuesto = Presupuesto::findOrFail($id);
        $configuraciones = Config::first();
        $partidas = Partida::all();

        return view('presupuesto',compact('presupuesto','configuraciones','partidas'));
    }

    public function agregarpresupuesto(Request $request)
    {


         $validatedData = $request->validate([
                'partidas' => 'required',
                ]);

        $partidas = $request->input('partidas');
        foreach ($partidas as $partida) 
        {
            $pre = new Presupuestopartida();
            $pre->partida_id     = $partida;
            $pre->presupuesto_id = $request->presupuesto_id;
            $pre->unidad         = '';
            $pre->cantidad       = 1;
            $pre->save();
        }

        return redirect('presupuesto'.'/'.$request->presupuesto_id);
    }

    public function actualizarpresupuesto(Request $request)
    {
        
        $partidas = $request->input('partidas');
        $cantidades = $request->input('cantidades');
        $cambios = array_combine($partidas,$cantidades);


        foreach ($cambios as $partida => $cantidad) {
            $partida = Presupuestopartida::findOrFail($partida);
            $partida->cantidad = $cantidad;
            $partida->save();
        }

        $presupuesto = Presupuesto::findOrFail($request->presupuesto_id);
        $presupuesto->subtotal = $request->subtotal;
        $presupuesto->total = $request->total;
        $presupuesto->save();

        return redirect()->back()->with('status','Cambios registrados con éxito');
    }

    public function exportarpresupuesto($id)
    {
        $presupuesto = Presupuesto::findOrFail($id);
        $configuraciones = Config::first();
        

       return Excel::download(new PresupuestoExport,'partidas.xlsx',$id);
    }

    public function nuevopresupuesto()
    {
        $partidas = Partida::all();

        return view('nuevopresupuesto',compact('partidas'));
    }

    public function historial()
    {
        $presupuestos = Presupuesto::all();

        return view('historial',compact('presupuestos'));
    }

    public function storepresupuesto(Request $request)
    {
         $validatedData = $request->validate([
                'partidas' => 'required',
                'nombre' => 'required',
                ]);
        
        $presupuesto           = new Presupuesto();
        $presupuesto->nombre   = $request->nombre;
        $presupuesto->subtotal = 0;
        $presupuesto->total    = 0;
        $presupuesto->save();

        $partidas = $request->input('partidas');
        foreach ($partidas as $partida) 
        {
            $pre = new Presupuestopartida();
            $pre->partida_id     = $partida;
            $pre->presupuesto_id = $presupuesto->id;
            $pre->unidad         = '';
            $pre->cantidad       = 1;
            $pre->save();
        }

        return redirect('presupuesto'.'/'.$presupuesto->id);
    }
    public function configuraciones()
    {
        $configuracion = Config::first();
        $manos         = Mano::all();
        $indirectos    = Indirecto::all();
        $partidas      = Partida::all();
        
        if($configuracion == null)
        {
            $configuracion      = new Config();
            $configuracion->iva = 0;
            $configuracion->save();
        }

        return view('globales',compact('configuracion','manos','indirectos','partidas'));
    }

    public function actualizarconfiguraciones(Request $request)
    {
        $configuracion      = Config::first();
        $configuracion->iva = $request->iva;
        $configuracion->save();

        return redirect()
                ->back()
                ->with('status','Actualizado Correctamente');
    }

    public function storemano(Request $request)
    {
        $mano = new Mano();
        $mano->nombre = $request->nombre;
        $mano->precio = $request->precio;
        $mano->save();

        return redirect()
                ->back()
                ->with('status','Mano de Obra registrada');
    }

    public function storeindirecto(Request $request)
    {
        $indirecto = new Indirecto();
        $indirecto->nombre = $request->nombre;
        $indirecto->precio = $request->precio;
        $indirecto->save();

        return redirect()
                ->back()
                ->with('status','Indirecto registrado');
    }
}

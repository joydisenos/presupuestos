<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partida;
use App\Config;
use App\Mano;
use App\Indirecto;
use App\Partidamaterial;
use App\Presupuestopartida;
use App\PresupuestoMaterial;
use App\Material;
use App\Unidad;
use App\SubMaterial;
use App\Presupuesto;
use App\Exports\PartidasExport;
use App\Exports\MaterialesExport;
use App\Exports\PresupuestoExport;
use App\Exports\MaterialesCountExport;
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
    	
        $partidas = Partida::where('estatus','=',1)->get();
        $manos = Mano::where('estatus','=',1)->get();
    	$indirectos = Indirecto::where('estatus','=',1)->get();

		return view('partidas',compact('partidas','manos','indirectos'));
	}

    public function partida($id)
    {
        
        $partida             = Partida::findOrFail($id);
        $materiales          = Material::where('estatus','=',1)->get();
        $presupuestopartidas = Presupuestopartida::where('partida_id','=',$id)->get();
        $manos               = Mano::where('estatus','=',1)->get();
        $indirectos          = Indirecto::where('estatus','=',1)->get();

        return view('partida',compact('partida','materiales','presupuestopartidas','manos','indirectos'));
    }

    public function eliminarpartida($id)
    {
        $partida = Partida::findOrFail($id);
        $partida->estatus = 0;
        $partida->save();

        return redirect()->back()->with('status','Partida eliminada');
    }



	public function storepartidas(Request $request)
    {
        // $mano      = Mano::findOrFail($request->mano_id);
        // $indirecto = Indirecto::findOrFail($request->indirecto_id);
        // $total     = 0;
        // $total     = $total + $mano->precio;
        // $total     = $total + $indirecto->precio

        $validatedData = $request->validate([
                'mano_id' => 'required',
                'indirecto_id' => 'required',
                ]);

        $partida               = new Partida();
        $partida->nombre       = $request->nombre;
        $partida->mano_id      = $request->mano_id;
        $partida->indirecto_id = $request->indirecto_id;
        $partida->campo1 = 'campo';
        $partida->valor1 = 0;
        $partida->campo2 = 'campo';
        $partida->valor2 = 0;
        $partida->campo3 = 'campo';
        $partida->valor3 = 0;
        $partida->save();


        Excel::store(new PartidasExport,'partidas.xlsx');

        return redirect()->back()->with('status','Partida Registrada con éxito');
		
	}

    
    public function materiales()

    {
        $materiales = Material::where('estatus','=',1)->get();
        $unidades = Unidad::where('estatus','=',1)->get();

        return view('materiales',compact('materiales','unidades'));
    }

    public function storemateriales(Request $request)
    {

         $validatedData = $request->validate([
                'nombre' => 'required|string|min:3|unique:materials',
                'precio' => 'required|numeric',
                'tipo' => 'required',
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

    public function agregarmaterialescopia (Request $request)
    {

        $partidapadre = Presupuestopartida::findOrFail($request->partida_id);
        $partidapadre = $partidapadre->partida->id;
        $materiales = $request->input('material');

        foreach ($materiales as $key=>$material) 
        {

        $materialselect        = Material::findOrFail($material);
        
        $material              = new SubMaterial();
        $material->presupuestopartida_id  = (int) $request->partida_id;
        $material->presupuesto_id  = (int) $request->presupuesto_id;
        $material->material_id = $materialselect->id;
        $material->formula = '';
        $material->cantidad    = 1;
        $material->cantidad_partida    = $partidapadre;
        $material->save();
        
        }

        return redirect()->back()->with('status','Materiales asignados correctamente');
    }

    public function editarmaterial(Request $request, $id)
    {
        $validatedData = $request->validate([
                'nombre' => 'required',
                'precio' => 'required',
                'tipo' => 'required',
                ]);

        $material = Material::findOrFail($id);
        $material->nombre = $request->nombre;
        $material->precio = $request->precio;
        $material->tipo = $request->tipo;
        $material->save();

        return redirect()->back()->with('status','Material editado correctamente');

    }

    public function eliminarmaterial($id)
    {
        $material = Material::findOrFail($id);
        $material->estatus = 0;
        $material->save();

        return redirect()->back()->with('status','Material eliminado');
    }

    public function actualizarmateriales(Request $request)
    {
        
        $validatedData = $request->validate([
                'presupuestocantidad' => 'required',
                'nombre' => 'required',
                'material_id' => 'required',
                'cantidad' => 'required',
                ]);

        $materialId                   = $request->input('material_id');
        $cantidades                   = $request->input('cantidad');
        $formulas                     = $request->input('formula');
        $arreglo                      = array_combine($materialId , $cantidades);
        $arreglo2                     = array_combine($materialId , $formulas);
        $acumular                     = 0;

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

        $partida            = Partida::findOrFail($request->partida_id);
        $partida->cantidad   = $request->presupuestocantidad;
        $partida->campo1 = $request->campo1;
        $partida->valor1 = $request->valor1;
        $partida->campo2 = $request->campo2;
        $partida->valor2 = $request->valor2;
        $partida->campo3 = $request->campo3;
        $partida->valor3 = $request->valor3;
        $partida->nombre   = $request->nombre;
        $partida->mano_id   = $request->mano_id;
        $partida->indirecto_id = $request->indirecto_id;
        //$mano               = $acumular * (((float)$partida->mano->precio)/100);
        //$indirecto          = $acumular * (((float)$partida->indirecto->precio)/100);
        // $partida->total     = $acumular + $mano + $indirecto;
        $partida->total_materiales     = $acumular;
        $partida->save();

        Excel::store(new PartidasExport,'partidas.xlsx');

        return redirect()
                ->back()
                ->with('status','Materiales actualizados correctamente');
    }

    public function actualizarmaterialescopia (Request $request)
    {
        // Materiales Almacenados en PRESUPUESTOS
        $validatedData = $request->validate([
                'presupuestocantidad' => 'required',
                'nombre' => 'required',
                ]);

        $materialId                   = $request->input('material_id');
        $cantidades                   = $request->input('cantidad');
        $formulas                     = $request->input('formula');
        $arreglo                      = array_combine($materialId , $cantidades);
        $arreglo2                     = array_combine($materialId , $formulas);
        $acumular                     = 0;

        foreach ($arreglo2 as $material_id => $formula) {
            $material           = SubMaterial::findOrFail($material_id);
            if($formula==null)
            {
                $material->formula = '';
                $material->cantidad_partida = $request->presupuestocantidad;
            }else{
                $material->formula = $formula;
                $material->cantidad_partida = $request->presupuestocantidad;
            }
            $material->save();
        }

        foreach ($arreglo as $material_id => $cantidad) 
        {
            $material           = SubMaterial::findOrFail($material_id);
            $material->cantidad = $cantidad;
            $material->save();
            
            $suma     = Material::findOrFail($material->material_id);
            $precio   = (float)$suma->precio * $cantidad;
            $acumular = $acumular + (float)$precio;
        }


        $partida            = Presupuestopartida::findOrFail($request->partida_id);
        $partida->cantidad   = $request->presupuestocantidad;
        $partida->campo1 = $request->campo1;
        $partida->valor1 = $request->valor1;
        $partida->campo2 = $request->campo2;
        $partida->valor2 = $request->valor2;
        $partida->campo3 = $request->campo3;
        $partida->valor3 = $request->valor3;
        $partida->mano_id   = $request->mano_id;
        $partida->indirecto_id = $request->indirecto_id;
        //$mano               = $acumular * (((float)$partida->mano->precio)/100);
        //$indirecto          = $acumular * (((float)$partida->indirecto->precio)/100);
        $partida->total_materiales     = $acumular;
        // $partida->total     = $acumular + $mano + $indirecto;
        $partida->save();


    

        return redirect()
                ->back()
                ->with('status','Materiales actualizados correctamente');
    }

    public function presupuesto($id)
    {
        $presupuesto     = Presupuesto::findOrFail($id);
        $configuraciones = Config::first();
        $partidas        = Partida::where('estatus','=',1)->get();
        $manos           = Mano::where('estatus','=',1)->get();
        $indirectos      = Indirecto::where('estatus','=',1)->get();
        $materiales = SubMaterial::
                    with('presupuestopartida')
                    ->select('material_id', DB::raw('SUM(cantidad * cantidad_partida) as total_cantidades'))
                    ->where('presupuesto_id',$id)
                    ->groupBy('material_id')
                    ->get();

        return view('presupuesto',compact('presupuesto','configuraciones','partidas','manos','indirectos','materiales'));
    }

    public function eliminarpresupuestomaterial($id)
    {
        $material = Partidamaterial::findOrFail($id);
        $material->delete();

        return redirect()->back()->with('status','Material Eliminado');
    }

    public function eliminarpresupuesto($id)
    {
        $presupuesto = Presupuesto::findOrFail($id);
        $presupuesto->estatus = 0;
        $presupuesto->save();

        return redirect()->back()->with('status','Presupuesto eliminado');
    }

    public function agregarpresupuesto(Request $request)
    {


         $validatedData = $request->validate([
                'partidas' => 'required',
                ]);

        $partidas = $request->input('partidas');
        foreach ($partidas as $partida) 
        {
            $partidapadre = Partida::findOrFail($partida);
            $pre = new Presupuestopartida();
            $pre->partida_id     = $partida;
            $pre->numero         = '1';
            $pre->presupuesto_id = $request->presupuesto_id;
            $pre->unidad         = '';
            $pre->mano_id = $partidapadre->mano_id;
            $pre->indirecto_id = $partidapadre->indirecto_id;
            $pre->cantidad       = $partidapadre->cantidad;
            $pre->campo1 = $partidapadre->campo1;
            $pre->valor1 = $partidapadre->valor1;
            $pre->campo2 = $partidapadre->campo2;
            $pre->valor2 = $partidapadre->valor2;
            $pre->campo3 = $partidapadre->campo3;
            $pre->valor3 = $partidapadre->valor3;
            $pre->save();

            $partidareal = Partida::findOrFail($partida);

            foreach ($partidareal->materiales as $material) {

                $materialcopia = new SubMaterial();
                $materialcopia->presupuestopartida_id = $pre->id;
                $materialcopia->presupuesto_id = $request->presupuesto_id;
                $materialcopia->material_id = $material->material_id;
                $materialcopia->cantidad = $material->cantidad;
                $materialcopia->cantidad_partida = $partidapadre->cantidad;
                $materialcopia->formula = $material->formula;
                $materialcopia->save();

            }

        }

        return redirect('presupuesto'.'/'.$request->presupuesto_id);
    }

    public function actualizarpresupuesto(Request $request)
    {
        $validatedData = $request->validate([
                'nombre' => 'required',
                ]);
        
        $partidas = $request->input('partidas');
        //$cantidades = $request->input('cantidades');
        $manos = $request->input('manos');
        $indirectos = $request->input('indirectos');
        $numeros = $request->input('numeros');
        //$cambios = array_combine($partidas,$cantidades);
        $cambios2 = array_combine($partidas,$numeros);
        $cambios3 = array_combine($partidas,$manos);
        $cambios4 = array_combine($partidas,$indirectos);

        /*
        foreach ($cambios as $partida => $cantidad) {
            $partida = Presupuestopartida::findOrFail($partida);
            $partida->cantidad = $cantidad;
            $partida->save();
        }
        */

        foreach ($cambios2 as $partida => $numero) {
            $partida = Presupuestopartida::findOrFail($partida);
            $partida->numero = $numero;
            $partida->save();
        }

        foreach ($cambios3 as $partida => $mano) {
            $partida = Presupuestopartida::findOrFail($partida);
            $partida->mano_id = $mano;
            $partida->save();
        }

        foreach ($cambios4 as $partida => $indirecto) {
            $partida = Presupuestopartida::findOrFail($partida);
            $partida->indirecto_id = $indirecto;
            $partida->save();
        }

        $presupuesto = Presupuesto::findOrFail($request->presupuesto_id);
        $presupuesto->subtotal = $request->subtotal;
        $presupuesto->total = $request->total;
        $presupuesto->nombre = $request->nombre;
        $presupuesto->save();

        return redirect()->back()->with('status','Cambios registrados con éxito');
    }

    public function partidapresupuestoactualizar ($id)
    {

        $partida             = Presupuestopartida::findOrFail($id);
        $materiales          = Material::where('estatus','=',1)->get();
        $presupuestopartidas = SubMaterial::where('partida_id','=',$id)->get();
        $manos               = Mano::where('estatus','=',1)->get();
        $indirectos          = Indirecto::where('estatus','=',1)->get();

        return view('partidapresupuesto',compact('partida','materiales','presupuestopartidas','manos','indirectos'));
    }

    public function exportarpresupuesto($id)
    {
        $presupuesto = Presupuesto::findOrFail($id);
        $configuraciones = Config::first();
        

       return Excel::download(new PresupuestoExport($presupuesto,$configuraciones),'presupuesto.xlsx');
    }

    public function exportarmaterialesglobal($id)
    {

        $materiales = SubMaterial::
                    with('presupuestopartida')
                    ->select('material_id', DB::raw('SUM(cantidad * cantidad_partida) as total_cantidades'))
                    ->where('presupuesto_id',$id)
                    ->groupBy('material_id')
                    ->get();
        

       return Excel::download(new MaterialesCountExport($materiales),'presupuesto.xlsx');
    }

    public function exportarmateriales($id)
    {
        $presupuesto = Presupuesto::findOrFail($id);
        $configuraciones = Config::first();
        

       return Excel::download(new MaterialesExport($presupuesto,$configuraciones),'materiales.xlsx');
    }

    public function nuevopresupuesto()
    {
        $partidas = Partida::where('estatus','=',1)->get();

        return view('nuevopresupuesto',compact('partidas'));
    }

    public function historial()
    {
        $presupuestos = Presupuesto::where('estatus','=',1)->get();

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
        foreach ($partidas as $key => $partida) 
        {
            $partidapadre = Partida::findOrFail($partida);
            $pre = new Presupuestopartida();
            $pre->partida_id     = $partida;
            $pre->numero         = $key;
            $pre->presupuesto_id = $presupuesto->id;
            $pre->mano_id = $partidapadre->mano_id;
            $pre->indirecto_id = $partidapadre->indirecto_id;
            $pre->campo1 = $partidapadre->campo1;
            $pre->valor1 = $partidapadre->valor1;
            $pre->campo2 = $partidapadre->campo2;
            $pre->valor2 = $partidapadre->valor2;
            $pre->campo3 = $partidapadre->campo3;
            $pre->valor3 = $partidapadre->valor3;
            $pre->unidad         = '';
            $pre->cantidad       = $partidapadre->cantidad;
            $pre->save();

            $partidareal = Partida::findOrFail($partida);

            foreach ($partidareal->materiales as $material) {

                $materialcopia = new SubMaterial();
                $materialcopia->presupuestopartida_id = $pre->id;
                $materialcopia->presupuesto_id = $presupuesto->id;
                $materialcopia->material_id = $material->material_id;
                $materialcopia->cantidad = $material->cantidad;
                $materialcopia->cantidad_partida = $partidapadre->cantidad;
                $materialcopia->formula = $material->formula;
                $materialcopia->save();

            }
        }

        return redirect('presupuesto'.'/'.$presupuesto->id);
    }
    public function configuraciones()
    {
        $configuracion = Config::first();
        $manos         = Mano::where('estatus','=',1)->get();
        $indirectos    = Indirecto::where('estatus','=',1)->get();
        $partidas      = Partida::where('estatus','=',1)->get();
        $unidades      = Unidad::where('estatus','=',1)->get();
        
        if($configuracion == null)
        {
            $configuracion      = new Config();
            $configuracion->iva = 0;
            $configuracion->save();
        }

        return view('globales',compact('configuracion','manos','indirectos','partidas','unidades'));
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
        $validatedData = $request->validate([
                'nombre' => 'required',
                'precio' => 'required',
                ]);

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
        $validatedData = $request->validate([
                'nombre' => 'required',
                'precio' => 'required',
                ]);

        $indirecto = new Indirecto();
        $indirecto->nombre = $request->nombre;
        $indirecto->precio = $request->precio;
        $indirecto->save();

        return redirect()
                ->back()
                ->with('status','Indirecto registrado');
    }

    public function storeunidad(Request $request)
    {
        $validatedData = $request->validate([
                'nombre' => 'required',
                ]);

        $unidad = new Unidad();
        $unidad->nombre = $request->nombre;
        $unidad->save();

        return redirect()->back()->with('status','Unidad registrada con éxito');
    }

    public function eliminarunidad($id)
    {
        $unidad = Unidad::findOrFail($id);
        $unidad->estatus = 0;
        $unidad->save();

        return redirect()->back()->with('status','Unidad eliminada');
    }

    public function eliminarmano($id)
    {
        $mano = Mano::findOrFail($id);
        $mano->estatus = 0;
        $mano->save();

        return redirect()->back()->with('status','Mano de obra eliminada');
    }

    public function eliminarindirecto($id)
    {
        $indirecto = Indirecto::findOrFail($id);
        $indirecto->estatus = 0;
        $indirecto->save();

        return redirect()->back()->with('status','Indirecto eliminado');
    }

    public function eliminarpartidapresupuesto($id)
    {
        $partida = Presupuestopartida::findOrFail($id);
        $partida->delete();

        return redirect()->back()->with('status','Partida eliminada');
    }

    public function modificarunidad(Request $request)
    {
        $unidad = Unidad::findOrFail($request->unidad_id);
        $unidad->nombre = $request->nombre;
        $unidad->save();

        return redirect()->back()->with('status','Unidad modificada');
    }

    public function modificarmano(Request $request)
    {
        $mano = Mano::findOrFail($request->mano_id);
        $mano->nombre = $request->nombre;
        $mano->precio = $request->precio;
        $mano->save();

        return redirect()->back()->with('status','Mano de Obra modificada');
    }

    public function modificarindirecto(Request $request)
    {
        $indirecto = Indirecto::findOrFail($request->indirecto_id);
        $indirecto->nombre = $request->nombre;
        $indirecto->precio = $request->precio;
        $indirecto->save();

        return redirect()->back()->with('status','Indirecto modificado');
    }

}

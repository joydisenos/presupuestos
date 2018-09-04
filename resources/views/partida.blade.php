@extends('layouts.principal')
@section('content')
<div id="wrapper">

    @include('includes.nav') 

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                    @include('includes.error')
                    @include('includes.errors')
                    @include('includes.notificacion')
                
<div class="row">
    <div class="col-md-8">
        <h3>Partida: {{$partida->nombre}}</h3>
    </div>
    <div class="col-md-4">
        <label for="">Editar nombre</label>
       <input type="text" id="nombrepartida" value="{{$partida->nombre}}" class="form-control form-control-lg">
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <h3>Cantidad Global</h3>
    </div>
    <div class="col-md-3">
        <h3 class="slugpartida">&PG%</h3>
    </div>
    <div class="col-md-3">
        <label for="">Cantidad</label>
        <input type="number" value="{{$partida->cantidad}}" min="0" step="0.01" name="cantidadglobal" id="PG" class="form-control cantidadglobal">
    </div>
</div>
<hr>

<!-- Campos Personalizados -->
<div class="row">
    <div class="col-md-6">
        <input type="text" target-id="#campo1" class="form-control campos" value="{{$partida->campo1}}">
    </div>
    <div class="col-md-3">
        <h6 class="slugcampo">&C01%</h6>
    </div>
    <div class="col-md-3">

        <input type="number" value="{{$partida->valor1}}" min="0" step="0.01" target-id="#valor1" id="C01" class="form-control valores">
    </div>
</div>
<hr>

<div class="row">
    <div class="col-md-6">
        <input type="text" target-id="#campo2" class="form-control campos" value="{{$partida->campo2}}">
    </div>
    <div class="col-md-3">
        <h6 class="slugcampo">&C02%</h6>
    </div>
    <div class="col-md-3">

        <input type="number" value="{{$partida->valor2}}" min="0" step="0.01" target-id="#valor2" id="C02" class="form-control valores">
    </div>
</div>

<hr>

<div class="row">
    <div class="col-md-6">
        <input type="text" target-id="#campo3" class="form-control campos" value="{{$partida->campo3}}">
    </div>
    <div class="col-md-3">
        <h6 class="slugcampo">&C03%</h6>
    </div>
    <div class="col-md-3">

        <input type="number" value="{{$partida->valor3}}" min="0" step="0.01" target-id="#valor3" id="C03" class="form-control valores">
    </div>
</div>

<hr>

<div class="row">
    <div class="col-md-6">
        <input type="text" target-id="#campo4" class="form-control campos" value="{{$partida->campo4}}">
    </div>
    <div class="col-md-3">
        <h6 class="slugcampo">&C04%</h6>
    </div>
    <div class="col-md-3">

        <input type="number" value="{{$partida->valor4}}" min="0" step="0.01" target-id="#valor4" id="C04" class="form-control valores">
    </div>
</div>

<hr>


<div class="row">
    <div class="col-md-6">
        <input type="text" target-id="#campo5" class="form-control campos" value="{{$partida->campo5}}">
    </div>
    <div class="col-md-3">
        <h6 class="slugcampo">&C05%</h6>
    </div>
    <div class="col-md-3">

        <input type="number" value="{{$partida->valor5}}" min="0" step="0.01" target-id="#valor5" id="C05" class="form-control valores">
    </div>
</div>

<hr>

<!-- Fin Campos Personalizados -->


                <div class="row">
                	<div class="col-lg-12">
                    	
                    <p><strong>Total Materiales: {{$partida->total_materiales}}</strong></p>

                    
                    	<button class="btn btn-primary agregar"> <i class="fa fa-plus"></i> Agregar Material</button>

                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#otros">
                        Otros
                        </button>
                    
                    </div>
                </div>

                <div class="row">
                	<div class="col-lg-12">
                		<div class="toggle">
                            <input type="text" id="filtro" class="form-control">
                    		<div class="table-responsive" id="registros">
                    		<table width="100%" class="table table-striped table-bordered table-hover">
                    			<form action="{{url('agregarmateriales')}}" method="post">
                                    {{csrf_field()}}
                    		<tbody>
                    			
                    				<input type="hidden" name="partida_id" value="{{$partida->id}}">
                    		@foreach($materiales as $material)
                    		<tr>
                    			<td><input type="checkbox" name="material[]" value="{{$material->id}}"></td>
                    			<td>{{$material->nombre}}</td>
                    			<td>{{$material->precio}}</td>
                    			<td>{{$material->tipo}}</td>
                    			
                    		</tr>
                    		@endforeach
                    		<tr>
                    			<td colspan="4">
                    				<button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Guardar</button>
                    			</td>
                    		</tr>
                    			
                    		</tbody>
                            </form>
                    		</table>
                    		</div>
                    		
                    </div>
                	</div>
                </div> 

                 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Listado de Materiales
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
<form action="{{url('actualizarmateriales')}}" method="post">
    <input type="hidden" name="campo1" id="campo1" value="{{$partida->campo1}}">
    <input type="hidden" name="valor1" id="valor1" value="{{$partida->valor1}}">
    <input type="hidden" name="campo2" id="campo2" value="{{$partida->campo2}}">
    <input type="hidden" name="valor2" id="valor2" value="{{$partida->valor2}}">
    <input type="hidden" name="campo3" id="campo3" value="{{$partida->campo3}}">
    <input type="hidden" name="valor3" id="valor3" value="{{$partida->valor3}}">
    <input type="hidden" name="campo4" id="campo4" value="{{$partida->campo4}}">
    <input type="hidden" name="valor4" id="valor4" value="{{$partida->valor4}}">
    <input type="hidden" name="campo5" id="campo5" value="{{$partida->campo5}}">
    <input type="hidden" name="valor5" id="valor5" value="{{$partida->valor5}}">
    <input type="hidden" name="presupuestopartida_id" id="presupuestopartida" value="">
                                        <input type="hidden" value="{{$partida->id}}" name="partida_id">
                                        <input type="hidden" id="presupuestocantidad" value="{{$partida->cantidad}}" name="presupuestocantidad">
                                        {{csrf_field()}}
    <input type="hidden" class="nombrepartida" name="nombre" value="{{$partida->nombre}}">
<div class="row">
    <div class="col-md-6">
        <label for="">Mano de Obra</label>
        <select name="mano_id" id="mano_id" class="form-control">
            @foreach($manos as $mano)
            <option value="{{$mano->id}}" <?php if($partida->mano_id == $mano->id){echo "selected";} ?> >{{$mano->nombre}}, {{$mano->precio}}% </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label for="">Indirectos</label>
        <select name="indirecto_id" id="indirecto_id" class="form-control">
            @foreach($indirectos as $indirecto)
            <option value="{{$indirecto->id}}" <?php if($partida->indirecto_id == $indirecto->id){echo "selected";} ?> >{{$indirecto->nombre}}, {{$indirecto->precio}}% </option>
            @endforeach
        </select>
    </div>
</div>
                            <table width="100%" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Eliminar</th>
                                        <th>Material</th>
                                        <th>Slug</th>
                                        <th>Precio</th>
                                        <th>Tipo</th>
                                        <th>Incremento</th>
                                        <th>Cantidad</th>
                                        <th>Total</th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="datos">
                                    
                                       
                                    @foreach($partida->materiales as $material)
                                    <tr>
                                        <td>
                                            <a href="{{url('material/eliminar').'/'.$material->id}}" class="btn btn-primary"> <i class="fa fa-trash"></i> </a>
                                        </td>
                                    	<td>
                                    		{{$material->material->nombre}}
                                    	</td>
                                        <td>
                                            &M{{$material->material->id}}%
                                        </td>
                                    	<td>
                                    		${{$material->material->precio}}
                                            <input type="hidden" name="price" class="price" value="{{$material->material->precio}}">
                                    	</td>
                                    	<td>
                                    		{{$material->material->tipo}}
                                    	</td>
                                      
                                        <td><input type="text" placeholder="=&slug% * n" name="formula[]" class="form-control operaciones" value="{{$material->formula}}">
<input type="hidden" class="formulas" value="
<?php 
$material->formula = str_replace('=', 'mat = ', $material->formula);
$material->formula = str_replace('&',"parseFloat($('#", $material->formula);
            $material->formula = str_replace('%',"').val())",$material->formula);
            echo $material->formula;

 ?>
" name="">
                                        </td>
                                    	<td>
                                    		<input type="hidden" name="material_id[]" value="{{$material->id}}">
                                            <input type="number" min="0" step="0.01" name="cantidad[]" class="form-control cantidades" id="M{{$material->material->id}}" value="{{$material->cantidad}}" slug="M{{$material->material->id}}" required>

                                    	</td>
                                    	<td>
                                    		$<span id="total{{$material->id}}" class="precios">{{$material->material->precio * $material->cantidad}}</span>
                                    	</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                    <tr>
                                    	<td colspan="6">
                                    		<button type="submit" class="btn btn-primary">Guardar cambios</button>
                                    	</td>
                                    </tr>
                                    </form>
                                
                            </table>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


<!-- Modal -->
<div class="modal fade" id="otros" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Otros</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('agregarotros')}}" method="post">
        {{csrf_field()}}
        <input type="hidden" name="partida_id" value="{{$partida->id}}">
          <div class="modal-body">

             <div class="form-group">
            <label for="">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="" required>
        </div>
        <div class="form-group">
            <label for="">Precio($)</label>
            <input type="text" name="precio" step="0.01" min="0" class="form-control" required>
        </div>
       <div class="form-group">
                                            <label>Tipo</label>
                                            <select name="tipo" class="form-control">
                            <option>Seleccione la unidad</option>
                            <option value="N/A">No aplica</option>
                            @foreach($unidades as $unidad)
                            <option value="{{$unidad->nombre}}">{{$unidad->nombre}}</option>
                            @endforeach
                                            </select>
                           </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Registrar</button>
        
      </div>
      </form>
    </div>
  </div>
</div>
@endsection 

@section('scripts')

@include('includes.tablasscript')

<script type="text/javascript">
        
       //cambio de valores de campos personalizados

       $('.campos, .valores').change(function(){
            id = $(this).attr('target-id');
            val = $(this).val();
            $(id).val(val);
       });
        
        $('#nombrepartida').change(function(){
            nombre = $(this).val();
            $('.nombrepartida').val(nombre);
        });
    

        $('.cantidadglobal').change(function(){
            cantidadpresupuesto = $(this).val();
            $('#presupuestocantidad').val(cantidadpresupuesto);
        })

        $('input,.nombrepresupuesto').change(function(){

            $('.datos tr').each(function(){


            //buscar formulas
            operaciones = $(this).find('.operaciones').val();

            if(operaciones != '')
            {
                operaciones = operaciones.replace('=', 'mat = ');
                operaciones = operaciones.replace('&',"parseFloat($('#");
                operaciones = operaciones.replace('%',"').val())");
                $(this).find('.formulas').val(operaciones);

            }
            
            
            mat = null;
            var formula = $(this).find('.formulas').val();
            
            $.globalEval(formula);

            if(mat != null)
            {
               $(this).find('.cantidades').val(mat.toFixed(2)); 
            }else{

            }

            var precio    = $(this).find('.price').val();
            var multiplo  = $(this).find('.cantidades').val();
            var resultado = parseFloat(multiplo) * parseFloat(precio);
            $(this).find('.precios').text(resultado.toFixed(2));

            });

        });

        $(document).ready(function () {
        $('#filtro').keyup(function () {
      var rex = new RegExp($(this).val(), 'i');
        $('#registros tr').hide();
        $('#registros tr').filter(function () {
            return rex.test($(this).text());
        }).show();

        })

});

       



</script>

 @endsection
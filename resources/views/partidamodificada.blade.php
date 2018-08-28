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
                    <div class="col-lg-12">
                        <h1 class="page-header">Partida: {{$partida->nombre}}</h1>
                    </div>
                    <!-- /.col-lg-12 -->

                    

                    


                  

                </div>
                <!-- /.row -->
<div class="row">
    <div class="col-md-6">
        <label for="">Presupuesto</label>
        <select name="" id="" class="form-control nombrepresupuesto">
            @foreach($presupuestopartidas as $presupuesto)
            <option value="{{$presupuesto->id}}" attr-cantidad="{{$presupuesto->cantidad}}">{{$presupuesto->presupuesto->nombre}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <h3 class="slugpartida">&PG%</h3>
    </div>
    <div class="col-md-3">
        <label for="">Cantidad</label>
        <input type="number" value="{{old('cantidadglobal')}}" min="0" step="0.01" name="cantidadglobal" id="PG" class="form-control cantidadglobal">
    </div>
</div>


                <div class="row">
                	<div class="col-lg-12">
                    	
                    <p><strong>Total: {{$partida->total}}</strong></p>

                    
                    	<button class="btn btn-primary agregar"> <i class="fa fa-plus"></i> Agregar Material</button>
                    
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
                                    
                                        <input type="hidden" name="presupuestopartida_id" id="presupuestopartida" value="">
                                        <input type="hidden" id="presupuestocantidad" value="" name="presupuestocantidad">
                                    	{{csrf_field()}}
                                        <input type="hidden" value="{{$partida->id}}" name="partida_id">
                                    @foreach($partida->materiales as $material)
                                    <tr>
                                    	<td>
                                    		{{$material->material->nombre}}
                                    	</td>
                                        <td>
                                            &M{{$material->material->id}}%
                                        </td>
                                    	<td>
                                    		{{$material->material->precio}}
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
                                    		<span id="total{{$material->id}}" class="precios">{{$material->material->precio * $material->cantidad}}</span>
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
@endsection 

@section('scripts')

@include('includes.tablasscript')

<script type="text/javascript">
        
       
        cantidadpresupuesto = $('.nombrepresupuesto option:selected').attr('attr-cantidad');
        presupuestopartida = $('.nombrepresupuesto option:selected').val();
            $('.cantidadglobal').val(cantidadpresupuesto)
            $('#presupuestopartida').val(presupuestopartida);
            $('#presupuestocantidad').val(cantidadpresupuesto);

        $('.nombrepresupuesto').change(function(){
            cantidadpresupuesto = $('.nombrepresupuesto option:selected').attr('attr-cantidad');
            presupuestopartida = $('.nombrepresupuesto option:selected').val();
            $('.cantidadglobal').val(cantidadpresupuesto)
            $('#presupuestopartida').val(presupuestopartida);
            $('#presupuestocantidad').val(cantidadpresupuesto);
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
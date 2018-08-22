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
        <select name="" id="" class="form-control">
            @foreach($presupuestopartidas as $presupuesto)
            <option value="{{$presupuesto->cantidad}}">{{$presupuesto->presupuesto->nombre}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <h3 class="slugpartida">Slug</h3>
    </div>
    <div class="col-md-3">
        <label for="">Cantidad</label>
        <input type="number" value="" class="form-control">
    </div>
</div>
                <div class="row">
                	<div class="col-lg-12">
                    	<p>Mano de Obra: {{$partida->mano->nombre}}, {{$partida->mano->precio}}%</p>
                    <p>Indirectos: {{$partida->indirecto->nombre}}, {{$partida->indirecto->precio}}%</p>
                    <p><strong>Total: {{$partida->total}}</strong></p>

                    
                    	<button class="btn btn-primary agregar"> <i class="fa fa-plus"></i> Agregar Material</button>
                    
                    </div>
                </div>

                <div class="row">
                	<div class="col-lg-12">
                		<div class="toggle">
                    		<div class="table-responsive">
                    		<table width="100%" class="table table-striped table-bordered table-hover">
                    			
                    		<tbody>
                    			<form action="{{url('agregarmateriales')}}" method="post">
                    				{{csrf_field()}}
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
                    			</form>
                    		</tbody>
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
                                    <form action="{{url('actualizarmateriales')}}" method="post">
                                    	{{csrf_field()}}
                                        <input type="hidden" value="{{$partida->id}}" name="partida_id">
                                    @foreach($partida->materiales as $material)
                                    <tr>
                                    	<td>
                                    		{{$material->material->nombre}}
                                    	</td>
                                        <td>
                                            &{{str_slug($material->material->nombre)}}%
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
                                            <input type="number" min="0" step="0.01" name="cantidad[]" class="form-control cantidades" id="{{str_slug($material->material->nombre)}}" value="{{$material->cantidad}}" slug="{{str_slug($material->material->nombre)}}" required>

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
    
        $('input').change(function(){

            $('.datos tr').each(function(){

            //buscar formulas
            mat = null;
            var formula = $(this).find('.formulas').val();
            
            $.globalEval(formula);

            if(mat != null)
            {
               $(this).find('.cantidades').val(mat); 
            }else{

            }

            var precio    = $(this).find('.price').val();
            var multiplo  = $(this).find('.cantidades').val();
            var resultado = parseFloat(multiplo) * parseFloat(precio);
            $(this).find('.precios').text(resultado);

            });

        });

       



</script>

 @endsection
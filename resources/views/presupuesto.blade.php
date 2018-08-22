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
                        <h1 class="page-header">Presupuesto {{$presupuesto->id}} {{$presupuesto->created_at->format('d-m-Y')}}</h1>
                    </div>
                    <!-- /.col-lg-12 -->

                </div>
                <!-- /.row -->
 
<div class="row">
                    <div class="col-md-12">
                        <h4>Agregar partida</h4>
                        <form action="{{url('presupuesto/agregar')}}" method="post">
                            {{csrf_field()}}
                        <input type="hidden" name="presupuesto_id" value="{{$presupuesto->id}}">
                        <select name="partidas[]" class="selectpicker" multiple title="Seleccione las partidas">
                                            
                                                @foreach($partidas as $partida)
                                                <option value="{{$partida->id}}">{{$partida->nombre}}</option>
                                                @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </form>
                    </div>
                </div>
                

                 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Detalles
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            
                            <form action="{{url('actualizarpresupuesto')}}" method="post">
                                {{csrf_field()}}
                            <input type="hidden" value="0" id="total" name="total">
                            <input type="hidden" value="0" id="subtotal" name="subtotal">
                            <input type="hidden" value="{{$presupuesto->id}}" name="presupuesto_id">
                            <input type="hidden" id="iva" value="{{$configuraciones->iva}}" name="iva">

                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Materiales</th>
                                        <th>Ver / Editar</th>
                                        <th>Mano de Obra</th>
                                        <th>Indirectos</th>
                                        <th>Subtotales</th>
                                        <th>Cantidad</th>
                                        <th>Total</th>
                                        
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($presupuesto->partidas as $partida)
                                    <tr>
                                    	<td>
                                    		{{$partida->partida->nombre}}
                                    	</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#materiales{{$partida->partida->id}}">
                                              Materiales
                                            </button>
                                        </td>
                                        <td>
                                            <a href="{{url('partida').'/'.$partida->id}}" class="btn btn-warning"> <i class="fa fa-eye"></i> </a>
                                        </td>
                                    	<td>
                                    		{{$partida->partida->mano->nombre}}, {{$partida->partida->mano->precio}}%
                                    	</td>
                                    	<td>
                                    		{{$partida->partida->indirecto->nombre}}, {{$partida->partida->indirecto->precio}}%
                                    	</td>
                                    	<td>
                                    		$<span class="totalunit">{{$partida->partida->total}}</span>
                                            <input type="hidden" name="item[]" class="totalpartida" value="{{$partida->partida->total}}">
                                    	</td>
                                        
                                        <td>
                                            <input type="number" min="0" step="0.01" class="form-control cantidades" name="cantidades[]" value="{{$partida->cantidad}}" disabled>
                                            <input type="hidden" name="partidas[]" value="{{$partida->id}}">
                                        </td>
                                        <td>
                                            $<span class="precios">{{$partida->cantidad * $partida->partida->total}}</span>
                                            <input type="hidden" class="preciosval" value="{{$partida->cantidad * $partida->partida->total}}">
                                        </td>
                                    </tr>
                                    @endforeach

                                    <tr>
                                        <td colspan="7" align="right">Subtotal</td>
                                        <td>$<span class="subtotal">0</span> </td>
                                        
                                    </tr>

                                    <tr>
                                        <td colspan="7" align="right">Iva ({{$configuraciones->iva}}%)</td>
                                        <td>$<span class="iva">0</span></td>
                                    </tr>

                                    <tr>
                                        <td colspan="7" align="right"><strong>Total</strong></td>
                                        <td><strong>$<span class="total">0</span></strong></td>
                                        
                                    </tr>
                                    <tr>
                                        <td colspan="7" align="right">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#materialestotal">
                                              Materiales
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                Guardar
                                            </button>
                                        </td>
                                        <td>
                                            <!--<a class="btn btn-success" href="{{url('exportar/presupuesto').'/'.$presupuesto->id}}">
                                                Excel
                                            </a>-->
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            </form>
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

     @foreach($presupuesto->partidas as $partida)
     <!-- Modal -->
<div class="modal fade" id="materiales{{$partida->partida->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{$partida->partida->nombre}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-hover">
            <thead>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
            </thead>
        @foreach($partida->partida->materiales as $material)
        <tr>
            <td>{{$material->material->nombre}}</td>
            <td>{{$material->material->tipo}}</td>
            <td>{{$material->material->precio}}</td>
            <td>{{$material->cantidad}}</td>
            <td>{{$material->cantidad * $material->material->precio}}</td>
        </tr>    
        @endforeach
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
@endforeach

 <!-- Modal -->
<div class="modal fade" id="materialestotal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{$partida->partida->nombre}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-hover">
            <thead>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
            </thead>
        @foreach($presupuesto->partidas as $partida)
        @foreach($partida->partida->materiales as $material)
        <tr>
            <td>{{$material->material->nombre}}</td>
            <td>{{$material->material->tipo}}</td>
            <td>{{$material->material->precio}}</td>
            <td>{{$material->cantidad}}</td>
            <td>{{$material->cantidad * $material->material->precio}}</td>
        </tr>    
        @endforeach
        @endforeach
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
@endsection 

@section('scripts')

@include('includes.tablasscript')
<script>

    
        
    

$('.selectpicker').selectpicker({
    liveSearch: true,
    liveSearchNormalize: true,
});

var subtotal     = 0;
var iva = parseFloat($('#iva').val()) / 100;

$('.precios').each(function(i){
            
                    
            subtotal += parseFloat($(this).html());
            
             $('.subtotal').html(subtotal);
             var sIva = subtotal * parseFloat(iva);
             
             $('.iva').html(sIva);
             var total = subtotal + sIva;
             $('.total').html(total)

             $('#subtotal').val(subtotal);
             $('#total').val(total);
                
           
        });

    $('.cantidades').change(function(){
        var multiplo     = $(this).val();
        var totalpartida = $(this).parents('tr').find('.totalpartida').val();
        var item         = parseFloat(totalpartida) * parseFloat(multiplo);
        var subtotal     = 0;
        var iva = parseFloat($('#iva').val()) / 100;

        $(this).parents('tr').find('.precios').html(item);

        $('.precios').each(function(i){
            
                    
            subtotal += parseFloat($(this).html());
            
             $('.subtotal').html(subtotal);
             var sIva = subtotal * parseFloat(iva);
             
             $('.iva').html(sIva);
             var total = subtotal + sIva;
             $('.total').html(total);
            $('#subtotal').val(subtotal);
             $('#total').val(total);
                
           
        });
        
       
    });

   
</script>
 @endsection
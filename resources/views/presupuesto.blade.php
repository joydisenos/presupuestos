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
                        <h1 class="page-header">{{$presupuesto->nombre}} <small> {{$presupuesto->created_at->format('d-m-Y')}}</small></h1>
                    </div>
                    <!-- /.col-lg-12 -->

                </div>
                <!-- /.row -->
 
<div class="row">
                    <div class="col-md-6">
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control nombrepresupuesto" value="{{$presupuesto->nombre}}">
                        </div>
                    </div>
                </div>

@if($presupuesto->notas != null)
                <div class="row">
                    <div class="col-md-12">
                        {!!$presupuesto->notas!!}
                    </div>
                </div>
@endif

                 <div class="row">
                <div class="col-lg-12">
                   
                    <!-- /.panel -->
                     <form action="{{url('actualizarpresupuesto')}}" method="post">
                                {{csrf_field()}}
                            <input type="hidden" value="0" id="total" name="total">
                            <input type="hidden" value="0" id="subtotal" name="subtotal">
                            <input type="hidden" value="{{$presupuesto->id}}" name="presupuesto_id">
                            <input type="hidden" id="iva" value="{{$configuraciones->iva}}" name="iva">
                            <input type="hidden" id="nombrepresupuesto" value="{{$presupuesto->nombre}}" name="nombre">
<div class="row">
        <div class="col-md-6">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#notas">
                        Notas
                        </button>
        </div>
        <div class="col-md-6">
            <label for="">Seleccionar color</label>
            <input type="color" name="color"
    @if($partida->color != null)
    value="{{$partida->color}}"
    @else
    value="#ffffff"
    @endif
>
        </div>
    </div>

<div class="table-responsive">

                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Eliminar</th>
                                        <th>Número</th>
                                        <th>Nombre</th>
                                        <th>Materiales</th>
                                        <th>Ver / Editar</th>
                                        <th>T. Materiales</th>
                                        <th>Mano de Obra</th>
                                        <th>Indirectos</th>
                                        <th>Subtotales</th>
                                        <th>Cantidad</th>
                                        <th>Total</th>
                                        
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($presupuesto->partidas  as $numero => $partida)
                                    <tr
                                    @if($partida->color != null)
                                    style="background-color:{{$partida->color}}"
                                    @endif
                                    >
                                        <td>
                                            <a href="{{url('eliminar/partidapresupuesto').'/'.$partida->id}}" class="btn btn-primary btn-xs"> <i class="fa fa-trash"></i> </a>
                                        </td>
                                        <td>
                                            
                                            <input type="text" class="form-control" value="{{$partida->numero}}" name="numeros[]" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" value="{{$partida->nombre}}" name="nombres[]">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#materiales{{$numero}}{{$partida->partida->id}}">
                                              <i class="fa fa-eye"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <a href="{{url('partidapresupuesto').'/'.$partida->id}}" class="btn btn-warning"> <i class="fa fa-eye"></i> </a>
                                        </td>
                                        <td>
                                            <?php $total = 0; ?>
                                            <?php $cantidades_globales = 0; ?>
                                            @foreach($partida->materiales as $material)
<?php $total += $material->cantidad * $material->material->precio; ?>
                                            @endforeach
                                            $<span class="tmaterial">{{$total}}</span>
                                        </td>
                                        <td>
                                            
                                            <select name="manos[]" class="form-control manodeobra" id="">
                                                @foreach($manos as $mano)
                                                <option value="{{$mano->id}}" attr-porcentaje="{{$mano->precio}}" <?php if($partida->mano_id == $mano->id){ echo 'selected'; } ?> >{{$mano->nombre}}, {{$mano->precio}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select name="indirectos[]" class="form-control indirectos" id="">
                                                @foreach($indirectos as $indirecto)
                                                <option value="{{$indirecto->id}}" attr-porcentaje="{{$indirecto->precio}}" <?php if($partida->indirecto_id == $mano->id){ echo 'selected'; } ?> >{{$indirecto->nombre}}, {{$indirecto->precio}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            $<span class="totalunit">{{$partida->total}}</span>
                                            <input type="hidden" name="item[]" class="totalpartida" value="{{$partida->total}}">
                                        </td>
                                        
                                        <td>
                                            
                                            <span class="cantidades">{{$partida->cantidad}}</span>
                                            <input type="hidden" name="partidas[]" value="{{$partida->id}}">
                                        </td>
                                        <td>
$<span class="precios">{{

     

    ($partida->total_materiales + (($partida->mano->precio / 100) * $partida->total_materiales) + (($partida->indirecto->precio /100) * $partida->total_materiales)) * $partida->cantidad

}}</span>
<input type="hidden" class="preciosval" value="{{
($partida->total_materiales + (($partida->mano->precio / 100) * $partida->total_materiales) + (($partida->indirecto->precio /100) * $partida->total_materiales)) * $partida->cantidad
}}">
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#totalmateriales">
                                          Global
                                        </button>
                                        </td>
                                        <td></td>
                                        <td>$<span class="materialesglobal"></span></td>
                                        <td>$<span class="manoglobal"></span></td>
                                        <td>$<span class="indirectoglobal"></span></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="10" align="right">Subtotal</td>
                                        <td>$<span class="subtotal">0</span> </td>
                                        
                                    </tr>

                                    <tr>
                                        <td colspan="10" align="right">Iva ({{$configuraciones->iva}}%)</td>
                                        <td>$<span class="iva">0</span></td>
                                    </tr>

                                    <tr>
                                        <td colspan="10" align="right"><strong>Total</strong></td>
                                        <td><strong>$<span class="total">0</span></strong></td>
                                        
                                    </tr>
                                    <tr>
                                        <td colspan="10" align="right">
                                            
                                            <button type="submit" class="btn btn-primary">
                                                Guardar
                                            </button>
                                            <a href="{{url('exportar/materiales').'/'.$presupuesto->id}}" class="btn btn-success">
                                             Desglose unitario
                                            </a>
                                            
                                        
                                        </td>
                                        <td>
                                            <a class="btn btn-success" href="{{url('exportar/presupuesto').'/'.$presupuesto->id}}">
                                                Excel
                                            </a>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                            </div>
                            <!-- /.table-responsive -->
                            </form>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

     @foreach($presupuesto->partidas as $numero => $partida)
     <!-- Modal -->
<div class="modal fade" id="materiales{{$numero}}{{$partida->partida->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <?php $totalmaterialunitario = 0; ?>
        @foreach($partida->materiales as $material)
        <?php $totalmaterialunitario += ($material->cantidad * $material->material->precio); ?>
        <tr>
            <td>{{$material->material->nombre}}</td>
            <td>{{$material->material->tipo}}</td>
            <td>${{$material->material->precio}}</td>
            <td>{{$material->cantidad}}</td>
            <td>${{$material->cantidad * $material->material->precio}}</td>
        </tr>    
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><strong>SubTotal</strong></td>
            <td><strong>${{$totalmaterialunitario}}</strong></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>{{$partida->mano->nombre}}</td>
            <td>Mano de Obra ({{$partida->mano->precio}}%)</td>
            <td>${{$totalmaterialunitario * ($partida->mano->precio / 100)}}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>{{$partida->indirecto->nombre}}</td>
            <td>Indirecto ({{$partida->indirecto->precio}}%)</td>
            <td>${{$totalmaterialunitario * ($partida->indirecto->precio / 100)}}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><strong>Total Unitario</strong></td>
            <td><strong>${{
                ($totalmaterialunitario * ($partida->indirecto->precio / 100))
                +
                ($totalmaterialunitario * ($partida->mano->precio / 100))
                +
                $totalmaterialunitario

            }}</strong></td>
        </tr>
         <tr>
            <td></td>
            <td></td>
            <td>{{$partida->mano->nombre}}</td>
            <td>Mano de Obra ({{$partida->mano->precio}}%) (cantidad partidas: {{$partida->cantidad}})</td>
            <td>${{($totalmaterialunitario * ($partida->mano->precio / 100))* $partida->cantidad}}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>{{$partida->indirecto->nombre}}</td>
            <td>Indirecto ({{$partida->indirecto->precio}}%) (cantidad partidas: {{$partida->cantidad}})</td>
            <td>${{($totalmaterialunitario * ($partida->indirecto->precio / 100))* $partida->cantidad}}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><strong>Total (cantidad partidas: {{$partida->cantidad}})</strong></td>
            <td><strong>${{
                (
                ($totalmaterialunitario * ($partida->indirecto->precio / 100))
                +
                ($totalmaterialunitario * ($partida->mano->precio / 100))
                +
                $totalmaterialunitario
                ) 
                *
                $partida->cantidad

            }}</strong></td>
        </tr>
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
<div class="modal fade" id="totalmateriales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Materiales Global</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <table class="table">
           <thead>
               <th>Material</th>
               <th>Cantidad Global</th>
               <th>Unidad</th>
               <th>Precio Unitario</th>
               <th>Total</th>
           </thead>
           <tbody>
               @foreach($materiales as $material)
               <tr>
               <td>{{$material->material->nombre}} </td>
               <td>{{$material->total_cantidades}} </td>
               <td>{{$material->material->tipo}} </td>
               <td>${{$material->material->precio}} </td>
               <td>${{$material->material->precio * $material->total_cantidades}} </td>
               </tr>
               @endforeach
           </tbody>
       </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <a href="{{url('exportar/totalmateriales').'/'.$presupuesto->id}}" class="btn btn-success">Exportar</a>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="notas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear/Editar notas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

       <div class="modal-body">

      <form action="{{url('agregarnotaspresupuesto')}}" method="post">
        {{csrf_field()}}
        <input type="hidden" name="presupuesto_id" value="{{$presupuesto->id}}">
       
       <textarea name="notas" id="" class="notas" cols="30" rows="10">{!!$presupuesto->notas!!}</textarea>
      
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Agregar</button>
        
      </div>
      </form>
    </div>
  </div>
</div>
</div>


@endsection 

@section('scripts')

<script type="text/javascript" src="{{asset('vendor/tinymce/tinymce.min.js')}}"></script>

@include('includes.tablasscript')
<script>
    tinymce.init({
          selector: '.notas',
          height: 500,
          menubar: false,
          plugins: [
            'advlist autolink lists link image charmap print preview anchor textcolor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code help wordcount'
          ],
          toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
        });
    //variables globales
    sumaMateriales = 0;
    sumaMano = 0;
    sumaIndirecto = 0;
    totalSinIva = 0;
    iva = parseFloat($('#iva').val()) / 100;

    //Buscar Cada material
     $('.tmaterial').each(function(){
        //Buscar Operantes
        totalmaterial = $(this).html();
        mano = $(this).parents('tr').find('.manodeobra option:selected').attr('attr-porcentaje');
        indirecto = $(this).parents('tr').find('.indirectos option:selected').attr('attr-porcentaje');
        multiplo = $(this).parents('tr').find('.cantidades').html();
        sumaMateriales += parseFloat(totalmaterial) * parseFloat(multiplo);

        // .totalunit .totalpartida subtotales
        //calcular subtotales
            //calcular porcentaje
        manoSuma = (parseFloat(mano) / 100)*parseFloat(totalmaterial);
            //acumular porcentaje ($)
        sumaMano += parseFloat(manoSuma) * parseFloat(multiplo);
            //calcular porcentaje
        indirectoSuma = (parseFloat(indirecto) / 100)*parseFloat(totalmaterial);
            //acumular porcentaje ($)
        sumaIndirecto += parseFloat(indirectoSuma) * parseFloat(multiplo);
            //subtotales integral
        subtotal = parseFloat(totalmaterial) + parseFloat(manoSuma) + parseFloat(indirectoSuma);
            //subtotales con multiplo
        totalunit = parseFloat(subtotal) * parseFloat(multiplo);
            //acumular total
        totalSinIva += totalunit;

        //imprimir valores
        $(this).parents('tr').find('.totalunit').html(subtotal.toFixed(2));
        $(this).parents('tr').find('.subtotales').val(subtotal.toFixed(2));
        $(this).parents('tr').find('.precios').html(totalunit.toFixed(2));
        $(this).parents('tr').find('.preciosval').val(totalunit.toFixed(2));
    });

     //calculo de iva
     ivaCantidad = totalSinIva * iva;
     totalConIva = totalSinIva + ivaCantidad;

     //Totales inferiores
     $('.materialesglobal').html(sumaMateriales.toFixed(2));
     $('.manoglobal').html(sumaMano.toFixed(2));
     $('.indirectoglobal').html(sumaIndirecto.toFixed(2));
     $('.subtotal').html(totalSinIva.toFixed(2));
     $('#subtotal').val(totalSinIva.toFixed(2));
     $('.iva').html(ivaCantidad.toFixed(2));
     $('.total').html(totalConIva.toFixed(2));
     $('#total').val(totalConIva.toFixed(2));




    $('.manodeobra , .indirectos').change(function(){
        //variables globales
    sumaMateriales = 0;
    sumaMano = 0;
    sumaIndirecto = 0;
    totalSinIva = 0;
    iva = parseFloat($('#iva').val()) / 100;

    //Buscar Cada material
     $('.tmaterial').each(function(){
        //Buscar Operantes
        totalmaterial = $(this).html();
        mano = $(this).parents('tr').find('.manodeobra option:selected').attr('attr-porcentaje');
        indirecto = $(this).parents('tr').find('.indirectos option:selected').attr('attr-porcentaje');
        multiplo = $(this).parents('tr').find('.cantidades').html();
        sumaMateriales += parseFloat(totalmaterial) * parseFloat(multiplo);

        // .totalunit .totalpartida subtotales
        //calcular subtotales
            //calcular porcentaje
        manoSuma = (parseFloat(mano) / 100)*parseFloat(totalmaterial);
            //acumular porcentaje ($)
        sumaMano += parseFloat(manoSuma) * parseFloat(multiplo);
            //calcular porcentaje
        indirectoSuma = (parseFloat(indirecto) / 100)*parseFloat(totalmaterial);
            //acumular porcentaje ($)
        sumaIndirecto += parseFloat(indirectoSuma) * parseFloat(multiplo);
            //subtotales integral
        subtotal = parseFloat(totalmaterial) + parseFloat(manoSuma) + parseFloat(indirectoSuma);
            //subtotales con multiplo
        totalunit = parseFloat(subtotal) * parseFloat(multiplo);
            //acumular total
        totalSinIva += totalunit;

        //imprimir valores
        $(this).parents('tr').find('.totalunit').html(subtotal.toFixed(2));
        $(this).parents('tr').find('.subtotales').val(subtotal.toFixed(2));
        $(this).parents('tr').find('.precios').html(totalunit.toFixed(2));
        $(this).parents('tr').find('.preciosval').val(totalunit.toFixed(2));
    });

     //calculo de iva
     ivaCantidad = totalSinIva * iva;
     totalConIva = totalSinIva + ivaCantidad;

     //Totales inferiores
     $('.materialesglobal').html(sumaMateriales.toFixed(2));
     $('.manoglobal').html(sumaMano.toFixed(2));
     $('.indirectoglobal').html(sumaIndirecto.toFixed(2));
     $('.subtotal').html(totalSinIva.toFixed(2));
     $('#subtotal').val(totalSinIva.toFixed(2));
     $('.iva').html(ivaCantidad.toFixed(2));
     $('.total').html(totalConIva.toFixed(2));
     $('#total').val(totalConIva.toFixed(2));
    });

    $('.nombrepresupuesto').change(function(){
        $('#nombrepresupuesto').val($(this).val());
    });

    //Select picker plugin
    $('.selectpicker').selectpicker({
    liveSearch: true,
    liveSearchNormalize: true,
});
   
</script>
 @endsection
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
                        <h1 class="page-header">Nuevo Presupuesto</h1>
                    </div>
                    <!-- /.col-lg-12 -->

                </div>
                <!-- /.row -->

             

                 <div class="row">
                     <div class="col-md-12">
                         <div class="table-resposive">
                             <table class="table table-bordered table-hover">
                                 <thead>
                                     <th>Descripción de ítems</th>
                                     <th>Unidad</th>
                                     <th>Cantidad</th>
                                     <th>Precio Unitario ($)</th>
                                     <th>Monto ($)</th>
                                 </thead>
                                 <tbody class="pri">


                                    <tr class="partida">
                                        <td>
                                            <select name="partida_id[]" class="selectpicker partidaselect">
                                                <option>Seleccione la partida</option>
                                                @foreach($partidas as $partida)
                                                <option value="{{$partida->id}}" attr-total="{{$partida->total}}">{{$partida->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select name="unidad[]" class="selectpicker">
                                                <option>Seleccione la unidad</option>
                                                <option value="cu">(cu) Cada uno</option>
                                                <option value="ml">(ml) Cada metros lineales</option>
                                                <option value="sg">(sg) Suma global</option>
                                            </select>
                                        </td>
                                        <td><input type="number" min="0" name="cantidad[]" step="0.1" class="form-control cantidades"></td>
                                        <td>
                                            <span class="total"></span>
                                        </td>
                                        <td>
                                            <span class="suma"></span>
                                        </td>
                                    </tr>

                                </tbody>

                                     <tr>
                                         <td colspan="4" align="right">Subtotal</td>
                                         <td></td>
                                     </tr>
                                     <tr>
                                         <td colspan="4" align="right">Iva</td>
                                         <td></td>
                                     </tr>
                                     <tr>
                                         <td colspan="4" align="right"><strong>Total</strong></td>
                                         <td><strong></strong></td>
                                     </tr>
                                 
                             </table>
                         </div>
                     </div>
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
<script>
   
        $('.selectpicker').selectpicker({
    liveSearch: true,
    liveSearchNormalize: true,
});

        $('.partidaselect').change(function(e){
          var total = $('option:selected',this).attr('attr-total');
          var id = $('option:selected',this).val();
          $(this).parents('tr').find('td .total').text(total);
        });

        $('.cantidades').change(function(total){
            var subtotal = $(this).parents('tr').find('td .total').html();
            var cantidad = $(this).val();
            var suma = parseFloat(subtotal) * parseFloat(cantidad);

            $(this).parents('tr').find('td .suma').text(suma);
        });
  
</script>

 @endsection
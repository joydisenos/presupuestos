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
                <form action="{{url('presupuesto/nuevo')}}" method="post">
                    {{csrf_field()}}
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="nombre" placeholder="Nombre del Presupuesto" required>
                    </div>
                    <div class="col-md-6">
                        <select name="partidas[]" class="selectpicker" multiple title="Seleccione las partidas">
                                            
                                                @foreach($partidas as $partida)
                                                <option value="{{$partida->id}}">{{$partida->nombre}}</option>
                                                @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary">crear</button>
                    </div>
                    </form>
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
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
                        <h1 class="page-header">Configuraciones</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->


                <div class="row">
                    <div class="col-md-12">
                        <form action="{{url('configuraciones')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>Iva ($)</label>
                                <input type="number" name="iva" step="0.01" class="form-control" value="{{$configuracion->iva}}">
                          </div>

                          <div class="form-group">
                              <button class="btn btn-primary" type="submit">Guardar</button>
                          </div>
                        </form>
                    </div>
                   
                </div>

                <div class="row">
                    <div class="col-md-6">
                        
                        <form action="{{url('mano')}}" method="post">
                            {{csrf_field()}}                                           <div class="col-sm-6">
                                    <label for="">Mano de Obra</label>
                                    <input type="text" class="form-control" name="nombre" required>
                                </div>
                                <div class="col-sm-4">
                                    <label for="">Precio</label>
                                    <input type="number" step="0.01" class="form-control" name="precio" required>
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                                </div>
                            
                        </form>

                        
                        <table class="table table-hover">
                            @foreach($manos as $mano)
                            <tr>
                                <td>{{$mano->nombre}}</td>
                                <td>{{$mano->precio}}</td>
                                <td><!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#asignar" data-item="{{$mano->id}}" data-tipo="mano">Asignar</button>--></td>
                            </tr>
                            @endforeach
                        </table>
                        

                       
                    </div>
                    <div class="col-md-6">
                        
                        <form action="{{url('indirecto')}}" method="post">
                            {{csrf_field()}}
                            
                                <div class="col-sm-6">
                                    <label for="">Indirectos</label>
                                    <input type="text" class="form-control" name="nombre" required>
                                </div>
                                <div class="col-sm-4">
                                    <label for="">Precio</label>
                                    <input type="number" step="0.01" class="form-control" name="precio" required>
                                </div>

                                 <div class="col-sm-2">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                                </div>
                            
                        </form>
                        
                        <table class="table table-hover">
                            @foreach($indirectos as $indirecto)
                            <tr>
                                <td>{{$indirecto->nombre}}</td>
                                <td>{{$indirecto->precio}}</td>
                                <td><!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#asignar" data-item="{{$indirecto->id}}" data-tipo="indirecto">Asignar</button>--></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <div class="modal fade" id="asignar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            {{csrf_field()}}
            <input type="hidden" id="tipo" name="tipo" value="">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <select name="" class="selectpicker" id="">
                <option>Seleccione la Partida</option>
                @foreach($partidas as $partida)
                <option value="{{$partida->id}}">{{$partida->nombre}}</option>
                @endforeach
            </select>
          </div>
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script>
    $('#asignar').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('item') // Extract info from data-* attributes
  var tipo = button.data('tipo') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient + ' ' + tipo)
  modal.find('.modal-body input').val(recipient)
  modal.find('#tipo').val(tipo)
})

     $('.selectpicker').selectpicker({
    liveSearch: true,
    liveSearchNormalize: true,
});
</script>
@endsection
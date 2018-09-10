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
                    <div class="col-md-6">
                        <form action="{{url('configuraciones')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>Iva (%)</label>
                                <input type="number" name="iva" step="0.01" class="form-control" value="{{$configuracion->iva}}">
                          </div>

                          <div class="form-group">
                              <button class="btn btn-primary" type="submit">Guardar</button>
                          </div>
                        </form>
                    </div>
                
                   <div class="col-md-6">
                      <form action="{{url('unidades')}}" method="post">
                            {{csrf_field()}}                                           <div class="col-sm-8">
                                    <label for="">Unidad</label>
                                    <input type="text" class="form-control" name="nombre" required>
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                                </div>
                            
                        </form>
                        <table class="table table-hover">
                            @foreach($unidades as $unidad)
                            <tr>
                                <td>{{$unidad->nombre}}</td>
                                <td>
                                  <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#unidad" data-id="{{$unidad->id}}" data-nombre="{{$unidad->nombre}}"> <i class="fa fa-edit"></i> </a>
                                  <a href="{{url('unidad/eliminar').'/'.$unidad->id}}" class="btn btn-primary"> <i class="fa fa-trash"></i> </a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
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
                                    <label for="">Porcentaje</label>
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
                                <td>{{$mano->precio}}%</td>
                                <td>
                                <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#mano" data-id="{{$mano->id}}" data-nombre="{{$mano->nombre}}" data-precio="{{$mano->precio}}"> <i class="fa fa-edit"></i> </a>
                                  <a href="{{url('mano/eliminar').'/'.$mano->id}}" class="btn btn-primary"> <i class="fa fa-trash"></i> </a>
                                </td>
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
                                    <label for="">Porcentaje</label>
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
                                <td>{{$indirecto->precio}}%</td>
                                <td>
                                <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#indirecto" data-id="{{$indirecto->id}}" data-nombre="{{$indirecto->nombre}}" data-precio="{{$indirecto->precio}}"> <i class="fa fa-edit"></i> </a>

                                  <a href="{{url('indirecto/eliminar').'/'.$indirecto->id}}" class="btn btn-primary"> <i class="fa fa-trash"></i> </a>
                                </td>
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


<!-- Modales -->
<!-- Unidades -->
<div class="modal fade" id="unidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Unidad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('modificarunidad')}}" method="post">
      <div class="modal-body">
        
            {{csrf_field()}}
            <input type="hidden" name="unidad_id" class="unidad_id" value="">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nombre:</label>
            <input type="text" name="nombre" class="form-control nombre" value="" required>
          </div>
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Mano de Obra -->
<div class="modal fade" id="mano" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Mano de Obra</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('modificarmano')}}" method="post">
      <div class="modal-body">
        
            {{csrf_field()}}
            <input type="hidden" name="mano_id" class="mano_id" value="">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nombre:</label>
            <input type="text" name="nombre" class="form-control nombre" value="" required>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Porcentaje:</label>
            <input type="number" min="0" step="0.01" name="precio" class="form-control precio" value="" required>
          </div>
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Indirecto -->
<div class="modal fade" id="indirecto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Indirecto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('modificarindirecto')}}" method="post">
      <div class="modal-body">
        
            {{csrf_field()}}
            <input type="hidden" name="indirecto_id" class="indirecto_id" value="">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nombre:</label>
            <input type="text" name="nombre" class="form-control nombre" value="" required>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Porcentaje:</label>
            <input type="number" min="0" step="0.01" name="precio" class="form-control precio" value="" required>
          </div>
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>

@endsection
@section('scripts')
<script>
    $('#unidad').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') // Extract info from data-* attributes
  var nombre = button.data('nombre') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('Modificar unidad:' + nombre)
  modal.find('.nombre').val(nombre)
  modal.find('.modal-body .unidad_id').val(id)
})

 $('#mano').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') // Extract info from data-* attributes
  var nombre = button.data('nombre') // Extract info from data-* attributes
  var precio = button.data('precio') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('Modificar Mano de Obra:' + nombre)
  modal.find('.nombre').val(nombre)
  modal.find('.precio').val(precio)
  modal.find('.modal-body .mano_id').val(id)
})

 $('#indirecto').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') // Extract info from data-* attributes
  var nombre = button.data('nombre') // Extract info from data-* attributes
  var precio = button.data('precio') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('Modificar indirecto:' + nombre)
  modal.find('.nombre').val(nombre)
  modal.find('.precio').val(precio)
  modal.find('.modal-body .indirecto_id').val(id)
})

     
</script>
@endsection
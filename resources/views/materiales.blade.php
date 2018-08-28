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
                        <h1 class="page-header">Materiales</h1>
                    </div>
                    <!-- /.col-lg-12 -->

                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-right">
    <button class="btn btn-primary agregar"> <i class="fa fa-plus"></i> Agregar</button>
</div>
                    
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="toggle">
                        <form action="{{url('materiales')}}" method="post">
                        {{csrf_field()}}

                         <div class="form-group">
                                            <label>Material</label>
                                            <textarea class="form-control" name="nombre" rows="3"></textarea>
                          </div>

                          <div class="form-group">
                                            <label>Precio</label>
                                            <input type="number" name="precio" step="0.01" min="0" class="form-control">
                           </div>

                          <div class="form-group">
                                            <label>Tipo</label>
                                            <select name="tipo" class="form-control">
                            <option>Seleccione la unidad</option>
                            @foreach($unidades as $unidad)
                            <option value="{{$unidad->nombre}}">{{$unidad->nombre}}</option>
                            @endforeach
                                            </select>
                           </div>

                           <div class="form-group">
                            <button type="submit" class="btn btn-primary">Registrar</button>
                           </div>
                    </form>
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
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                        <th>Tipo</th>
                                        <th>Editar / Eliminar</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($materiales as $material)
                                    <tr>
                                    	<td>
                                    		{{$material->nombre}}
                                    	</td>
                                    	<td>
                                    		${{$material->precio}}
                                    	</td>
                                    	<td>
                                    		{{$material->tipo}}
                                    	</td>
                                    	<td>
                                    		<a type="button" class="btn btn-primary" data-toggle="modal" data-target="#editar{{$material->id}}"> <i class="fa fa-edit"></i> </a>

                                            <a href="{{url('eliminar/material').'/'.$material->id}}" class="btn btn-primary">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                    	</td>
                                    </tr>
                                    @endforeach
                                </tbody>
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

    <!-- Button trigger modal -->

@foreach($materiales as $material)
<!-- Modal -->
<div class="modal fade" id="editar{{$material->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Material</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form action="{{url('material/editar').'/'.$material->id}}" method="post">
        {{csrf_field()}}

      <div class="modal-body">
        <div class="form-group">
            <label for="">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{$material->nombre}}">
        </div>
        <div class="form-group">
            <label for="">Precio($)</label>
            <input type="text" name="precio" step="0.01" min="0" class="form-control" value="{{$material->precio}}">
        </div>
       <div class="form-group">
                                            <label>Tipo</label>
                                            <select name="tipo" class="form-control">
                            <option>Seleccione la unidad</option>
                            @foreach($unidades as $unidad)
                            <option value="{{$unidad->nombre}}">{{$unidad->nombre}}</option>
                            @endforeach
                                            </select>
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
@endforeach
@endsection 

@section('scripts')

@include('includes.tablasscript')

 @endsection
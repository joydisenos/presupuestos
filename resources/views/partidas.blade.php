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
                        <h1 class="page-header">Partidas</h1>
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
                        <form action="{{url('partidas')}}" method="post">
                        {{csrf_field()}}

                         <div class="form-group">
                                            <label>Nombre de Partida</label>
                                            <textarea class="form-control" name="nombre" rows="3"></textarea>
                          </div>

                          <div class="form-group">
                                            <label>Mano de Obra</label>
                                            <select name="mano_id" class="form-control">
                                                <option value="">Seleccione</option>
                                                @foreach($manos as $mano)
                                                <option value="{{$mano->id}}">{{$mano->nombre}}</option>
                                                @endforeach
                                            </select>
                           </div>

                          <div class="form-group">
                                            <label>Indirectos</label>
                                            <select name="indirecto_id" class="form-control">
                                                <option value="">Seleccione</option>
                                                @foreach($indirectos as $indirecto)
                                                <option value="{{$indirecto->id}}">{{$indirecto->nombre}}</option>
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
                            Listado de Partidas
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Mano de Obra</th>
                                        <th>Indirectos</th>
                                        <th>Total</th>
                                        <th>Editar / Eliminar</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($partidas as $partida)
                                    <tr>
                                    	<td>
                                    		{{$partida->nombre}}
                                    	</td>
                                    	<td>
                                    		{{$partida->mano->nombre}}, {{$partida->mano->precio}}%
                                    	</td>
                                    	<td>
                                    		{{$partida->indirecto->nombre}}, {{$partida->indirecto->precio}}%
                                    	</td>
                                        <td>
                                            ${{$partida->total_materiales}}
                                        </td>
                                    	<td>
                                            <a href="{{url('partida').'/'.$partida->id}}" class="btn btn-warning"> <i class="fa fa-eye"></i> </a>
                                    		<a href="{{url('eliminar/partida').'/'.$partida->id}}" class="btn btn-primary"> <i class="fa fa-trash"></i> </a>
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
@endsection 

@section('scripts')

@include('includes.tablasscript')

 @endsection
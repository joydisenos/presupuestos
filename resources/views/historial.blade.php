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
                        <h1 class="page-header">Presupuestos</h1>
                    </div>
                    <!-- /.col-lg-12 -->

                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-right">
    <a href="{{url('presupuesto/nuevo')}}" class="btn btn-primary"> <i class="fa fa-plus"></i> Nuevo</a>
</div>
                    
                    </div>
                </div>

               

                 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Listado de Presupuestos
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Número</th>
                                        <th>Nombre</th>
                                        <th>Fecha</th>
                                        <th>Total</th>
                                        <th>Editar / Eliminar</th>
                                        <th>Exportar</th>
                                        <th>Marcar</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($presupuestos as $presupuesto)
                                    <tr
                                    @if($presupuesto->color != null)
                                    style="background-color:{{$presupuesto->color}}"
                                    @endif
                                    >
                                    	<td>
                                    		{{$presupuesto->id}}
                                    	</td>
                                        <td>
                                            {{$presupuesto->nombre}}
                                        </td>
                                    	<td>
                                    		{{$presupuesto->created_at->format('d-m-Y')}}
                                    	</td>
                                    	<td>
                                    		${{$presupuesto->total}}
                                    	</td>
                                    	<td>
                                           
                                    		<a href="{{url('presupuesto').'/'.$presupuesto->id}}" class="btn btn-primary"> <i class="fa fa-edit"></i> </a>
                                            <a href="{{url('eliminar/presupuesto').'/'.$presupuesto->id}}" class="btn btn-primary"> <i class="fa fa-trash"></i> </a>
                                    	</td>
                                        <td>
                                            <a class="btn btn-success" href="{{url('exportar/presupuesto').'/'.$presupuesto->id}}">
                                                Excel
                                            </a>
                                            <a href="{{url('exportar/materiales').'/'.$presupuesto->id}}" class="btn btn-success">
                                             Desglose unitario
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{url('colorpresupuesto')}}" method="post">
                                                {{csrf_field()}}
                                                <input type="hidden" name="presupuesto_id" value="{{$presupuesto->id}}">
                                                <input type="color" name="color"
@if($presupuesto->color != null)
value="{{$presupuesto->color}}"
@else
value="#ffffff"
@endif
                                                >
                                                <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i></button>
                                            </form>
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
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
                        <h1 class="page-header">Importar Datos</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

                <div class="row">
                    
                    
                      <form action="{{url('importarpartidas')}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
<div class="text-left">

    <div class="custom-file col-md-6">
      <input type="file" class="custom-file-input" name="hoja" id="customFile">
    </div>
   <div class="col-md-6">
        <button type="submit" class="btn btn-success">Importar</button>
   </div>
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
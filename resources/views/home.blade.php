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
                        <h1 class="page-header">Panel</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-md-6">
                        <h5>
                            Partidas Registradas: {{$partidas}}
                        </h5>
                    </div>
                    <div class="col-md-6">
                        <h5>
                            Materiales Registrados: {{$materiales}}
                        </h5>
                   
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
@endsection
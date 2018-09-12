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
                        <h1 class="page-header">Grupos</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <form action="{{url('storegrupo')}}" method="post">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-left">
                                <h4>Registrar Grupo</h4>
                            </div>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="nombre" class="form-control" placeholder="nombre del Grupo" required>
                    </div>
               
                    <div class="col-md-4">
                        <select name="materiales[]" id="" title="Selecciones los materiales" class="selectpicker" multiple>
                            @foreach($materiales as $material)
                            <option value="{{$material->id}}">{{$material->nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </div>
                </div>
                </form>
<hr>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Grupos Registrados</h4>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <th>Nombre</th>
                            <th>Ver materiales</th>
                        </thead>
                        <tbody>
                            @foreach($grupos as $grupo)
                            <tr>
                                <td>{{$grupo->nombre}}</td>
                                <td>
                                    <button class="btn btn-primary ver" target="#grupo{{$grupo->id}}"> <i class="fa fa-eye"></i> </button>

                                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#grupo" data-id="{{$grupo->id}}" data-nombre="{{$grupo->nombre}}"> <i class="fa fa-edit" ></i></a>

                                    <a href="{{url('eliminargrupo').'/'.$grupo->id}}" class="btn btn-primary"> <i class="fa fa-trash"></i></a>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
                    </div>

                    <div class="col-md-8">

<div class="row">
    <div class="col-md-6">
        <h3>Cantidad Global</h3>
    </div>
    <div class="col-md-3">
        <h3 class="slugpartida">&PG%</h3>
    </div>
    <div class="col-md-3">
        <label for="">Cantidad</label>
        <input type="number" value="1" min="0" step="0.01" name="cantidadglobal" id="PG" class="form-control">
    </div>
</div>
<hr>
                        @foreach($grupos as $grupo)
                        
                        <div id="grupo{{$grupo->id}}" class="toggle">

                            <form action="agregarmaterialesgrupo" method="post">
                                {{csrf_field()}}
                                <input type="hidden" name="grupo_id" value="{{$grupo->id}}">
                            <div class="row">
                    <div class="col-md-8">
                        <select name="materiales[]" title="Selecciones los materiales" class="selectpicker" multiple>
                            @foreach($materiales as $material)
                            <option value="{{$material->id}}">{{$material->nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                    </div>
                        </form>
                        

                            <h3>{{$grupo->nombre}}</h3>
                        <div class="table-responsive">
                            <form action="{{url('guardarmaterialesgrupo')}}" method="post">
                                {{csrf_field()}}
                            <table class="table table-hover">
                                <thead>
                                    <th>Material</th>
                                 
                                    <th>Precio</th>
                                    <th>Slug</th>
                                    <th>Fórmula</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <th></th>
                                    
                                </thead>
                                <tbody class="datos">
                                @foreach($grupo->materiales as $material)
                                <tr>
                                    <td>{{$material->material->nombre}}
    <input type="hidden" name="material_id[]" value="{{$material->id}}">
                                    </td>
                          
                                    <td>${{$material->material->precio}}
                                    <input type="hidden" name="price" class="price" value="{{$material->material->precio}}">
                                </td>
                                    <td>&M{{$grupo->id}}{{$material->material->id}}%</td>
                                    <td>
<input type="text" placeholder="=&slug% * n" name="formula[]" class="form-control operaciones" value="{{$material->formula}}">
<input type="hidden" class="formulas" value="
<?php 
$material->formula = str_replace('=', 'mat = ', $material->formula);
$material->formula = str_replace('&',"parseFloat($('#", $material->formula);
$material->formula = str_replace('%',"').val())",$material->formula);

echo $material->formula;
 ?>
" name="">
                                    </td>
                                    <td>
<input type="number" min="0" step="0.01" name="cantidad[]" class="form-control cantidades" id="M{{$grupo->id}}{{$material->material->id}}" value="{{$material->cantidad}}" slug="M{{$grupo->id}}{{$material->material->id}}" required>
                                    </td>
                                    <td>
                                        $<span class="precios">{{$material->material->precio * $material->cantidad}}</span>
                                    </td>
                                    
                                    <td><a href="{{url('eliminargrupomaterial').'/'.$material->id}}" class="btn btn-primary"> <i class="fa fa-trash"></i></a></td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="7">
                                        <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Guardar</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            </form>
                        </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                

               
                
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


    <!-- Unidades -->
<div class="modal fade" id="grupo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Unidad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('modificargrupo')}}" method="post">
      <div class="modal-body">
        
            {{csrf_field()}}
            <input type="hidden" name="grupo_id" class="grupo_id" value="">
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
@endsection
@section('scripts')
<script>
   
        $('.selectpicker').selectpicker({
    liveSearch: true,
    liveSearchNormalize: true,
});
        //toggle materiales
        $('.ver').click(function(){
            target = $(this).attr('target');
            $('.toggle').hide();
            $(target).toggle();
        });

        //modal dinámico para editar grupos
        $('#grupo').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') // Extract info from data-* attributes
  var nombre = button.data('nombre') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('Modificar grupo:' + nombre)
  modal.find('.nombre').val(nombre)
  modal.find('.modal-body .grupo_id').val(id)
})

        $('input').change(function(){
            //$('.datos tr').each(function(){
            $(this).parents('.datos').find('tr').each(function(){


            //buscar formulas
            operaciones = $(this).find('.operaciones').val();

            if(operaciones != '')
            {
                operaciones = operaciones.replace('=', 'mat = ');
                operaciones = operaciones.replace('&',"parseFloat($('#");
                operaciones = operaciones.replace('%',"').val())");
                $(this).find('.formulas').val(operaciones);

            }
            
            
            mat = null;
            var formula = $(this).find('.formulas').val();
            
            $.globalEval(formula);

            if(mat != null)
            {
               $(this).find('.cantidades').val(mat.toFixed(2)); 
            }else{

            }

            var precio    = $(this).find('.price').val();
            var multiplo  = $(this).find('.cantidades').val();
            var resultado = parseFloat(multiplo) * parseFloat(precio);
            $(this).find('.precios').text(resultado.toFixed(2));

            });

        });


  
</script>

 @endsection
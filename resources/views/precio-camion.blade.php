@extends('layouts.dashboard')

@section('content')


    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="card">
        <div class="card-content">
              <div class="row">
                <div class="input-field col s3">
                    <form action="{{route('precio-camion')}}" method="GET">
                    @csrf
                    <label class="" for="pc_clasificacion">Clasificacion</label>
                    <select name="clasificacion" class="browser-default form-control" id="pc_clasificacion" onchange="this.form.submit()">
                    @foreach($CamionesClasificacion as $item)
                      <option value="{{$item->cod_int}}" {{ $item->cod_int==$clasificacion?'selected':' '}} >{{$item->desc01}}</option>
                    @endforeach
                    </select>
                    </form>
                </div>
                <div class="input-field col s3">
                    <label class="" for="pc_sucursal">Sucursal</label>
                    <select name="sucursal" class="browser-default form-control" id="pc_sucursal" >
                    @foreach($AdmSucursal as $item)
                      <option value="{{$item->SUCU_CODIGO}}"  >{{$item->SUCU_NOMBRE}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col s12 m12 l12">
      <div id="responsive-table" class="card card card-default scrollspy">
        <div class="card-content" style=" margin-top: -6px; overflow: auto; height: 60vh; ">
          <h4 class="card-title"></h4>
          <p class="mb-2"></p>
          <div class="row">
            <div class="col s12">
            </div>
            <div class="col s12 dataTables_scrollBody">
               @include('table-precio-camion', ['PrecioCamion' => $PrecioCamion])
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 

<!-- modal  -->
<div id="formalModal" class="modal modal-fixed-footer" role="dialog">

      <div class="modal-content container">
         <h5 class="modal-title ">Modificar precio</h5>
          <span id="form_result"></span>
          <form method="post" id="actualizar_precio" action="{{route('actualizar-ofertas')}}" enctype="multipart/form-data">
            @csrf
            <div class="input-field col s6">
                <label class="control-label col-md-4 mb-0">Camión: </label>
                <input id="camion" type="text" name="camion"  class="browser-default form-control" disabled>
            </div>
            <div class="input-field col s6">
                <label class="control-label col-md-4 mb-0">Código: </label>
                <input id="codigo" type="text" name="codigo" class="browser-default form-control" disabled>

            </div>
            <div class="input-field col s6">
                <label class="control-label col-md-4 mb-0">Descripción: </label>
                <input id="descripcion" type="text" name="descripcion"  class="browser-default form-control" disabled> 

            </div>


            <div class="input-field col s6">
              <label class="control-label col-md-4">Precio público: </label>
              
              <input id="publico" type="text" name="publico"  class="browser-default form-control" id="example" placeholder ="">

            </div>
            <div class="input-field col s6">
              <label class="control-label col-md-4">Precio mayorista: </label>
              <input id="mayor" type="text" name="mayor" class="browser-default form-control">
            </div>

          <div class="input-field col s6">
    
                  <label class="control-label col-md-4" for="fecha_baja">Fecha de caducidad</label>
                  <input id="fecha_baja"  name="fecha_baja" class="datepicker" placeholder="Selecciona una fecha" type="text" value="">
             
          </div>
          <div class="input-field col s6">
    
                  <label class="control-label col-md-4" for="fecha_baja">Fecha de caducidad</label>
                  <input id="fecha_baja"  name="fecha_baja" class="form-control datepicker col-md-8" placeholder="Selecciona una fecha" type="text" value="">
             
          </div>
          <label class="control-label col-md-4" for="exampleDatepicker">Fecha de caducidad</label>

            <br>
          </form>
      </div>
      <div class="modal-footer">
       <div class="col offset-s8 s4">
              <input type="hidden" name="hidden_id" id="hidden_id">
              <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Actualizar Datos">
        </div>

      </div>
  
</div>
@endsection

@section('js')
  <script src="{{ asset('js/precio-camion.js') }}"></script>
@endsection

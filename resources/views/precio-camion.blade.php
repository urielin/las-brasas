@extends('layouts.dashboard')

@section('content')

 
     
    <div class="card">
        <div class="card-content">
              <div class="row">
                <div style="display: flex; justify-content: space-between">
                  <div style="display: flex;    align-items: center;">
                    <i class="material-icons dp48">subject</i><span class="card-title">Precio por camiones</span>
                  </div>
                </div>
 
                <form id="buscar-precio-camion" action="{{route('show-precio-camion')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class=" col s6 l3">
                    <label class="" for="pc_clasificacion">Clasificacion</label>
                    <select name="clasificacion" class="browser-default form-control" id="pc_clasificacion" >
                    @foreach($CamionesClasificacion as $item)
                      <option value="{{$item->cod_int}}" {{ $item->cod_int==$clasificacion?'selected':' '}} >{{$item->desc01}}</option>
                    @endforeach
                    </select>
                    
                </div>
                <div class=" col s6 l3">
                    <label class="" for="pc_sucursal">Sucursal</label>
                    <select name="sucursal" class="browser-default form-control" id="pc_sucursal" >
                      <option value="0"  >---</option>
                    @foreach($AdmSucursal as $item)
                      <option value="{{$item->SUCU_CODIGO}}"  >{{$item->SUCU_NOMBRE}}</option>
                    @endforeach
                    </select>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col s12 m12 l12">
      <div id="responsive-table" class="card card card-default scrollspy">
        <div class="card-content pl-1 pt-1" style=" margin-top: -6px; overflow: scroll; height: 60vh; ">
  
          <div class="row">
       
            <div id="table-precio-camion" style=" margin: 20px 10px 10px 10px;" class="col s12  ">
               @include('table-precio-camion', ['PrecioCamion' => $PrecioCamion])
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


<!-- modal  -->
<div id="pc-modal" class="modal modal-fixed-footer precio-camion-modal col s10 p-0 l5" role="dialog" style="">
      <form method="post" id="actualizar_precio" action="{{route('actualizar-ofertas')}}" enctype="multipart/form-data">

      <div class="modal-content container pb-0" style=" background: white; ">
         <h5 class="modal-title ">Modificar precio</h5>
          <span id="form_result"></span>
            @csrf
            <div class=" col s12 ">
                <label class="control-label  mb-0">Camión: </label>
                <input id="camion" type="text" name="camion"  class="browser-default form-control" disabled>
            </div>
            <div class=" col s12 ">
                <label class="control-label  mb-0">Código: </label>
                <input id="codigo" type="text" name="codigo" class="browser-default form-control" disabled>

            </div>
            <div class=" col s12 ">
                <label class="control-label  mb-0">Descripción: </label>
                <input id="descripcion" type="text" name="descripcion"  class="browser-default form-control" disabled> 

            </div>


            <div class=" col s6 ">
              <label class="control-label ">Precio público: </label>
              
              <input id="publico" type="text" name="publico"  class="browser-default form-control" id="example" placeholder ="">

            </div>
            <div class=" col s6 ">
              <label class="control-label ">Precio mayorista: </label>
              <input id="mayor" type="text" name="mayor" class="browser-default form-control">
            </div>
            <div class=" col s6 ">
              <label class="control-label ">CIF TIERRA </label>
              <input id="cif_tierra" type="text" name="cif_tierra" class="browser-default form-control" disabled>
            </div>
          <div class=" col s6 ">
    
                  <label class="control-label " for="fecha_baja">Fecha de caducidad</label>
                  <input id="fecha_baja"  name="fecha_baja" class="browser-default form-control" placeholder="Selecciona una fecha" type="date" value="">
             
          </div>

            <br>
         
      </div>
      <div class="modal-footer">
       <div class="col s12 offset-l7 l5">
              <input type="hidden" name="hidden_id" id="hidden_id">
              <input type="submit" name="action_button" id="action_button" class="btn btn-warning col s12" value="Actualizar Datos">
        </div>

      </div>
      </form>
</div>
@endsection

@section('js')
  <script src="{{ asset('js/precio-camion.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@endsection

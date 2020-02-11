@extends('layouts.dashboard')

@section('content')


    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s10 m6 l6">
                <h5 class="breadcrumbs-title mt-0 mb-0"><span>Precio por camiones</span></h5>
                <!-- <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a href="index.html">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Basic UI</a>
                  </li>
                  <li class="breadcrumb-item active">Icons
                  </li>
                </ol> -->
              </div>
              <!-- <div class="col s2 m6 l6"><a class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" href="#!" data-target="dropdown1"><i class="material-icons hide-on-med-and-up">settings</i><span class="hide-on-small-onl">Settings</span><i class="material-icons right">arrow_drop_down</i></a><ul class="dropdown-content" id="dropdown1" tabindex="0">
                  <li tabindex="0"><a class="grey-text text-darken-2" href="user-profile-page.html">Profile<span class="new badge red">2</span></a></li>
                  <li tabindex="0"><a class="grey-text text-darken-2" href="app-contacts.html">Contacts</a></li>
                  <li tabindex="0"><a class="grey-text text-darken-2" href="page-faq.html">FAQ</a></li>
                  <li class="divider" tabindex="-1"></li>
                  <li tabindex="0"><a class="grey-text text-darken-2" href="user-login.html">Logout</a></li>
                </ul>
                
              </div> -->
            </div>
          </div>
        </div>
    <div class="card">
        <div class="card-content">
              <div class="row">
                <form id="buscar-precio-camion" action="{{route('show-precio-camion')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input-field col s6 l3">
                    <label class="" for="pc_clasificacion">Clasificacion</label>
                    <select name="clasificacion" class="browser-default form-control" id="pc_clasificacion" >
                    @foreach($CamionesClasificacion as $item)
                      <option value="{{$item->cod_int}}" {{ $item->cod_int==$clasificacion?'selected':' '}} >{{$item->desc01}}</option>
                    @endforeach
                    </select>
                    
                </div>
                <div class="input-field col s6 l3">
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
        <div class="card-content" style=" margin-top: -6px; overflow: auto; height: 60vh; ">
          <h4 class="card-title"></h4>
          <p class="mb-2"></p>
          <div class="row">
            <div class="col s12">
            </div>
            <div id="table-precio-camion" class="col s12 dataTables_scrollBody">
               @include('table-precio-camion', ['PrecioCamion' => $PrecioCamion])
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


<!-- modal  -->
<div id="pc-modal" class="modal modal-fixed-footer precio-camion-modal" role="dialog" style="width: 40%">
      <form method="post" id="actualizar_precio" action="{{route('actualizar-ofertas')}}" enctype="multipart/form-data">

      <div class="modal-content container" style=" background: white; ">
         <h5 class="modal-title ">Modificar precio</h5>
          <span id="form_result"></span>
            @csrf
            <div class="input-field col s12 l4">
                <label class="control-label col-md-4 mb-0">Camión: </label>
                <input id="camion" type="text" name="camion"  class="browser-default form-control" disabled>
            </div>
            <div class="input-field col s12 l4">
                <label class="control-label col-md-4 mb-0">Código: </label>
                <input id="codigo" type="text" name="codigo" class="browser-default form-control" disabled>

            </div>
            <div class="input-field col s12 l4">
                <label class="control-label col-md-4 mb-0">Descripción: </label>
                <input id="descripcion" type="text" name="descripcion"  class="browser-default form-control" disabled> 

            </div>


            <div class="input-field col s12 l4">
              <label class="control-label col-md-4">Precio público: </label>
              
              <input id="publico" type="text" name="publico"  class="browser-default form-control" id="example" placeholder ="">

            </div>
            <div class="input-field col s12 l4">
              <label class="control-label col-md-4">Precio mayorista: </label>
              <input id="mayor" type="text" name="mayor" class="browser-default form-control">
            </div>

          <!-- <div class="input-field col s12 l4">
    
                  <label class="control-label col-md-4" for="fecha_baja">Fecha de caducidad</label>
                  <input id="fecha_baja"  name="fecha_baja" class="datepicker" placeholder="Selecciona una fecha" type="text" value="">
             
          </div> -->
          <div class="input-field col s12 l4">
    
                  <label class="control-label col-md-4" for="fecha_baja">Fecha de caducidad</label>
                  <input id="fecha_baja"  name="fecha_baja" class="form-control col-md-8" placeholder="Selecciona una fecha" type="date" value="">
             
          </div>

            <br>
         
      </div>
      <div class="modal-footer">
       <div class="col offset-s7 s5">
              <input type="hidden" name="hidden_id" id="hidden_id">
              <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Actualizar Datos">
        </div>

      </div>
      </form>
</div>
@endsection

@section('js')
  <script src="{{ asset('js/precio-camion.js') }}"></script>
@endsection

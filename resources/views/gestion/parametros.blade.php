@extends('layouts.dashboard')

@section('content')
<div class="card card card card-default scrollspy">
  <div class="card-content">
    <div class="row"> 
          <div class="col s12">
            <div style="display: flex; justify-content: space-between;margin-bottom:10px">
              <div style="display: flex">
                <i class="material-icons dp48">subject</i>
                <span >DETALLE DE PROVEEDORES</span>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="form-control-label">Proveedor</label>
              <select class="form-control browser-default" id="proveedor" name="proveedor">
                <option value="">Seleccione un proveedor</option>
                @foreach ($proveedor as $p)
                  <option value="{{$p->id_proveedor}}">{{$p->emp_nombre}}</option>
                @endforeach 
               </select>
            </div>
          </div>
        </div>
    </div>
</div>
<div class="card card card card-default scrollspy">
  <div class="card-content">
    <div class="row">


      <div class="col s12">
        <ul class="tabs">
          <li class="tab col m6"><a class="active" href="#test1">Detalle Proveedor</a></li>
         </ul>
      </div>
      <div id="test1" class="col s12">
        <div class="responsive-table" style="overflow-x: scroll; width: 100%;margin-top: 20px;padding:10px">
<div style="display: flex; justify-content: space-between">
                          <!--<div style="display: flex">
                            <i class="material-icons dp48">subject</i><span class="card-title">Catalogo de Productos</span>
                          </div>-->
                       
                          <div style="display: flex;">
                            <select class="form-control browser-default col-md-1 float-right"  style='height:35px !important' id="filter_state">
                              <option value="" selected>Nuevo</option>
                              
                            </select>
                            <button type="button"  class="btn btn-50 btn-add-product cyan pull-right btn-icon-only rounded-circle float-right" name="button">
                              <i class="material-icons dp48">add_box</i>
                            </button>
                          </div>
                        </div>
          <table class="table table-responsive responsive-table centered" id="tabla-proveedor">
            <thead>
              <tr>
                <th>Codigo</th>
                <th>RUT</th>
                <th>Empresa</th>
                <th>Pais</th>
                <th>Direccion</th>
                <th>Telefono</th>
                <th>Movil</th>
                <th>Fax</th>
                <th>Email</th>
                <th>Cambios</th>
              </tr>
            </thead>
            <tbody id="proveedor-datos">

            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection

@section('js')
  <script src="{{asset('js/parametros.js') }}"></script>
@endsection

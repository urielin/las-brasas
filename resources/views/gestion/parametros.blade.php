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
                          <div class="">

                          </div>
                          <div style="display: flex;">
                           
                            <button type="button"  class="btn btn-50 btn-add-product green pull-rigth btn-icon-only rounded-circle float-right" id="btn-nuevo"name="button">
                              <i class="material-icons dp48">add_box</i>
                            </button>
                            
                          </div>
                        </div>
                        <br>
          <table class="table table-responsive responsive-table centered" id="tabla-proveedor">
            <thead>
              <tr>
                <th>Acción</th>
                <th>Código</th>
                <th>RUT</th>
                <th>Empresa</th>
                <th>País</th>
                <th>Dirección</th>
                <!--<th>Teléfono</th>
                <th>Móvil</th>
                <th>Fax</th>
                <th>Email</th>-->
                <th>Detalles</th>

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
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  @endsection

@section('modal')
  <div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Modal Header</h4>
      <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
  </div>
  <div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <div class=" col s6 pb-2">
              <h5 class="modal-title">Detalles del proveedor</h5>
            </div>
            <div class="col s6" align="right">
              <button type="button" class="modal-action modal-close waves-effect waves-green btn-flat" data-dismiss="modal">&times;</button>
            </div>
          </div>
        </div>

        <div class="modal-body">
          <span id="form_result"></span>
          <form  method="POST" id="" class="form-horizontal">
            @csrf
            <div class="row container">
                                  <div class="row pb-2">
                                        <div class="col s12 l6">
                                          <label for="codigo_agregar">Código: </label>
                                          <input type="text" name="codigo_detalle" readonly="readonly" id="codigo_detalle" placeholder=" " class="validate form-control" step="1">
                                        </div>
                                        <div class="col s12 l6">
                                          <label for="auxiliar_agregar">RUT:</label>
                                          <input type="text" name="rut_detalle" readonly="readonly" id="rut_detalle" placeholder=" " class="validate form-control" step="1">
                                        </div>
                                  </div>

                                  <div class="row pb-2">
                                        <div class="col s12 l6">
                                          <label for="descripcion_agregar">Empresa: </label>
                                          <input type="text" name="empresa_detalle" readonly="readonly" id="empresa_detalle" placeholder=" " class="validate form-control" step="1">
                                        </div>
                                        <div class="col s12 l6">
                                          <label for="contenido_agregar">País:</label>
                                          <input type="text" name="pais_detalle" readonly="readonly" id="pais_detalle" placeholder=" " class="validate form-control" step="1">
                                        </div>
                                  </div>
                                  
                                  <div class="row pb-2">
                                        <div class="col s12 l6">
                                          <label for="documento_agregar">Móvil: </label>
                                          <input type="text" name="movil_detalle" readonly="readonly" id="movil_detalle" placeholder=" " class="validate form-control" step="1">
                                        </div>
                                        <div class="col s12 l6">
                                          <label for="fecha_agregar">Fax:</label>
                                          <input type="text" name="fax_detalle" readonly="readonly" id="fax_detalle" placeholder=" "  class="validate form-control" step="1">
                                        </div>
                                  </div>

                                  <div class="row pb-2">
                                        <div class="col s12 l6">
                                          <label for="observaciones_agregar">Email: </label>
                                          <input type="text" name="email_detalle" readonly="readonly" id="email_detalle" placeholder=" " class="validate form-control" step="1">
                                        </div>
                                        <div class="col s12 l6">
                                          <label for="fecha_agregar">Teléfono:</label>
                                          <input type="text" name="telefono_detalle" readonly="readonly" id="telefono_detalle" placeholder=" "  class="validate form-control" step="1">
                                        </div>

                                  </div>

                                  <div class="row">
                                        <div class="col s12 l12">
                                          <label for="documento_agregar">Dirección: </label>
                                          <input type="text" name="direccion_detalle" readonly="readonly" id="direccion_detalle" placeholder=" " class="validate form-control" step="1">
                                        </div>
                                        
                                  </div>
                                  <div class="row ">
                                        <div class="col s12 l12">
                                        </div>
                                  </div>
                                  
             </div>
            <br />
          </form>
        </div>
      </div>
    </div>
  </div>

  <div id="formNuevo" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <div class=" col s6 pb-2">
              <h5 class="modal-title">Agregar nuevo proveedor</h5>
            </div>
            <div class="col s6" align="right">
              <button type="button" class="modal-action modal-close waves-effect waves-green btn-flat" data-dismiss="modal">&times;</button>
            </div>
          </div>
        </div>

        <div class="modal-body">
          <span id="form_result"></span>
          <form  method="POST" id="nuevo-proveedor" class="form-horizontal">
            @csrf
            <div class="row container">
            <div class="row pb-2">
                                    <div class="col s12 l6">
                                          <label for="codigo_agregar">Código: </label>
                                          <input type="text" name="codigo_nuevo"  id="codigo_nuevo" placeholder=" " class="validate form-control" step="1">
                                        </div>
                                        <div class="col s12 l6">
                                          <label for="auxiliar_agregar">RUT:</label>
                                          <input type="text" name="rut_nuevo"  id="rut_nuevo" placeholder=" " class="validate form-control" step="1">
                                        </div>
                                  </div>
                                  <div class="row pb-2">
                                        <div class="col s12 l6">
                                          <label for="descripcion_agregar">Empresa: </label>
                                          <input type="text" name="empresa_nuevo"  id="empresa_nuevo" placeholder=" " class="validate form-control" step="1">
                                        </div>
                                        <div class="col s12 l6">
                                          <label for="contenido_agregar">País:</label>
                                          <input type="text" name="pais_nuevo"  id="pais_nuevo" placeholder=" " class="validate form-control" step="1">
                                        </div>
                                  </div>
                                  
                                  <div class="row pb-2">
                                        <div class="col s12 l6">
                                          <label for="documento_agregar">Móvil: </label>
                                          <input type="text" name="movil_nuevo" id="movil_nuevo" placeholder=" " class="validate form-control" step="1">
                                        </div>
                                        <div class="col s12 l6">
                                          <label for="fecha_agregar">Fax:</label>
                                          <input type="text" name="fax_nuevo"  id="fax_nuevo" placeholder=" "  class="validate form-control" step="1">
                                        </div>
                                  </div>

                                  <div class="row pb-2">
                                        <div class="col s12 l6">
                                          <label for="observaciones_agregar">Email: </label>
                                          <input type="text" name="email_nuevo"  id="email_nuevo" placeholder=" " class="validate form-control" step="1">
                                        </div>
                                        <div class="col s12 l6">
                                          <label for="fecha_agregar">Teléfono:</label>
                                          <input type="text" name="telefono_nuevo"  id="telefono_nuevo" placeholder=" "  class="validate form-control" step="1">
                                        </div>

                                  </div>

                                  <div class="row">
                                        <div class="col s12 l12">
                                          <label for="documento_agregar">Dirección: </label>
                                          <input type="text" name="direccion_nuevo"  id="direccion_nuevo" placeholder=" " class="validate form-control" step="1">
                                        </div>
                                        
                                  </div>
                                  <div class="row ">
                                        <div class="col s12 l12">
                                        </div>
                                  </div>
                                  
                                  <br>
                                  <div class="row " align="right">
                                        <div class="col s12 l12">
                                          <input type="submit" name="agregar_button" id="action_agregar"  class="btn btn-warning" value="Agregar">
                                        </div>
                                  </div>
             </div>
            <br />
          </form>
        </div>
      </div>
    </div>
  </div>
  <div id="formEdit" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <div class="col s6 pb-2">
              <h5 class="modal-title">Actualizar proveedor</h5>
            </div>
            <div class="col s6" align="right">
              <button type="button" class="modal-action modal-close waves-effect waves-green btn-flat" data-dismiss="modal">&times;</button>
            </div>
          </div>
        </div>

        <div class="modal-body">
          <span id="form_result"></span>
          <form  method="POST" id="editar-proveedor" class="form-horizontal">
            @csrf
            <div class="row container">
            <div class="row pb-2">
                                    <div class="col s12 l6">
                                          <label for="codigo_agregar">Código: </label>
                                          <input type="text" name="codigo_edit"  id="codigo_edit" placeholder=" " class="validate form-control" step="1">
                                        </div>
                                        <div class="col s12 l6">
                                          <label for="auxiliar_agregar">RUT:</label>
                                          <input type="text" name="rut_edit"  id="rut_edit" placeholder=" " class="validate form-control" step="1">
                                        </div>
                                  </div>
                                  <div class="row pb-2">
                                        <div class="col s12 l6">
                                          <label for="descripcion_agregar">Empresa: </label>
                                          <input type="text" name="empresa_edit"  id="empresa_edit" placeholder=" " class="validate form-control" step="1">
                                        </div>
                                        <div class="col s12 l6">
                                          <label for="contenido_agregar">País:</label>
                                          <input type="text" name="pais_edit"  id="pais_edit" placeholder=" " class="validate form-control" step="1">
                                        </div>
                                  </div>
                                  
                                  <div class="row pb-2">
                                        <div class="col s12 l6">
                                          <label for="documento_agregar">Móvil: </label>
                                          <input type="text" name="movil_edit"  id="movil_edit" placeholder=" " class="validate form-control" step="1">
                                        </div>
                                        <div class="col s12 l6">
                                          <label for="fecha_agregar">Fax:</label>
                                          <input type="text" name="fax_edit"  id="fax_edit" placeholder=" "  class="validate form-control" step="1">
                                        </div>
                                  </div>

                                  <div class="row pb-2">
                                        <div class="col s12 l6">
                                          <label for="observaciones_agregar">Email: </label>
                                          <input type="text" name="email_edit"  id="email_edit" placeholder=" " class="validate form-control" step="1">
                                        </div>
                                        <div class="col s12 l6">
                                          <label for="fecha_agregar">Teléfono:</label>
                                          <input type="text" name="telefono_edit"  id="telefono_edit" placeholder=" "  class="validate form-control" step="1">
                                        </div>

                                  </div>

                                  <div class="row">
                                        <div class="col s12 l12">
                                          <label for="documento_agregar">Dirección: </label>
                                          <input type="text" name="direccion_edit"  id="direccion_edit" placeholder=" " class="validate form-control" step="1">
                                        </div>
                                        <div id="ocultar-id" style="display:none">
                                          <input type="text" name="id_edit"  id="id_edit" placeholder=" " class="validate form-control" step="1">
                                        </div>
                                  </div>
                                  <div class="row ">
                                        <div class="col s12 l12">
                                        </div>
                                  </div>
                                  
                                  <br>
                                  <div class="row " align="right">
                                        <div class="col s12 l12">
                                          <input type="submit" name="update_button" id="action_actualizar"  class="btn btn-warning" value="Actualizar">
                                        </div>
                                  </div>
             </div>
            <br />
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('after-scripts')
    <script type="text/javascript" src="{{asset('js/tabs.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    

    @endsection
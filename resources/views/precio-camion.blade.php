@extends('layouts.dashboard')

@section('content')


    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="card">
        <div class="card-content">
                  <div class="row">
                    <div class="input-field col s6">
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
                    <div class="input-field col s6">
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
        <div class="card-content">
          <h4 class="card-title">Responsive Table</h4>
          <p class="mb-2">Add <code class="  language-markup">class="responsive-table"</code> to the table tag to make
            the table
            horizontally scrollable on smaller screen widths.</p>
          <div class="row">
            <div class="col s12">
            </div>
            <div class="col s12">
              <table class="responsive-table striped">
                <thead>
                  <tr>
                      <th scope="row">
                        2001
                      </th>
                      <th scope="row">
                        ABASTERO 
                      </th>
                      <th scope="row">
                        3990.0000
                      </th>
                      <th scope="row">
                        .0000
                      </th>
                      <td class="mostrar-info table-danger" data-codigo="2001" data-camion="A19VFR14" data-descripcion="ABASTERO " data-sucursal="0" data-publico="3590.0000" data-mayor="3470.0000" data-fecha_baja="30/01/2020" data-interval="-210">
                        3590.0000
                      </td>
                      <td class="mostrar-info  table-danger" data-codigo="2001" data-camion="A19VFR14" data-descripcion="ABASTERO " data-sucursal="0" data-publico="3590.0000" data-mayor="3470.0000" data-fecha_baja="30/01/2020" data-interval="-210">
                        3470.0000
                      </td>
                        
                                                                    <td class="mostrar-info " data-codigo="2001" data-camion="A19VFR17" data-descripcion="ABASTERO " data-sucursal="0" data-publico="3840.0000" data-mayor="3740.0000" data-fecha_baja="07/02/2020" data-interval="0">                         3840.0000
                        </td>
                        <td class="mostrar-info " data-codigo="2001" data-camion="A19VFR17" data-descripcion="ABASTERO " data-sucursal="0" data-publico="3840.0000" data-mayor="3740.0000" data-fecha_baja="07/02/2020" data-interval="0">                          3740.0000
                        </td>
                
                                                                    <td class="mostrar-info " data-codigo="2001" data-camion="I19VC15" data-descripcion="ABASTERO " data-sucursal="0" data-publico=".0000" data-mayor=".0000" data-fecha_baja="07/02/2020" data-interval="0">                         .0000
                        </td>
                        <td class="mostrar-info " data-codigo="2001" data-camion="I19VC15" data-descripcion="ABASTERO " data-sucursal="0" data-publico=".0000" data-mayor=".0000" data-fecha_baja="07/02/2020" data-interval="0">                          .0000
                        </td>
                
                                                                    <td class="mostrar-info " data-codigo="2001" data-camion="I19VF16" data-descripcion="ABASTERO " data-sucursal="0" data-publico="3690.0000" data-mayor="3590.0000" data-fecha_baja="07/02/2020" data-interval="0">                         3690.0000
                        </td>
                        <td class="mostrar-info " data-codigo="2001" data-camion="I19VF16" data-descripcion="ABASTERO " data-sucursal="0" data-publico="3690.0000" data-mayor="3590.0000" data-fecha_baja="07/02/2020" data-interval="0">                          3590.0000
                        </td>
                
                                                                    <td class="mostrar-info " data-codigo="2001" data-camion="I19VF19" data-descripcion="ABASTERO " data-sucursal="0" data-publico="3910.0000" data-mayor="3810.0000" data-fecha_baja="07/02/2020" data-interval="0">                         3910.0000
                        </td>
                        <td class="mostrar-info " data-codigo="2001" data-camion="I19VF19" data-descripcion="ABASTERO " data-sucursal="0" data-publico="3910.0000" data-mayor="3810.0000" data-fecha_baja="07/02/2020" data-interval="0">                          3810.0000
                        </td>
                
                                                                    <td class="mostrar-info table-danger" data-codigo="2001" data-camion="I19VFR12" data-descripcion="ABASTERO " data-sucursal="0" data-publico="3540.0000" data-mayor="3440.0000" data-fecha_baja="25/01/2020" data-interval="-330">                         3540.0000
                        </td>
                        <td class="mostrar-info table-danger" data-codigo="2001" data-camion="I19VFR12" data-descripcion="ABASTERO " data-sucursal="0" data-publico="3540.0000" data-mayor="3440.0000" data-fecha_baja="25/01/2020" data-interval="-330">                          3440.0000
                        </td>
                
                                                                    <td class="mostrar-info " data-codigo="2001" data-camion="I19VFR13" data-descripcion="ABASTERO " data-sucursal="0" data-publico="3590.0000" data-mayor="3490.0000" data-fecha_baja="07/02/2020" data-interval="0">                         3590.0000
                        </td>
                        <td class="mostrar-info " data-codigo="2001" data-camion="I19VFR13" data-descripcion="ABASTERO " data-sucursal="0" data-publico="3590.0000" data-mayor="3490.0000" data-fecha_baja="07/02/2020" data-interval="0">                          3490.0000
                        </td>
                
                                                                  <td class="mostrar-info " data-codigo="2001" data-camion="I19VFR18" data-descripcion="ABASTERO " data-sucursal="0" data-publico="3840.0000" data-mayor="3740.0000" data-fecha_baja="07/02/2020" data-interval="0">                         3840.0000
                        </td>
                      <td class="mostrar-info " data-codigo="2001" data-camion="I19VFR18" data-descripcion="ABASTERO " data-sucursal="0" data-publico="3840.0000" data-mayor="3740.0000" data-fecha_baja="07/02/2020" data-interval="0">                          3740.0000
                      </td>
                    </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Alvin</td>
                    <td>Eclair</td>
                    <td>$0.87</td>
                    <td>$1.87</td>
                    <td>Yes</td>
                  </tr>
                  <tr>
                    <td>Alan</td>
                    <td>Jellybean</td>
                    <td>$3.76</td>
                    <td>$10.87</td>
                    <td>No</td>
                  </tr>
                  <tr>
                    <td>Jonathan</td>
                    <td>Lollipop</td>
                    <td>$7.00</td>
                    <td>$12.87</td>
                    <td>Yes</td>
                  </tr>
                  <tr>
                    <td>Shannon</td>
                    <td>KitKat</td>
                    <td>$9.99</td>
                    <td>$14.87</td>
                    <td>No</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="container-fluid mt--7">
      <div class="row ">
          <div class="col-xl-12 mb-5 mb-xl-0">
              <div class="card shadow mt-3">
                <div class="card-header border-0  mb--2">
                  <div class="row align-items-center">
                    <div class="col-12 ">
                        <div class="row">
                          <div class="col-md-3 col-sm-12 media">
                            <h1 class="mb-0">Precio por camiones        </h2>
                          </div>
                          <div class="col-4 py-3">
                            <!-- <button type="button" class="btn btn-primary">Imprimir</button> -->
                            <a href="{{route('precio-camion')}}" type="button" class="btn btn-success">Actualizar</a>
                          </div>
                          <div class="col-4">
                          </div>
                        </div>


                      {{-- <h1 class="mb-0">Edición del precio de Camión</h3> --}}
                    </div>


                  </div>
                </div>
                <div class="table-responsive  table-hover">
                <div id="table-precio-camion" class="table-responsive">
                <!--  tabla -->
                @include('table-precio-camion', ['PrecioCamion' => $PrecioCamion])
                  <!--  endtabla -->
      
                </div>

                  <!-- Projects table -->

                </div>
              </div>



            </div>
      </div>
     </div>


    <!-- Footer -->

 

<!-- modal  -->
<div id="formalModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title align-items-center">Modificar precio</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body card-body px-lg-5 py-lg-4">
          <span id="form_result"></span>
          <form method="post" id="actualizar_precio" action="{{route('actualizar-ofertas')}}" enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
                <label class="control-label col-md-4 mb-0">Camión: </label>
                <input id="camion" type="text" name="camion"  class="form-control col-md-8 form-control-alternative" disabled>

            </div>
            <div class="form-group row">
                <label class="control-label col-md-4 mb-0">Código: </label>
                <input id="codigo" type="text" name="codigo" class="form-control col-md-8 form-control-alternative" disabled>

            </div>
            <div class="form-group row">
                <label class="control-label col-md-4 mb-0">Descripción: </label>
                <input id="descripcion" type="text" name="descripcion"  class="form-control col-md-8 form-control-alternative" disabled> 

            </div>


            <div class="form-group row">
              <label class="control-label col-md-4">Precio público: </label>
              
              <input id="publico" type="text" name="publico"  class="form-control col-md-8" id="example" placeholder ="">

            </div>
            <div class="form-group row">
              <label class="control-label col-md-4">Precio mayorista: </label>
              <input id="mayor" type="text" name="mayor" class="form-control col-md-8">
            </div>

          <div class="form-group row">
              <div class="input-group ">
                  <label class="control-label col-md-4" for="exampleDatepicker">Fecha de caducidad</label>

                  <div class="input-group-prepend ">
                          <span class="input-group-text"><i class="ni ni-calendar-grid-58" style=" max-height: 46px; "></i></span>
                  </div>
                  <input id="fecha_baja"  name="fecha_baja" class="form-control datepicker col-md-8" placeholder="Selecciona una fecha" type="text" value="">
              </div>
          </div>
            <br>
            <div class="form-group align-center">
              <input type="hidden" name="hidden_id" id="hidden_id">
              <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Actualizar Datos">
            </div>
          </form>
      </div>
    </div>
  </div>
</div>
@endsection

@extends('layouts.dashboard')
@section('content')

    <div class="row">
      <div class="col l9 m12 s12">
           <div class="card card card-default scrollspy">
             <div class="card-content">
               <div class="" style="display:flex; justify-content: space-between">
                 <span class="card-title">Filtros</span>

                 <button title='Buscar' type="button" style="margin-top: -10px;"  id='searchCatalogo'  class="btn btn-50 cyan float-right">
                   <span class="btn-inner--icon">
                      <i class="material-icons dp48">search</i>
                    </span>
                    Buscar
                 </button>

               </div>
                   <div class="row">
                     <div class="col l3 m6 s12">
                       <div class="form-group">
                         <label class="form-control-label">Codigo</label>
                         <input type="text" class="form-control browser-default" placeholder="codigo" id='code' value="">
                       </div>
                     </div>
                     <div class="col l3 m6 s12">
                       <div class="form-group">
                         <label class="form-control-label">Descripcion</label>
                         <input type="text" class="form-control browser-default" placeholder="descripcion" id="description" value="">
                       </div>
                     </div>
                     <div class="col l3 m6 s12">
                       <div class="form-group">
                         <label for="" class="form-control-label">Clasificacion</label>
                         <select class="form-control browser-default" id='clasificacion'  style="height:46px">
                           <option value="" selected>selecciona ...</option>
                           @foreach($clasificacion as $value)
                           <option value="{{$value->clco_codigo}}">{{$value->clco_descripcion}}</option>
                           @endforeach
                         </select>
                       </div>
                     </div>
                     <div class="col l3 m6 s12">
                       <div class="form-group">
                         <label for="" class="form-control-label browser-default">Tipo</label>
                         <select class="form-control browser-default" id="tipo" style="height:46px">
                           <option value="1" selected>Mercancias</option>
                           <option value="2">Terminado</option>
                         </select>
                       </div>
                     </div>
                   </div>

             </div>
          </div>

      </div>
      <div class="col l3 m12 s12">
        <div class="card">
          <div class="card-body" style="height: 25vh; overflow-y: auto;">
            <table id='productTable' class="table centered">
              <thead>
                <tr>
                  <th style='width: 30%;'>COD.</th>
                  <th style='width: 70%;'>DESCRIPCION</th>
                </tr>
              </thead>
              <tbody class="member">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row">

      <div class="col s12 m12 l12">
        <div id="preselecting" class="card card card-default scrollspy">
          <div class="card-content">
            <div class="row">
              <div class="col s12">
                <ul class="tabs">
                  <li class="tab col m3" class="active"><a href="#test1">Editar Codigo</a></li>
                  <li class="tab col m3"><a  href="#test2">Catalogo de Productos</a></li>
                  <li class="tab col m3"><a href="#test3">Crear Codigo</a></li>
                  <li class="tab col m3"><a href="#test4">Informacion nutricional</a></li>

                </ul>
              </div>
              <div id="test1" class="col s12">

                <div class="container" style="margin-top: 30px">
                  <div style="display: flex; justify-content: space-between">

                      <div style="display: flex">
                        <i class="material-icons dp48">subject</i><span class="card-title">Editar Codigo</span>
                      </div>

                  </div>
                  <div class="bs-example" data-example-id="form-group-height-sizes">
                    <form class="form-horizontal form-inline">

                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;" for="formGroupInputLarge">Codigo: </label>
                        <div class="col l6 m6 s6">
                          <input class="form-control browser-default" type="text" id="edt-code" placeholder=" ">
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;" for="">Nombre Codigo: </label>
                        <div class="col l6 m6 s6  ">
                          <input class="form-control browser-default" type="text" id="edt-name" placeholder="">
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;" for="">Unidad de medida: </label>
                        <div class="col l6 m6 s6  ">
                          <select class="form-control browser-default" type="text" id="edt-unid-media" placeholder="" style="height:46px">
                            @foreach($unidades as $value)
                            <option value="{{$value->TUME_CODIGO}}">{{$value->TUME_DESCR}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;"   for="">Mult/Unidad: </label>
                        <div class="col l6 m6 s6  ">
                          <input class="form-control browser-default" type="text" id="edt-multi-unid" placeholder="">
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;"   for="">Tipo Codigo: </label>
                        <div class="col l6 m6 s6  ">
                          <select  id="edt-tipo-code" name="edt-tipo-code"   class="form-control  browser-default" style="height:46px">
                            <option value="1" selected>MERCANCIA</option>
                            <option value="2">PRODUCTO</option>
                            <option value="3">INSUMOS</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;" for="">Descripcion: </label>
                        <div class="col l6 m6 s6  ">
                          <input class="form-control browser-default" type="text" id="edt-descripcion" placeholder="">
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;" for="">Peso / Codigo: </label>
                        <div class="col l6 m6 s6  ">
                          <input class="form-control browser-default" type="text" id="edt-peso" placeholder="">
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;" for="">Afecto Adicional: </label>
                        <div class="col l6 m6 s6  ">
                          <select class="form-control browser-default" type="text" id="edt-afecto-adicional" placeholder=""  style="height:46px">
                            <option value="1">Si</option>
                            <option value="2">No</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;"  for="">Impuesto Adicional %: </label>
                        <div class="col l6 m6 s6  ">
                          <input class="form-control browser-default" type="number" id="edt-impuesto" placeholder="">
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;"  for="">Codigo Arancelario: </label>
                        <div class="col l6 m6 s6  ">
                          <input class="form-control browser-default" type="number" id="edt-code-arancelario" placeholder="">
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;"  for="">Clasificación 2: </label>
                        <div class="col l6 m6 s6  ">
                          <select class="form-control browser-default" type="text" id="edt-clasificacion-producto" placeholder=""  style="height:46px">
                            <option value="" selected>-----</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;"for="">Clasificación 1: </label>
                        <div class="col l6 m6 s6  ">
                          <select class="form-control browser-default" type="text" id="edt-clasificacion-mercancia" placeholder=""  style="height:46px">
                            <option value="" selected>-----</option>
                            <option value="1">Si</option>
                            <option value="2">No</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;" for="">Mayorista: </label>
                        <div class="col l6 m6 s6">
                          <select class="form-control browser-default" type="text" id="edt-mayorista"  style="height:46px">
                            <option value="" selected>-----</option>
                            <option value="1">Si</option>
                            <option value="2">No</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;"  for="">Estado: </label>
                        <div class="col l6 m6 s6">
                          <select class="form-control browser-default" type="text" id="edt-state" placeholder="" style="height:46px">
                            <option value="1">Si</option>
                            <option value="2">No</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <div class="col l12 m12 s12 " style="padding-left:0px;padding-right:0px" >
                          <button type="button" class="btn cyan float-right"  style="margin-top:20px" id='edt-son-product' name="button">Guardar</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div id="test2" class="col s12">
                <div >
                  <div class="table-responsive">
                    <div class="col-ms-12"  >
                      <h4>
                        <div style="display: flex; justify-content: space-between">
                          <div style="display: flex">
                            <i class="material-icons dp48">subject</i><span class="card-title">Catalogo de Productos</span>
                          </div>
                          <div style="display: flex;">
                            <select class="form-control browser-default col-md-1 float-right"  style='height:35px !important' id="filter_state">
                              <option value="" selected>Seleccione</option>
                              <option value="1">Si</option>
                              <option value="0">No</option>
                            </select>
                            <button type="button"  class="btn btn-50 btn-add-product cyan pull-right btn-icon-only rounded-circle float-right" name="button">
                              <i class="material-icons dp48">add_box</i>
                            </button>
                          </div>
                        </div>
                      </h4>
                    </div>
                    <div>

                      <table id='catalogoTable' style=" " class="table responsive-table centered table-striped">
                        <thead>
                          <tr >
                            <th width='7%'>Padre</th>
                            <th width='8%'>Codigo</th>
                            <th width='14%'>Producto</th>
                            <th width='8%'>Multipl.</th>
                            <th width='8%'>Divisor</th>
                            <th width='14%'>Tipo</th>
                            <th width='9%'>Estado</th>
                            <th width='8%'>Usuario</th>
                            <th width='auto'>Fecha</th>
                            <th width='11%'></th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div id="test3" class="col s12">
                <div class="container" style="margin: 20px">
                  <div style="display: flex; justify-content: space-between">
                      <div style="display: flex">
                        <i class="material-icons dp48">subject</i><span class="card-title">Crear Codigo</span>
                      </div>
                  </div>
                  <div class="bs-example" data-example-id="form-group-height-sizes">
                    <form class="form-horizontal form-inline">
                      <div class="form-group col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;"  for="formGroupInputLarge">Codigo: </label>
                        <div class="col l6 m6 s6">
                          <input class="form-control browser-default" type="text"  id="create-code" placeholder="">
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6  form-control-label" style="text-align: right; display: inline-block;"  for="">Nombre Codigo: </label>
                        <div class="col l6 m6 s6  ">
                          <input class="form-control browser-default" type="text" id="create-name" placeholder="">
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;"  for="">Unidad de medida: </label>
                        <div class="col l6 m6 s6">
                          <select class="form-control browser-default" type="text" id="create-unid-media" placeholder="">
                            @foreach($unidades as $value)
                            <option value="{{$value->TUME_CODIGO}}">{{$value->TUME_DESCR}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;"  for="">Mult/Unidad: </label>
                        <div class="col l6 m6 s6">
                          <input class="form-control browser-default" type="text" id="create-multi-unid" placeholder="">
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label " style="text-align: right; display: inline-block;"  for="">Tipo Codigo: </label>
                        <div class="col l6 m6 s6">
                          <select  id="create-tipo-code " name="TPCO_CODIGO" dl="0"  class="form-control browser-default">
                            <option value="1" selected>MERCANCIA</option>
                            <option value="2">PRODUCTO</option>
                            <option value="3">INSUMOS</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;"  for="">Descripcion: </label>
                        <div class="col l6 m6 s6">
                          <input class="form-control browser-default" type="text" id="create-descripcion" placeholder="">
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;"  for="">Peso / Codigo: </label>
                        <div class="col l6 m6 s6">
                          <input class="form-control browser-default" type="text" id="create-peso" placeholder="">
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;"  for="">Afecto Adicional: </label>
                        <div class="col l6 m6 s6  ">
                          <select class="form-control browser-default" type="text" id="create-afecto-adicional" placeholder="">
                            <option value="1">Si</option>
                            <option value="0">No</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;"  for="">Impuesto Adicional %: </label>
                        <div class="col l6 m6 s6">
                          <input class="form-control browser-default" type="number" id="create-impuesto" placeholder="">
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;"  for="">Codigo Arancelario: </label>
                        <div class="col l6 m6 s6">
                          <input class="form-control browser-default" type="number" id="create-code-arancelario" placeholder="">
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;"  for="">Clasificación 2: </label>
                        <div class="col l6 m6 s6">
                          <select class="form-control browser-default" type="text" id="create-clasificacion-producto" placeholder="">
                            @foreach($clasifications as $value)
                            @if($value->CLCO_CODIGO == 0)
                            <option value="{{$value->CLCO_CODIGO}}" selected> {{$value->CLCO_DESCRIPCION}}</option>
                            @else
                            <option value="{{$value->CLCO_CODIGO}}"> {{$value->CLCO_DESCRIPCION}}</option>
                            @endif
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;"  for="">Clasificación 1: </label>
                        <div class="col l6 m6 s6">
                          <select class="form-control browser-default" type="text" id="create-clasificacion-mercancia" placeholder="">
                            @foreach($clasifications2 as $value)
                            @if($value->clco_codigo == 0)
                            <option value="{{$value->clco_codigo}}" selected> {{$value->clco_descripcion}}</option>
                            @else
                            <option value="{{$value->clco_codigo}}"> {{$value->clco_descripcion}}</option>
                            @endif
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;"  for="">Mayorista: </label>
                        <div class="col l6 m6 s6">

                          <select class="form-control browser-default" type="text" id="create-mayorista" placeholder="">
                            <option value="" selected>-----</option>
                            <option value="1">Si</option>
                            <option value="0">No</option>
                          </select>

                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;"  for="">Estado: </label>
                        <div class="col l6 m6 s6">
                          <select class="form-control browser-default" type="text" id="create-state" placeholder="">
                            <option value="1">Si</option>
                            <option value="0">No</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group  col m12">
                        <div class="col l12 m12 s12 " style="padding-left:0px;padding-right:0px; margin-top:20px" >
                          <button type="button" class="btn cyan float-right" id='create-son-product' name="button">Guardar</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div id="test4" class="col s12">
                <div class="container" style="margin-top: 20px">
                     <div style="display: flex; justify-content: space-between">
                        <div style="display: flex">
                          <i class="material-icons dp48">subject</i><span class="card-title">Informacion Nutricional</span>
                        </div>
                    </div>
                  <div class="bs-example" data-example-id="form-group-height-sizes">
                    <form class="form-horizontal form-inline">
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;" for="formGroupInputLarge">Codigo: </label>
                        <div class="col l6 m6 s6">
                          <input class="form-control browser-default" type="text" id="info-code">
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label  " style="text-align: right; display: inline-block;" for="">Porcion: </label>
                        <div class="col l6 m6 s6  ">
                          <input class="form-control browser-default" type="text" id="info-porcion">
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label  "  style="text-align: right; display: inline-block;" for="">Calorias: </label>
                        <div class="col l6 m6 s6  ">
                          <input class="form-control browser-default" type="text" id="info-calorias">

                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label  " style="text-align: right; display: inline-block;" for="">Grasas Totales: </label>
                        <div class="col l6 m6 s6  ">
                          <input class="form-control browser-default" type="text" id="info-grasas-totales">
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label  " style="text-align: right; display: inline-block;" for="">Grasas Saturadas: </label>
                        <div class="col l6 m6 s6  ">
                          <input class="form-control browser-default" type="text" id="info-grasas-saturadas">
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label  " style="text-align: right; display: inline-block;" for="">Grasas Trans: </label>
                        <div class="col l6 m6 s6  ">
                          <input class="form-control browser-default" type="text" id="info-grasas-trans">
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;" for="">Grasas Mono Insaturada </label>
                        <div class="col l6 m6 s6  ">
                          <input class="form-control browser-default" type="text" id="info-mono-insaturada">
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;" for="">Grasas Poli Saturada: </label>
                        <div class="col l6 m6 s6">
                          <input class="form-control browser-default" type="text" id="info-poli-saturada">

                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;" for="">Colesterol: </label>
                        <div class="col l6 m6 s6">
                          <input class="form-control browser-default" type="number" id="info-colesterol">
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;" for="">Sodio: </label>
                        <div class="col l6 m6 s6  ">
                          <input class="form-control browser-default" type="number" id="info-sodio">
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;" for="">Total Carbohidratos: </label>
                        <div class="col l6 m6 s6  ">
                          <input class="form-control browser-default" type="text" id="info-total-carbohidratos"/>
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;" for="">Fibra dietetica: </label>
                        <div class="col l6 m6 s6  ">
                          <input class="form-control browser-default" type="text" style="text-align: right; display: inline-block;" id="info-fibra-dietetica"/>
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;" for="">Azucar: </label>
                        <div class="col l6 m6 s6  ">
                          <input class="form-control browser-default" type="text" id="info-azucar">
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;" for="">Proteinas: </label>
                        <div class="col l6 m6 s6  ">
                          <input class="form-control browser-default" type="text" id="info-proteinas">
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;" for="">Vitamina A: </label>
                        <div class="col l6 m6 s6  ">
                          <input class="form-control browser-default" type="text" id="info-vitamina-a">
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;" for="">Vitamina C: </label>
                        <div class="col l6 m6 s6 ">
                          <input class="form-control browser-default" type="text" id="info-vitamina-c">
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;" for="">Calcio: </label>
                        <div class="col l6 m6 s6  ">
                          <input class="form-control browser-default" type="text" id="info-calcio">
                        </div>
                      </div>
                      <div class="form-group  col l6 m12 s12">
                        <label class="col l6 m6 s6 form-control-label" style="text-align: right; display: inline-block;" for="">Hierro: </label>
                        <div class="col l6 m6 s6  ">
                          <input class="form-control browser-default" type="text" id="info-hierro">
                        </div>
                      </div>
                      <div class="form-group  col m12">
                        <div class="col l12 m12 s12" style="margin-top:20px">
                          <button type="button" class="btn cyan float-right" id='info-nutricional' name="button">Guardar</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection

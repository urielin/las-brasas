@extends('layouts.dashboard')
@section('content')
  <div class=" " style="display: flex; flex-wrap: wrap;padding-right: 0px !important; padding-left: 0px !important;margin-top: 10px;">
      <div class="  col col-lg-3" style=' padding-right: 0px;padding-top:0px; margin:0px'>
        <div class="card">
          <div class="card-header">
            <h5 class="h3">Lista de Mercancias

             </h5>

          </div>
          <div class="card-body p-0" style="height: 20vh; overflow-y: auto;">
            <table id='productTable' class="table">
              <thead>
                <tr>
                  <th style='width: 10%;'>COD.</th>
                  <th style='width: 90%;'>DESCRIPCION</th>
                </tr>
                </thead>
                <tbody class="member">
                </tbody>
              </table>
          </div>
         </div>
      </div>
      <div class="col col-lg-9">
          <div class="card-wrapper">
            <div class="card">
              <div class="card-header">
                <h5 class="h3">Filtros
                  <button title='Buscar' type="button" style="margin-top: -10px;"  id='searchCatalogo'  class="btn btn-slack btn-icon-only rounded-circle float-right">
                    <span class="btn-inner--icon">
                      <i class="fa fa-search" style="top:0px"></i>
                    </span>
                  </button>
                 </h5>
              </div>
              <div class="card-body p-0">
              <div class="card-body" style="padding-bottom: 0px;">
                <div class="row">
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label class="form-control-label">Codigo</label>
                      <input type="text" class="form-control" placeholder="codigo" id='code' value="">
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label class="form-control-label">Descripcion</label>
                      <input type="text" class="form-control" placeholder="descripcion" id="description" value="">
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="" class="form-control-label">Clasificacion</label>
                      <select class="form-control" id="clasification" style="height:46px">
                          <option value="" selected>selecciona ...</option>
                        @foreach($clasificacion as $value)
                          <option value="{{$value->clco_codigo}}">{{$value->clco_descripcion}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="" class="form-control-label">Tipo</label>
                      <select class="form-control" id="tipo" style="height:46px">
                        <option value="1" selected>Mercancias</option>
                        <option value="2">Terminado</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
          </div>
      </div>
      <div class="col col-lg-12">
        <div class="card-wrapper">
          <div class="card">
            <div class="card-body">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="producto-tab" data-toggle="tab" href="#producto" role="tab" aria-controls="producto" aria-selected="true">Codigo</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="catalogo-tab" data-toggle="tab" href="#catalogo" role="tab" aria-controls="catalogo" aria-selected="false">Catalogo</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="nuevo-tab" data-toggle="tab" href="#nuevo" role="tab" aria-controls="nuevo" aria-selected="false">Nuevo Codigo</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="nutricional-tab" data-toggle="tab" href="#nutricional" role="tab" aria-controls="nutricional" aria-selected="false">Nutricional</a>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="producto" role="tabpanel" aria-labelledby="producto-tab">
                  <div class="container" style="margin-top: 30px">
                    <div class="">
                      <h4>
                        <div>
                          <i class="fa fa-bars"></i>
                          Editar Codigo
                         </div>
                      </h4>
                    </div>
                    <div class="bs-example" data-example-id="form-group-height-sizes">
                      <form class="form-horizontal form-inline">

                        <div class="form-group  col-md-6">
                          <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;" for="formGroupInputLarge">Codigo: </label>
                          <div class="col-sm-6">
                            <input class="form-control" type="text" id="edt-code" placeholder=" ">
                          </div>
                        </div>
                        <div class="form-group  col-md-6">
                          <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;" for="formGroupInputSmall">Nombre Codigo: </label>
                          <div class="col-sm-6  ">
                            <input class="form-control" type="text" id="edt-name" placeholder="">
                          </div>
                        </div>
                        <div class="form-group  col-md-6">
                          <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;" for="formGroupInputSmall">Unidad de medida: </label>
                          <div class="col-sm-6  ">
                            <select class="form-control" type="text" id="edt-unid-media" placeholder="" style="height:46px">
                              @foreach($unidades as $value)
                              <option value="{{$value->TUME_CODIGO}}">{{$value->TUME_DESCR}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="form-group  col-md-6">
                          <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;"   for="formGroupInputSmall">Mult/Unidad: </label>
                          <div class="col-sm-6  ">
                            <input class="form-control" type="text" id="edt-multi-unid" placeholder="">
                          </div>
                        </div>
                        <div class="form-group  col-md-6">
                          <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;"   for="formGroupInputSmall">Tipo Codigo: </label>
                          <div class="col-sm-6  ">
                             <select  id="edt-tipo-code" name="edt-tipo-code"   class="form-control" style="height:46px">
                               <option value="1" selected>MERCANCIA</option>
                               <option value="2">PRODUCTO</option>
                               <option value="3">INSUMOS</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group  col-md-6">
                          <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;" for="formGroupInputSmall">Descripcion: </label>
                          <div class="col-sm-6  ">
                            <input class="form-control" type="text" id="edt-descripcion" placeholder="">
                          </div>
                        </div>
                        <div class="form-group  col-md-6">
                          <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;" for="formGroupInputSmall">Peso / Codigo: </label>
                          <div class="col-sm-6  ">
                            <input class="form-control" type="text" id="edt-peso" placeholder="">
                          </div>
                        </div>
                        <div class="form-group  col-md-6">
                          <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;" for="formGroupInputSmall">Afecto Adicional: </label>
                          <div class="col-sm-6  ">
                            <select class="form-control" type="text" id="edt-afecto-adicional" placeholder=""  style="height:46px">
                              <option value="1">Si</option>
                              <option value="2">No</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group  col-md-6">
                          <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;"  for="formGroupInputSmall">Impuesto Adicional %: </label>
                          <div class="col-sm-6  ">
                            <input class="form-control" type="number" id="edt-impuesto" placeholder="">
                          </div>
                        </div>
                        <div class="form-group  col-md-6">
                          <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;"  for="formGroupInputSmall">Codigo Arancelario: </label>
                          <div class="col-sm-6  ">
                            <input class="form-control" type="number" id="edt-code-arancelario" placeholder="">
                          </div>
                        </div>
                        <div class="form-group  col-md-6">
                          <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;"  for="formGroupInputSmall">Clasificación 2: </label>
                          <div class="col-sm-6  ">
                            <select class="form-control" type="text" id="edt-clasificacion-producto" placeholder=""  style="height:46px">
                              <option value="" selected>-----</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group  col-md-6">
                          <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;"for="formGroupInputSmall">Clasificación 1: </label>
                          <div class="col-sm-6  ">
                            <select class="form-control" type="text" id="edt-clasificacion-mercancia" placeholder=""  style="height:46px">
                              <option value="" selected>-----</option>
                              <option value="1">Si</option>
                              <option value="2">No</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group  col-md-6">
                          <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;" for="formGroupInputSmall">Mayorista: </label>
                          <div class="col-sm-6  ">

                            <select class="form-control" type="text" id="edt-mayorista" placeholder="" style="height:46px">
                              <option value="" selected>-----</option>
                              <option value="1">Si</option>
                              <option value="2">No</option>
                            </select>

                          </div>
                        </div>
                        <div class="form-group  col-md-6">
                          <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;"  for="formGroupInputSmall">Estado: </label>
                          <div class="col-sm-6">
                            <select class="form-control" type="text" id="edt-state" placeholder="" style="height:46px">
                              <option value="1">Si</option>
                              <option value="2">No</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group  col-sm-12">
                           <div class="col-sm-12 " style="padding-left:0px;padding-right:0px">
                             <button type="button" class="btn btn-success  float-right"  style="margin-top:20px" id='edt-son-product' name="button">Guardar</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
               </div>

                <div class="tab-pane fade" id="catalogo" role="tabpanel" aria-labelledby="catalogo-tab">
                  <div >
                    <div class="table-responsive">
                      <div class="col-ms-12" style="margin:10px">
                        <h4>
                          <div>
                            <i class="fa fa-bars">
                            </i>
                            Catalogo de Productos
                            <select class="form-control col-md-1 float-right" id="filter_state">
                              <option value="" selected>Seleccione</option>

                              <option value="1">Si</option>
                              <option value="0">No</option>
                            </select>
                            <button type="button"  class="btn btn-success btn-add-product pull-right btn-icon-only rounded-circle float-right" name="button">+</button>
                          </div>
                        </h4>
                      </div>
                      <div>
                        <table id='catalogoTable' style="width:auto !important" class="table align-items-center">
                          <thead>
                            <tr>
                              <th>Padre</th>
                              <th>Codigo</th>
                              <th>Producto</th>
                              <th>Multipl.</th>
                              <th>Divisor</th>
                              <th>Tipo</th>
                              <th>Estado</th>
                              <th>Usuario</th>
                              <th>Fecha</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>

                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                </div>
                <div class="tab-pane fade" id="nuevo" role="tabpanel" aria-labelledby="nuevo-tab">
                      <div class="container" style="margin: 20px">
                        <div class="">
                          <h4>
                            <div>
                              <i class="fa fa-bars">
                              </i>
                              Crear Codigo
                             </div>
                          </h4>
                        </div>
                        <div class="bs-example" data-example-id="form-group-height-sizes">
                          <form class="form-horizontal form-inline">
                            <div class="form-group col-md-6">
                              <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;"  for="formGroupInputLarge">Codigo: </label>
                              <div class="col-sm-6">
                                <input class="form-control" type="text"  id="create-code" placeholder="">
                              </div>
                            </div>
                            <div class="form-group  col-md-6">
                              <label class="col-sm-6  form-control-label" style="text-align: right; display: inline-block;"  for="formGroupInputSmall">Nombre Codigo: </label>
                              <div class="col-sm-6  ">
                                <input class="form-control" type="text" id="create-name" placeholder="">
                              </div>
                            </div>
                            <div class="form-group  col-md-6">
                              <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;"  for="formGroupInputSmall">Unidad de medida: </label>
                              <div class="col-sm-6">
                                <select class="form-control" type="text" id="create-unid-media" placeholder="">
                                  @foreach($unidades as $value)
                                  <option value="{{$value->TUME_CODIGO}}">{{$value->TUME_DESCR}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                            <div class="form-group  col-md-6">
                              <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;"  for="formGroupInputSmall">Mult/Unidad: </label>
                              <div class="col-sm-6">
                                <input class="form-control" type="text" id="create-multi-unid" placeholder="">
                              </div>
                            </div>
                            <div class="form-group  col-md-6">
                              <label class="col-sm-6 form-control-label " style="text-align: right; display: inline-block;"  for="formGroupInputSmall">Tipo Codigo: </label>
                              <div class="col-sm-6">
                                <select  id="create-tipo-code" name="TPCO_CODIGO" dl="0"  class="form-control">
                                  <option value="1" selected>MERCANCIA</option>
                                  <option value="2">PRODUCTO</option>
                                  <option value="3">INSUMOS</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group  col-md-6">
                              <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;"  for="formGroupInputSmall">Descripcion: </label>
                              <div class="col-sm-6">
                                <input class="form-control" type="text" id="create-descripcion" placeholder="">
                              </div>
                            </div>
                            <div class="form-group  col-md-6">
                              <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;"  for="formGroupInputSmall">Peso / Codigo: </label>
                              <div class="col-sm-6">
                                <input class="form-control" type="text" id="create-peso" placeholder="">
                              </div>
                            </div>
                            <div class="form-group  col-md-6">
                              <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;"  for="formGroupInputSmall">Afecto Adicional: </label>
                              <div class="col-sm-6  ">
                                <select class="form-control" type="text" id="create-afecto-adicional" placeholder="">
                                  <option value="1">Si</option>
                                  <option value="0">No</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group  col-md-6">
                              <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;"  for="formGroupInputSmall">Impuesto Adicional %: </label>
                              <div class="col-sm-6">
                                <input class="form-control" type="number" id="create-impuesto" placeholder="">
                              </div>
                            </div>
                            <div class="form-group  col-md-6">
                              <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;"  for="formGroupInputSmall">Codigo Arancelario: </label>
                              <div class="col-sm-6">
                                <input class="form-control" type="number" id="create-code-arancelario" placeholder="">
                              </div>
                            </div>
                            <div class="form-group  col-md-6">
                              <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;"  for="formGroupInputSmall">Clasificación 2: </label>
                              <div class="col-sm-6">
                                <select class="form-control" type="text" id="create-clasificacion-producto" placeholder="">
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
                            <div class="form-group  col-md-6">
                              <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;"  for="formGroupInputSmall">Clasificación 1: </label>
                              <div class="col-sm-6">
                                <select class="form-control" type="text" id="create-clasificacion-mercancia" placeholder="">
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
                            <div class="form-group  col-md-6">
                              <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;"  for="formGroupInputSmall">Mayorista: </label>
                              <div class="col-sm-6">

                                <select class="form-control" type="text" id="create-mayorista" placeholder="">
                                  <option value="" selected>-----</option>
                                  <option value="1">Si</option>
                                  <option value="0">No</option>
                                </select>

                              </div>
                            </div>
                            <div class="form-group  col-md-6">
                              <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;"  for="formGroupInputSmall">Estado: </label>
                              <div class="col-sm-6">
                                <select class="form-control" type="text" id="create-state" placeholder="">
                                  <option value="1">Si</option>
                                  <option value="0">No</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group  col-md-12">
                              <div class="col-sm-12 " style="padding-left:0px;padding-right:0px">
                                 <button type="button" class="btn btn-success float-right" id='create-son-product' name="button">Guardar</button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                </div>
                <div class="tab-pane fade" id="nutricional" role="tabpanel" aria-labelledby="nutricional-tab">
                  <div class="container" style="margin: 20px">
                    <div class="">
                      <h4>
                        <div>
                          <i class="fa fa-bars">
                          </i>
                          Informacion Nutricional
                         </div>
                      </h4>
                    </div>
                    <div class="bs-example" data-example-id="form-group-height-sizes">
                      <form class="form-horizontal form-inline">
                        <div class="form-group col-md-6">
                          <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;" for="formGroupInputLarge">Codigo: </label>
                          <div class="col-sm-6">
                            <input class="form-control" type="text" id="info-code">
                          </div>
                        </div>
                        <div class="form-group  col-md-6">
                          <label class="col-sm-6 form-control-label  " style="text-align: right; display: inline-block;" for="formGroupInputSmall">Porcion: </label>
                          <div class="col-sm-6  ">
                            <input class="form-control" type="text" id="info-porcion">
                          </div>
                        </div>
                        <div class="form-group  col-md-6">
                          <label class="col-sm-6 form-control-label  "  style="text-align: right; display: inline-block;" for="formGroupInputSmall">Calorias: </label>
                          <div class="col-sm-6  ">
                            <input class="form-control" type="text" id="info-calorias">

                          </div>
                        </div>
                        <div class="form-group  col-md-6">
                          <label class="col-sm-6 form-control-label  " style="text-align: right; display: inline-block;" for="formGroupInputSmall">Grasas Totales: </label>
                          <div class="col-sm-6  ">
                            <input class="form-control" type="text" id="info-grasas-totales">
                          </div>
                        </div>
                        <div class="form-group  col-md-6">
                          <label class="col-sm-6 form-control-label  " style="text-align: right; display: inline-block;" for="formGroupInputSmall">Grasas Saturadas: </label>
                          <div class="col-sm-6  ">
                            <input class="form-control" type="text" id="info-grasas-saturadas">
                          </div>
                        </div>
                        <div class="form-group  col-md-6">
                          <label class="col-sm-6 form-control-label  " style="text-align: right; display: inline-block;" for="formGroupInputSmall">Grasas Trans: </label>
                          <div class="col-sm-6  ">
                            <input class="form-control" type="text" id="info-grasas-trans">
                          </div>
                        </div>
                        <div class="form-group  col-md-6">
                          <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;" for="formGroupInputSmall">Grasas Mono Insaturada </label>
                          <div class="col-sm-6  ">
                            <input class="form-control" type="text" id="info-mono-insaturada">
                          </div>
                        </div>
                        <div class="form-group  col-md-6">
                          <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;" for="formGroupInputSmall">Grasas Poli Saturada: </label>
                          <div class="col-sm-6">
                            <input class="form-control" type="text" id="info-poli-saturada">

                          </div>
                        </div>
                        <div class="form-group col-md-6">
                          <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;" for="formGroupInputSmall">Colesterol: </label>
                          <div class="col-sm-6">
                            <input class="form-control" type="number" id="info-colesterol">
                          </div>
                        </div>
                        <div class="form-group  col-md-6">
                          <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;" for="formGroupInputSmall">Sodio: </label>
                          <div class="col-sm-6  ">
                            <input class="form-control" type="number" id="info-sodio">
                          </div>
                        </div>
                        <div class="form-group  col-md-6">
                          <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;" for="formGroupInputSmall">Total Carbohidratos: </label>
                          <div class="col-sm-6  ">
                            <input class="form-control" type="text" id="info-total-carbohidratos"/>
                          </div>
                        </div>
                        <div class="form-group  col-md-6">
                          <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;" for="formGroupInputSmall">Fibra dietetica: </label>
                          <div class="col-sm-6  ">
                            <input class="form-control" type="text" style="text-align: right; display: inline-block;" id="info-fibra-dietetica"/>
                          </div>
                        </div>
                        <div class="form-group  col-md-6">
                          <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;" for="formGroupInputSmall">Azucar: </label>
                          <div class="col-sm-6  ">
                            <input class="form-control" type="text" id="info-azucar">
                          </div>
                        </div>
                        <div class="form-group  col-md-6">
                          <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;" for="formGroupInputSmall">Proteinas: </label>
                          <div class="col-sm-6  ">
                            <input class="form-control" type="text" id="info-proteinas">
                          </div>
                        </div>
                        <div class="form-group  col-md-6">
                          <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;" for="formGroupInputSmall">Vitamina A: </label>
                          <div class="col-sm-6  ">
                            <input class="form-control" type="text" id="info-vitamina-a">
                          </div>
                        </div>
                        <div class="form-group  col-md-6">
                          <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;" for="formGroupInputSmall">Vitamina C: </label>
                          <div class="col-sm-6 ">
                            <input class="form-control" type="text" id="info-vitamina-c">
                          </div>
                        </div>
                        <div class="form-group  col-md-6">
                          <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;" for="formGroupInputSmall">Calcio: </label>
                          <div class="col-sm-6  ">
                            <input class="form-control" type="text" id="info-calcio">
                          </div>
                        </div>
                        <div class="form-group  col-md-6">
                          <label class="col-sm-6 form-control-label" style="text-align: right; display: inline-block;" for="formGroupInputSmall">Hierro: </label>
                          <div class="col-sm-6  ">
                            <input class="form-control" type="text" id="info-hierro">
                          </div>
                        </div>
                        <div class="form-group  col-md-12">
                           <div class="col-sm-12">
                             <button type="button" class="btn btn-success float-right" id='info-nutricional' name="button">Guardar</button>
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
  </div>
@endsection

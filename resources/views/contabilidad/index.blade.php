@extends('layouts.dashboard')

@section('content')
  <div class=" ">
    <div class="card card card card-default scrollspy">
      <div class="card-content">
        <h4><span class="card-title">Retiros Bancos/Prosegur</span></h4>
        <div class="row">
          <div class="col s12">
            <ul class="tabs">
              <li class="tab col m3"><a class='active' href="#test1">Salida Bancos</a></li>
              <li class="tab col m3"><a class="" href="#test2">Otros Depositos</a></li>
              <li class="tab col m4"><a class="" href="#test3">Depositos Pendientes</a></li>
            </ul>
            <div id="test1">
              <div class="container" style="margin-top: 30px">
                <div class=" " data-example-id="form-group-height-sizes">

                  <div class="col l5 m5 s5">
                    <div class="form-group">
                      <label for="" class="form-control-babel">Desde</label>
                      <input type="date" class="form-control browser-default">
                    </div>
                  </div>
                  <div class="col l5 m5 s5">
                    <div class="form-group">
                      <label for="" class="form-control-babel">Hasta</label>
                      <input type="date" class="form-control browser-default">
                    </div>
                  </div>
                  <div class="col l2 m2 s2">
                    <button type="button" class="btn cyan btn-45" style='margin-top:21px' name="button">Buscar</button>
                  </div>
                </div>
                 <div class=" ">
                    <div class="col m12" style="margin-top: 20px;">
                      <div style="display: flex">
                        <i class="material-icons dp48">subject</i><span class="card-title">Detalle Retiro Prosegur</span>
                      </div>
                      <table class="table table-striped centered">
                      <thead>
                        <tr>
                          <th width='6%'>ID</th>
                          <th>Tipo Retiro</th>
                          <th>Desde</th>
                          <th>Hasta</th>
                          <th>Cantidad</th>
                          <th>Monto total</th>
                          <th>Estado</th>
                          <th>Fecha cierre</th>
                          <th>Responsable</th>
                          <th>Observacion</th>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                     </div>
                </div>
              </div>
            </div>
            <div id="test2" class="col s12  lighten-4">
              <div class="container" style="margin-top: 30px">
                <div class=" " data-example-id="form-group-height-sizes">

                  <div class="col l5 m5 s5">
                    <div class="form-group">
                      <label for="" class="form-control-babel">Desde</label>
                      <input type="date" class="form-control browser-default">
                    </div>
                  </div>
                  <div class="col l5 m5 s5">
                    <div class="form-group">
                      <label for="" class="form-control-babel">Hasta</label>
                      <input type="date" class="form-control browser-default">
                    </div>
                  </div>
                  <div class="col l2 m2 s2">
                    <button type="button" class="btn cyan btn-45" style='margin-top:21px' name="button">Buscar</button>
                  </div>
                </div>
                 <div class=" ">
                    <div class="col m12" style="margin-top: 20px;">
                      <div style="display: flex">
                        <i class="material-icons dp48">subject</i><span class="card-title">Detalle otros retiros prosegur</span>
                      </div>
                      <table class="table table-striped centered">
                      <thead>
                        <tr>
                          <th width='6%'>ID</th>
                          <th>Folio</th>
                          <th>Fecha</th>
                          <th>Descripcion</th>
                          <th>Sucursal</th>
                          <th>Usuario</th>
                          <th>Deposito</th>
                          <th>Monto</th>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                     </div>
                </div>
              </div>
            </div>
            <div id="test3" class="col s12  lighten-4">Test 2</div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

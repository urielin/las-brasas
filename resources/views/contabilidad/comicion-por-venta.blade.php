@extends('layouts.dashboard')

@section('content')
<div class=" ">
    <div class="card card card card-default scrollspy">
      <div class="card-content">
        <h4><span class="card-title">Comisiones por Venta</span></h4>
        <div class="row">
          <div class="col s12">
            <ul class="tabs">
              <li class="tab col m3"><a class='active' href="#test1">Resumen por mes</a></li>
            </ul>
            <div id="test1">
              <div class="container" style="margin-top: 30px">
                <div class=" " data-example-id="form-group-height-sizes">
                
                  <div class="col l5 m5 s5">
                    <div class="form-group">
                      <label for="" class="form-control-babel">Gestion</label>
                      <!--<input type="text" id="gestion" class="form-control browser-default">-->
                      <select name="gestion" id="gestion" value="----" class=".select2">
                        <option color="blue">ddfgfd</option>

                        <option value="---">ddfgfd</option>
                        <option value="---">ddfgfd</option>
                        <option value="---">ddfgfd</option>
                      </select>
                    </div>
                  </div>
                  <div class="col l5 m5 s5">
                    <div class="form-group">
                      <label for="" class="form-control-babel">Meses</label>
                      <select name="meses" id="meses" value="----" class="select2">
                      </select>
                    </div>
                  </div>
                  <div class="col l5 m5 s5">
                    <div class="form-group">
                      <label for="" class="form-control-babel">Sucursal</label>
                      <select name="sucursal" id="sucursal" value="----" class=".select2">
                      </select>
                    </div>
                  </div>
                  <div class="col l5 m5 s5">
                    <div class="form-group">
                      <label for="" class="form-control-babel">Vendedor</label>
                      <select name="vendedor" id="vendedor" value="----" class=".select2">
                      </select>
                    </div>
                  </div>
                  <div class="col l2 m2 s2">
                    <button type="button" id="buscar-salida-bancos" class="btn cyan btn-45" style='margin-top:21px' name="button">Buscar</button>
                  </div>
                </div>
                 <div class=" ">
                    <div class="col l12 m12 s12" style="margin-top: 20px;">
                      <div style="display: flex">
                        <i class="material-icons dp48">subject</i><span class="card-title">Resumen Histórico</span>
                      </div>
                      <table id='tableRetiroProsegur' class="table responsive-table">
                        <thead>
                          <tr>
                            <th width='6%'>ID</th>
                            <th>Gestion</th>
                            <th>Mes</th>
                            <th>F.Pago</th>
                            <th>Descripcion</th>
                            <th>Cantidad</th>
                            <th>Impuesto</th>
                            <th>Adicional</th>
                            <th>Monto total</th>
                            <th>OP</th>
                            <th>Operación</th>
                          </tr>
                        </thead>
                        <tbody id="retiroTabla">

                        </tbody>
                      </table>
                     </div>

                     <div class="col m12" style="margin-top: 20px;">
                       <span id="icono1"></span>

                           <table class="responsive-table striped">
                             <thead id="depositoDetalleHead">

                             </thead>
                             <tbody id="depositoDetalleTabla">

                             </tbody>
                           </table>

                      </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>


@endsection

@section('js')
        
@endsection

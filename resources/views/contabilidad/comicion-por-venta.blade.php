@extends('layouts.dashboard')

@section('content')
<<<<<<< HEAD
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
=======
<div class="card card card card-default scrollspy">
  <div class="card-content">
      <div style="display: flex">
        <i class="material-icons dp48">subject</i>
        <span>Seleccionar resumen por mes de los asientos contables</span>
      </div>
      <div class="row">
        <div class="form-group col l3 m6 s12">
          <label for="" class="form-control-label">Gestion</label>
          <select class="form-control browser-default" name="gestion">
            <option value=""></option>
          </select>
        </div>
        <div class="form-group col l3 m6 s12">
          <label for="" class="form-control-label">Meses</label>
          <select class="form-control browser-default" name="mes">
            <option value=""></option>
          </select>
        </div>
        <div class="form-group col l3 m6 s12">
          <label for="" class="form-control-label">Sucursal</label>
          <select class="form-control browser-default" name="sucursal">
            <option value=""></option>
          </select>
        </div>
        <div class="form-group col l3 m6 s12">
          <label for="" class="form-control-label">Vendedor</label>
          <select class="form-control browser-default" name="vendedor">
            <option value=""></option>
          </select>
        </div>
        <div class="form-group col l12 m12 s12 " style="display:flex; justify-content: space-around; margin-top:10px">
          <button type="button" class="btn btn-45 cyan" name="updateReport">Actualizar Informes</button>
          <button type="button" class="btn btn-45 cyan" name="sumarySeller">Resumen por Vendedor</button>
          <button type="button" class="btn btn-45 cyan" name="reportSells">Reporte Detalle de Ventas</button>
        </div>
      </div>
  </div>
</div>
<div class="card card card card-default scrollspy">
  <div class="card-content">
    <div class="row">
>>>>>>> 498907c26da29f768a2aa458a783947dbc496a59

      <div class="col s12">
        <ul class="tabs">
          <li class="tab col m6"><a class="active" href="#test1">Resumen de comiciones</a></li>
          <li class="tab col m6"><a href="#test2">Detalle de comiciones</a></li>
        </ul>
      </div>
      <div id="test1" class="col s12">
        <div class="responsive-table" style="overflow-x: scroll; width: 100%;">

          <table class="table table-responsive responsive-table">
            <thead>
              <tr>
                <th>Gestion</th>
                <th>Mes</th>
                <th>Forma Pago</th>
                <th>Descripcion</th>
                <th>Cantidad</th>
                <th>Impuesto</th>
                <th>Adicional</th>
                <th>Monto Total</th>
                <th>Monto Neto</th>
                <th>Operacion</th>
                <th>Operacion Gest</th>
                <th>Operacion Mes</th>
                <th>Est</th>
                <th>Descripcion</th>
                <th>Cartola Gestion</th>
                <th>Cartola Mes</th>
                <th>Monto confirmado</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
      <div id="test2" class="col s12">
        <div class="responsive-table" style="overflow-x: scroll; width: 100%;">
          <table class="table table-responsive responsive-table">

          <thead>
            <tr>
              <th>Gest</th>
              <th>Mes</th>
              <th>FP</th>
              <th>Forma de pago</th>
              <th>Cant</th>
              <th>Imp</th>
              <th>Adic.</th>
              <th>Total</th>
              <th>Neto</th>
              <th>CO</th>
              <th>Operacion</th>
              <th>Mes</th>
              <th>Gest</th>
              <th>C</th>
              <th>Cartola</th>
              <th>Mes</th>
              <th>Gest.</th>
              <th>Codigo</th>
              <th>Producto</th>
              <th>Monto</th>
              <th>Comis</th>
              <th>Total</th>

            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
        
@endsection

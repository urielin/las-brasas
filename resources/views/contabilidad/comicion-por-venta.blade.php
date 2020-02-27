@extends('layouts.dashboard')

@section('content')
<div class="card card card card-default scrollspy">
  <div class="card-content">
      <div style="display: flex">
        <i class="material-icons dp48">subject</i>
        <span>Seleccionar resumen por mes de los asientos contables</span>
      </div>
      <div class="row">
        <div class="form-group col l3 m6 s12">
          <label for="" class="form-control-label">Gestion</label>
          <select class="form-control browser-default" id="gestion" name="gestion">
          <option value="">Seleccione gestión</option>  
          @foreach ($gestion as $g)
                <option value="{{$g->TP_GESTION}}">{{$g->ges}}</option>
            @endforeach 
          </select>
        </div>
        <div class="form-group col l3 m6 s12">
          <label for="" class="form-control-label">Meses</label>
          <select class="form-control browser-default" id="mes" name="mes">
          
          </select>
        </div>
        <div class="form-group col l3 m6 s12">
          <label for="" class="form-control-label">Sucursal</label>
          <select class="form-control browser-default" id="sucursal" name="sucursal">
          
          </select>
        </div>
        <div class="form-group col l3 m6 s12">
          <label for="" class="form-control-label">Vendedor</label>
          <select class="form-control browser-default" id="vendedor" name="vendedor">
          
          </select>
        </div>
        <div class="form-group col l12 m12 s12 " style="display:flex; justify-content: space-around; margin-top:10px">
          <button type="button" class="btn btn-45 cyan" name="updateReport" id="actualizar">Actualizar Informes</button>
          <button type="button" class="btn btn-45 cyan" name="sumarySeller">Resumen por Vendedor</button>
          <button type="button" class="btn btn-45 cyan" name="reportSells">Reporte Detalle de Ventas</button>
          <button type="button" class="btn btn-45 cyan" name="reportSells">Exportar</button>
        </div>
      </div>
  </div>
</div>
<div class="card card card card-default scrollspy">
  <div class="card-content">
    <div class="row">

      <div class="col s12">
        <ul class="tabs">
          <li class="tab col m6"><a class="active" href="#test1" id="tabla1">Resumen de comiciones</a></li>
          <li class="tab col m6"><a href="#test2" id="tabla2">Detalle de comiciones</a></li>
        </ul>
      </div>
      <div id="test1" class="col s12">
        <div class="responsive-table" style="overflow-x: scroll; width: 100%;">

          <table class="table table-responsive responsive-table" id="tabla-comisiones">
            <thead>
              <tr>
                <th>ID Venta</th>
                <th>Folio</th>
                <!--<th>Proc Folio Pedido</th>-->
                <!--<th>Fecha Venta</th>-->
                <th>FormaDePago</th>
                <th>Código Vendedor</th>
                <th>Precio Total</th>
                <th>Impuesto</th>
                <th>Adicional</th>
                <th>Precio Neto</th>
                <th>RUT Cliente</th>
                <!--<th>Comision</th>-->
                <th>Fecha Venta</th>
                <th>Fecha de Pago</th>
                <th>Monto</th>
                <th>Tipo de Documento</th>
                <th>N° Deposito</th>
              </tr>
            </thead>
            <tbody id="contenido">

            </tbody>
          </table>
        </div>
      </div>
      <div id="test2" class="col s12">
        <div class="responsive-table" style="overflow-x: scroll; width: 100%;">
          <table class="table table-responsive responsive-table" id="tabla-detalles">
          <thead>
            <tr>
              <th>Folio</th>
              <th>Nombre producto</th>
              <th>Código</th>
              <th>Cantidad</th>
              <th>Precio Total</th>
              <th>Sucursal</th>
            </tr>
          </thead>
          <tbody id="contenido-detalles">

          </tbody>
        </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
  
@section('js')
    <script src="{{asset('js/comision-venta.js') }}"></script>
@endsection

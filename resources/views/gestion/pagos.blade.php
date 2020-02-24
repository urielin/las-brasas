@extends('layouts.dashboard')

@section('content')

<div class="card card card card-default scrollspy">
  <div class="card-content">
    <div class="row">

      <div class="col s12">
        <ul class="tabs">
          <li class="tab col m6"><a class="active" href="#test1">Camiones por pagar</a></li>
          <li class="tab col m6"><a href="#test2">Historial de pago de camiones</a></li>
        </ul>
      </div>
      <div id="test1" class="col s12">
        <div class="responsive-table" style="overflow-x: scroll; width: 100%;">

          <table class="table table-responsive responsive-table">
            <thead>
              <tr>
                <th>Codigo</th>
                <th>Descripcion</th>
                <th>Pagar a Nombre de:</th>
                <th>Total de Factura</th>
                <th>Moneda</th>
                <th>Fecha Llegada</th>
                <th>Forward</th>
                <th>Fecha Forward</th>
                <th>Fecha compromiso</th>
                <th>Swift</th>
                <th>Fecha Swift</th>
                <th>Pagado Fecha</th>
                <th></th>
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
              <th>Codigo</th>
              <th>Descripcion</th>
              <th>FP</th>
              <th>Resol. Sanit</th>
              <th>Embarque</th>
              <th>Llegada</th>
              <th>Pago Estimado.</th>
              <th>Items</th>
              <th>Forma Pago</th>
              <th>-</th>
              <th>Despues</th>
              <th>Moneda</th>
              <th>Total Factura</th>
              <th>Pagado</th>
              <th>Total Pagos</th>
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

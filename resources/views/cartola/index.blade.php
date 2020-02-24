@extends('layouts.dashboard')

@section('content')
<div class="card card card card-default scrollspy">
  <div class="card-content">
      <div style="display: flex">
        <i class="material-icons dp48">subject</i>
        <span>Seleccionar resumen por mes de los asientos contables</span>
      </div>
      <div class="row" style="margin-top:10px">
        <div class="form-group col l4 m6 s12">
          <label for="" class="form-control-label">Cuenta</label>
          <select id="elegir-cuenta"  class="form-control browser-default" name="cuenta">
            <option value="disabled">Seleccione cuenta</option>

            @foreach ($cuentas as $cuenta)
            <option value="{{$cuenta->COD_CUENTA}}" >{{$cuenta->DESCRIPCION_CUENTA}}</option>
            @endforeach

          </select>
        </div>
        <div class="form-group col l4 m6 s12">
          <label for="" class="form-control-label">Gestion</label>
          <select disabled id="elegir-gestion" class="form-control browser-default" name="gestion">
            @foreach ($gestion as $g)
              <option value="{{$g->TP_GESTION }}" >{{$g->tp}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group col l4 m6 s12">
          <label  for="" class="form-control-label">Cartola</label>
          <input disabled id="insertar-cartolar" type='text' class="form-control browser-default" name="cartola"/>

        </div>
        <div class="form-group col l12 m12 s12">
          <label for="" class="form-control-label">Texto de migracion</label>
          <textarea disabled id="insertar-migracion" rows='6'  class="form-control-textarea browser-default" style="width:100%" name="txt_migracion">

          </textarea>
        </div>
        <div class="form-group col l12 m12 s12 " style="display:flex; justify-content: flex-end; margin-top:10px">
          <button type="button" class="btn btn-45 cyan" name="updateReport">Migracion</button>
          <button type="button" class="btn btn-45 cyan" name="sumarySeller">Borrar Temporales</button>
        </div>
      </div>
  </div>
</div>
<div class="card card card card-default scrollspy">
  <div class="card-content">
    <div class="row">
      <div class="responsive-table" style="overflow-x: scroll; width: 100%;">
        <table class="table table-responsive responsive-table">
          <thead>
            <tr>
              <th>Cuenta</th>
              <th>Cartola</th>
              <th>Fecha</th>
              <th>Sucursal</th>
              <th>Descripcion</th>
              <th>Documento</th>
              <th>Cargos</th>
              <th>Abono</th>
              <th>Saldo</th>
              <th>Deposito</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
    </div>
 </div>
</div>
@endsection

@section('js')
    <script src="{{ asset('js/ingreso-cartola.js') }}"></script>
@endsection

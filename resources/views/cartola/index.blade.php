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
          <select class="form-control browser-default" name="cuenta">
            <option value=""></option>
          </select>
        </div>
        <div class="form-group col l4 m6 s12">
          <label for="" class="form-control-label">Gestion</label>
          <select class="form-control browser-default" name="gestion">
            <option value=""></option>
          </select>
        </div>
        <div class="form-group col l4 m6 s12">
          <label for="" class="form-control-label">Cartola</label>
          <input type='text' class="form-control browser-default" name="cartola"/>

        </div>
        <div class="form-group col l12 m12 s12">
          <label for="" class="form-control-label">Texto de migracion</label>
          <textarea rows='6'  class="form-control-textarea browser-default" style="width:100%" name="txt_migracion">

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
@endsection

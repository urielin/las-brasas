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
          <!--<textarea disabled id="insertar-migracion" rows='6'  class="form-control-textarea browser-default" style="width:100%" name="txt_migracion">

          </textarea>-->
          <input id='xlsFile' placeholder="Seleccionar Archivo" type="file" name="file" class="form-control">
          <button class="btn btn-45 cyan" id='importCartola'>Importar</button>
        </div>
        <div class="form-group col l12 m12 s12 " style="display:flex; justify-content: flex-end; margin-top:10px">
          <button type="button" class="btn btn-45 cyan" name="updateReport" id='migration'>Migracion</button>
          <button type="button" class="btn btn-45 cyan" name="sumarySeller" id='borrarTemporales'>Borrar Temporales</button>
        </div>
      </div>
  </div>
</div>
<div class="card card card card-default scrollspy">
  <div class="card-content">
    <div class="row">
      <div class="responsive-table" style="overflow-x: scroll; width: 100%;">
        <table id='detalleCartola' class="table table-responsive responsive-table">
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
    <script type="text/javascript">
      $('#borrarTemporales').on('click', function() {
        localStorage.removeItem('cartolas');
      })
      $('#migration').on('click', function() {

        let data = localStorage.getItem('cartolas')

        $.ajax({
          type:'POST',
          url:'/cartola/migracion',
          data: {cartolas: data},
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        }).then((data) => {

        })
      })
      $('#importCartola').on('click', function(){
          let data = new FormData();
          let file = document.getElementById('xlsFile').files[0];
          let cuenta = $('#elegir-cuenta').val()
          let cartola = $('#insertar-cartolar').val()
          data.append('file', file );
          data.append('cuenta', cuenta)
          data.append('cartola', cartola)
          $.ajax({
            type:'POST',
            url:'/cartola/importar',
            data: data,
            processData: false,
            contentType: false,
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          }).then((data) => {
            let html  = setCartolaDetail(data.movimientos)
            $('#detalleCartola tbody').empty().append(html);
          })
      })
      function setCartolaDetail (data){
        localStorage.setItem('cartolas', JSON.stringify(data))
        let array = [];
        for (let i = 0; i < data.length; i++) {
          array[i] = `<tr>
                        <td style='padding-right: 1rem;padding-left: 1rem;;'>${data[i].cuenta}</td>
                        <td style='padding-right: 1rem;padding-left: 1rem;;'>${data[i].cartola}</td>
                        <td style='padding-right: 1rem;padding-left: 1rem;;'>${data[i].fecha}</td>
                        <td style='padding-right: 1rem;padding-left: 1rem;;'>${data[i].sucursal}</td>
                        <td style='padding-right: 1rem;padding-left: 1rem;;'>${data[i].descripcion}</td>
                        <td style='padding-right: 1rem;padding-left: 1rem;;'>${data[i].documento}</td>
                        <td style='padding-right: 1rem;padding-left: 1rem;;'>${data[i].cargo}</td>
                        <td style='padding-right: 1rem;padding-left: 1rem;;'>${data[i].monto}</td>
                    </tr>`;
        }
        return array;
      }
    </script>
@endsection

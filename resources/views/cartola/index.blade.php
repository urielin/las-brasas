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
        <div class="form-group col l4 m12 s12">
          <label  for="" class="form-control-label">Cartola</label>
          <input disabled id="insertar-cartolar" type='text' class="form-control browser-default" name="cartola"/>

        </div>
        <div class="form-group col l4 m12 s12" >
          <label for="" class="form-control-label">Texto de migracion</label>
          <div class="input-group">

            <!--<input id='xlsFile' type="file" placeholder="Seleccionar Archivo" name="file" class="form-control input-50">-->
            <input id="txt"  class="form-control input-50 browser-default"   type="text" value = "Seleccionar Archivo" onclick ="javascript:document.getElementById('xlsFile').click();">

            <div class="input-group-append">
              <button class="btn btn-45 cyan" id='importCartola'>Importar</button>
              <input id="xlsFile"  class="form-control input-50 browser-default"  type="file" style='visibility: hidden; display:none' name="file" onchange="ChangeText(this, 'txt');"/>

            </div>
          </div>
        </div>
        <div class="form-group col l12 m12 s12 " style="display:flex; justify-content: flex-end; margin-top:10px">
          <button type="button" class="waves-effect  btn-flat" name="sumarySeller" id='borrarTemporales' style='margin-right: 10px'>Borrar Temporales</button>
          <button type="button" class="btn  green" name="updateReport" id='migration'>Migracion</button>
        </div>
      </div>
  </div>
</div>
<div class="card card card card-default scrollspy">
  <div class="card-content">
    <div class="row">
      <div class="responsive-table" style="overflow-x: scroll; width: 100%;">
        <table id='detalleCartola' class="table table-responsive centered responsive-table">
          <thead>
            <tr>
              <th>Cuenta</th>
              <th>Cartola</th>
              <th>Fecha</th>
              <th>Sucursal</th>
              <th>Descripcion</th>
              <th>Documento</th>
            <!--  <th>Cargos</th>
              <th>Abono</th>-->
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
      function ChangeText(oFileInput, sTargetID) {
        document.getElementById(sTargetID).value = oFileInput.value;
      }
      $('#borrarTemporales').on('click', function() {
        localStorage.removeItem('cartolas');
        $('[name=cuenta] option').filter(function() {
          return ($(this).text() == 'Seleccione cuenta');
        }).prop('selected', true);
        $('#insertar-cartolar').val('')
        $("#xlsFile").val(null);
        $("#txt").val('Seleccionar Archivo');

      })
      $('#migration').on('click', function() {

        let data = localStorage.getItem('cartolas')
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })
        let valid = {
          cuenta: $('#elegir-cuenta').val(),
          cartola: $('#insertar-cartolar').val(),
        }
        if (valid.cuenta != 'disabled') {

          $.ajax({
            type:'POST',
            url:'/cartola/migracion',
            data: {cartolas: data},
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          }).then((data) => {
            if (data.status == 200) {
              Toast.fire({
                icon: 'success',
                title: 'Cartola ingresada'
              })
            } else {
              Toast.fire({
                icon: 'error',
                title: 'Cartola ya ha sido registrada'
              })
            }
          })
        } else {
          Toast.fire({
            icon: 'error',
            title: 'El campo cuenta es obligatorio'
          })
        }
      })
      $('#importCartola').on('click', function(){
         let data = new FormData();
         let file = document.getElementById('xlsFile').files[0];

         let array = [];
         let planes = [];
         let reader = new FileReader();
         let filename;
         reader.onload = function(progressEvent){
           let lines = this.result.split('\n');
           for(var i = 0; i < lines.length; i++){
               array[i] = lines[i];
           }
          let date = array[0].substring(161, 169)
          let fecha = date.substring(0,2)+'/'+ date.substring(2,4)+'/'+ date.substring(4)
          var fullPath = document.getElementById('xlsFile').value;
          if (fullPath) {
              var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
              filename = fullPath.substring(startIndex);
              if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                  filename = filename.substring(1);
              }
          }
           array.shift();
           array.pop();
           array.forEach((item, i) => {
             let document = item.substring(42, 48).trim() != '000000' ? item.substring(42, 48).trim() : ''
             planes.push({
                          cuenta: $('#elegir-cuenta').val(),
                          cartola: $('#insertar-cartolar').val(),
                          deposito: item.substring(0, 10).trim(),
                          descripcion: item.substring(10, 40).trim(),
                          documento: document,
                          fecha: fecha,
                          monto: parseInt(item.substring(49, 67).trim(), 10),
                          sucursal: item.substring(68).trim(),
                          nombre_archivo: filename,

                        })
           });

           localStorage.setItem('cartolas', JSON.stringify(planes))
           const html  = setCartolaDetail(planes)
           $('#detalleCartola tbody').empty().append(html);
          };
          reader.readAsText(file, "ISO-8859-1");

      })
      function setCartolaDetail (data){
        let array = [];
        for (let i = 0; i < data.length; i++) {
          array[i] = `<tr>
                        <td style='padding-right: 1rem;padding-left: 1rem;;'>${data[i].cuenta}</td>
                        <td style='padding-right: 1rem;padding-left: 1rem;;'>${data[i].cartola}</td>
                        <td style='padding-right: 1rem;padding-left: 1rem;;'>${data[i].fecha}</td>
                        <td style='padding-right: 1rem;padding-left: 1rem;;'>${data[i].sucursal}</td>
                        <td style='padding-right: 1rem;padding-left: 1rem;;'>${data[i].descripcion}</td>
                        <td style='padding-right: 1rem;padding-left: 1rem;;'>${data[i].documento}</td>

                        <td style='padding-right: 1rem;padding-left: 1rem;;'>${addCommas(data[i].monto)}</td>
                        <td style='padding-right: 1rem;padding-left: 1rem;;'>${data[i].deposito}</td>

                    </tr>`;
        }
        return array;
      }
      function addCommas(nStr)
      {
      	nStr += '';
      	x = nStr.split('.');
      	x1 = x[0];
      	x2 = x.length > 1 ? '.' + x[1] : '';
      	var rgx = /(\d+)(\d{3})/;
      	while (rgx.test(x1)) {
      		x1 = x1.replace(rgx, '$1' + ',' + '$2');
      	}
      	return x1 + x2;
      }

    </script>
 @endsection

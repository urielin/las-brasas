$(document).ready(function(){

   $('#clasificacionad').on('change', function(){
     let clasificacion, estado;
      clasificacion = $(this).val();
      estado = $('#estado').val();

      $('#tabla-administracion-cuerpo').empty();
      if ( $.trim(clasificacion) != '') {
          $.get('administrar-tabla-clasificacion',{clasificacion:clasificacion,estado:estado},function(res){
                if (res.camiones != '') {
                  $.each(res.camiones,function(index,value){
                    let monto_cierre = value.monto_cierre == null ? '-' : value.monto_cierre;
                    let ingreso_zeta = value.ingreso_zeta == null ? '-' : value.ingreso_zeta;
                    let declara_origen = value.declara_origen == '' ? '-' : value.declara_origen;
                    let naviera = value.naviera == null ? '-' : value.naviera;

                    $('#tabla-administracion-cuerpo').append(`
                      <tr class="administrar-detalle" data-id_camion="${value.id_camion}">
                      <td>${value.id_camion}</td>
                      <td>${value.codigo}</td>
                      <td>${value.estado}</td>
                      <td>${value.codigo_aux}</td>
                      <td>${value.descripcion}</td>
                      <td>${dateUTC(value.fecha_cierre)}</td>
                      <td>${value.proveedor}</td>
                      <td>${monto_cierre}</td>
                      <td>${value.tipo_moneda}</td>
                      <td>${dateUTC(value.fecha_embarque)}</td>
                      <td>${dateUTC(value.fecha_llegada_estimada)}</td>
                      <td>${value.lugar_arribo}</td>
                      <td>${declara_origen}</td>
                      <td>${ingreso_zeta}</td>
                      <td>${naviera}</td>
                      </tr>
                      `);
                    });
                } else {
                  $('#tabla-administracion-cuerpo').append(`
                    <tr class="group">
                      <td colspan="15">Camiones no encontrados</td>
                    </tr>
                  `);
                }
          });
      }

   });

   $('#estado').on('change', function(){
     let clasificacion, estado;
      estado = $(this).val();
      clasificacion = $('#clasificacionad').val();

      $('#tabla-administracion-cuerpo').empty();
      if ( $.trim(clasificacion) != '') {
          $.get('administrar-tabla-estado',{clasificacion:clasificacion,estado:estado},function(res){
              if (res.camiones != '') {
                    $.each(res.camiones,function(index,value){
                      let monto_cierre = value.monto_cierre == null ? '-' : value.monto_cierre;
                      let ingreso_zeta = value.ingreso_zeta == null ? '-' : value.ingreso_zeta;
                      let declara_origen = value.declara_origen == '' ? '-' : value.declara_origen;
                      let naviera = value.naviera == null ? '-' : value.naviera;
                      $('#tabla-administracion-cuerpo').append(`
                        <tr class="administrar-detalle" data-id_camion="${value.id_camion}">
                        <td>${value.id_camion}</td>
                        <td>${value.codigo}</td>
                        <td>${value.estado}</td>
                        <td>${value.codigo_aux}</td>
                        <td>${value.descripcion}</td>
                        <td>${dateUTC(value.fecha_cierre)}</td>
                        <td>${value.proveedor}</td>
                        <td>${monto_cierre}</td>
                        <td>${value.tipo_moneda}</td>
                        <td>${dateUTC(value.fecha_embarque)}</td>
                        <td>${dateUTC(value.fecha_llegada_estimada)}</td>
                        <td>${value.lugar_arribo}</td>
                        <td>${declara_origen}</td>
                        <td>${ingreso_zeta}</td>
                        <td>${naviera}</td>
                        </tr>
                        `);
                      });
              } else {
                $('#tabla-administracion-cuerpo').append(`
                  <tr class="group">
                    <td colspan="15">Camiones no encontrados</td>
                  </tr>
                `);
              }
          });
      }
   });

   $('#buscar-camionad').on('click', function(){
       let codigo;
       codigo = $('#codigo').val();
       $('#tabla-administracion-cuerpo').empty();
       if ( $.trim(codigo)!= '') {
            $.get('administrar-tabla-codigo',{codigo:codigo},function(res){

                if (res.camiones != '') {
                  $.each(res.camiones,function(index,value){
                    let monto_cierre = value.monto_cierre == null ? '-' : value.monto_cierre;
                    let ingreso_zeta = value.ingreso_zeta == null ? '-' : value.ingreso_zeta;
                    let declara_origen = value.declara_origen == '' ? '-' : value.declara_origen;
                    let naviera = value.naviera == null ? '-' : value.naviera;
                    $('#tabla-administracion-cuerpo').append(`
                      <tr class="administrar-detalle" data-id_camion="${value.id_camion}">
                      <td>${value.id_camion}</td>
                      <td>${value.codigo}</td>
                      <td>${value.estado}</td>
                      <td>${value.codigo_aux}</td>
                      <td>${value.descripcion}</td>
                      <td>${dateUTC(value.fecha_cierre)}</td>
                      <td>${value.proveedor}</td>
                      <td>${monto_cierre}</td>
                      <td>${value.tipo_moneda}</td>
                      <td>${dateUTC(value.fecha_embarque)}</td>
                      <td>${dateUTC(value.fecha_llegada_estimada)}</td>
                      <td>${value.lugar_arribo}</td>
                      <td>${declara_origen}</td>
                      <td>${ingreso_zeta}</td>
                      <td>${naviera}</td>
                      </tr>
                      `);
                    });
                } else {
                  $('#tabla-administracion-cuerpo').append(`
                    <tr class="group">
                      <td colspan="15">Camiones no encontrados</td>
                    </tr>
                  `);
                }
            })
       } else {
          alerta('error','Debes ingresar un código de camión');
       }
   });


   $('#tabla-administracion-cuerpo').on('click','.administrar-detalle',function(){
          let id_camion;

          let elem = $('.tabs')
          let instance = M.Tabs.getInstance(elem);
          instance.select('test2');

          id_camion = $(this).attr('data-id_camion');
          $.get('detalle-administrar-camion',{id_camion:id_camion},function(res){
              console.log(res);
              

          });
   });

   function dateUTC(ms) {
     var ms, fecha,año, mes, dia, hora, minuto, segundo;

     if ( ms != null) {
       ms = new Date(ms);
       año=ms.getUTCFullYear();
       mes=ms.getUTCMonth()+1;
       dia=ms.getUTCDate();
       fecha= año+'-'+ pad(mes) +'-'+ pad(dia);
       return fecha;
     } else {
       return '-';
     }

   }

   function pad(number) {
       if (number < 10) {
           if (number == 0) {
             return '0' + number;
           }
           else {
             return '0' + number;
           }
       }
       return number;
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

   function alerta(icon, title){
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
     Toast.fire({
       icon: icon,
       title: title
     })
   }


});

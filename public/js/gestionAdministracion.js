$(document).ready(function(){

  $("#tableAdministrador tbody").on('mouseover','tr', function(e){
    $(this).addClass('tr-selected').siblings().removeClass('tr-selected');
  });
});

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
                    let monto_cierre = value.monto_cierre == null || value.monto_cierre == '' ? '-' : value.monto_cierre;
                    let ingreso_zeta = value.ingreso_zeta == null || value.monto_cierre == '' ? '-' : value.ingreso_zeta;
                    let declara_origen = value.declara_origen == null || value.monto_cierre == '' ? '-' : value.declara_origen;
                    let naviera = value.naviera == null || value.monto_cierre == '' ? '-' : value.naviera;
                    let proveedor = value.proveedor == null || value.proveedor == '' ? '-' : value.proveedor;
                    let tipo_moneda = value.tipo_moneda == null || value.tipo_moneda == '' ? '-' : value.tipo_moneda;
                    let lugar_arribo = value.lugar_arribo == null || value.lugar_arribo == '' ? '-' : value.lugar_arribo;




                    $('#tabla-administracion-cuerpo').append(`
                      <tr>
                      <td class="administrar-detalle" data-id_camion="${value.id_camion}" data-estado="${estado}">${value.id_camion}</td>
                      <td class="administrar-detalle" data-id_camion="${value.id_camion}" data-estado="${estado}">${value.codigo}</td>
                      <td class="administrar-detalle" data-id_camion="${value.id_camion}" data-estado="${estado}">${value.estado}</td>
                      <td class="administrar-detalle" data-id_camion="${value.id_camion}" data-estado="${estado}">${value.codigo_aux}</td>
                      <td class="administrar-detalle" data-id_camion="${value.id_camion}" data-estado="${estado}">${value.descripcion}</td>
                      <td class="administrar-detalle" data-id_camion="${value.id_camion}" data-estado="${estado}">${dateUTC(value.fecha_cierre)}</td>
                      <td class="administrar-detalle" data-id_camion="${value.id_camion}" data-estado="${estado}">${proveedor}</td>
                      <td>
                          <a class="btn btn-50 blue">
                            <i class="material-icons detalle-camion"
                              data-monto_cierre="${monto_cierre}"
                              data-tipo_moneda="${tipo_moneda}"
                              data-fecha_embarque="${dateUTC(value.fecha_embarque)}"
                              data-fecha_llegada_estimada="${dateUTC(value.fecha_llegada_estimada)}"
                              data-lugar_arribo="${lugar_arribo}"
                              data-declara_origen="${declara_origen}"
                              data-ingreso_zeta="${ingreso_zeta}"
                              data-naviera="${naviera}" >
                            expand_more</i>
                          </a>
                      </td>
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
      console.log(estado);

      $('#tabla-administracion-cuerpo').empty();
      if ( $.trim(clasificacion) != '') {
          $.get('administrar-tabla-estado',{clasificacion:clasificacion,estado:estado},function(res){
              if (res.camiones != '') {
                    $.each(res.camiones,function(index,value){
                      let monto_cierre = value.monto_cierre == null ? '-' : value.monto_cierre;
                      let ingreso_zeta = value.ingreso_zeta == null ? '-' : value.ingreso_zeta;
                      let declara_origen = value.declara_origen == '' ? '-' : value.declara_origen;
                      let naviera = value.naviera == null ? '-' : value.naviera;
                      let proveedor = value.proveedor == null || value.proveedor == '' ? '-' : value.proveedor;
                      let tipo_moneda = value.tipo_moneda == null || value.tipo_moneda == '' ? '-' : value.tipo_moneda;
                      let lugar_arribo = value.lugar_arribo == null || value.lugar_arribo == '' ? '-' : value.lugar_arribo;

                      $('#tabla-administracion-cuerpo').append(`
                        <tr>
                        <td class="administrar-detalle" data-id_camion="${value.id_camion}" data-estado="${estado}">${value.id_camion}</td>
                        <td class="administrar-detalle" data-id_camion="${value.id_camion}" data-estado="${estado}">${value.codigo}</td>
                        <td class="administrar-detalle" data-id_camion="${value.id_camion}" data-estado="${estado}">${value.estado}</td>
                        <td class="administrar-detalle" data-id_camion="${value.id_camion}" data-estado="${estado}">${value.codigo_aux}</td>
                        <td class="administrar-detalle" data-id_camion="${value.id_camion}" data-estado="${estado}">${value.descripcion}</td>
                        <td class="administrar-detalle" data-id_camion="${value.id_camion}" data-estado="${estado}">${dateUTC(value.fecha_cierre)}</td>
                        <td class="administrar-detalle" data-id_camion="${value.id_camion}" data-estado="${estado}">${proveedor}</td>
                        <td>
                            <a class="btn btn-50 blue">
                              <i class="material-icons detalle-camion"
                                data-monto_cierre="${monto_cierre}"
                                data-tipo_moneda="${tipo_moneda}"
                                data-fecha_embarque="${dateUTC(value.fecha_embarque)}"
                                data-fecha_llegada_estimada="${dateUTC(value.fecha_llegada_estimada)}"
                                data-lugar_arribo="${lugar_arribo}"
                                data-declara_origen="${declara_origen}"
                                data-ingreso_zeta="${ingreso_zeta}"
                                data-naviera="${naviera}" >
                              expand_more</i>
                            </a>
                        </td>
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
                    let proveedor = value.proveedor == null || value.proveedor == '' ? '-' : value.proveedor;
                    let tipo_moneda = value.tipo_moneda == null || value.tipo_moneda == '' ? '-' : value.tipo_moneda;
                    let lugar_arribo = value.lugar_arribo == null || value.lugar_arribo == '' ? '-' : value.lugar_arribo;

                    let id_camion = value.id_camion == '' ? '-' : value.id_camion;
                    let codigo = value.codigo == null ? '-' : value.codigo;
                    let estado = value.estado == null || value.estado == '' ? '-' : value.estado;
                    let codigo_aux = value.codigo_aux == null || value.codigo_aux == '' ? '-' : value.codigo_aux;
                    let descripcion = value.descripcion == null || value.descripcion == '' ? '-' : value.descripcion;

                    $('#tabla-administracion-cuerpo').append(`
                      <tr >

                        <td data-id_camion="${value.id_camion}" data-estado="${value.estado}" class="administrar-detalle">${id_camion}</td>
                        <td data-id_camion="${value.id_camion}" data-estado="${value.estado}" class="administrar-detalle">${codigo}</td>
                        <td data-id_camion="${value.id_camion}" data-estado="${value.estado}" class="administrar-detalle">${estado}</td>
                        <td data-id_camion="${value.id_camion}" data-estado="${value.estado}" class="administrar-detalle">${codigo_aux}</td>
                        <td data-id_camion="${value.id_camion}" data-estado="${value.estado}" class="administrar-detalle">${descripcion}</td>
                        <td data-id_camion="${value.id_camion}" data-estado="${value.estado}" class="administrar-detalle">${dateUTC(value.fecha_cierre)}</td>
                        <td data-id_camion="${value.id_camion}" data-estado="${value.estado}" class="administrar-detalle">${proveedor}</td>

                        <td>
                            <a class="btn btn-50 blue">
                              <i class="material-icons detalle-camion"
                                data-monto_cierre="${monto_cierre}"
                                data-tipo_moneda="${tipo_moneda}"
                                data-fecha_embarque="${dateUTC(value.fecha_embarque)}"
                                data-fecha_llegada_estimada="${dateUTC(value.fecha_llegada_estimada)}"
                                data-lugar_arribo="${lugar_arribo}"
                                data-declara_origen="${declara_origen}"
                                data-ingreso_zeta="${ingreso_zeta}"
                                data-naviera="${naviera}" >
                              expand_more</i>
                            </a>
                        </td>

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
          alerta('info','Debes ingresar un código de camión');
       }
   });


   $('#tabla-administracion-cuerpo').on('click','.administrar-detalle',function(){
          let id_camion,estado;

          let elem = $('.tabs')
          let instance = M.Tabs.getInstance(elem);
          instance.select('test2');
          // 
          // let elem = $('.tablinks')
          // let instance = M.Tabs.getInstance(elem);
          // instance.select('uno2');



          $('#tabla-camionesContenedorDetalle-body').empty();
          $('#tabla-itemsContenedorDetalle-body').empty();
          $('#tabla-camionesBultoDetalle-body').empty();
          $('#tabla-camionesAdjuntoDetalle-body').empty();
          $('#tabla-camionesAutorizacionDetalle-body').empty();

          id_camion = $(this).attr('data-id_camion');
          estado = $(this).attr('data-estado');

          console.log(id_camion);
          console.log(estado);

          if (estado == '1') {
              $('.activo').prop("disabled", false);
              $('.accion').show();
          } else {
              $('.activo').prop("disabled", true);
              $('.accion').hide();
          }

          $.get('detalle-administrar-camion',{id_camion:id_camion},function(res){

                let clasif_mercancia = res.camionesDetalle[0]['clasif_mercancia'] == null || res.camionesDetalle[0]['clasif_mercancia'] == '' ? '0' : res.camionesDetalle[0]['clasif_mercancia'];
                let tipo_unidades    = res.camionesDetalle[0]['tipo_unidades'] == null || res.camionesDetalle[0]['tipo_unidades'] == '' ? '0' : res.camionesDetalle[0]['tipo_unidades'];
                let tipo_moneda    = res.camionesDetalle[0]['tipo_moneda'] == null || res.camionesDetalle[0]['tipo_moneda'] == '' ? '0' : res.camionesDetalle[0]['tipo_moneda'];
                let forma_pago    = res.camionesDetalle[0]['forma_pago'] == null || res.camionesDetalle[0]['forma_pago'] == '' ? '0' : res.camionesDetalle[0]['forma_pago'];
                let despues_dias    = res.camionesDetalle[0]['despues_dias'] == null || res.camionesDetalle[0]['despues_dias'] == '' ? '0' : res.camionesDetalle[0]['despues_dias'];
                let despues_fecha    = res.camionesDetalle[0]['despues_fecha'] == null || res.camionesDetalle[0]['despues_fecha'] == '' ? '0' : res.camionesDetalle[0]['despues_fecha'];
                let lugar_arribo    = res.camionesDetalle[0]['lugar_arribo'] == null || res.camionesDetalle[0]['lugar_arribo'] == '' ? '0' : res.camionesDetalle[0]['lugar_arribo'];

                $("#id_codigo_detalle").val(res.camionesDetalle[0]['id_camion']);
                $("#codigo_detalle").val(res.camionesDetalle[0]['codigo']);
                $("#codigo_aux").val(res.camionesDetalle[0]['codigo_aux']);
                $("#estado_detalle").val(res.camionesDetalle[0]['estado']);
                $("#descripcion").val(res.camionesDetalle[0]['descripcion']);
                $("#contenido").val(res.camionesDetalle[0]['contenido']);
                $("#observaciones").val(res.camionesDetalle[0]['observaciones']);
                $("#proveedor").val(res.camionesDetalle[0]['proveedor']);
                $("#marca_origen").val(res.camionesDetalle[0]['marca_origen']);
                $("#clasif_mercancia").val(clasif_mercancia);
                $("#fecha_cierre").val(dateUTCR(res.camionesDetalle[0]['fecha_cierre']));
                $("#cantidad_unidades").val(res.camionesDetalle[0]['cantidad_unidades']);
                $("#tipo_unidades").val(tipo_unidades);
                $("#monto_unitario").val(res.camionesDetalle[0]['monto_unitario']);
                $("#monto_cierre").val(res.camionesDetalle[0]['monto_cierre']);
                $("#tipo_moneda").val(tipo_moneda);
                $("#forma_pago").val(forma_pago);
                $("#despues_dias").val(despues_dias);
                $("#despues_fecha").val(despues_fecha);
                $("#lugar_arribo").val(lugar_arribo);
                $("#fecha_embarque1").val(dateUTCR(res.camionesDetalle[0]['fecha_embarque1']));
                $("#fecha_embarque2").val(dateUTCR(res.camionesDetalle[0]['fecha_embarque2']));
                $("#fecha_llegada1").val(dateUTCR(res.camionesDetalle[0]['fecha_llegada1']));
                $("#fecha_llegada2").val(dateUTCR(res.camionesDetalle[0]['fecha_llegada2']));
                $("#fecha_produccion").val(dateUTCR(res.camionesDetalle[0]['fecha_produccion']));
                $("#fecha_produccion2").val(dateUTCR(res.camionesDetalle[0]['fecha_produccion2']));
                $("#fecha_vencimiento").val(dateUTCR(res.camionesDetalle[0]['fecha_vencimiento']));
                $("#fecha_vencimiento2").val(dateUTCR(res.camionesDetalle[0]['fecha_vencimiento2']));
                $("#observacion_fecha").val(res.camionesDetalle[0]['observacion_fecha']);

          //Logistica

                $("#id_codigo_logistica").val(res.camionesDetalle[0]['id_camion']);
                $("#id_logistica").val(res.camionesDetalle[0]['id_camion']);
                $("#codigo_logistica").val(res.camionesDetalle[0]['codigo']);
                $("#fecha_cierre_logistica").val(dateUTCR(res.camionesDetalle[0]['fecha_cierre']));
                $("#fecha_embarque").val(dateUTCR(res.camionesDetalle[0]['fecha_embarque']));
                $("#fecha_declaracion").val(dateUTCR(res.camionesDetalle[0]['fecha_declaracion']));
                $("#fecha_transbordo").val(dateUTCR(res.camionesDetalle[0]['fecha_transbordo']));
                $("#fecha_llegada_estimada").val(dateUTCR(res.camionesDetalle[0]['fecha_llegada_estimada']));
                $("#fecha_llegada").val(dateUTCR(res.camionesDetalle[0]['fecha_llegada']));
                $("#fecha_descarga").val(dateUTCR(res.camionesDetalle[0]['fecha_descarga']));
                $("#fecha_devolucion_contenedor").val(dateUTCR(res.camionesDetalle[0]['fecha_devolucion_contenedor']));
                $("#fecha_cumplimiento").val(dateUTCR(res.camionesDetalle[0]['fecha_cumplimiento']));
                $("#fecha_finalizacion").val(dateUTCR(res.camionesDetalle[0]['fecha_finalizacion']));

            //Datos tecnicos


            let naviera = res.camionesDetalle[0]['naviera'] == null || res.camionesDetalle[0]['naviera'] == '' ? '0' : res.camionesDetalle[0]['naviera'];
            let agencia = res.camionesDetalle[0]['agencia'] == null || res.camionesDetalle[0]['agencia'] == '' ? '0' : res.camionesDetalle[0]['agencia'];

            let declara_tramite = res.camionesDetalle[0]['declara_tramite'] == null || res.camionesDetalle[0]['declara_tramite'] == '' ? '0' : res.camionesDetalle[0]['declara_tramite'];
            let declara_origen = res.camionesDetalle[0]['declara_origen'] == null || res.camionesDetalle[0]['declara_origen'] == '' ? '0' : res.camionesDetalle[0]['declara_origen'];
            let declara_zona_ext = res.camionesDetalle[0]['declara_zona_ext'] == null || res.camionesDetalle[0]['declara_zona_ext'] == '' ? '0' : res.camionesDetalle[0]['declara_zona_ext'];
            let declara_zona_exp = res.camionesDetalle[0]['declara_zona_exp'] == null || res.camionesDetalle[0]['declara_zona_exp'] == '' ? '0' : res.camionesDetalle[0]['declara_zona_exp'];
            let declara_zona_franca = res.camionesDetalle[0]['declara_zona_franca'] == null || res.camionesDetalle[0]['declara_zona_franca'] == '' ? '0' : res.camionesDetalle[0]['declara_zona_franca'];

            let declara_region = res.camionesDetalle[0]['declara_region'] == null || res.camionesDetalle[0]['declara_region'] == '' ? '0' : res.camionesDetalle[0]['declara_region'];
            let declara_tipo_transp = res.camionesDetalle[0]['declara_tipo_transp'] == null || res.camionesDetalle[0]['declara_tipo_transp'] == '' ? '0' : res.camionesDetalle[0]['declara_tipo_transp'];
            let declara_trasb_ext = res.camionesDetalle[0]['declara_trasb_ext'] == null || res.camionesDetalle[0]['declara_trasb_ext'] == '' ? '0' : res.camionesDetalle[0]['declara_trasb_ext'];
            let declara_trasb_nal = res.camionesDetalle[0]['declara_trasb_nal'] == null || res.camionesDetalle[0]['declara_trasb_nal'] == '' ? '0' : res.camionesDetalle[0]['declara_trasb_nal'];

            let declara_clausula = res.camionesDetalle[0]['declara_clausula'] == null || res.camionesDetalle[0]['declara_clausula'] == '' ? '0' : res.camionesDetalle[0]['declara_clausula'];
            let sucursal = res.camionesDetalle[0]['sucursal'] == null || res.camionesDetalle[0]['sucursal'] == '' ? '0' : res.camionesDetalle[0]['sucursal'];

                $("#id_codigo_tecnico").val(res.camionesDetalle[0]['id_camion']);
                $("#naviera").val(naviera);
                $("#agencia").val(agencia);
                $("#transporte_nombre").val(res.camionesDetalle[0]['transporte_nombre']);
                $("#ingreso_zeta").val(res.camionesDetalle[0]['ingreso_zeta']);
                $("#ingreso_zeta_fecha").val(dateUTCR(res.camionesDetalle[0]['ingreso_zeta_fecha']));
                $("#declara_tramite").val(declara_tramite);
                $("#declara_origen").val(declara_origen);
                $("#declara_zona_ext").val(declara_zona_ext);
                $("#declara_zona_exp").val(declara_zona_exp);
                $("#declara_zona_franca").val(declara_zona_franca);
                $("#declara_region").val(declara_region);
                $("#declara_tipo_transp").val(declara_tipo_transp);
                $("#declara_pais_origen").val(res.camionesDetalle[0]['declara_pais_origen']);
                $("#declara_pais_procedencia").val(res.camionesDetalle[0]['declara_pais_procedencia']);
                $("#declara_puerto_embarque").val(res.camionesDetalle[0]['declara_puerto_embarque']);
                $("#declara_trasb_ext").val(declara_trasb_ext);
                $("#declara_trasb_nal").val(declara_trasb_nal);
                $("#declara_almacen").val(res.camionesDetalle[0]['declara_almacen']);
                $("#declara_almacen_ubic").val(res.camionesDetalle[0]['declara_almacen_ubic']);
                $("#declara_clausula").val(declara_clausula);
                $("#valor_flete").val(res.camionesDetalle[0]['valor_flete']);
                $("#valor_seguro").val(res.camionesDetalle[0]['valor_seguro']);
                $("#valor_fob").val(res.camionesDetalle[0]['valor_fob']);
                $("#valor_total").val(res.camionesDetalle[0]['valor_total']);
                $("#valor_total_nal").val(res.camionesDetalle[0]['valor_total_nal']);
                $("#sucursal").val(sucursal);
            //Referencias
                  $.each(res.camionesAutorizacionDetalle,function(index,value){
                    $('#tabla-camionesAutorizacionDetalle-body').append(`
                      <tr >
                      <td>${value.certificado}</td>
                      <td>${value.organismo}</td>
                      <td>${value.tipo}</td>
                      <td>${value.numero_aut}</td>
                      <td>${dateUTC(value.fecha_aut)}</td>
                      <td>${value.glosa}</td>
                      <td>${value.usuario}</td>
                      <td>${dateUTC(value.fecha)}</td>
                      </tr>
                      `);
                  });

                  $.each(res.camionesAdjuntoDetalle,function(index,value){
                    $('#tabla-camionesAdjuntoDetalle-body').append(`
                      <tr >
                      <td>${value.tipo_adjunto}</td>
                      <td>${value.numero_documento}</td>
                      <td>${dateUTC(value.fecha_documento)}</td>
                      <td>${value.emisor}</td>
                      <td>${value.numero_fiscal}</td>
                      <td>${value.usuario}</td>
                      <td>${dateUTC(value.fecha)}</td>
                      </tr>
                      `);
                  });

                  $.each(res.camionesBultoDetalle,function(index,value){
                    $('#tabla-camionesBultoDetalle-body').append(`
                      <tr >
                      <td>${value.tipo}</td>
                      <td>${value.cantidad}</td>
                      <td>${value.peso}</td>
                      <td>${value.descripcion}</td>
                      <td>${value.usuario}</td>
                      <td>${dateUTC(value.fecha)}</td>
                      </tr>
                      `);
                  });

                  $.each(res.camionesContenedorDetalle,function(index,value){
                    $('#tabla-camionesContenedorDetalle-body').append(`
                      <tr >
                      <td>${value.tipo_cont}</td>
                      <td>${value.id_contenedor}</td>
                      <td>${value.cont_obs}</td>
                      <td>${value.usuario}</td>
                      <td>${dateUTC(value.fecha)}</td>
                      </tr>
                      `);
                  });

                  $.each(res.camionesItems,function(index,value){

                    let esp_nombre = value.esp_nombre == null ? '-' : value.esp_nombre;
                    let nro_item = value.nro_item == null ? '-' : value.nro_item;

                    $('#tabla-itemsContenedorDetalle-body').append(`
                      <tr >
                      <td>${nro_item}</td>
                      <td>${esp_nombre}</td>
                      <td>${value.codigo}</td>
                      <td>${value.producto}</td>
                      </tr>
                      `);
                  });
          });
   });

   // $('#uno2').on('submit','#actualizar-datosGenerales',function(){
    $('#actualizar-datosGenerales').on('submit', function(){
        event.preventDefault();

        console.log($(this).serialize());
             request=$.ajax({
               url: 'subir-datosGenerales',
               method:"POST",
               data:$(this).serialize(),
               dataType:"json",
               success:function(res)
               {

                 if (res.success)
                 {
                   sweetalerta('Listo!','Actualizado correctamente','success' );


                 }
              }
             });

             request.done(function( msg ) {

             $( "#log" ).html( msg );
               console.log(msg);
             });

             request.fail(function( jqXHR, textStatus ) {
               console.log(jqXHR.responseText,textStatus);
               alert( "Request failed: " + textStatus + jqXHR.responseText);
             });

   });

   $('#actualizar-datosLogistica').on('submit', function(){
       event.preventDefault();

       // console.log($(this).serialize());
            request=$.ajax({
              url: 'subir-datosLogistica',
              method:"POST",
              data:$(this).serialize(),
              dataType:"json",
              success:function(res)
              {

                if (res.success)
                {
                  sweetalerta('Listo!','Actualizado correctamente','success' );
                }
             }
            });

            request.done(function( msg ) {

            $( "#log" ).html( msg );
              console.log(msg);
            });

            request.fail(function( jqXHR, textStatus ) {
              console.log(jqXHR.responseText,textStatus);
              alert( "Request failed: " + textStatus + jqXHR.responseText);
            });

  });



  $('#actualizar-datosTecnicos').on('submit', function(){
      event.preventDefault();

      console.log($(this).serialize());
           request=$.ajax({
             url: 'subir-datosTecnicos',
             method:"POST",
             data:$(this).serialize(),
             dataType:"json",
             success:function(res)
             {

               if (res.success)
               {
                 sweetalerta('Listo!','Actualizado correctamente','success' );
               }
            }
           });

           request.done(function( msg ) {

           $( "#log" ).html( msg );
             console.log(msg);
           });

           request.fail(function( jqXHR, textStatus ) {
             console.log(jqXHR.responseText,textStatus);
             alert( "Request failed: " + textStatus + jqXHR.responseText);
           });
  });

  $('#agregar-camion').on('click', function(){

      console.log('click !');
      $('#formModal').modal('open');
  });


$('#tabla-administracion-cuerpo').on('click','.detalle-camion',function(){
      console.log('click2 !');

      $('#monto_cierred').val($(this).attr('data-monto_cierre'));
      $('#tipo_monedad').val($(this).attr('data-tipo_moneda'));
      $('#fecha_embarqued').val($(this).attr('data-fecha_embarque'));
      $('#fecha_llegada_estimadad').val($(this).attr('data-fecha_llegada_estimada'));
      $('#lugar_arribod').val($(this).attr('data-lugar_arribo'));
      $('#declara_origend').val($(this).attr('data-declara_origen'));
      $('#ingreso_zetad').val($(this).attr('data-ingreso_zeta'));
      $('#navierad').val($(this).attr('data-naviera'));

      $('#formModal2').modal('open');
  });

  $('#nuevo-camion').on('submit', function(){
      event.preventDefault();

      console.log($(this).serialize());
           request=$.ajax({
             url: 'subir-camion',
             method:"POST",
             data:$(this).serialize(),
             dataType:"json",
             success:function(res)
             {

                if (res.camionAgregar == '0') {
                     sweetalerta('Listo!','Actualizado correctamente','success' );
                } else {
                    alerta('info','El contenedor ya existe, ingrese otro código');
                }

            }
           });

           $('#codigo_agregar').val('');
           $('#auxiliar_agregar').val('');
           $('#descripcion_agregar').val('');
           $('#contenido_agregar').val('');
           $('#documento_agregar').val('');
           $('#fecha_agregar').val('');
           $('#observaciones_agregar').val('');

           request.done(function( msg ) {

           $( "#log" ).html( msg );
             console.log(msg);
           });

           request.fail(function( jqXHR, textStatus ) {
             console.log(jqXHR.responseText,textStatus);
             alert( "Request failed: " + textStatus + jqXHR.responseText);
           });
  });

   function dateUTCR(ms) {
     var ms, fecha,año, mes, dia, hora, minuto, segundo;
     // ms= res.dato_general[0]['fecha_embarque1']+' UTC';

     if ( ms != null) {
       ms = new Date(ms);
       año=ms.getUTCFullYear();
       mes=ms.getUTCMonth()+1;
       dia=ms.getUTCDate();
       hora=ms.getUTCHours()-3;
       minuto=ms.getUTCMinutes();
       segundo=ms.getUTCSeconds();
       fecha= año+'-'+ pad(mes) +'-'+ pad(dia)+'T'+ pad(hora)+':'+ pad(minuto)+':'+ pad(segundo);
       return fecha;
     } else {
       return '';
     }
   }

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

   function sweetalerta(title,text,icon ){
     Swal.fire({
          icon: icon,
          title: title,
          text: text,
          })
   }




});


  $(document).ready(function(){



      $('#anio').on('change', function(){
        var anio_id = $(this).val();

        console.log('');
        if($.trim(anio_id) != ''  ){
              // console.log('consicion 1');
            $.get('select-clasificacion',{anio_id:anio_id},function(res){
             $('#clasificacion').empty();
             // $('#camion').append("<option value=''> Seleccione un camión </option>");
             $.each(res, function(index,value){
               $('#clasificacion').append("<option value='"+ value +"'>"+ value +"</option>");

             })
          });

          // request.done(function( msg ) {
          //   // $( "#log" ).html( msg );
          //   console.log(msg);
          // });
          //
          // request.fail(function( jqXHR, textStatus ) {
          //   console.log(jqXHR.responseText,textStatus);
          //   alert( "Request failed: " + textStatus + jqXHR.responseText);
          // });

        }
        // else{
        //     console.log('condicion 2');
        // }
      });

      $('#anior').on('change', function(){
        var anio_id = $(this).val();

        // console.log(anio_id);
        if($.trim(anio_id) != ''  ){
              // console.log('consicion 1');
            $.get('select-clasificacion',{anio_id:anio_id},function(res){
             $('#clasificacionr').empty();
             // $('#camion').append("<option value=''> Seleccione un camión </option>");
             $.each(res, function(index,value){
               $('#clasificacionr').append("<option value='"+ value +"'>"+ value +"</option>");

             })
          });

          // request.done(function( msg ) {
          //   // $( "#log" ).html( msg );
          //   console.log(msg);
          // });
          //
          // request.fail(function( jqXHR, textStatus ) {
          //   console.log(jqXHR.responseText,textStatus);
          //   alert( "Request failed: " + textStatus + jqXHR.responseText);
          // });

        }
        // else{
        //     console.log('condicion 2');
        // }
      });

      $('#clasificacion').on('change', function(){
        var clasificacion_id = $(this).val();
        var anio_id = $('#anio').val();

        // console.log(camion_id);
        if($.trim(clasificacion_id) != ''){
            $.get('obtener-camion',{clasificacion_id:clasificacion_id,anio_id:anio_id },function(res){

                $('#camion').empty();
                $('#camion').append("<option value=''> Seleccione un camión </option>");
                // $('#camiontabla').append("<tr><td>aaaaaaaaaaa</td></tr>");
                $.each(res, function(index,value){
                  // $(res).each(function(key,value){
                    // $('#camiontabla').append("<tr><td>"+ value.codigo +"</td><td>"+ value.descripcion+"</td><td>"+ value.cierre_cantidad +"</td><td>"+ value.monto_cierre +"</td><td>"+ value.ingreso_cantidad +"</td></tr>");
                    if (value != 'Camiones no encontrados') {
                      $('#camion').append("<option value='"+ index +"'>"+ value +"</option>");
                    } else {
                      $('#camion').empty();
                      $('#camion').append("<option value=''> Camiones no encontrados </option>");
                    }
                });

          });


          // request.done(function( msg ) {
          //   // $( "#log" ).html( msg );
          //   console.log(msg);
          // });
          //
          // request.fail(function( jqXHR, textStatus ) {
          //   console.log(jqXHR.responseText,textStatus);
          //   alert( "Request failed: " + textStatus + jqXHR.responseText);
          // });
        }
      });

      $('#clasificacionr').on('change', function(){
        var clasificacion_id = $(this).val();
        var anio_id = $('#anior').val();
        if($.trim(clasificacion_id) != ''){
            $.get('obtener-camion-r',{clasificacion_id:clasificacion_id,anio_id:anio_id},function(res){

                $('#camion').empty();
                $('#camion').append("<option value=''> Seleccione un camión </option>");
                // $('#camiontabla').append("<tr><td>aaaaaaaaaaa</td></tr>");
                $.each(res, function(index,value){
                  // $(res).each(function(key,value){
                    // $('#camiontabla').append("<tr><td>"+ value.codigo +"</td><td>"+ value.descripcion+"</td><td>"+ value.cierre_cantidad +"</td><td>"+ value.monto_cierre +"</td><td>"+ value.ingreso_cantidad +"</td></tr>");
                    if (value != 'Camiones no encontrados') {
                      $('#camion').append("<option value='"+ index +"'>"+ value +"</option>");
                    } else {
                      $('#camion').empty();
                      $('#camion').append("<option value=''> Camiones no encontrados </option>");
                    }
                });

          });


          // request.done(function( msg ) {
          //   // $( "#log" ).html( msg );
          //   console.log(msg);
          // });
          //
          // request.fail(function( jqXHR, textStatus ) {
          //   console.log(jqXHR.responseText,textStatus);
          //   alert( "Request failed: " + textStatus + jqXHR.responseText);
          // });
        }
      });

      $('#camion').on('change', function(){

        var camion_id = $(this).val();
        var valor;
        var action_url, bandera_bloqueo;
          // console.log($("#icamion").val());
          // icamion: es el input que se encuentra encima del select de camion
        if ($('#icamion').val() == 'camion')
        {
            console.log('camion');
            bandera_bloqueo=0;
            action_url = 'tabla-camion';
            valor= '2';
        }
        if ($("#icamion").val() == 'camion-r')
        {
            console.log('camion-r');
            bandera_bloqueo=1;
            action_url = 'tabla-camion-r';
            valor= '2';
        }


        // console.log(camion_id);
        if($.trim(camion_id) != ''){
            $.get(action_url,{camion_id:camion_id },function(res){
              // console.log(res.documento);
              $('#bloquear-camion').empty();
              $('#form_result_consulta1').empty();
              $('#form_result_consulta2').empty();
              $('#form_result_consulta4').empty();
              $('#form_result_consulta5').empty();
              $('#camiontabla-head').empty();
             $('#camiontabla').empty();

            var bi=0;

            var ci=0;

            var mm=0;
            // value.cantidad_diferencia
            var tf=0;
            // value.total_compra
            var tcf=0;
            // value.total_costo
            // var co = 'class="editar-gestion btn btn-warning btn-sm"';
            // console.log(co);


            if (bandera_bloqueo=="1") {
              $('#bloquear-camion').append('<label for="" class="pt-0">Bloquear camión</label><label class="custom-toggle custom-toggle-default"> <input type="checkbox" checked  id="change-bloqueo-camion" value="2"><span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span></label>');
               $('#camiontabla-head').append('<tr><th >Bloqueo</th><th>Nro</th><th>Cod.</th><th>Producto</th><th >Cantidad cierre</th><th>Bultos ingreso</th><th >Cantidad ingreso</th><th >(+/-)</th><th >C.I.F</th><th >V.I.U</th><th >C.I.F(MN)</th><th >Precio_Compra(MN)</th><th >Total factura</th><th>Gastos(MN)</th><th >CIF tierra(MN)</th><th >Total_Costo_Final</th>');
            } else {
               $('#camiontabla-head').append('<tr><th >Acción</th><th >Nro</th><th >Cod.</th><th >Producto</th><th >Cantidad cierre</th><th >Bultos ingreso</th><th >Cantidad ingreso</th><th >(+/-)</th><th >C.I.F</th><th >V.I.U</th><th >C.I.F(MN)</th><th >Precio_Compra(MN)</th><th >Total factura</th><th >Gastos(MN)</th><th >CIF tierra(MN)</th><th >Total_Costo_Final</th>');
            }
             $.each(res.documento, function(index,value){

               if (bandera_bloqueo=="1") {
                       //camion que ya llego

                       if (value.bloqueo_2 == '1' ) {
                         $('#camiontabla').append("<tr>"+'<td> <label class="custom-toggle custom-toggle-default"> <input class="btn-switch" type="checkbox"  checked> <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span> </label> </td><td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ value.cantidad_cierre +"</td><td>"+ value.bultos_ingreso +" </td><td>"+ value.cantidad_ingreso +"</td><td>"+ value.cantidad_diferencia +"</td><td>"+ value.cif_moneda_ext +"</td><td>"+ value.viu_moneda_nal +"</td><td>"+ value.cif_moneda_nal +"</td><td>"+ value.precio_compra +"</td><td>"+ value.total_compra +"</td><td>"+ value.cif_adicional_nal +"</td><td>"+ value.cif_final_nal +"</td><td>"+ value.total_costo +"</td></tr>");

                       } else {
                         $('#camiontabla').append("<tr>"+'<td> <label class="custom-toggle custom-toggle-default"> <input class="btn-switch" type="checkbox"  > <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span> </label> </td><td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ value.cantidad_cierre +"</td><td>"+ value.bultos_ingreso +" </td><td>"+ value.cantidad_ingreso +"</td><td>"+ value.cantidad_diferencia +"</td><td>"+ value.cif_moneda_ext +"</td><td>"+ value.viu_moneda_nal +"</td><td>"+ value.cif_moneda_nal +"</td><td>"+ value.precio_compra +"</td><td>"+ value.total_compra +"</td><td>"+ value.cif_adicional_nal +"</td><td>"+ value.cif_final_nal +"</td><td>"+ value.total_costo +"</td></tr>");
                       }
                       bi+=parseFloat(value.bultos_ingreso);
                       ci+=parseFloat(value.cantidad_ingreso);
                       mm+=parseFloat(value.cantidad_diferencia);
                       tf+=parseFloat(value.total_compra);
                       tcf+= parseFloat(value.total_costo);

                }
                else
                {

                    $('#camiontabla').append("<tr>"+'<td> <button type="button" value="'+valor+'" class="editar-gestion waves-effect waves-light  btn">Editar</button></td><td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ value.cantidad_cierre +"</td><td>"+ value.bultos_ingreso +" </td><td>"+ value.cantidad_ingreso +"</td><td>"+ value.cantidad_diferencia +"</td><td>"+ value.cif_moneda_ext +"</td><td>"+ value.viu_moneda_nal +"</td><td>"+ value.cif_moneda_nal +"</td><td>"+ value.precio_compra +"</td><td>"+ value.total_compra +"</td><td>"+ value.cif_adicional_nal +"</td><td>"+ value.cif_final_nal +"</td><td>"+ value.total_costo +"</td></tr>");


                    bi+=parseFloat(value.bultos_ingreso);
                    ci+=parseFloat(value.cantidad_ingreso);
                    mm+=parseFloat(value.cantidad_diferencia);
                    tf+=parseFloat(value.total_compra);
                    tcf+= parseFloat(value.total_costo);

                }
              });
              $('#camiontabla').append("<tr>"+'<td>  </td>'+"<td></td><td></td><td></td><td></td><td>"+bi+" </td><td>"+ci+" </td><td>"+mm+"</td><td></td><td></td><td></td><td></td><td>"+tf+"</td><td></td><td></td><td>"+tcf+"</td></tr>");
              // $('#form_result').empty();
              $('#codigo_oficial').val(res.dato_general[0]['codigo']);
              $('#codigo_oficial_real').val(res.dato_general[0]['codigo']);
              $('#codigo_auxiliar').val(res.dato_general[0]['codigo_aux']);
              $('#nro_de_contenedor').val(res.dato_general[0]['doc_contenedor']);
              $('#nro_bl').val(res.dato_general[0]['doc_bl']);
              $('#pais_origen').val(res.dato_general[0]['pais_origen']);
              $('#descripcion').val(res.dato_general[0]['descripcion']);
              $('#contenido').val(res.dato_general[0]['contenido']);
              $('#observaciones').val(res.dato_general[0]['observaciones']);
              $('#bandera-general').append('<input type="hidden" id="subbandera"  value="2">');

              $('#codigo_oficial_real2').val(res.dato_general[0]['codigo']);
              $('#fecha_de_cierre').val(dateUTC(res.dato_general[0]['fecha_cierre']));
                console.log('sin UTC');
                console.log(res.dato_general[0]['fecha_cierre']);
              $('#fecha_de_embarque_desde').val(dateUTC(res.dato_general[0]['fecha_embarque1']));
                console.log('CON utc 2');
                console.log(dateUTC(res.dato_general[0]['fecha_embarque1']));
                console.log('sin utc 2');
                console.log(res.dato_general[0]['fecha_embarque1']);

              $('#fecha_de_embarque_desde_hasta').val(dateUTC(res.dato_general[0]['fecha_embarque2']));
              $('#fecha_de_llegada_desde').val(dateUTC(res.dato_general[0]['fecha_llegada1']));
              $('#fecha_de_llegada_desde_hasta').val(dateUTC(res.dato_general[0]['fecha_llegada2']));
              $('#observacion').val(res.dato_general[0]['observacion_fecha']);



              $('#a_cumplirse_a').val(res.dato_general[0]['despues_dias']);
              $('#a_cumplirse_a-').val(res.dato_general[0]['despues_fecha']);

              $('#codigo_oficial_real4').val(res.dato_general[0]['codigo']);
              $('#fecha_de_embarque_real').val(dateUTC(res.dato_general[0]['fecha_embarque']));
              $('#fecha_de_llegada').val(dateUTC(res.dato_general[0]['fecha_llegada']));
              $('#resol_sanitaria').val(res.dato_general[0]['resolucion_sanitaria']);
              // console.log('pruebaaaa');
              // console.log(res.dato_general[0]['fecha_resolucion']);
              $('#fecha_de_resol_sanitaria').val(dateUTC(res.dato_general[0]['fecha_resolucion']));
              $('#forward').val(res.dato_general[0]['forward']);
              $('#fecha_forward').val(dateUTC(res.dato_general[0]['forward_fecha']));
              $('#fecha_producción_desde').val(dateUTC(res.dato_general[0]['fecha_produccion']));
              $('#fecha_producción_desde_hasta').val(dateUTC(res.dato_general[0]['fecha_produccion2']));
              $('#fecha_vencimiento_desde').val(dateUTC(res.dato_general[0]['fecha_vencimiento']));
              $('#fecha_vencimiento_desde_hasta').val(dateUTC(res.dato_general[0]['fecha_vencimiento2']));


              $('#codigo_oficial_real5').val(res.dato_general[0]['codigo']);
              $('#factura_proveedor').val(res.dato_general[0]['factura_nro']);
              $('#cantidad_recibida').val(res.dato_general[0]['cantidad_unidades']);
              $('#valor_total').val(res.dato_general[0]['valor_total']);
              // console.log('abajoooo para formulario');
              // console.log(res.dato_general[0]['codigo']);

              // $('#clasificacion_de_mercancia').append("<option value=''> Seleccione un camión </option>");
              // $('#camiontabla').append("<tr><td>aaaaaaaaaaa</td></tr>");
              $('#clasificacion_de_mercancia').empty();
              $.each(res.clasificaciones_camion, function(index,value){
                    $('#clasificacion_de_mercancia').append("<option value='"+ value['cod_int'] +"'>"+value['desc01']+"</option>");
              });
              $('#clasificacion_de_mercancia').val(res.dato_general[0]['clasif_mercancia']);

              $('#proveedor').empty();
              $.each(res.proveedor_camion, function(index,value){
                    $('#proveedor').append("<option value='"+ value['id_proveedor'] +"'>"+value['emp_nombre']+"</option>");
              });
              $('#proveedor').val(res.dato_general[0]['proveedor']);


              $('#marca_origen').empty();
              $.each(res.marca_origen, function(index,value){
                    $('#marca_origen').append("<option value='"+ value['MARC_CODIGO'] +"'>"+value['MARC_DESCRIPCION']+"</option>");
              });
              $('#marca_origen').val(res.dato_general[0]['marca_origen']);

              $('#lugar_de_arribo').empty();
              $.each(res.lugar_de_arribo, function(index,value){
                    $('#lugar_de_arribo').append("<option value='"+ value['ciudad_codigo'] +"'>"+value['descripcion']+"</option>");
              });
              $('#lugar_de_arribo').val(res.dato_general[0]['lugar_arribo']);

              $('#forma_de_pago').empty();
              $.each(res.forma_pago, function(index,value){
                // console.log(value);
                    $('#forma_de_pago').append("<option value='"+ value['FRPG_CODIGO'] +"'>"+value['FRPG_DESCRIPCION']+"</option>");
              });
              $('#forma_de_pago').val(res.dato_general[0]['forma_pago']);

              $('#unidad').empty();
              $.each(res.unidad, function(index,value){
                    $('#unidad').append("<option value='"+ value['TUME_CODIGO'] +"'>"+value['TUME_DESCR']+"</option>");
              });
              $('#unidad').val(res.dato_general[0]['tipo_unidades']);

              $('#tipo_de_moneda').empty();
              $.each(res.tipo_moneda, function(index,value){
                    $('#tipo_de_moneda').append("<option value='"+ value['TMDA_CODIGO'] +"'>"+value['TMDA_DESCRIPCION']+"</option>");
              });
              $('#tipo_de_moneda').val(res.dato_general[0]['tipo_moneda']);

          });


          // setTimeout(function(){ alert("Hello"); }, 9000);
        }


      });


// ---------------------------------------------------------
      $('#camionr').on('change', function(){
        var camion_id = $(this).val();

        // console.log(camion_id);
        if($.trim(camion_id) != ''){
            $.get('tabla-camion-r',{camion_id:camion_id },function(res){
            $('#bloquear-camion').empty();
            $('#camiontabla').empty();
            var bi=0;

            var ci=0;

            var mm=0;
            // value.cantidad_diferencia
            var tf=0;
            // value.total_compra
            var tcf=0;
            // value.total_costo
            $('#bloquear-camion').append('<label for="" class="pt-0">Bloquear camión</label><label class="custom-toggle custom-toggle-default"> <input type="checkbox" checked  id="change-bloqueo-camion" value="3"><span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span></label>');
             $.each(res, function(index,value){

               if (value.bloqueo_2 == '1' ) {
                 $('#camiontabla').append("<tr>"+'<td> <label class="custom-toggle custom-toggle-default"> <input class="btn-switch" type="checkbox"  checked> <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span> </label> </td>'+'<td> <button type="button" value="{{$item->nro_item}}" class="editar-gestion btn btn-warning btn-sm">Editar</button></td><td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ value.cantidad_cierre +"</td><td>"+ value.bultos_ingreso +" </td><td>"+ value.cantidad_ingreso +"</td><td>"+ value.cantidad_diferencia +"</td><td>"+ value.cif_moneda_ext +"</td><td>"+ value.viu_moneda_nal +"</td><td>"+ value.cif_moneda_nal +"</td><td>"+ value.precio_compra +"</td><td>"+ value.total_compra +"</td><td>"+ value.cif_adicional_nal +"</td><td>"+ value.cif_final_nal +"</td><td>"+ value.total_costo +"</td></tr>");

               } else {
                 $('#camiontabla').append("<tr>"+'<td> <label class="custom-toggle custom-toggle-default"> <input class="btn-switch" type="checkbox"  > <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span> </label> </td>'+'<td> <button type="button" value="{{$item->nro_item}}" class="editar-gestion btn btn-warning btn-sm">Editar</button></td><td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ value.cantidad_cierre +"</td><td>"+ value.bultos_ingreso +" </td><td>"+ value.cantidad_ingreso +"</td><td>"+ value.cantidad_diferencia +"</td><td>"+ value.cif_moneda_ext +"</td><td>"+ value.viu_moneda_nal +"</td><td>"+ value.cif_moneda_nal +"</td><td>"+ value.precio_compra +"</td><td>"+ value.total_compra +"</td><td>"+ value.cif_adicional_nal +"</td><td>"+ value.cif_final_nal +"</td><td>"+ value.total_costo +"</td></tr>");

               }
                  bi+=parseFloat(value.bultos_ingreso);
                  ci+=parseFloat(value.cantidad_ingreso);
                  mm+=parseFloat(value.cantidad_diferencia);
                  tf+=parseFloat(value.total_compra);
                  tcf+= parseFloat(value.total_costo);
              });
              // tf=parseFloat()+parseFloat();
              $('#camiontabla').append("<tr>"+'<td>  </td>'+"<td></td><td></td><td></td><td></td><td></td><td>"+bi+" </td><td>"+bi+" </td><td>"+mm+"</td><td></td><td></td><td></td><td></td><td>"+tf+"</td><td></td><td></td><td>"+tcf+"</td></tr>");
           });


          // request.done(function( msg ) {
          //   // $( "#log" ).html( msg );
          //   console.log(msg);
          // });
          //
          // request.fail(function( jqXHR, textStatus ) {
          //   console.log(jqXHR.responseText,textStatus);
          //   alert( "Request failed: " + textStatus + jqXHR.responseText);
          // });

        }
      });

// ----------------------------------------------------
      $('#create_record').click(function(){
        // console.log('Se cliqueoooo');
        $('#formModal').modal('show');
      });
// ----------------------------------------------------

$(document).on('submit','#consulta1',function(){
// $('#sample_form').on('submit',function(event){
          event.preventDefault();
          var camion_id;
          var valor;
          // $('#sample_form')[0].reset();
          // $('#form_result').html();

          var action_url = '';
          action_url = 'actualizar-camion-general';

          console.log('linea para la ultima condicion');
          console.log($('#action-producto').val());
          if ($('#subbandera').val() == '2')
          {
            camion_id = $('#camion').val();

            valor= '2';
          }
          else{
            camion_id = $('#buscar-codigo-camion').val();
            valor ='1';
          }
          // if ($('#action').val() == 'Editar')
          // {
          //     action_url = 'actualizar-camion';
          // }

          $.ajax({
            url: action_url,
            method:"POST",
            data:$(this).serialize(),
            dataType:"json",
            success:function(data)
            {
              var html ='';

              if (data.success)
              {

                  html= '<div class="card-alert card green"><div class="card-content white-text">'+ data.success+'</div></div>';

                  if($.trim(camion_id) != ''){
                      $.get('tabla-camion',{camion_id:camion_id },function(res){
                        $('#bloquear-camion').empty();
                        console.log('actualizando tablaaaaa');
                       $('#camiontabla').empty();

                      var bi=0;

                      var ci=0;

                      var mm=0;
                      // value.cantidad_diferencia
                      var tf=0;
                      // value.total_compra
                      var tcf=0;
                      // value.total_costo
                      // var co = 'class="editar-gestion btn btn-warning btn-sm"';
                      // console.log(co);
                      $('#bloquear-camion').append('<label for="" class="pt-0">Bloquear camión</label><label class="custom-toggle custom-toggle-default"> <input type="checkbox" checked  id="change-bloqueo-camion" value="2"><span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span></label>');
                       $.each(res.documento, function(index,value){

                           $('#camiontabla').append("<tr>"+'<td> <button type="button" value="'+valor+'" class="editar-gestion btn btn-warning btn-sm">Editar</button></td><td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ value.cantidad_cierre +"</td><td>"+ value.bultos_ingreso +" </td><td>"+ value.cantidad_ingreso +"</td><td>"+ value.cantidad_diferencia +"</td><td>"+ value.cif_moneda_ext +"</td><td>"+ value.viu_moneda_nal +"</td><td>"+ value.cif_moneda_nal +"</td><td>"+ value.precio_compra +"</td><td>"+ value.total_compra +"</td><td>"+ value.cif_adicional_nal +"</td><td>"+ value.cif_final_nal +"</td><td>"+ value.total_costo +"</td></tr>");


                           bi+=parseFloat(value.bultos_ingreso);
                           ci+=parseFloat(value.cantidad_ingreso);
                           mm+=parseFloat(value.cantidad_diferencia);
                           tf+=parseFloat(value.total_compra);
                           tcf+= parseFloat(value.total_costo);

                        });

                            $('#camiontabla').append("<tr>"+"<td></td><td></td><td></td><td></td><td></td><td>"+bi+" </td><td>"+ci+" </td><td>"+mm+"</td><td></td><td></td><td></td><td></td><td>"+tf+"</td><td></td><td></td><td>"+tcf+"</td></tr>");

                    });
                  }
                  // ------------------------

                  // ------------------------

              }
              setTimeout(function() {
              //   $('div.loader-6').addClass('d-none'); }, 1500);


              $('#form_result_consulta1').html(html);}, 1500);
            }
          });

          // request.done(function( msg ) {
          //
          // $( "#log" ).html( msg );
          //   console.log(msg);
          // });
          //
          // request.fail(function( jqXHR, textStatus ) {
          //   console.log(jqXHR.responseText,textStatus);
          //   alert( "Request failed: " + textStatus + jqXHR.responseText);
          // });


        });

        $(document).on('submit','#consulta2',function(){
        // $('#sample_form').on('submit',function(event){
                  event.preventDefault();
                  var camion_id;
                  var valor ;
                  // $('#sample_form')[0].reset();
                  // $('#form_result').html();

                  var action_url = '';
                  action_url = 'actualizar-camion-fecha';

                  console.log('linea para la ultima condicion');
                  console.log($('#action-producto').val());
                  if ($('#subbandera').val() == '2')
                  {
                    camion_id = $('#camion').val();
                    console.log('val 2');
                    valor= '2';
                  }
                  else{
                    camion_id = $('#buscar-codigo-camion').val();
                    valor ='1';
                    console.log('val 1');
                  }
                  // if ($('#action').val() == 'Editar')
                  // {
                  //     action_url = 'actualizar-camion';
                  // }

                  request=$.ajax({
                    url: action_url,
                    method:"POST",
                    data:$(this).serialize(),
                    dataType:"json",
                    success:function(data)
                    {
                      var html ='';

                      if (data.success)
                      {
                          console.log('exito');
                          html= '<div class="card-alert card green"><div class="card-content white-text">'+ data.success+'</div></div>';

                          if($.trim(camion_id) != ''){
                              $.get('tabla-camion',{camion_id:camion_id },function(res){
                                $('#bloquear-camion').empty();
                                console.log('actualizando tablaaaaa');
                               $('#camiontabla').empty();

                              var bi=0;

                              var ci=0;

                              var mm=0;
                              // value.cantidad_diferencia
                              var tf=0;
                              // value.total_compra
                              var tcf=0;
                              // value.total_costo
                              // var co = 'class="editar-gestion btn btn-warning btn-sm"';
                              // console.log(co);
                              $('#bloquear-camion').append('<label for="" class="pt-0">Bloquear camión</label><label class="custom-toggle custom-toggle-default"> <input type="checkbox" checked  id="change-bloqueo-camion" value="2"><span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span></label>');
                               $.each(res.documento, function(index,value){
                                 $('#camiontabla').append("<tr>"+'<td> <button type="button" value="'+valor+'" class="editar-gestion btn btn-warning btn-sm">Editar</button></td><td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ value.cantidad_cierre +"</td><td>"+ value.bultos_ingreso +" </td><td>"+ value.cantidad_ingreso +"</td><td>"+ value.cantidad_diferencia +"</td><td>"+ value.cif_moneda_ext +"</td><td>"+ value.viu_moneda_nal +"</td><td>"+ value.cif_moneda_nal +"</td><td>"+ value.precio_compra +"</td><td>"+ value.total_compra +"</td><td>"+ value.cif_adicional_nal +"</td><td>"+ value.cif_final_nal +"</td><td>"+ value.total_costo +"</td></tr>");


                                 bi+=parseFloat(value.bultos_ingreso);
                                 ci+=parseFloat(value.cantidad_ingreso);
                                 mm+=parseFloat(value.cantidad_diferencia);
                                 tf+=parseFloat(value.total_compra);
                                 tcf+= parseFloat(value.total_costo);
                                });
                                    $('#camiontabla').append("<tr>"+"<td></td><td></td><td></td><td></td><td></td><td>"+bi+" </td><td>"+ci+" </td><td>"+mm+"</td><td></td><td></td><td></td><td></td><td>"+tf+"</td><td></td><td></td><td>"+tcf+"</td></tr>");
                                   });
                                 }
                          // ------------------------

                          // ------------------------

                      }
                      setTimeout(function() {
                      //   $('div.loader-6').addClass('d-none'); }, 1500);

                      $('#form_result_consulta2').html(html);}, 1500);
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
// --------------------------------
// consulta 3: tiene datos desconocidos
// ------------------------------------------
        $(document).on('submit','#consulta4',function(){
        // $('#sample_form').on('submit',function(event){
          event.preventDefault();
          var camion_id;
          var valor ;
          // $('#sample_form')[0].reset();
          // $('#form_result').html();

          var action_url = '';
          action_url = 'actualizar-camion-embarque';

          console.log('linea para la ultima condicion');
          console.log($('#action-producto').val());
          if ($('#subbandera').val() == '2')
          {
            camion_id = $('#camion').val();

            valor= '2';
          }
          else{
            camion_id = $('#buscar-codigo-camion').val();
            valor ='1';
          }
          // if ($('#action').val() == 'Editar')
          // {
          //     action_url = 'actualizar-camion';
          // }

          request=$.ajax({
            url: action_url,
            method:"POST",
            data:$(this).serialize(),
            dataType:"json",
            success:function(data)
            {
              var html ='';

              if (data.success)
              {
                  html= '<div class="card-alert card green"><div class="card-content white-text">'+ data.success+'</div></div>';

                  if($.trim(camion_id) != ''){
                      $.get('tabla-camion',{camion_id:camion_id },function(res){
                        $('#bloquear-camion').empty();
                        console.log('actualizando tablaaaaa');
                       $('#camiontabla').empty();

                      var bi=0;

                      var ci=0;

                      var mm=0;
                      // value.cantidad_diferencia
                      var tf=0;
                      // value.total_compra
                      var tcf=0;
                      // value.total_costo
                      // var co = 'class="editar-gestion btn btn-warning btn-sm"';
                      // console.log(co);
                      $('#bloquear-camion').append('<label for="" class="pt-0">Bloquear camión</label><label class="custom-toggle custom-toggle-default"> <input type="checkbox" checked  id="change-bloqueo-camion" value="2"><span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span></label>');
                       $.each(res.documento, function(index,value){
                         $('#camiontabla').append("<tr>"+'<td> <button type="button" value="'+valor+'" class="editar-gestion btn btn-warning btn-sm">Editar</button></td><td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ value.cantidad_cierre +"</td><td>"+ value.bultos_ingreso +" </td><td>"+ value.cantidad_ingreso +"</td><td>"+ value.cantidad_diferencia +"</td><td>"+ value.cif_moneda_ext +"</td><td>"+ value.viu_moneda_nal +"</td><td>"+ value.cif_moneda_nal +"</td><td>"+ value.precio_compra +"</td><td>"+ value.total_compra +"</td><td>"+ value.cif_adicional_nal +"</td><td>"+ value.cif_final_nal +"</td><td>"+ value.total_costo +"</td></tr>");


                         bi+=parseFloat(value.bultos_ingreso);
                         ci+=parseFloat(value.cantidad_ingreso);
                         mm+=parseFloat(value.cantidad_diferencia);
                         tf+=parseFloat(value.total_compra);
                         tcf+= parseFloat(value.total_costo);
                        });
                            $('#camiontabla').append("<tr>"+"<td></td><td></td><td></td><td></td><td></td><td>"+bi+" </td><td>"+ci+" </td><td>"+mm+"</td><td></td><td></td><td></td><td></td><td>"+tf+"</td><td></td><td></td><td>"+tcf+"</td></tr>");
                           });
                         }
                  // ------------------------

                  // ------------------------

              }
              setTimeout(function() {
              //   $('div.loader-6').addClass('d-none'); }, 1500);

              $('#form_result_consulta4').html(html);}, 1500);
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

        // ------------------------------------------
                $(document).on('submit','#consulta5',function(){
                // $('#sample_form').on('submit',function(event){
                  event.preventDefault();
                  var camion_id;
                  var valor ;
                  // $('#sample_form')[0].reset();
                  // $('#form_result').html();

                  var action_url = '';
                  action_url = 'actualizar-camion-valor-total';

                  console.log('linea para la ultima condicion');
                  console.log($('#action-producto').val());
                  if ($('#subbandera').val() == '2')
                  {
                    camion_id = $('#camion').val();

                    valor= '2';
                  }
                  else{
                    camion_id = $('#buscar-codigo-camion').val();
                    valor ='1';
                  }
                  // if ($('#action').val() == 'Editar')
                  // {
                  //     action_url = 'actualizar-camion';
                  // }

                  $.ajax({
                    url: action_url,
                    method:"POST",
                    data:$(this).serialize(),
                    dataType:"json",
                    success:function(data)
                    {
                      var html ='';

                      if (data.success)
                      {
                          html= '<div class="card-alert card green"><div class="card-content white-text">'+ data.success+'</div></div>';

                          if($.trim(camion_id) != ''){
                              $.get('tabla-camion',{camion_id:camion_id },function(res){
                                $('#bloquear-camion').empty();
                                console.log('actualizando tablaaaaa');
                               $('#camiontabla').empty();

                              var bi=0;

                              var ci=0;

                              var mm=0;
                              // value.cantidad_diferencia
                              var tf=0;
                              // value.total_compra
                              var tcf=0;
                              // value.total_costo
                              // var co = 'class="editar-gestion btn btn-warning btn-sm"';
                              // console.log(co);
                              $('#bloquear-camion').append('<label for="" class="pt-0">Bloquear camión</label><label class="custom-toggle custom-toggle-default"> <input type="checkbox" checked  id="change-bloqueo-camion" value="2"><span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span></label>');
                               $.each(res.documento, function(index,value){
                                 $('#camiontabla').append("<tr>"+'<td> <button type="button" value="'+valor+'" class="editar-gestion btn btn-warning btn-sm">Editar</button></td><td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ value.cantidad_cierre +"</td><td>"+ value.bultos_ingreso +" </td><td>"+ value.cantidad_ingreso +"</td><td>"+ value.cantidad_diferencia +"</td><td>"+ value.cif_moneda_ext +"</td><td>"+ value.viu_moneda_nal +"</td><td>"+ value.cif_moneda_nal +"</td><td>"+ value.precio_compra +"</td><td>"+ value.total_compra +"</td><td>"+ value.cif_adicional_nal +"</td><td>"+ value.cif_final_nal +"</td><td>"+ value.total_costo +"</td></tr>");


                                 bi+=parseFloat(value.bultos_ingreso);
                                 ci+=parseFloat(value.cantidad_ingreso);
                                 mm+=parseFloat(value.cantidad_diferencia);
                                 tf+=parseFloat(value.total_compra);
                                 tcf+= parseFloat(value.total_costo);
                                });
                                    $('#camiontabla').append("<tr>"+"<td></td><td></td><td></td><td></td><td></td><td>"+bi+" </td><td>"+ci+" </td><td>"+mm+"</td><td></td><td></td><td></td><td></td><td>"+tf+"</td><td></td><td></td><td>"+tcf+"</td></tr>");
                                   });
                                 }
                          // ------------------------

                          // ------------------------

                      }

                      setTimeout(function(){
                          $('#form_result_consulta5').html(html);
                       }, 3000);

                    }
                  });

                  // request.done(function( msg ) {
                  //
                  // $( "#log" ).html( msg );
                  //   console.log(msg);
                  // });
                  //
                  // request.fail(function( jqXHR, textStatus ) {
                  //   console.log(jqXHR.responseText,textStatus);
                  //   alert( "Request failed: " + textStatus + jqXHR.responseText);
                  // });


                });
//------------------------------------------------------
$(document).on('submit','#sample_form',function(){
// $('#sample_form').on('submit',function(event){
          event.preventDefault();
          var camion_id;
          var valor ;
          // $('#sample_form')[0].reset();
          // $('#form_result').html();

          var action_url = '';
          action_url = 'actualizar-camion';
          console.log('lineaaaaaaaaa para la ultima condicion');
          console.log($('#action-producto').val());
          if ($('#action-producto').val() == '1')
          {
              camion_id = $('#buscar-codigo-camion').val();
              valor ='1';
          }
          else{
              camion_id = $('#camion').val();
              valor= '2';
          }
          // if ($('#action').val() == 'Editar')
          // {
          //     action_url = 'actualizar-camion';
          // }

          $.ajax({
            url: action_url,
            method:"POST",
            data:$(this).serialize(),
            dataType:"json",
            success:function(data)
            {
              var html ='';
              if(data.errors)
              {
                html = '<div class="alert alert-danger">';
                for (var count = 0; count < data.errors.length ; count++)
                {
                  html += '<p>'+ data.errors[count] + '</p>'
                }
                html += '</div>'
              }
              if (data.success)
              {

                  html= '<div class="card-alert card green"><div class="card-content white-text">'+ data.success+'</div></div>';
                  // $('#sample_form')[0].reset();

                  // ----------------



                  // console.log(camion_id);
                  if($.trim(camion_id) != ''){

                      $.get('tabla-camion',{camion_id:camion_id },function(res){
                        // $('#bloquear-camion').empty();
                        console.log('actualizando tablaaaaa');
                       $('#camiontabla').empty();
                            $('#camiontabla-head').empty();
                      var bi=0;

                      var ci=0;

                      var mm=0;
                      // value.cantidad_diferencia
                      var tf=0;
                      // value.total_compra
                      var tcf=0;
                      // value.total_costo
                      // var co = 'class="editar-gestion btn btn-warning btn-sm"';
                      // console.log(co);

                      // $('#bloquear-camion').append('<label for="" class="pt-0">Bloquear camión</label><label class="custom-toggle custom-toggle-default"> <input type="checkbox" checked  id="change-bloqueo-camion" value="2"><span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span></label>');

                        $('#camiontabla-head').append('<tr><th scope="col">Acción</th><th scope="col">Nro</th><th scope="col">Cod.</th><th scope="col">Producto</th><th scope="col">Cantidad cierre</th><th scope="col">Bultos ingreso</th><th scope="col">Cantidad ingreso</th><th scope="col">(+/-)</th><th scope="col">C.I.F</th><th scope="col">V.I.U</th><th scope="col">C.I.F(MN)</th><th scope="col">Precio_Compra(MN)</th><th scope="col">Total factura</th><th scope="col">Gastos(MN)</th><th scope="col">CIF tierra(MN)</th><th scope="col">Total_Costo_Final</th>');
                       $.each(res.documento, function(index,value){
                            if (value.bloqueo_2 == '1' ) {
                              $('#camiontabla').append("<tr>"+'<td> <button type="button" value="'+valor+'" class="editar-gestion btn btn-warning btn-sm">Editar</button></td><td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ value.cantidad_cierre +"</td><td>"+ value.bultos_ingreso +" </td><td>"+ value.cantidad_ingreso +"</td><td>"+ value.cantidad_diferencia +"</td><td>"+ value.cif_moneda_ext +"</td><td>"+ value.viu_moneda_nal +"</td><td>"+ value.cif_moneda_nal +"</td><td>"+ value.precio_compra +"</td><td>"+ value.total_compra +"</td><td>"+ value.cif_adicional_nal +"</td><td>"+ value.cif_final_nal +"</td><td>"+ value.total_costo +"</td></tr>");

                            } else {
                              $('#camiontabla').append("<tr>"+'<td> <button type="button" value="'+valor+'" class="editar-gestion btn btn-warning btn-sm">Editar</button></td><td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ value.cantidad_cierre +"</td><td>"+ value.bultos_ingreso +" </td><td>"+ value.cantidad_ingreso +"</td><td>"+ value.cantidad_diferencia +"</td><td>"+ value.cif_moneda_ext +"</td><td>"+ value.viu_moneda_nal +"</td><td>"+ value.cif_moneda_nal +"</td><td>"+ value.precio_compra +"</td><td>"+ value.total_compra +"</td><td>"+ value.cif_adicional_nal +"</td><td>"+ value.cif_final_nal +"</td><td>"+ value.total_costo +"</td></tr>");

                            }

                           bi+=parseFloat(value.bultos_ingreso);
                           ci+=parseFloat(value.cantidad_ingreso);
                            mm+=parseFloat(value.cantidad_diferencia);
                            tf+=parseFloat(value.total_compra);
                            tcf+= parseFloat(value.total_costo);
                        });
                        // tf=parseFloat()+parseFloat();
                           $('#camiontabla').append("<tr>"+'<td>  </td>'+"<td></td><td></td><td></td><td></td><td>"+bi+" </td><td>"+bi+" </td><td>"+mm+"</td><td></td><td></td><td></td><td></td><td>"+tf+"</td><td></td><td></td><td>"+tcf+"</td></tr>");

                           });
                         }
                  // ------------------------

              }
              setTimeout(function() {
                $('#form_result').html(html).fadeOut(1000);
             },3000);

             // setTimeout(function() {
             //     $('#form_result').html(html).fadeIn(3000);
             // },1000);

             // $('#form_result').empty();
              // $('#form_result').html(html).hide(10000);
            }
          });

          // request.done(function( msg ) {
          //
          // $( "#log" ).html( msg );
          //   console.log(msg);
          // });
          //
          // request.fail(function( jqXHR, textStatus ) {
          //   console.log(jqXHR.responseText,textStatus);
          //   alert( "Request failed: " + textStatus + jqXHR.responseText);
          // });


        });
// ----------------------------------------------------------

$('#buscar-camion-r').on('submit',function(event){
  event.preventDefault();
  $('#bloquear-camion').empty();
  // $('#sample_form')[0].reset();
  // $('#form_result').html();

  var action_url = '';

  if ($('#action-buscar-camion').val() == 'buscar-camion')
  {
      action_url = 'ver-camion';
  }
  if ($('#action-buscar-camion').val() == 'buscar-camion-r')
  {
      action_url = 'ver-camion-r';
  }

  $.ajax({
    url: action_url,
    method:"POST",
    data:$(this).serialize(),
    dataType:"json",
    success:function(data)
    {
      var html ='';
      if(data.errors)
      {
        html = '<div class="alert alert-danger">';
        for (var count = 0; count < data.errors.length ; count++)
        {
          html += '<p>'+ data.errors[count] + '</p>'
        }
        html += '</div>'
        // $('#form_result').html(html);  sirve por mientras
        console.log('error');
      }
      else
      {
        $('#camiontabla').empty();
       var bi=0;

       var ci=0;

       var mm=0;
       // value.cantidad_diferencia
       var tf=0;
       // value.total_compra
       var tcf=0;
       // value.total_costo
       // var co = 'class="editar-gestion btn btn-warning btn-sm"';
       // console.log(co);
       $('#bloquear-camion').append('<label for="" class="pt-0">Bloquear camión</label><label class="custom-toggle custom-toggle-default"> <input type="checkbox" checked  id="change-bloqueo-camion" value="1"><span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span></label>');

        $.each(data, function(index,value){
             if (value.bloqueo_2 == '1' ) {
               $('#camiontabla').append("<tr>"+'<td> <label class="custom-toggle custom-toggle-default"> <input class="btn-switch" type="checkbox"  checked> <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span> </label> </td>'+'<td> <button type="button" value="{{$item->nro_item}}" class="editar-gestion btn btn-warning btn-sm">Editar</button></td><td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ value.cantidad_cierre +"</td><td>"+ value.bultos_ingreso +" </td><td>"+ value.cantidad_ingreso +"</td><td>"+ value.cantidad_diferencia +"</td><td>"+ value.cif_moneda_ext +"</td><td>"+ value.viu_moneda_nal +"</td><td>"+ value.cif_moneda_nal +"</td><td>"+ value.precio_compra +"</td><td>"+ value.total_compra +"</td><td>"+ value.cif_adicional_nal +"</td><td>"+ value.cif_final_nal +"</td><td>"+ value.total_costo +"</td></tr>");

             } else {
               $('#camiontabla').append("<tr>"+'<td> <label class="custom-toggle custom-toggle-default"> <input class="btn-switch" type="checkbox"  > <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span> </label> </td>'+'<td> <button type="button" value="{{$item->nro_item}}" class="editar-gestion btn btn-warning btn-sm">Editar</button></td><td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ value.cantidad_cierre +"</td><td>"+ value.bultos_ingreso +" </td><td>"+ value.cantidad_ingreso +"</td><td>"+ value.cantidad_diferencia +"</td><td>"+ value.cif_moneda_ext +"</td><td>"+ value.viu_moneda_nal +"</td><td>"+ value.cif_moneda_nal +"</td><td>"+ value.precio_compra +"</td><td>"+ value.total_compra +"</td><td>"+ value.cif_adicional_nal +"</td><td>"+ value.cif_final_nal +"</td><td>"+ value.total_costo +"</td></tr>");

             }

            bi+=parseFloat(value.bultos_ingreso);
            ci+=parseFloat(value.cantidad_ingreso);
             mm+=parseFloat(value.cantidad_diferencia);
             tf+=parseFloat(value.total_compra);
             tcf+= parseFloat(value.total_costo);
         });
         // tf=parseFloat()+parseFloat();
            $('#camiontabla').append("<tr>"+'<td>  </td>'+"<td></td><td></td><td></td><td></td><td></td><td>"+bi+" </td><td>"+bi+" </td><td>"+mm+"</td><td></td><td></td><td></td><td></td><td>"+tf+"</td><td></td><td></td><td>"+tcf+"</td></tr>");



          // html= '<div class="alert alert-success">'+ data.success+'</div>';
          // $('#sample_form')[0].reset();

      }

    }
  });

  // request.done(function( msg ) {
  //
  // $( "#log" ).html( msg );
  //   console.log(msg);
  // });
  //
  // request.fail(function( jqXHR, textStatus ) {
  //   console.log(jqXHR.responseText,textStatus);
  //   alert( "Request failed: " + textStatus + jqXHR.responseText);
  // });


});

    $(document).on('submit','#buscar-camion',function(){
      // $('#buscar-camion').on('submit',function(event){
        var valor, bandera_bloqueo;
        event.preventDefault();
        $('#bloquear-camion').empty();
        // $('#sample_form')[0].reset();
        // $('#form_result').html();

        var action_url = '';
        // action-buscar-camion: es el input que esta encima del buscador
        if ($('#action-buscar-camion').val() == 'buscar-camion')
        {
            console.log('buscar-camion');
            action_url = 'ver-camion';
            valor= '1';
            bandera_bloqueo='0';
        }
        if ($('#action-buscar-camion').val() == 'buscar-camion-r')
        {
            console.log('errreeeeeeeeee');
            console.log('buscar-camion-r');
            action_url = 'ver-camion-r';
            valor= '1';
            bandera_bloqueo='1';
        }

        $.ajax({
          url: action_url,
          method:"GET",
          data:$(this).serialize(),
          dataType:"json",
          success:function(res)
          {
            var html ='';
              console.log('entro');
              $('#camiontabla').empty();
              $('#camiontabla-head').empty();
              $('#form_result_consulta1').empty();
              $('#form_result_consulta2').empty();
              $('#form_result_consulta4').empty();
              $('#form_result_consulta5').empty();

             var bi=0;

             var ci=0;

             var mm=0;
             // value.cantidad_diferencia
             var tf=0;
             // value.total_compra
             var tcf=0;
             // value.total_costo
             // var co = 'class="editar-gestion btn btn-warning btn-sm"';
             // console.log(co);


             if (bandera_bloqueo=="1") {
               $('#bloquear-camion').append('<label for="" class="pt-0">Bloquear camión</label><label class="custom-toggle custom-toggle-default"> <input type="checkbox" checked  id="change-bloqueo-camion" value="1"><span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span></label>');

                $('#camiontabla-head').append('<tr><th scope="col">Bloqueo</th><th scope="col">Nro</th><th scope="col">Cod.</th><th scope="col">Producto</th><th scope="col">Cantidad cierre</th><th scope="col">Bultos ingreso</th><th scope="col">Cantidad ingreso</th><th scope="col">(+/-)</th><th scope="col">C.I.F</th><th scope="col">V.I.U</th><th scope="col">C.I.F(MN)</th><th scope="col">Precio_Compra(MN)</th><th scope="col">Total factura</th><th scope="col">Gastos(MN)</th><th scope="col">CIF tierra(MN)</th><th scope="col">Total_Costo_Final</th>');
             } else {
                $('#camiontabla-head').append('<tr><th scope="col">Acción</th><th scope="col">Nro</th><th scope="col">Cod.</th><th scope="col">Producto</th><th scope="col">Cantidad cierre</th><th scope="col">Bultos ingreso</th><th scope="col">Cantidad ingreso</th><th scope="col">(+/-)</th><th scope="col">C.I.F</th><th scope="col">V.I.U</th><th scope="col">C.I.F(MN)</th><th scope="col">Precio_Compra(MN)</th><th scope="col">Total factura</th><th scope="col">Gastos(MN)</th><th scope="col">CIF tierra(MN)</th><th scope="col">Total_Costo_Final</th>');
             }

              $.each(res.documento, function(index,value){
                if (bandera_bloqueo=="1") {
                        //camion que ya llego
                        if (value.bloqueo_2 == '1' ) {

                          $('#camiontabla').append("<tr>"+'     <td> <label class="custom-toggle custom-toggle-default"> <input class="btn-switch" type="checkbox" checked > <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span> </label> </td>      <td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ value.cantidad_cierre +"</td><td>"+ value.bultos_ingreso +" </td><td>"+ value.cantidad_ingreso +"</td><td>"+ value.cantidad_diferencia +"</td><td>"+ value.cif_moneda_ext +"</td><td>"+ value.viu_moneda_nal +"</td><td>"+ value.cif_moneda_nal +"</td><td>"+ value.precio_compra +"</td><td>"+ value.total_compra +"</td><td>"+ value.cif_adicional_nal +"</td><td>"+ value.cif_final_nal +"</td><td>"+ value.total_costo +"</td></tr>");

                        } else {
                          $('#camiontabla').append("<tr>"+'     <td> <label class="custom-toggle custom-toggle-default"> <input class="btn-switch" type="checkbox"  > <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span> </label> </td>      <td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ value.cantidad_cierre +"</td><td>"+ value.bultos_ingreso +" </td><td>"+ value.cantidad_ingreso +"</td><td>"+ value.cantidad_diferencia +"</td><td>"+ value.cif_moneda_ext +"</td><td>"+ value.viu_moneda_nal +"</td><td>"+ value.cif_moneda_nal +"</td><td>"+ value.precio_compra +"</td><td>"+ value.total_compra +"</td><td>"+ value.cif_adicional_nal +"</td><td>"+ value.cif_final_nal +"</td><td>"+ value.total_costo +"</td></tr>");
                        }

                        bi+=parseFloat(value.bultos_ingreso);
                        ci+=parseFloat(value.cantidad_ingreso);
                        mm+=parseFloat(value.cantidad_diferencia);
                        tf+=parseFloat(value.total_compra);
                        tcf+= parseFloat(value.total_costo);
                        // $('#camiontabla').append("<tr>"+'<td>  </td>'+"<td></td><td></td><td></td><td></td><td></td><td>"+bi+" </td><td>"+bi+" </td><td>"+mm+"</td><td></td><td></td><td></td><td></td><td>"+tf+"</td><td></td><td></td><td>"+tcf+"</td></tr>");
                } else {
                        //camion que todavia no llega
                        $('#camiontabla').append("<tr>"+'<td> <button type="button" value="'+valor+'" class="editar-gestion btn btn-warning btn-sm">Editar</button></td><td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ value.cantidad_cierre +"</td><td>"+ value.bultos_ingreso +" </td><td>"+ value.cantidad_ingreso +"</td><td>"+ value.cantidad_diferencia +"</td><td>"+ value.cif_moneda_ext +"</td><td>"+ value.viu_moneda_nal +"</td><td>"+ value.cif_moneda_nal +"</td><td>"+ value.precio_compra +"</td><td>"+ value.total_compra +"</td><td>"+ value.cif_adicional_nal +"</td><td>"+ value.cif_final_nal +"</td><td>"+ value.total_costo +"</td></tr>");


                      bi+=parseFloat(value.bultos_ingreso);
                      ci+=parseFloat(value.cantidad_ingreso);
                      mm+=parseFloat(value.cantidad_diferencia);
                      tf+=parseFloat(value.total_compra);
                      tcf+= parseFloat(value.total_costo);
                }
               });
               $('#camiontabla').append("<tr>"+"<td></td><td></td><td></td><td></td><td></td><td>"+bi+" </td><td>"+ci+" </td><td>"+mm+"</td><td></td><td></td><td></td><td></td><td>"+tf+"</td><td></td><td></td><td>"+tcf+"</td></tr>");
               // tf=parseFloat()+parseFloat();
                  // ---------------------------------
                  // console.log('aaaaaaaaaa');
                  // console.log(res.dato_general[0]['codigo']);
                  $('#codigo_oficial').val(res.dato_general[0]['codigo']);
                  $('#codigo_oficial_real').val(res.dato_general[0]['codigo']);
                  $('#codigo_auxiliar').val(res.dato_general[0]['codigo_aux']);
                  $('#nro_de_contenedor').val(res.dato_general[0]['doc_contenedor']);
                  $('#nro_bl').val(res.dato_general[0]['doc_bl']);
                  $('#pais_origen').val(res.dato_general[0]['pais_origen']);
                  $('#descripcion').val(res.dato_general[0]['descripcion']);
                  $('#contenido').val(res.dato_general[0]['contenido']);
                  $('#observaciones').val(res.dato_general[0]['observaciones']);
                  $('#bandera-general').append('<input type="hidden" id="subbandera"  value="2">');

                  $('#codigo_oficial_real2').val(res.dato_general[0]['codigo']);
                  $('#fecha_de_cierre').val(dateUTC(res.dato_general[0]['fecha_cierre']));
                  $('#fecha_de_embarque_desde').val(dateUTC(res.dato_general[0]['fecha_embarque1']));
                  $('#fecha_de_embarque_desde_hasta').val(dateUTC(res.dato_general[0]['fecha_embarque2']));
                  $('#fecha_de_llegada_desde').val(dateUTC(res.dato_general[0]['fecha_llegada1']));
                  $('#fecha_de_llegada_desde_hasta').val(dateUTC(res.dato_general[0]['fecha_llegada2']));
                  $('#observacion').val(res.dato_general[0]['observacion_fecha']);



                  $('#a_cumplirse_a').val(res.dato_general[0]['despues_dias']);
                  $('#a_cumplirse_a-').val(res.dato_general[0]['despues_fecha']);

                  $('#codigo_oficial_real4').val(res.dato_general[0]['codigo']);

                  console.log('fecha de embarque');
                  console.log('2019-03-23 00:00:00.000');
                  console.log(dateUTC('2019-03-23 00:00:00.000'));
                  $('#fecha_de_embarque_real').val(dateUTC(res.dato_general[0]['fecha_embarque']));

                  console.log('fecha de llegada');
                  console.log('2019-01-21 00:00:00.000');
                  console.log(dateUTC('2019-01-21 00:00:00.000'));
                  $('#fecha_de_llegada').val(dateUTC(res.dato_general[0]['fecha_llegada']));

                  $('#resol_sanitaria').val(res.dato_general[0]['resolucion_sanitaria']);
                  $('#fecha_de_resol_sanitaria').val(dateUTC(res.dato_general[0]['fecha_resolucion']));
                  $('#forward').val(res.dato_general[0]['forward']);
                  $('#fecha_forward').val(dateUTC(res.dato_general[0]['forward_fecha']));
                  $('#fecha_producción_desde').val(dateUTC(res.dato_general[0]['fecha_produccion']));
                  $('#fecha_producción_desde_hasta').val(dateUTC(res.dato_general[0]['fecha_produccion2']));
                  $('#fecha_vencimiento_desde').val(dateUTC(res.dato_general[0]['fecha_vencimiento']));
                  $('#fecha_vencimiento_desde_hasta').val(dateUTC(res.dato_general[0]['fecha_vencimiento2']));


                  $('#codigo_oficial_real5').val(res.dato_general[0]['codigo']);
                  $('#factura_proveedor').val(res.dato_general[0]['factura_nro']);
                  $('#cantidad_recibida').val(res.dato_general[0]['cantidad_unidades']);
                  $('#valor_total').val(res.dato_general[0]['valor_total']);
                  // console.log('abajoooo para formulario');
                  // console.log(res.dato_general[0]['codigo']);

                  // $('#clasificacion_de_mercancia').append("<option value=''> Seleccione un camión </option>");
                  // $('#camiontabla').append("<tr><td>aaaaaaaaaaa</td></tr>");
                  $('#clasificacion_de_mercancia').empty();
                  $.each(res.clasificaciones_camion, function(index,value){
                        $('#clasificacion_de_mercancia').append("<option value='"+ value['cod_int'] +"'>"+value['desc01']+"</option>");
                  });
                  $('#clasificacion_de_mercancia').val(res.dato_general[0]['clasif_mercancia']);

                  $('#proveedor').empty();
                  $.each(res.proveedor_camion, function(index,value){
                        $('#proveedor').append("<option value='"+ value['id_proveedor'] +"'>"+value['emp_nombre']+"</option>");
                  });
                  $('#proveedor').val(res.dato_general[0]['proveedor']);


                  $('#marca_origen').empty();
                  $.each(res.marca_origen, function(index,value){
                        $('#marca_origen').append("<option value='"+ value['MARC_CODIGO'] +"'>"+value['MARC_DESCRIPCION']+"</option>");
                  });
                  $('#marca_origen').val(res.dato_general[0]['marca_origen']);

                  $('#lugar_de_arribo').empty();
                  $.each(res.lugar_de_arribo, function(index,value){
                        $('#lugar_de_arribo').append("<option value='"+ value['ciudad_codigo'] +"'>"+value['descripcion']+"</option>");
                  });
                  $('#lugar_de_arribo').val(res.dato_general[0]['lugar_arribo']);

                  $('#forma_de_pago').empty();
                  $.each(res.forma_pago, function(index,value){
                    // console.log(value);
                        $('#forma_de_pago').append("<option value='"+ value['FRPG_CODIGO'] +"'>"+value['FRPG_DESCRIPCION']+"</option>");
                  });
                  $('#forma_de_pago').val(res.dato_general[0]['forma_pago']);

                  $('#unidad').empty();
                  $.each(res.unidad, function(index,value){
                        $('#unidad').append("<option value='"+ value['TUME_CODIGO'] +"'>"+value['TUME_DESCR']+"</option>");
                  });
                  $('#unidad').val(res.dato_general[0]['tipo_unidades']);

                  $('#tipo_de_moneda').empty();
                  $.each(res.tipo_moneda, function(index,value){
                      // console.log('áaaaaaaaaaaa');
                      // console.log(value);
                        $('#tipo_de_moneda').append("<option value='"+ value['TMDA_CODIGO'] +"'>"+value['TMDA_DESCRIPCION']+"</option>");
                  });
                  $('#tipo_de_moneda').val(res.dato_general[0]['tipo_moneda']);
                  // -----------------------------------


                // html= '<div class="alert alert-success">'+ data.success+'</div>';
                // $('#sample_form')[0].reset();



          }
        });

        // request.done(function( msg ) {
        //
        // $( "#log" ).html( msg );
        //   console.log(msg);
        // });
        //
        // request.fail(function( jqXHR, textStatus ) {
        //   console.log(jqXHR.responseText,textStatus);
        //   alert( "Request failed: " + textStatus + jqXHR.responseText);
        // });


      });

      // $('.editar-gestion').on('click',function(){
      //   console.log('se clicqueoooooo');
      // });

// --------------------------------------------------

      $(document).on('click','.editar-gestion',function(){

        var valores = new Array();
        var i=0, j=1;




          $(this).parents("tr").find("td").each(function(){
            if (j>1) {
              valores[i] =$(this).html();
              i++;
            }
            j++;
          });


        // $('#formModal').modal('show');
        console.log('-------');
        console.log($(this).val());

        $('#form_result').empty();
        $('#nro_item').val(valores[0]);
        $('#nro_itemreal').val(valores[0]);
        $('#codigo').val(valores[1]);
        $('#codigoreal').val(valores[1]);
        $('#cantidad_cierre').val(valores[3]);
        $('#bultos_ingreso').val(valores[4]);
        $('#cantidad_ingreso').val(valores[5]);
        $('#action-producto').val($(this).val());

        $('#formModal').modal('open');
        // $('#modal2').modal('open');


      });

      // --------------------------------------------------

      $('.editar-gestionE').on('click',function(){

        var id= $(this).attr('id');
        $('#form_result').html('');
        $.ajax({
          url : "/sample/"+id+"/edit",
          dataType:"json",
          success:function(data)
          {
            // $('#first_name').val('valor nombre');
            // $('#last_name').val('valor apellido');
            // $('#hidden_id').val(id);
            // $('.modal-tittle').text('Edit Record');
            $('#action_button').val('Edit');
            $('#action').text('Edit');
            $('#formModal').modal('show');


          }
        })
      });

// --------------------------------------------------

$(document).on('change','#change-bloqueo-camion',function(){
      event.preventDefault();
      // var valores = new Array();
      // var id_bloque_2;
      // var i=0, j=1;
      // console.log($(this).val());
      if ($(this).val() == '1') {
          var camion_id = $('#buscar-codigo-camion').val();

      }
      else {
        if ($(this).val() == '2') {
          var camion_id = $('#camion').val();
        } else {
          var camion_id = $('#camionr').val();
        }
      }


      if($(this).prop("checked") == true){
        var bloqueo_2_id = '1';
      }else{

        var bloqueo_2_id = '0';
      }
      // console.log(anio_id);
      if($.trim(camion_id) != ''  ){
            // console.log('consicion 1');
          $.get('cambiar-bloqueo-camion',{camion_id:camion_id, bloqueo_2_id:bloqueo_2_id},function(res){
            console.log('nueva tabla');
            $('#camiontabla-head').empty();
            $('#camiontabla').empty();
           var bi=0;

           var ci=0;

           var mm=0;
           // value.cantidad_diferencia
           var tf=0;
           // value.total_compra
           var tcf=0;
           // value.total_costo
           // var co = 'class="editar-gestion btn btn-warning btn-sm"';
           // console.log(co);

            $('#camiontabla-head').append('<tr><th scope="col">Bloqueo</th><th scope="col">Nro</th><th scope="col">Cod.</th><th scope="col">Producto</th><th scope="col">Cantidad cierre</th><th scope="col">Bultos ingreso</th><th scope="col">Cantidad ingreso</th><th scope="col">(+/-)</th><th scope="col">C.I.F</th><th scope="col">V.I.U</th><th scope="col">C.I.F(MN)</th><th scope="col">Precio_Compra(MN)</th><th scope="col">Total factura</th><th scope="col">Gastos(MN)</th><th scope="col">CIF tierra(MN)</th><th scope="col">Total_Costo_Final</th>');

            $.each(res, function(index,value){
                 if (value.bloqueo_2 == '1' ) {
                   $('#camiontabla').append("<tr>"+'<td> <label class="custom-toggle custom-toggle-default"> <input class="btn-switch" type="checkbox"  checked> <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span> </label> </td><td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ value.cantidad_cierre +"</td><td>"+ value.bultos_ingreso +" </td><td>"+ value.cantidad_ingreso +"</td><td>"+ value.cantidad_diferencia +"</td><td>"+ value.cif_moneda_ext +"</td><td>"+ value.viu_moneda_nal +"</td><td>"+ value.cif_moneda_nal +"</td><td>"+ value.precio_compra +"</td><td>"+ value.total_compra +"</td><td>"+ value.cif_adicional_nal +"</td><td>"+ value.cif_final_nal +"</td><td>"+ value.total_costo +"</td></tr>");

                 } else {
                   $('#camiontabla').append("<tr>"+'<td> <label class="custom-toggle custom-toggle-default"> <input class="btn-switch" type="checkbox"  > <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span> </label> </td><td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ value.cantidad_cierre +"</td><td>"+ value.bultos_ingreso +" </td><td>"+ value.cantidad_ingreso +"</td><td>"+ value.cantidad_diferencia +"</td><td>"+ value.cif_moneda_ext +"</td><td>"+ value.viu_moneda_nal +"</td><td>"+ value.cif_moneda_nal +"</td><td>"+ value.precio_compra +"</td><td>"+ value.total_compra +"</td><td>"+ value.cif_adicional_nal +"</td><td>"+ value.cif_final_nal +"</td><td>"+ value.total_costo +"</td></tr>");

                 }

                bi+=parseFloat(value.bultos_ingreso);
                ci+=parseFloat(value.cantidad_ingreso);
                 mm+=parseFloat(value.cantidad_diferencia);
                 tf+=parseFloat(value.total_compra);
                 tcf+= parseFloat(value.total_costo);
             });
             // tf=parseFloat()+parseFloat();
                $('#camiontabla').append("<tr>"+'<td>  </td>'+"<td></td><td></td><td></td><td></td><td>"+bi+" </td><td>"+bi+" </td><td>"+mm+"</td><td></td><td></td><td></td><td></td><td>"+tf+"</td><td></td><td></td><td>"+tcf+"</td></tr>");
         });


         // request.done(function( msg ) {
         //   // $( "#log" ).html( msg );
         //   console.log(msg);
         // });
         //
         // request.fail(function( jqXHR, textStatus ) {
         //   console.log(jqXHR.responseText,textStatus);
         //   alert( "Request failed: " + textStatus + jqXHR.responseText);
         // });

      }
     //
     //    $(this).parents("tr").find("td").each(function(){
     //      if (j>2) {
     //        valores[i] =$(this).html();
     //        i++;
     //      }
     //      j++;
     //
     //    });
     //    // i++;
     // if($(this).prop("checked") == true){
     //   valores[i]=1;
     //
     //        request=$.get('switch-item',{bloqueo_2_id:valores[15],camion_id:valores[1],item_id:valores[0] },function(res){
     //          console.log('actualizado');
     //        });
     //
     //        request.done(function( msg ) {
     //          // $( "#log" ).html( msg );
     //          console.log(msg);
     //        });
     //
     //        request.fail(function( jqXHR, textStatus ) {
     //          console.log(jqXHR.responseText,textStatus);
     //          alert( "Request failed: " + textStatus + jqXHR.responseText);
     //        });
     //
     //
     //      }else{
     //            valores[i]=0;
     //          // console.log(valores[15]);
     //          request=$.get('switch-item',{bloqueo_2_id:valores[15],camion_id:valores[1],item_id:valores[0] },function(res){
     //            console.log('actualizado');
     //          });
     //
     //
     //            request.done(function( msg ) {
     //              // $( "#log" ).html( msg );
     //              console.log(msg);
     //            });
     //
     //            request.fail(function( jqXHR, textStatus ) {
     //              console.log(jqXHR.responseText,textStatus);
     //              alert( "Request failed: " + textStatus + jqXHR.responseText);
     //            });
     //    }

      });


$(document).on('change','.btn-switch',function(){

      var valores = new Array();
      var id_bloque_2;
      var i=0, j=1;

        $(this).parents("tr").find("td").each(function(){
          if (j>1) {
            valores[i] =$(this).html();
            i++;
          }
          j++;

        });
        // i++;
     if($(this).prop("checked") == true){
       valores[i]=1;
     // console.log(valores[15]);
            $.get('switch-item',{bloqueo_2_id:valores[15],camion_id:valores[1],item_id:valores[0] },function(res){
              console.log('actualizado');
            });

            // request.done(function( msg ) {
            //   // $( "#log" ).html( msg );
            //   console.log(msg);
            // });
            //
            // request.fail(function( jqXHR, textStatus ) {
            //   console.log(jqXHR.responseText,textStatus);
            //   alert( "Request failed: " + textStatus + jqXHR.responseText);
            // });


          }else{
                valores[i]=0;
              // console.log(valores[15]);
              $.get('switch-item',{bloqueo_2_id:valores[15],camion_id:valores[1],item_id:valores[0] },function(res){
                console.log('actualizado');
              });


                // request.done(function( msg ) {
                //   // $( "#log" ).html( msg );
                //   console.log(msg);
                // });
                //
                // request.fail(function( jqXHR, textStatus ) {
                //   console.log(jqXHR.responseText,textStatus);
                //   alert( "Request failed: " + textStatus + jqXHR.responseText);
                // });
        }

      });

// ------------------------------------------------------
// ------------------------------------------------------



      function dateUTC(ms) {
        var ms, fecha,año, mes, dia, hora, minuto, segundo;
        // ms= res.dato_general[0]['fecha_embarque1']+' UTC';

        ms = new Date(ms);

        // ms = Date.parse(2020-01-27);
        // fecha = new Date(ms);
        // console.log('Año');
        // console.log(ms.getUTCFullYear());
        año=ms.getUTCFullYear();
        // console.log('Mes');
        // console.log(ms.getUTCMonth()+1);
        mes=ms.getUTCMonth()+1;
        // console.log('Dia');
        // console.log(ms.getUTCDate());
        dia=ms.getUTCDate();
        // console.log('Horas');
        // console.log(ms.getUTCHours()-4);
        hora=ms.getUTCHours()-3;
        // console.log('Minutos');
        // console.log(ms.getUTCMinutes());
        minuto=ms.getUTCMinutes();
        // console.log('Segundos');
        // console.log(ms.getUTCSeconds());
        segundo=ms.getUTCSeconds();
        fecha= año+'-'+ pad(mes) +'-'+ pad(dia)+'T'+ pad(hora)+':'+ pad(minuto)+':'+ pad(segundo);
        // console.log('fechaaaa:');
        // console.log(fecha);
        return fecha;
      }

      function pad(number) {
        // console.log('este numero es:');
        // console.log(number);
      if (number < 10) {
        if (number == 0) {
          // console.log('el numero es ceroooo');
          return '0' + number;
        }
        else {
          // console.log('aqui hay numero may 0 y menor q 10:');
          // console.log(number);
          return '0' + number;
        }
       // console.log('pad');
       // console.log('00' + number);
      }

      // console.log('es numero mayor de 9');
      return number;
      }
  });

  $(document).ready(function(){

      $('#camiones_vencidos').on('change', function(){
          var year, clasificacion,n ;
          n = $(this).val();
          console.log(n);
          year = $('#anior').val() ;
          clasificacion = $('#clasificacionr').val() ;
          $('#camiones-vencidos').empty();

          var d = new Date();

          var month = d.getMonth()+1;
          var day = d.getDate();

          var output = d.getFullYear() + '-' +
              (month<10 ? '0' : '') + month + '-' +
              (day<10 ? '0' : '') + day;

          if($.trim( $('#anior').val()) != '' && $.trim($('#clasificacionr').val()) != ''  ){
            $.get('camiones-vencidos',{anio_id:year,clasificacion_id:clasificacion },function(res){
                if (res.camionesVencidos != '') {
                  $.each(res.camionesVencidos, function(index,value){

                    var fechaInicio = new Date(value.fecha_llegada).getTime();
                    var fechaFin    = new Date(output).getTime();
                    var diff = fechaFin - fechaInicio;

                    if (diff >= n) {
                      let codigo_aux = value.codigo_aux == null || value.codigo_aux == '' ? '-' : value.codigo_aux;
                      let ingreso_zeta = value.ingreso_zeta == null || value.ingreso_zeta == '' ? '-' : value.ingreso_zeta;

                      $('#camiones-vencidos').append('<tr><td>'+ value.codigo +"</td><td>"+ codigo_aux+"</td><td>"+value.descripcion+" </td><td>"+ dateUTC(value.fecha_llegada) +"</td><td>"+ dateUTC(value.fecha_vencimiento) +" </td><td>"+ ingreso_zeta +"</td><td>"+ value.marca_origen +"</td><td>"+ NumericoDecimal(value.valor_total) +"</td><td>"+ NumericoDecimal(value.cierre_gastos) +"</td><td>"+ value.lugar_arribo +"</td></tr>");
                    }

                  })
                } else {
                  alerta('info','No hay camiones, ingrese otro valor');
                }


            });
          }
          else
          {
            alerta('info','Los campos gestión y clasificar camión deben estar llenos');


          }
      });


      $('#anio').on('change', function(){
        var anio_id = $(this).val();

        if($.trim(anio_id) != ''  ){
            $.get('select-clasificacion',{anio_id:anio_id},function(res){
             $('#clasificacion').empty();
             $.each(res, function(index,value){
               $('#clasificacion').append("<option value='"+ value +"'>"+ value +"</option>");
             })
          });

        }
      });

      $('#anior').on('change', function(){
        var anio_id = $(this).val();

        if($.trim(anio_id) != ''  ){
            $.get('select-clasificacion',{anio_id:anio_id},function(res){
             $('#clasificacionr').empty();
             $.each(res, function(index,value){
               $('#clasificacionr').append("<option value='"+ value +"'>"+ value +"</option>");

             })
          });


        }
      });

      $('#clasificacion').on('change', function(){
        var clasificacion_id = $(this).val();
        var anio_id = $('#anio').val();
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

        }
      });

      $('#camion').on('change', function(){
          event.preventDefault();
        var camion_id = $(this).val();
        var valor;
        var action_url, bandera_bloqueo;
        if ($('#icamion').val() == 'camion')
        {

            bandera_bloqueo=0;
            action_url = 'tabla-camion';
            valor= '2';
        }
        if ($("#icamion").val() == 'camion-r')
        {
            bandera_bloqueo=1;
            action_url = 'tabla-camion-r';
            valor= '2';
        }

        if($.trim(camion_id) != ''){
            $.get(action_url,{camion_id:camion_id },function(res){
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
            var tf=0;
            var tcf=0;

            if (bandera_bloqueo=="1") {
              $('#bloquear-camion').append('<label style="cursor:pointer" >Bloquear camión</label><label class="custom-toggle custom-toggle-default"> <input type="checkbox" checked  id="change-bloqueo-camion" value="2"><span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span></label>');
               $('#camiontabla-head').append('<tr><th  >Bloqueo</th><th>Nro</th><th>Cod.</th><th>Producto</th><th >Cantidad cierre</th><th>Bultos ingreso</th><th >Cantidad ingreso</th><th >(+/-)</th><th >C.I.F</th><th >V.I.U</th><th >C.I.F(MN)</th><th >Precio_Compra(MN)</th><th >Total factura</th><th>Gastos(MN)</th><th >CIF tierra(MN)</th><th >Total_Costo_Final</th>');
            } else {
               $('#camiontabla-head').append('<tr><th >Editar</th><th >Nro</th><th >Cod.</th><th >Producto</th><th >Cantidad cierre</th><th >Bultos ingreso</th><th >Cantidad ingreso</th><th >(+/-)</th><th >C.I.F</th><th >V.I.U</th><th >C.I.F(MN)</th><th >Precio_Compra(MN)</th><th >Total factura</th><th >Gastos(MN)</th><th >CIF tierra(MN)</th><th >Total_Costo_Final</th>');
            }
             $.each(res.documento, function(index,value){

               if (bandera_bloqueo=="1") {
                       //camion que ya llego

                       if (value.bloqueo_2 == '1' ) {
                         $('#camiontabla').append("<tr>"+'<td > <label class="custom-toggle custom-toggle-default"> <input class="btn-switch" type="checkbox"  checked> <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span> </label> </td><td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+addCommas((parseFloat(value.cantidad_cierre)).toFixed(2))  +"</td><td>"+ addCommas((parseFloat(value.bultos_ingreso)).toFixed(2)) +" </td><td>"+ addCommas((parseFloat(value.cantidad_ingreso)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cantidad_diferencia)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_ext)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.viu_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.precio_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_adicional_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_final_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_costo)).toFixed(2)) +"</td></tr>");

                       } else {
                         $('#camiontabla').append("<tr>"+'<td > <label class="custom-toggle custom-toggle-default"> <input class="btn-switch" type="checkbox"  > <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span> </label> </td><td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+ value.producto +" </td><td>"+ addCommas((parseFloat(value.cantidad_cierre)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.bultos_ingreso)).toFixed(2)) +" </td><td>"+ addCommas((parseFloat(value.cantidad_ingreso)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cantidad_diferencia)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_ext)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.viu_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.precio_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_adicional_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_final_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_costo)).toFixed(2)) +"</td></tr>");
                       }
                       bi+=parseFloat(value.bultos_ingreso);
                       ci+=parseFloat(value.cantidad_ingreso);
                       mm+=parseFloat(value.cantidad_diferencia);
                       tf+=parseFloat(value.total_compra);
                       tcf+= parseFloat(value.total_costo);

                }
                else
                {

                    $('#camiontabla').append(`
                      <tr>
                        <td style="height: 45px;">
                          <a type="button" value="${valor}" class="editar-gestion  btn blue btn-50 darken-1" style="cursor: pointer"> <i class="material-icons dp48">edit</i></a>
                        </td>
                        <td>${value.nro_item}</td>
                        <td>${value.codigo}  </td>
                        <td>${value.producto}</td>
                        <td>${addCommas((parseFloat(value.cantidad_cierre)).toFixed(2))}     </td>
                        <td>${addCommas((parseFloat(value.bultos_ingreso)).toFixed(2))}      </td>
                        <td>${addCommas((parseFloat(value.cantidad_ingreso)).toFixed(2))}    </td>
                        <td>${addCommas((parseFloat(value.cantidad_diferencia)).toFixed(2))} </td>
                        <td>${addCommas((parseFloat(value.cif_moneda_ext)).toFixed(2))}      </td>
                        <td>${addCommas((parseFloat(value.viu_moneda_nal)).toFixed(2))}      </td>
                        <td>${addCommas((parseFloat(value.cif_moneda_nal)).toFixed(2))}      </td>
                        <td>${addCommas((parseFloat(value.precio_compra)).toFixed(2))}       </td>
                        <td>${addCommas((parseFloat(value.cif_adicional_nal)).toFixed(2))}   </td>
                        <td>${addCommas((parseFloat(value.cif_adicional_nal)).toFixed(2))}   </td>
                        <td>${addCommas((parseFloat(value.cif_final_nal)).toFixed(2))}       </td>
                        <td>${addCommas((parseFloat(value.total_costo)).toFixed(2))}         </td>
                      </tr>
                    `);


                    bi+=parseFloat(value.bultos_ingreso);
                    ci+=parseFloat(value.cantidad_ingreso);
                    mm+=parseFloat(value.cantidad_diferencia);
                    tf+=parseFloat(value.total_compra);
                    tcf+= parseFloat(value.total_costo);

                }
              });
              $('#camiontabla').append("<tr >"+'<td style="height: 55px;">  </td>'+"<td></td><td></td><td></td><td></td><td>"+addCommas((parseFloat(bi)).toFixed(2))+" </td><td>"+addCommas((parseFloat(ci)).toFixed(2))+" </td><td>"+addCommas((parseFloat(mm)).toFixed(2))+"</td><td></td><td></td><td></td><td></td><td>"+addCommas((parseFloat(tf)).toFixed(2))+"</td><td></td><td></td><td>"+addCommas((parseFloat(tcf)).toFixed(2))+"</td></tr>");
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
              $('#fecha_de_embarque_desde').val(dateUTC(res.dato_general[0]['fecha_embarque1']));
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
                 $('#camiontabla').append("<tr>"+'<td> <label class="custom-toggle custom-toggle-default"> <input class="btn-switch" type="checkbox"  checked> <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span> </label> </td>'+'<td> <button type="button" value="{{$item->nro_item}}" class="editar-gestion btn btn-warning btn-sm">Editar</button></td><td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ addCommas((parseFloat(value.cantidad_cierre)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.bultos_ingreso)).toFixed(2)) +" </td><td>"+ addCommas((parseFloat(value.cantidad_ingreso)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cantidad_diferencia)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_ext)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.viu_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.precio_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_adicional_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_final_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_costo)).toFixed(2)) +"</td></tr>");

               } else {
                 $('#camiontabla').append("<tr>"+'<td> <label class="custom-toggle custom-toggle-default"> <input class="btn-switch" type="checkbox"  > <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span> </label> </td>'+'<td> <button type="button" value="{{$item->nro_item}}" class="editar-gestion btn btn-warning btn-sm">Editar</button></td><td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ addCommas((parseFloat(value.cantidad_cierre)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.bultos_ingreso)).toFixed(2)) +" </td><td>"+ addCommas((parseFloat(value.cantidad_ingreso)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cantidad_diferencia)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_ext)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.viu_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.precio_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_adicional_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_final_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_costo)).toFixed(2)) +"</td></tr>");

               }
                  bi+=parseFloat(value.bultos_ingreso);
                  ci+=parseFloat(value.cantidad_ingreso);
                  mm+=parseFloat(value.cantidad_diferencia);
                  tf+=parseFloat(value.total_compra);
                  tcf+= parseFloat(value.total_costo);
              });
              // tf=parseFloat()+parseFloat();
              $('#camiontabla').append("<tr>"+'<td>  </td>'+"<td></td><td></td><td></td><td></td><td></td><td>"+addCommas((parseFloat(bi)).toFixed(2))+" </td><td>"+addCommas((parseFloat(ci)).toFixed(2))+" </td><td>"+addCommas((parseFloat(mm)).toFixed(2))+"</td><td></td><td></td><td></td><td></td><td>"+addCommas((parseFloat(tf)).toFixed(2))+"</td><td></td><td></td><td>"+addCommas((parseFloat(tcf)).toFixed(2))+"</td></tr>");
           });

        }
      });

// ----------------------------------------------------
      $('#create_record').click(function(){
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

          if ($('#subbandera').val() == '2')
          {
            camion_id = $('#camion').val();

            valor= '2';
          }
          else{
            camion_id = $('#buscar-codigo-camion').val();
            valor ='1';
          }


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
                  alerta('success',data.success);
                  // html= '<div class="card-alert card green"><div class="card-content white-text">'+ data.success+'</div></div>';

                  if($.trim(camion_id) != ''){
                      $.get('tabla-camion',{camion_id:camion_id },function(res){
                        $('#bloquear-camion').empty();
                       $('#camiontabla').empty();
                      var bi=0;
                      var ci=0;
                      var mm=0;
                      var tf=0;
                      var tcf=0;

                      $('#bloquear-camion').append('<label for="" class="pt-0">Bloquear camión</label><label class="custom-toggle custom-toggle-default"> <input type="checkbox" checked  id="change-bloqueo-camion" value="2"><span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span></label>');
                       $.each(res.documento, function(index,value){

                           $('#camiontabla').append("<tr>"+'<td> <button type="button" value="'+valor+'" class="editar-gestion btn btn-warning btn-sm">Editar</button></td><td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ addCommas((parseFloat(value.cantidad_cierre)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.bultos_ingreso)).toFixed(2)) +" </td><td>"+ addCommas((parseFloat(value.cantidad_ingreso)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cantidad_diferencia)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_ext)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.viu_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.precio_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_adicional_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_final_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_costo)).toFixed(2)) +"</td></tr>");


                           bi+=parseFloat(value.bultos_ingreso);
                           ci+=parseFloat(value.cantidad_ingreso);
                           mm+=parseFloat(value.cantidad_diferencia);
                           tf+=parseFloat(value.total_compra);
                           tcf+= parseFloat(value.total_costo);

                        });

                            $('#camiontabla').append("<tr>"+"<td></td><td></td><td></td><td></td><td></td><td>"+addCommas((parseFloat(bi)).toFixed(2))+" </td><td>"+addCommas((parseFloat(ci)).toFixed(2))+" </td><td>"+addCommas((parseFloat(mm)).toFixed(2))+"</td><td></td><td></td><td></td><td></td><td>"+addCommas((parseFloat(tf)).toFixed(2))+"</td><td></td><td></td><td>"+addCommas((parseFloat(tcf)).toFixed(2))+"</td></tr>");

                    });
                  }
                  // ------------------------

                  // ------------------------

              }

              $('#form_result_consulta1').html(html);
            }
          });


        });

        $(document).on('submit','#consulta2',function(){
        // $('#sample_form').on('submit',function(event){
                  event.preventDefault();
                  var camion_id;
                  var valor ;

                  var action_url = '';
                  action_url = 'actualizar-camion-fecha';
                  if ($('#subbandera').val() == '2')
                  {
                    camion_id = $('#camion').val();
                    valor= '2';
                  }
                  else{
                    camion_id = $('#buscar-codigo-camion').val();
                    valor ='1';
                  }

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
                          alerta('success',data.success);
                          if($.trim(camion_id) != ''){
                              $.get('tabla-camion',{camion_id:camion_id },function(res){
                                $('#bloquear-camion').empty();
                                $('#camiontabla').empty();

                              var bi=0;
                              var ci=0;
                              var mm=0;
                              var tf=0;
                              var tcf=0;
                              $('#bloquear-camion').append('<label for="" class="pt-0">Bloquear camión</label><label class="custom-toggle custom-toggle-default"> <input type="checkbox" checked  id="change-bloqueo-camion" value="2"><span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span></label>');
                               $.each(res.documento, function(index,value){
                                 $('#camiontabla').append("<tr>"+'<td> <button type="button" value="'+valor+'" class="editar-gestion btn btn-warning btn-sm">Editar</button></td><td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ addCommas((parseFloat(value.cantidad_cierre)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.bultos_ingreso)).toFixed(2)) +" </td><td>"+ addCommas((parseFloat(value.cantidad_ingreso)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cantidad_diferencia)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_ext)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.viu_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.precio_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_adicional_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_final_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_costo)).toFixed(2)) +"</td></tr>");


                                 bi+=parseFloat(value.bultos_ingreso);
                                 ci+=parseFloat(value.cantidad_ingreso);
                                 mm+=parseFloat(value.cantidad_diferencia);
                                 tf+=parseFloat(value.total_compra);
                                 tcf+= parseFloat(value.total_costo);
                                });
                                    $('#camiontabla').append("<tr>"+"<td></td><td></td><td></td><td></td><td></td><td>"+addCommas((parseFloat(bi)).toFixed(2))+" </td><td>"+addCommas((parseFloat(ci)).toFixed(2))+" </td><td>"+addCommas((parseFloat(mm)).toFixed(2))+"</td><td></td><td></td><td></td><td></td><td>"+addCommas((parseFloat(tf)).toFixed(2))+"</td><td></td><td></td><td>"+addCommas((parseFloat(tcf)).toFixed(2))+"</td></tr>");
                                   });
                                 }
                          // ------------------------

                          // ------------------------

                      }

                      $('#form_result_consulta2').html(html);
                    }
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
                  // html= '<div class="card-alert card green"><div class="card-content white-text">'+ data.success+'</div></div>';
                  alerta('success',data.success);
                  if($.trim(camion_id) != ''){
                      $.get('tabla-camion',{camion_id:camion_id },function(res){
                        $('#bloquear-camion').empty();
                       $('#camiontabla').empty();

                      var bi=0;
                      var ci=0;
                      var mm=0;
                      var tf=0;
                      var tcf=0;

                      $('#bloquear-camion').append('<label for="" class="pt-0">Bloquear camión</label><label class="custom-toggle custom-toggle-default"> <input type="checkbox" checked  id="change-bloqueo-camion" value="2"><span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span></label>');
                       $.each(res.documento, function(index,value){
                         $('#camiontabla').append("<tr>"+'<td> <button type="button" value="'+valor+'" class="editar-gestion btn btn-warning btn-sm">Editar</button></td><td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ addCommas((parseFloat(value.cantidad_cierre)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.bultos_ingreso)).toFixed(2)) +" </td><td>"+ addCommas((parseFloat(value.cantidad_ingreso)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cantidad_diferencia)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_ext)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.viu_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.precio_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_adicional_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_final_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_costo)).toFixed(2)) +"</td></tr>");


                         bi+=parseFloat(value.bultos_ingreso);
                         ci+=parseFloat(value.cantidad_ingreso);
                         mm+=parseFloat(value.cantidad_diferencia);
                         tf+=parseFloat(value.total_compra);
                         tcf+= parseFloat(value.total_costo);
                        });
                            $('#camiontabla').append("<tr>"+"<td></td><td></td><td></td><td></td><td></td><td>"+addCommas((parseFloat(bi)).toFixed(2))+" </td><td>"+addCommas((parseFloat(ci)).toFixed(2))+" </td><td>"+addCommas((parseFloat(mm)).toFixed(2))+"</td><td></td><td></td><td></td><td></td><td>"+addCommas((parseFloat(tf)).toFixed(2))+"</td><td></td><td></td><td>"+addCommas((parseFloat(tcf)).toFixed(2))+"</td></tr>");
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
                          // html= '<div class="card-alert card green"><div class="card-content white-text">'+ data.success+'</div></div>';
                          alerta('success',data.success)
                          if($.trim(camion_id) != ''){
                              $.get('tabla-camion',{camion_id:camion_id },function(res){
                                $('#bloquear-camion').empty();
                               $('#camiontabla').empty();

                              var bi=0;
                              var ci=0;
                              var mm=0;
                              var tf=0;
                              var tcf=0;
                              $('#bloquear-camion').append('<label for="" class="pt-0">Bloquear camión</label><label class="custom-toggle custom-toggle-default"> <input type="checkbox" checked  id="change-bloqueo-camion" value="2"><span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span></label>');
                               $.each(res.documento, function(index,value){
                                 $('#camiontabla').append("<tr>"+'<td> <button type="button" value="'+valor+'" class="editar-gestion btn btn-warning btn-sm">Editar</button></td><td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ addCommas((parseFloat(value.cantidad_cierre)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.bultos_ingreso)).toFixed(2)) +" </td><td>"+ addCommas((parseFloat(value.cantidad_ingreso)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cantidad_diferencia)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_ext)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.viu_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.precio_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_adicional_nal)).toFixed(2)) +"</td><td>"+addCommas((parseFloat(value.cif_final_nal)).toFixed(2))  +"</td><td>"+ addCommas((parseFloat(value.total_costo)).toFixed(2)) +"</td></tr>");


                                 bi+=parseFloat(value.bultos_ingreso);
                                 ci+=parseFloat(value.cantidad_ingreso);
                                 mm+=parseFloat(value.cantidad_diferencia);
                                 tf+=parseFloat(value.total_compra);
                                 tcf+= parseFloat(value.total_costo);
                                });
                                    $('#camiontabla').append("<tr>"+"<td></td><td></td><td></td><td></td><td></td><td>"+bi+" </td><td>"+ci+" </td><td>"+addCommas((parseFloat(mm)).toFixed(2))+"</td><td></td><td></td><td></td><td></td><td>"+addCommas((parseFloat(tf)).toFixed(2))+"</td><td></td><td></td><td>"+addCommas((parseFloat(tcf)).toFixed(2))+"</td></tr>");
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



                });
//------------------------------------------------------
$(document).on('submit','#sample_form',function(){
// $('#sample_form').on('submit',function(event){
          event.preventDefault();
          var camion_id;
          var valor ;
          var action_url = '';
          action_url = 'actualizar-camion';
          if ($('#action-producto').val() == '1')
          {
              camion_id = $('#buscar-codigo-camion').val();
              valor ='1';
          }
          else{
              camion_id = $('#camion').val();
              valor= '2';
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
              }
              if (data.success)
              {

                   sweetalerta('Listo!','Actualizado correctamente','success' );
                         $('#formModal').modal('close');
                  // alerta('success',data.success);

                  if($.trim(camion_id) != ''){

                      $.get('tabla-camion',{camion_id:camion_id },function(res){
                       $('#camiontabla').empty();
                            $('#camiontabla-head').empty();
                      var bi=0;
                      var ci=0;
                      var mm=0;
                      var tf=0;
                      var tcf=0;
                        $('#camiontabla-head').append('<tr><th scope="col">Editar</th><th scope="col">Nro</th><th scope="col">Cod.</th><th scope="col">Producto</th><th scope="col">Cantidad cierre</th><th scope="col">Bultos ingreso</th><th scope="col">Cantidad ingreso</th><th scope="col">(+/-)</th><th scope="col">C.I.F</th><th scope="col">V.I.U</th><th scope="col">C.I.F(MN)</th><th scope="col">Precio_Compra(MN)</th><th scope="col">Total factura</th><th scope="col">Gastos(MN)</th><th scope="col">CIF tierra(MN)</th><th scope="col">Total_Costo_Final</th>');
                       $.each(res.documento, function(index,value){
                            if (value.bloqueo_2 == '1' ) {
                              $('#camiontabla').append("<tr>"+'<td> <a type="button" value="'+valor+'" class="editar-gestion  btn blue btn-50 darken-1" style="cursor: pointer"> <i class="material-icons dp48">edit</i></a></td><td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ addCommas((parseFloat(value.cantidad_cierre)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.bultos_ingreso)).toFixed(2)) +" </td><td>"+ addCommas((parseFloat(value.cantidad_ingreso)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cantidad_diferencia)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_ext)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.viu_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.precio_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_adicional_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_final_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_costo)).toFixed(2)) +"</td></tr>");

                            } else {
                              $('#camiontabla').append("<tr>"+'<td><a type="button" value="'+valor+'" class="editar-gestion  btn blue btn-50 darken-1" style="cursor: pointer"> <i class="material-icons dp48">edit</i></a></td><td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ addCommas((parseFloat(value.cantidad_cierre)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.bultos_ingreso)).toFixed(2)) +" </td><td>"+ addCommas((parseFloat(value.cantidad_ingreso)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cantidad_diferencia)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_ext)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.viu_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.precio_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_adicional_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_final_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_costo)).toFixed(2)) +"</td></tr>");

                            }

                           bi+=parseFloat(value.bultos_ingreso);
                           ci+=parseFloat(value.cantidad_ingreso);
                            mm+=parseFloat(value.cantidad_diferencia);
                            tf+=parseFloat(value.total_compra);
                            tcf+= parseFloat(value.total_costo);
                        });
                        // tf=parseFloat()+parseFloat();
                           $('#camiontabla').append("<tr>"+'<td>  </td>'+"<td></td><td></td><td></td><td></td><td>"+addCommas((parseFloat(bi)).toFixed(2))+" </td><td>"+addCommas((parseFloat(ci)).toFixed(2))+" </td><td>"+addCommas((parseFloat(mm)).toFixed(2))+"</td><td></td><td></td><td></td><td></td><td>"+addCommas((parseFloat(tf)).toFixed(2))+"</td><td></td><td></td><td>"+addCommas((parseFloat(tcf)).toFixed(2))+"</td></tr>");

                           });
                         }
                  // ------------------------

              }
             //  setTimeout(function() {
             //    $('#form_result').html(html).fadeOut(1000);
             // },3000);
              $('#form_result').html(html);

              }
          });


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
      }
      else
      {
        $('#camiontabla').empty();
       var bi=0;
       var ci=0;
       var mm=0;
       var tf=0;
       var tcf=0;
       $('#bloquear-camion').append('<label for="" class="pt-0">Bloquear camión</label><label class="custom-toggle custom-toggle-default"> <input type="checkbox" checked  id="change-bloqueo-camion" value="1"><span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span></label>');

        $.each(data, function(index,value){
             if (value.bloqueo_2 == '1' ) {
               $('#camiontabla').append("<tr>"+'<td> <label class="custom-toggle custom-toggle-default"> <input class="btn-switch" type="checkbox"  checked> <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span> </label> </td>'+'<td> <button type="button" value="{{$item->nro_item}}" class="editar-gestion btn btn-warning btn-sm">Editar</button></td><td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ addCommas((parseFloat(value.cantidad_cierre)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.bultos_ingreso)).toFixed(2)) +" </td><td>"+ addCommas((parseFloat(value.cantidad_ingreso)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cantidad_diferencia)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_ext)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.viu_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.precio_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_adicional_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_final_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_costo)).toFixed(2)) +"</td></tr>");

             } else {
               $('#camiontabla').append("<tr>"+'<td> <label class="custom-toggle custom-toggle-default"> <input class="btn-switch" type="checkbox"  > <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span> </label> </td>'+'<td> <button type="button" value="{{$item->nro_item}}" class="editar-gestion btn btn-warning btn-sm">Editar</button></td><td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ addCommas((parseFloat(value.cantidad_cierre)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.bultos_ingreso)).toFixed(2)) +" </td><td>"+ addCommas((parseFloat(value.cantidad_ingreso)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cantidad_diferencia)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_ext)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.viu_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.precio_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_adicional_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_final_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_costo)).toFixed(2)) +"</td></tr>");
             }

            bi+=parseFloat(value.bultos_ingreso);
            ci+=parseFloat(value.cantidad_ingreso);
             mm+=parseFloat(value.cantidad_diferencia);
             tf+=parseFloat(value.total_compra);
             tcf+= parseFloat(value.total_costo);
         });
         // tf=parseFloat()+parseFloat();
            $('#camiontabla').append("<tr>"+'<td>  </td>'+"<td></td><td></td><td></td><td></td><td></td><td>"+addCommas((parseFloat(bi)).toFixed(2))+" </td><td>"+addCommas((parseFloat(ci)).toFixed(2))+" </td><td>"+addCommas((parseFloat(mm)).toFixed(2))+"</td><td></td><td></td><td></td><td></td><td>"+addCommas((parseFloat(tf)).toFixed(2))+"</td><td></td><td></td><td>"+addCommas((parseFloat(tcf)).toFixed(2))+"</td></tr>");

      }

    }
  });


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
            action_url = 'ver-camion';
            valor= '1';
            bandera_bloqueo='0';
        }
        if ($('#action-buscar-camion').val() == 'buscar-camion-r')
        {
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
            if (res.documento == '') {
                alerta('info','El código no existe, ingrese otro.')
            } else {

              var html ='';
              $('#camiontabla').empty();
              $('#camiontabla-head').empty();
              $('#form_result_consulta1').empty();
              $('#form_result_consulta2').empty();
              $('#form_result_consulta4').empty();
              $('#form_result_consulta5').empty();

              var bi=0;
              var ci=0;
              var mm=0;
              var tf=0;
              var tcf=0;

              if (bandera_bloqueo=="1") {
                $('#bloquear-camion').append('<label for="" class="pt-0">Bloquear camión</label><label class="custom-toggle custom-toggle-default"> <input type="checkbox" checked  id="change-bloqueo-camion" value="1"><span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span></label>');

                $('#camiontabla-head').append('<tr><th scope="col">Bloqueo</th><th scope="col">Nro</th><th scope="col">Cod.</th><th scope="col">Producto</th><th scope="col">Cantidad cierre</th><th scope="col">Bultos ingreso</th><th scope="col">Cantidad ingreso</th><th scope="col">(+/-)</th><th scope="col">C.I.F</th><th scope="col">V.I.U</th><th scope="col">C.I.F(MN)</th><th scope="col">Precio_Compra(MN)</th><th scope="col">Total factura</th><th scope="col">Gastos(MN)</th><th scope="col">CIF tierra(MN)</th><th scope="col">Total_Costo_Final</th>');
              } else {
                $('#camiontabla-head').append('<tr><th scope="col">Editar</th><th scope="col">Nro</th><th scope="col">Cod.</th><th scope="col">Producto</th><th scope="col">Cantidad cierre</th><th scope="col">Bultos ingreso</th><th scope="col">Cantidad ingreso</th><th scope="col">(+/-)</th><th scope="col">C.I.F</th><th scope="col">V.I.U</th><th scope="col">C.I.F(MN)</th><th scope="col">Precio_Compra(MN)</th><th scope="col">Total factura</th><th scope="col">Gastos(MN)</th><th scope="col">CIF tierra(MN)</th><th scope="col">Total_Costo_Final</th>');
              }

              $.each(res.documento, function(index,value){
                if (bandera_bloqueo=="1") {
                  //camion que ya llego
                  if (value.bloqueo_2 == '1' ) {

                    $('#camiontabla').append("<tr>"+'     <td> <label class="custom-toggle custom-toggle-default"> <input class="btn-switch" type="checkbox" checked > <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span> </label> </td>      <td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ addCommas((parseFloat(value.cantidad_cierre)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.bultos_ingreso)).toFixed(2)) +" </td><td>"+ addCommas((parseFloat(value.cantidad_ingreso)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cantidad_diferencia)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_ext)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.viu_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.precio_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_adicional_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_final_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_costo)).toFixed(2)) +"</td></tr>");

                  } else {
                    $('#camiontabla').append("<tr>"+'     <td> <label class="custom-toggle custom-toggle-default"> <input class="btn-switch" type="checkbox" > <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span> </label> </td>      <td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ addCommas((parseFloat(value.cantidad_cierre)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.bultos_ingreso)).toFixed(2)) +" </td><td>"+ addCommas((parseFloat(value.cantidad_ingreso)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cantidad_diferencia)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_ext)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.viu_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.precio_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_adicional_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_final_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_costo)).toFixed(2)) +"</td></tr>");

                  }

                  bi+=parseFloat(value.bultos_ingreso);
                  ci+=parseFloat(value.cantidad_ingreso);
                  mm+=parseFloat(value.cantidad_diferencia);
                  tf+=parseFloat(value.total_compra);
                  tcf+= parseFloat(value.total_costo);
                  // $('#camiontabla').append("<tr>"+'<td>  </td>'+"<td></td><td></td><td></td><td></td><td></td><td>"+bi+" </td><td>"+bi+" </td><td>"+mm+"</td><td></td><td></td><td></td><td></td><td>"+tf+"</td><td></td><td></td><td>"+tcf+"</td></tr>");
                } else {
                  //camion que todavia no llega
                  $('#camiontabla').append("<tr>"+'<td style="height: 45px;"><a type="button" value="'+valor+'" class="editar-gestion  btn blue btn-50 darken-1" style="cursor: pointer"> <i class="material-icons dp48">edit</i></a></td><td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ addCommas((parseFloat(value.cantidad_cierre)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.bultos_ingreso)).toFixed(2)) +" </td><td>"+ addCommas((parseFloat(value.cantidad_ingreso)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cantidad_diferencia)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_ext)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.viu_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.precio_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_adicional_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_final_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_costo)).toFixed(2)) +"</td></tr>");


                  bi+=parseFloat(value.bultos_ingreso);
                  ci+=parseFloat(value.cantidad_ingreso);
                  mm+=parseFloat(value.cantidad_diferencia);
                  tf+=parseFloat(value.total_compra);
                  tcf+= parseFloat(value.total_costo);
                }
              });
              $('#camiontabla').append("<tr>"+"<td></td><td></td><td></td><td></td><td></td><td>"+addCommas((parseFloat(bi)).toFixed(2))+" </td><td>"+addCommas((parseFloat(ci)).toFixed(2))+" </td><td>"+addCommas((parseFloat(mm)).toFixed(2))+"</td><td></td><td></td><td></td><td></td><td>"+addCommas((parseFloat(tf)).toFixed(2))+"</td><td></td><td></td><td>"+addCommas((parseFloat(tcf)).toFixed(2))+"</td></tr>");
            }

                  // $('#codigo_oficial').val(res.dato_general[0]['codigo']);
                  // $('#codigo_oficial_real').val(res.dato_general[0]['codigo']);
                  // $('#codigo_auxiliar').val(res.dato_general[0]['codigo_aux']);
                  // $('#nro_de_contenedor').val(res.dato_general[0]['doc_contenedor']);
                  // $('#nro_bl').val(res.dato_general[0]['doc_bl']);
                  // $('#pais_origen').val(res.dato_general[0]['pais_origen']);
                  // $('#descripcion').val(res.dato_general[0]['descripcion']);
                  // $('#contenido').val(res.dato_general[0]['contenido']);
                  // $('#observaciones').val(res.dato_general[0]['observaciones']);
                  // $('#bandera-general').append('<input type="hidden" id="subbandera"  value="2">');
                  //
                  // $('#codigo_oficial_real2').val(res.dato_general[0]['codigo']);
                  // $('#fecha_de_cierre').val(dateUTC(res.dato_general[0]['fecha_cierre']));
                  // $('#fecha_de_embarque_desde').val(dateUTC(res.dato_general[0]['fecha_embarque1']));
                  // $('#fecha_de_embarque_desde_hasta').val(dateUTC(res.dato_general[0]['fecha_embarque2']));
                  // $('#fecha_de_llegada_desde').val(dateUTC(res.dato_general[0]['fecha_llegada1']));
                  // $('#fecha_de_llegada_desde_hasta').val(dateUTC(res.dato_general[0]['fecha_llegada2']));
                  // $('#observacion').val(res.dato_general[0]['observacion_fecha']);
                  //
                  //
                  //
                  // $('#a_cumplirse_a').val(res.dato_general[0]['despues_dias']);
                  // $('#a_cumplirse_a-').val(res.dato_general[0]['despues_fecha']);
                  //
                  // $('#codigo_oficial_real4').val(res.dato_general[0]['codigo']);
                  //
                  // $('#fecha_de_embarque_real').val(dateUTC(res.dato_general[0]['fecha_embarque']));
                  //
                  // $('#fecha_de_llegada').val(dateUTC(res.dato_general[0]['fecha_llegada']));
                  //
                  // $('#resol_sanitaria').val(res.dato_general[0]['resolucion_sanitaria']);
                  // $('#fecha_de_resol_sanitaria').val(dateUTC(res.dato_general[0]['fecha_resolucion']));
                  // $('#forward').val(res.dato_general[0]['forward']);
                  // $('#fecha_forward').val(dateUTC(res.dato_general[0]['forward_fecha']));
                  // $('#fecha_producción_desde').val(dateUTC(res.dato_general[0]['fecha_produccion']));
                  // $('#fecha_producción_desde_hasta').val(dateUTC(res.dato_general[0]['fecha_produccion2']));
                  // $('#fecha_vencimiento_desde').val(dateUTC(res.dato_general[0]['fecha_vencimiento']));
                  // $('#fecha_vencimiento_desde_hasta').val(dateUTC(res.dato_general[0]['fecha_vencimiento2']));
                  //
                  //
                  // $('#codigo_oficial_real5').val(res.dato_general[0]['codigo']);
                  // $('#factura_proveedor').val(res.dato_general[0]['factura_nro']);
                  // $('#cantidad_recibida').val(res.dato_general[0]['cantidad_unidades']);
                  // $('#valor_total').val(res.dato_general[0]['valor_total']);
                  //
                  // $('#clasificacion_de_mercancia').empty();
                  // $.each(res.clasificaciones_camion, function(index,value){
                  //       $('#clasificacion_de_mercancia').append("<option value='"+ value['cod_int'] +"'>"+value['desc01']+"</option>");
                  // });
                  // $('#clasificacion_de_mercancia').val(res.dato_general[0]['clasif_mercancia']);
                  //
                  // $('#proveedor').empty();
                  // $.each(res.proveedor_camion, function(index,value){
                  //       $('#proveedor').append("<option value='"+ value['id_proveedor'] +"'>"+value['emp_nombre']+"</option>");
                  // });
                  // $('#proveedor').val(res.dato_general[0]['proveedor']);
                  //
                  //
                  // $('#marca_origen').empty();
                  // $.each(res.marca_origen, function(index,value){
                  //       $('#marca_origen').append("<option value='"+ value['MARC_CODIGO'] +"'>"+value['MARC_DESCRIPCION']+"</option>");
                  // });
                  // $('#marca_origen').val(res.dato_general[0]['marca_origen']);
                  //
                  // $('#lugar_de_arribo').empty();
                  // $.each(res.lugar_de_arribo, function(index,value){
                  //       $('#lugar_de_arribo').append("<option value='"+ value['ciudad_codigo'] +"'>"+value['descripcion']+"</option>");
                  // });
                  // $('#lugar_de_arribo').val(res.dato_general[0]['lugar_arribo']);
                  //
                  // $('#forma_de_pago').empty();
                  // $.each(res.forma_pago, function(index,value){
                  //       $('#forma_de_pago').append("<option value='"+ value['FRPG_CODIGO'] +"'>"+value['FRPG_DESCRIPCION']+"</option>");
                  // });
                  // $('#forma_de_pago').val(res.dato_general[0]['forma_pago']);
                  //
                  // $('#unidad').empty();
                  // $.each(res.unidad, function(index,value){
                  //       $('#unidad').append("<option value='"+ value['TUME_CODIGO'] +"'>"+value['TUME_DESCR']+"</option>");
                  // });
                  // $('#unidad').val(res.dato_general[0]['tipo_unidades']);
                  //
                  // $('#tipo_de_moneda').empty();
                  // $.each(res.tipo_moneda, function(index,value){
                  //       $('#tipo_de_moneda').append("<option value='"+ value['TMDA_CODIGO'] +"'>"+value['TMDA_DESCRIPCION']+"</option>");
                  // });
                  // $('#tipo_de_moneda').val(res.dato_general[0]['tipo_moneda']);

          }
        });



      });


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
      if($.trim(camion_id) != ''  ){
          $.get('cambiar-bloqueo-camion',{camion_id:camion_id, bloqueo_2_id:bloqueo_2_id},function(res){

            $('#camiontabla-head').empty();
            $('#camiontabla').empty();
           var bi=0;
           var ci=0;
           var mm=0;
           var tf=0;
           var tcf=0;

            $('#camiontabla-head').append('<tr><th width="6%">Bloqueo</th><th scope="col">Nro</th><th scope="col">Cod.</th><th scope="col">Producto</th><th scope="col">Cantidad cierre</th><th scope="col">Bultos ingreso</th><th scope="col">Cantidad ingreso</th><th scope="col">(+/-)</th><th scope="col">C.I.F</th><th scope="col">V.I.U</th><th scope="col">C.I.F(MN)</th><th scope="col">Precio_Compra(MN)</th><th scope="col">Total factura</th><th scope="col">Gastos(MN)</th><th scope="col">CIF tierra(MN)</th><th scope="col">Total_Costo_Final</th>');

            $.each(res, function(index,value){
                 if (value.bloqueo_2 == '1' ) {
                   $('#camiontabla').append("<tr>"+'<td> <label class="custom-toggle custom-toggle-default"> <input class="btn-switch" type="checkbox"  checked> <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span> </label> </td><td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ addCommas((parseFloat(value.cantidad_cierre)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.bultos_ingreso)).toFixed(2)) +" </td><td>"+ addCommas((parseFloat(value.cantidad_ingreso)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cantidad_diferencia)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_ext)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.viu_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.precio_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_adicional_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_final_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_costo)).toFixed(2)) +"</td></tr>");

                 } else {
                   $('#camiontabla').append("<tr>"+'<td> <label class="custom-toggle custom-toggle-default"> <input class="btn-switch" type="checkbox"  > <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span> </label> </td><td>'+ value.nro_item +"</td><td>"+ value.codigo+"</td><td>"+value.producto+" </td><td>"+ addCommas((parseFloat(value.cantidad_cierre)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.bultos_ingreso)).toFixed(2)) +" </td><td>"+ addCommas((parseFloat(value.cantidad_ingreso)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cantidad_diferencia)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_ext)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.viu_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_moneda_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.precio_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_compra)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_adicional_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.cif_final_nal)).toFixed(2)) +"</td><td>"+ addCommas((parseFloat(value.total_costo)).toFixed(2)) +"</td></tr>");

                 }

                bi+=parseFloat(value.bultos_ingreso);
                ci+=parseFloat(value.cantidad_ingreso);
                 mm+=parseFloat(value.cantidad_diferencia);
                 tf+=parseFloat(value.total_compra);
                 tcf+= parseFloat(value.total_costo);
             });
             // tf=parseFloat()+parseFloat();
                $('#camiontabla').append("<tr>"+'<td>  </td>'+"<td></td><td></td><td></td><td></td><td>"+addCommas((parseFloat(bi)).toFixed(2))+" </td><td>"+addCommas((parseFloat(ci)).toFixed(2))+" </td><td>"+addCommas((parseFloat(mm)).toFixed(2))+"</td><td></td><td></td><td></td><td></td><td>"+addCommas((parseFloat(tf)).toFixed(2))+"</td><td></td><td></td><td>"+addCommas((parseFloat(tcf)).toFixed(2))+"</td></tr>");
         });

      }

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
            $.get('switch-item',{bloqueo_2_id:valores[15],camion_id:valores[1],item_id:valores[0] },function(res){

            });


          }else{
                valores[i]=0;
              $.get('switch-item',{bloqueo_2_id:valores[15],camion_id:valores[1],item_id:valores[0] },function(res){

              });

        }

      });

// ------------------------------------------------------
// ------------------------------------------------------

    function NumericoDecimal(number)
    {
          if ( number != null) {
              return  addCommas((parseFloat(number)).toFixed(2)) ;
          } else {
            return '-';
          }
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

      function dateUTC(ms) {
        var ms, fecha,año, mes, dia, hora, minuto, segundo;
        // ms= res.dato_general[0]['fecha_embarque1']+' UTC';

        ms = new Date(ms);

        año=ms.getUTCFullYear();
        mes=ms.getUTCMonth()+1;
        dia=ms.getUTCDate();
        hora=ms.getUTCHours()-3;
        minuto=ms.getUTCMinutes();
        segundo=ms.getUTCSeconds();
        fecha= año+'-'+ pad(mes) +'-'+ pad(dia);
        return fecha;
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


  $(document).ready(function(){
      function asignarEventoModalCeldas(){
        $('.mostrar-info').click(function(){
          var data=$(this).data();
          // console.log(data);
          // debugger
          $('#formalModal #codigo').val(data.codigo);
          $('#formalModal #descripcion').val(data.descripcion);
          $('#formalModal #camion').val(data.camion);
          $('#formalModal #publico').val(data.publico);
          $('#formalModal #mayor').val(data.mayor);
          //  fecha_baja= fecha_baja.datepicker.formatDate( "mm/dd/yyyy", new Date(data.fecha_baja));
          $('#formalModal #fecha_baja').val(data.fecha_baja);
          // interval= $('#formalModal #interval').val(data.interval);
          interval=Math.floor(data.interval);
          console.log(interval);
          if (interval<0) {
              $('#formalModal .modal-title').text('Modificar precio (La oferta expiro hace  '+Math.abs(interval)+' horas)');
              $('#formalModal .modal-header').css("border-bottom", "1px solid var(--danger)");
              $('#formalModal .modal-title').css("color", "var(--danger)");
              // console.log(data.fecha_baja);

          }else if(interval==0) {
              $('#formalModal .modal-title').text('Modificar precio (Es una nueva oferta)');
              $('#formalModal .modal-header').css("border-bottom", "1px solid #565cc0");
              $('#formalModal .modal-title').css("color", "#565cc0");
              // console.log(data.fecha_baja);

          }else if(interval<=24) {
              $('#formalModal .modal-title').text('Modificar precio (Quedan menos de '+interval+' horas)');
              $('#formalModal .modal-header').css("border-bottom", "1px solid var(--yellow)");
              $('#formalModal .modal-title').css("color", "var(--yellow)");
              // console.log(data.fecha_baja);

          }else if(interval<=48) {
              $('#formalModal .modal-title').text('Modificar precio (Quedan menos de '+interval+' horas)');
              $('#formalModal .modal-header').css("border-bottom", "1px solid var(--success)");
              $('#formalModal .modal-title').css("color", "var(--success)");
              // console.log(data.fecha_baja);

          }
          $('#formalModal').modal('show');
      });
    }

      $('#actualizar_precio').on('submit', function(event){
        // form_=new FormData(this);
        event.preventDefault();
        var form_url= $(this).attr('action'),
        form_data=new FormData(this);

        var id_camion=$('#actualizar_precio input[name=camion]').val();
        form_data.append('id_camion', id_camion);
        var   id_corte=$('#actualizar_precio input[name=codigo]').val();
        form_data.append('id_corte', id_corte);

        var clasificacion=$('select#sel1').val();
        form_data.append('clasificacion', clasificacion);
        // debugger
        // console.log(json);
        // for (var value of form_data.values()) {
        //   console.log(value);
        // }
        bootbox.confirm("¿Esta seguro que quiere actualizar los datos?", function(result){
          console.log('This was logged in the callback: ' + result);

        if (($('input#action_button').val()=='Actualizar Datos') && (result==true))
        {


          var request = $.ajax({
            url: form_url,
            method:"POST",
            data: form_data,
            contentType:false,
            // context: document.body,
            cache:false,
            processData: false,
            responseText: true,
            // dataType: "html",
          })

          request.done(function( response ) {
            // $( "#log" ).html( response );
            // console.log(response);
            // activar loader
            $('div.loader-6').removeClass('d-none');

            $('div#table-precio-camion').html(response);
            $('#formalModal').modal('hide');

            // desactivar loader
            setTimeout(function() {$('div.loader-6').addClass('d-none'); }, 1500);
            // asignar evento a celdas
            $('.mostrar-info').click(function(){
              var data=$(this).data();
              console.log(data);
              $('#formalModal #codigo').val(data.codigo);
              $('#formalModal #descripcion').val(data.descripcion);
              $('#formalModal #camion').val(data.camion);
              $('#formalModal #publico').val(data.publico);
              $('#formalModal #mayor').val(data.mayor);
              $('#formalModal').modal('show');
           });
          });

          request.fail(function( jqXHR, textStatus ) {
            console.log(jqXHR.responseText,textStatus);
            alert( "Request failed: " + textStatus + jqXHR.responseText);
          });
        }
        });
      });



      $('#clasificacion').on('change', function(){
        var clasificacion_id = $(this).val();
        // var anio_id = $(anio).val();

        // console.log(camion_id);
        if($.trim(clasificacion_id) != ''){
            $.get('obtener-camion',{clasificacion_id:clasificacion_id },function(res){

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
        if($.trim(clasificacion_id) != ''){
            request=$.get('obtener-camion-r',{clasificacion_id:clasificacion_id },function(res){

                $('#camionr').empty();
                $('#camionr').append("<option value=''> Seleccione un camión </option>");
                // $('#camiontabla').append("<tr><td>aaaaaaaaaaa</td></tr>");
                $.each(res, function(index,value){
                  // $(res).each(function(key,value){
                    // $('#camiontabla').append("<tr><td>"+ value.codigo +"</td><td>"+ value.descripcion+"</td><td>"+ value.cierre_cantidad +"</td><td>"+ value.monto_cierre +"</td><td>"+ value.ingreso_cantidad +"</td></tr>");
                    if (value != 'Camiones no encontrados') {
                      $('#camionr').append("<option value='"+ index +"'>"+ value +"</option>");
                    } else {
                      $('#camionr').empty();
                      $('#camionr').append("<option value=''> Camiones no encontrados </option>");
                    }
                });

          });


          request.done(function( msg ) {
            // $( "#log" ).html( msg );
            console.log(msg);
          });

          request.fail(function( jqXHR, textStatus ) {
            console.log(jqXHR.responseText,textStatus);
            alert( "Request failed: " + textStatus + jqXHR.responseText);
          });
        }
      });

      $('#camion').on('change', function(){
        var camion_id = $(this).val();

        // console.log(camion_id);
        if($.trim(camion_id) != ''){
            $.get('tabla-camion',{camion_id:camion_id },function(res){
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

          // request.fail(function( jqXHR, textStatus ) {
          //   console.log(jqXHR.responseText,textStatus);
          //   alert( "Request failed: " + textStatus + jqXHR.responseText);
          // });



        }
      });

      $('#camionr').on('change', function(){
        var camion_id = $(this).val();

        // console.log(camion_id);
        if($.trim(camion_id) != ''){
            request=$.get('tabla-camion-r',{camion_id:camion_id },function(res){
             $('#camiontabla').empty();
            var bi=0;

            var ci=0;

            var mm=0;
            // value.cantidad_diferencia
            var tf=0;
            // value.total_compra
            var tcf=0;
            // value.total_costo
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


          request.done(function( msg ) {
            // $( "#log" ).html( msg );
            console.log(msg);
          });

          request.fail(function( jqXHR, textStatus ) {
            console.log(jqXHR.responseText,textStatus);
            alert( "Request failed: " + textStatus + jqXHR.responseText);
          });

        }
      });

// ----------------------------------------------------
      $('#create_record').click(function(){
        // console.log('Se cliqueoooo');
        $('#formModal').modal('show');
      });
// ----------------------------------------------------
      $('#sample_form').on('submit',function(event){
        event.preventDefault();

        // $('#sample_form')[0].reset();
        // $('#form_result').html();

        var action_url = '';

        if ($('#action').val() == 'Add')
        {
            action_url = "{{ route('GestionCamionController.updateitem')}}";
        }
        if ($('#action').val() == 'Editar')
        {
            action_url = 'actualizar-camion';
        }

        request=$.ajax({
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
                html= '<div class="alert alert-success">'+ data.success+'</div>';
                $('#sample_form')[0].reset();
                // $('#user_table').DataTable().ajax.reload();
                // $('#tabla-load').load();
                // $('#tabla-load').html(response);
            }
            $('#form_result').html(html);
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

      // $('.editar-gestion').on('click',function(){
      //   console.log('se clicqueoooooo');
      // });

// --------------------------------------------------

      $(document).on('click','.editar-gestion',function(){

        var valores = new Array();
        var i=0, j=1;

          $(this).parents("tr").find("td").each(function(){
            if (j>2) {
              valores[i] =$(this).html();
              i++;
            }
            j++;
          });

        // $('#formModal').modal('show');
        // console.log(valores);

        $('#nro_item').val(valores[0]);
        $('#nro_itemreal').val(valores[0]);
        $('#codigo').val(valores[1]);
        $('#codigoreal').val(valores[1]);
        $('#cantidad_cierre').val(valores[3]);
        $('#bultos_ingreso').val(valores[4]);
        $('#cantidad_ingreso').val(valores[5]);

        $('#formModal').modal('show');


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

$(document).on('change','.btn-switch',function(){

      var valores = new Array();
      var id_bloque_2;
      var i=0, j=1;

        $(this).parents("tr").find("td").each(function(){
          if (j>2) {
            valores[i] =$(this).html();
            i++;
          }
          j++;

        });
        // i++;
     if($(this).prop("checked") == true){
       valores[i]=1;
     // console.log(valores[15]);
            request=$.get('switch-item',{bloqueo_2_id:valores[15],camion_id:valores[1],item_id:valores[0] },function(res){
              console.log('actualizoooooo');
            });

            request.done(function( msg ) {
              // $( "#log" ).html( msg );
              console.log(msg);
            });

            request.fail(function( jqXHR, textStatus ) {
              console.log(jqXHR.responseText,textStatus);
              alert( "Request failed: " + textStatus + jqXHR.responseText);
            });


          }else{
                valores[i]=0;
              // console.log(valores[15]);
              request=$.get('switch-item',{bloqueo_2_id:valores[15],camion_id:valores[1],item_id:valores[0] },function(res){
                console.log('actualizoooooo');
              });


                request.done(function( msg ) {
                  // $( "#log" ).html( msg );
                  console.log(msg);
                });

                request.fail(function( jqXHR, textStatus ) {
                  console.log(jqXHR.responseText,textStatus);
                  alert( "Request failed: " + textStatus + jqXHR.responseText);
                });
        }

      });

// ------------------------------------------------------------------------

  $(document).on('click','.editar-gestion',function(){

    var valores = new Array();
    var i=0, j=1;

      $(this).parents("tr").find("td").each(function(){
        if (j>2) {
          valores[i] =$(this).html();
          i++;
        }
        j++;
      });

          $('#nro_item').val(valores[0]);
          $('#nro_itemreal').val(valores[0]);
          $('#codigo').val(valores[1]);
          $('#codigoreal').val(valores[1]);
          $('#cantidad_cierre').val(valores[3]);
          $('#bultos_ingreso').val(valores[4]);
          $('#cantidad_ingreso').val(valores[5]);

          $('#formModal').modal('show');

        });
// ------------------------------------------------------
  });

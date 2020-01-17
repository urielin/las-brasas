
  $(document).ready(function(){
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

      $('#anio').on('change', function(){
        var anio_id = $(this).val();
        // console.log(anio_id);
        if($.trim(anio_id) != ''){
          request=$.get('obtener-camion',{anio_id:anio_id},function(camiones){
             $('#camion').empty();
             $('#camion').append("<option value=''> Seleccione un camión </option>");
             $.each(camiones, function(index,value){
                $('#camion').append("<option value='"+ value +"'>"+ value +"</option>");

             })
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
            request=$.get('tabla-camion',{camion_id:camion_id},function(res){
             $('#camiontabla').empty();
             // $('#camiontabla').append("<tr><td>aaaaaaaaaaa</td></tr>");
             $(res).each(function(key,value){
                $('#camiontabla').append("<tr><td>"+ value.id_camion +"</td><td>"+ value.codigo+"</td><td>"+ value.fecha_llegada +"</td><td>"+ value.descripcion +"</td><td>"+ value.contenido +"</td></tr>");
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

  });

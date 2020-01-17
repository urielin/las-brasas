
  $(document).ready(function(){
      $('.mostrar-info').click(function(){
         $('#formalModal').modal('show');
      });

      $('#sample_form').on('submit', function(event){
        event.preventDefault();
        // if ($('#action').val()=='Add')
        // {
        //   $.ajax({
        //     url:"aqui va la ruta en blade",
        //     method:"POST",
        //     data: new FormData(this),
        //     contentType:false,
        //     cache:false,
        //     processData: false,
        //     dataType:"json",
        //
        //   })
        // }
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
                // $('#camiontabla').append("<tr><td>"+ value.id_camion +"</td><td>"+ value.codigo+"</td><td>"+ value.fecha_llegada +"</td><td>"+ value.descripcion +"</td><td>"+ value.contenido +"</td></tr>");
                $('#camiontabla').append("<tr><td>"+ value.zeta +"</td><td>"+ value.nro_traslado+"</td><td>"+ value.fecha_viza +"</td><td>"+ value.tipo_traslado +"</td><td>"+ value.tipo_moneda +"</td></tr>");

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

      // $('#buscar-codigo-camion').on('submit', function(){
      //   var camion_cod = $(this).val();
      //   // console.log(camion_id);
      //   if($.trim(camion_cod) != ''){
      //       request=$.get('ver-camion',{camion_cod:camion_id},function(res){
      //        $('#camiontabla').empty();
      //        // $('#camiontabla').append("<tr><td>aaaaaaaaaaa</td></tr>");
      //        $(res).each(function(key,value){
      //           // $('#camiontabla').append("<tr><td>"+ value.id_camion +"</td><td>"+ value.codigo+"</td><td>"+ value.fecha_llegada +"</td><td>"+ value.descripcion +"</td><td>"+ value.contenido +"</td></tr>");
      //           $('#camiontabla').append("<tr><td>"+ value.zeta +"</td><td>"+ value.nro_traslado+"</td><td>"+ value.fecha_viza +"</td><td>"+ value.tipo_traslado +"</td><td>"+ value.tipo_moneda +"</td></tr>");
      //
      //        });
      //
      //     });
      //
      //
      //     request.done(function( msg ) {
      //       // $( "#log" ).html( msg );
      //       console.log(msg);
      //     });
      //
      //     request.fail(function( jqXHR, textStatus ) {
      //       console.log(jqXHR.responseText,textStatus);
      //       alert( "Request failed: " + textStatus + jqXHR.responseText);
      //     });
      //
      //
      //
      //   }
      // });

  });

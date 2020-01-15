
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
          $.get('obtener-camion',{anio_id:anio_id},function(camiones){
             $('#camion').empty();
             $('#camion').append("<option value=''> Seleccione un camión </option>");
             $.each(camiones, function(index,value){
                $('#camion').append("<option value='"+ value +"'>"+ value +"</option>");

             })
          });
        }
      });

      $('#camion').on('change', function(){
        var camion_id = $(this).val();
        // console.log(camion_id);
        if($.trim(camion_id) != ''){
          $.get('tabla-camion',{camion_id:camion_id},function(res){
             $('#camiontabla').empty();
             // $('#camiontabla').append("<tr><td>aaaaaaaaaaa</td></tr>");
             $(res).each(function(key,value){
                $('#camiontabla').append("<tr><td>"+ value.camion +"</td><td>"+ value.descripcion +"</td><td>"+ value.cantidad +"</td><td>"+ value.moneda +"</td><td>"+ value.costo +"</td></tr>");
             });

          });
        }
      });

      $('#camio').on('change', function(){
        var camion_id = $(this).val();
        // console.log(camion_id);
        // console.log(camion_id);
        // if($.trim(camion_id) != ''){
          $.get('tabla-camion',{camion_id:camion_id},function(camioninfo){
            // console.log('Cliqueo al camion para luego mostrar la tabla');
             // $('#camiontable').empty();
             // $('#camiontable').append("<option value=''> Seleccione un camión </option>");
             // $.each(camioninfo, function(index,value){
             $(camioninfo).each(function(key,value){

                $('#camiontable').append("<tr><td>"+value[1]+"</td></tr>");
                console.log(value);
             });
          });
        // }
      });

  });


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
        if($.trim(anio_id) != ''){
          $.get('obtener-camion',{anio_id:anio_id},function(camiones){
             $('#camion').empty();
             $('#camion').append("<option value=''> Seleccione un camión </option>");
             $.each(camiones, function(index,value){
                $('#camion').append("<option value='"+ index +"'>"+ value +"</option>");
             })
          });
        }
      });

  });

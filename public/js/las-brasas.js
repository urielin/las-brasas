
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
  });

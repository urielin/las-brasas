
$(document).ready(function(){
    $('#pc_sucursal').on('change', function(event){
        event.preventDefault();
          var request = $.ajax({
            url: "{{route('precio-camion')}}",
            method:"POST",
            data: form_data,
            contentType:false,
            cache:false,
            processData: false,
            responseText: true,
          })

          request.done(function( response ) {
            console.log(response);
   
          });

          request.fail(function( jqXHR, textStatus ) {
            console.log(jqXHR.responseText,textStatus);
            alert( "Request failed: " + textStatus + jqXHR.responseText);
          });

    });
});

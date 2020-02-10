
$(document).ready(function(){
    $('#formalModal #fecha_baja').datepicker({
      container: 'body',
      format: 'dd/mm/yyyy'
    })
    function asignarEventoModalCeldas(){
      $('.mostrar-info').click(function(){
        var data=$(this).data();
        console.log(data);
        // debugger
        $('#formalModal #codigo').val(data.codigo);
        $('#formalModal #descripcion').val(data.descripcion);
        $('#formalModal #camion').val(data.camion);
        $('#formalModal #publico').val(data.publico);
        $('#formalModal #mayor').val(data.mayor);
        var element = document.querySelector('#formalModal #fecha_baja');
        M.Datepicker.getInstance(element).setDate(new Date(data.fecha_baja));
        //  fecha_baja= fecha_baja.datepicker.formatDate( "mm/dd/yyyy", new Date(data.fecha_baja));
        // $('#formalModal #fecha_baja').val(data.fecha_baja);
        // $('#formalModal #fecha_baja').setDate(new Date(data.fecha_baja));
        // interval= $('#formalModal #interval').val(data.interval);
        interval=Math.floor(data.interval);
        console.log(interval);
        if (interval<0) {
            $('#formalModal .modal-title').text('Modificar precio (La oferta expiro hace  '+Math.abs(interval)+' horas)');
            $('#formalModal .modal-header').css("border-bottom", "1px solid var(--danger)");
            $('#formalModal .modal-title').css("color", "var(--danger)");
            // console.log(data.fecha_baja);

        }else if(interval==0) {
            // $('#formalModal .modal-title').text('Modificar precio (Es una nueva oferta)');
            // $('#formalModal .modal-header').css("border-bottom", "1px solid #565cc0");
            // $('#formalModal .modal-title').css("color", "#565cc0");
            // console.log(data.fecha_baja);

        }else if(interval<=48) {
            $('#formalModal .modal-title').text('Modificar precio (Quedan menos de '+interval+' horas)');
            $('#formalModal .modal-header').css("border-bottom", "1px solid var(--yellow)");
            $('#formalModal .modal-title').css("color", "var(--yellow)");
            // console.log(data.fecha_baja);

        }else if(interval<=168) {
            $('#formalModal .modal-title').text('Modificar precio (Quedan menos de '+interval+' horas)');
            $('#formalModal .modal-header').css("border-bottom", "1px solid var(--success)");
            $('#formalModal .modal-title').css("color", "var(--success)");
            // console.log(data.fecha_baja);

        }
        $('#formalModal').modal('open');
    });
  }
  asignarEventoModalCeldas();

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
          $('#formalModal').modal('close');

          // desactivar loader
          setTimeout(function() {$('div.loader-6').addClass('d-none'); }, 1500);
          // asignar evento a celdas
          asignarEventoModalCeldas();
        });

        request.fail(function( jqXHR, textStatus ) {
          console.log(jqXHR.responseText,textStatus);
          alert( "Request failed: " + textStatus + jqXHR.responseText);
        });
      }
      });
    });

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

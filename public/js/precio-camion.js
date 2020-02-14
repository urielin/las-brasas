
$(document).ready(function(){
    // $('#pc-modal #fecha_baja').datepicker({
    //   container: 'body',
    //   format: 'dd/mm/yyyy'
    // })
    function asignarEventoModalCeldas(){
      $('.mostrar-info').click(function(){
        var data=$(this).data();
        console.log(data);
        // debugger
        $('#pc-modal #codigo').val(data.codigo);
        $('#pc-modal #descripcion').val(data.descripcion);
        $('#pc-modal #camion').val(data.camion);
        $('#pc-modal #publico').val(data.publico);
        $('#pc-modal #mayor').val(data.mayor);
        // var element = document.querySelector('#pc-modal #fecha_baja');
        // M.Datepicker.getInstance(element).setDate(new Date(data.fecha_baja));
        // fecha_baja= fecha_baja.datepicker.formatDate( "mm/dd/yyyy", new Date(data.fecha_baja));
        $('#pc-modal #fecha_baja').val(data.fecha_baja);
        // $('#pc-modal #fecha_baja').setDate(new Date(data.fecha_baja));
        // interval= $('#pc-modal #interval').val(data.interval);
        interval=Math.floor(data.interval);
        $('#pc-modal #cif_tierra').val(data.cif_tierra);
        console.log(interval);
        if (interval<0) {
            $('#pc-modal .modal-title').html('Modificar precio <br>(La oferta expiro hace  '+Math.abs(interval)+' horas)');
            $('#pc-modal .modal-header').css("border-bottom", "1px solid red");
            //$('#pc-modal .modal-title').css("color", "red");
            // console.log(data.fecha_baja);

        }else if(interval==0) {
            // $('#pc-modal .modal-title').html('Modificar precio (Es una nueva oferta)');
            // $('#pc-modal .modal-header').css("border-bottom", "1px solid #565cc0");
            // $('#pc-modal .modal-title').css("color", "#565cc0");
            // console.log(data.fecha_baja);

        }else if(interval<=48) {
            $('#pc-modal .modal-title').html('Modificar precio <br>(Quedan menos de '+interval+' horas)');
            $('#pc-modal .modal-header').css("border-bottom", "1px solid yellow");
            //$('#pc-modal .modal-title').css("color", "yellow");
            // console.log(data.fecha_baja);

        }else if(interval<=168) {
            $('#pc-modal .modal-title').html('Modificar precio <br>(Quedan menos de '+interval+' horas)');
            $('#pc-modal .modal-header').css("border-bottom", "1px solid green");
            //$('#pc-modal .modal-title').css("color", "green");
            // console.log(data.fecha_baja);

        }
        $('#pc-modal').modal('open');

    });
    //  asignar toltip mensaje de ayuda
    $('.tooltipped').tooltip();
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

      var clasificacion=$('select#pc_clasificacion').val();
      form_data.append('clasificacion', clasificacion);
      var sucursal=$('select#pc_sucursal').val();
      form_data.append('sucursal', sucursal);
      // debugger
      // console.log(json);
      console.log(...form_data)
      // for (var value of form_data.values()) {
      //   console.log(value);
      // }
      // bootbox.confirm("¿Esta seguro que quiere actualizar los datos?", function(result){
        // console.log('This was logged in the callback: ' + result);
        Swal.fire({
          title: '¿Esta seguro de guardar los cambios?',
          text: "",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, Actualizar'
        }).then((result) => {
          if (($('input#action_button').val()=='Actualizar Datos') &&(result.value)){
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
              console.log(response);
              // activar loader
              // $('div.loader-6').removeClass('d-none');
    
              $('div#table-precio-camion').html(response);
              $('#pc-modal').modal('close');
    
              // desactivar loader
              // setTimeout(function() {$('div.loader-6').addClass('d-none'); }, 1500);
              // asignar evento a celdas
              asignarEventoModalCeldas();
            });
    
            request.fail(function( jqXHR, textStatus ) {
              // console.log(jqXHR.responseText,textStatus);
              alert( "Request failed: " + textStatus + jqXHR.responseText);
            });
          }
        })
        //

      // });
    });

    $('select#pc_sucursal, select#pc_clasificacion').on('change', function(event){
    // $('#buscar-precio-camion').on('submit', function(event){
          event.preventDefault();
          var form_url= $("#buscar-precio-camion").attr('action'),
          form_data=new FormData($("#buscar-precio-camion")[0]);
          // clasificacion=$("#pc_clasificacion").val(); 
          // form_data=new FormData();
          // form_data.append('sucursal', sucursal);
          // form_data.append('sucursal', clasificacion);
          console.log(...form_data)
          // debugger
          var request = $.ajax({
            url: form_url,
            method:"post",
            data: form_data,
            contentType:false,
            cache:false,
            processData: false,
            responseText: true,
          })

          request.done(function( response ) {
            // console.log(response);
            $('div#table-precio-camion').html(response);
            asignarEventoModalCeldas();
   
          });

          request.fail(function( jqXHR, textStatus ) {
            console.log(jqXHR.responseText,textStatus);
            // alert( "Request failed: " + textStatus + jqXHR.responseText);
          });

    });
});

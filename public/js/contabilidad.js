$(document).ready(function(){

    $(document).on('click','#buscar-salida-bancos',function(){

          var fecha1=$('#desde1').val();
          var fecha2=$('#hasta1').val();
          // console.log(fecha1);
          // console.log(fecha2);

        if($.trim(fecha1) != '' && $.trim(fecha2) != '' ){

              request = $.get('obtener-retiro',{fecha1:fecha1,fecha2:fecha2 },function(res){
                  // $('#retiro-head').empty();
                  $('#retiroTabla').empty();
                  $.each(res.retiros, function(index,value){
                      $('#retiroTabla').append('<tr id="mostrar-detalle">'+'<td>' + value.id_retiros_indice +'</td><td>'+ value.TP_RET_DESCRIPCION +"</td><td>"+ value.fecha_desde+"</td><td>"+value.fecha_hasta+" </td><td>"+ value.doc_cantidad +"</td><td>"+ value.monto_total +" </td><td>"+ value.estado +"</td><td>"+ value.fecha_cierre +"</td><td>"+ value.usuario_cierre +"</td><td>"+ value.observacion +"</td></tr>");
                  });


              request.done(function( msg ) {
                // $( "#log" ).html( msg );
                console.log(msg);
              });

              request.fail(function( jqXHR, textStatus ) {
                console.log(jqXHR.responseText,textStatus);
                alert( "Request failed: " + textStatus + jqXHR.responseText);
              });
          });
        }
      });
// -------------------------------------------------------------
$(document).on('click','#mostrar-detalle',function(){

      var fecha1=$('#desde1').val();
      var fecha2=$('#hasta1').val();
      var montoTotal= 0;
      // console.log(fecha1);
      // console.log(fecha2);

    if($.trim(fecha1) != '' && $.trim(fecha2) != '' ){

          request = $.get('obtener-retiro-detalle',{fecha1:fecha1,fecha2:fecha2 },function(res){
              // $('#retiro-head').empty();
              $('#icono1').empty();
              $('#depositoDetalleHead').empty();
              $('#depositoDetalleTabla').empty();

              $('#icono1').append('<div style="display: flex"><i class="material-icons dp48">subject</i><span class="card-title">Detalle Retiro Prosegur</span></div>');
              $('#depositoDetalleHead').append('<tr><th width="6%">Folio</th><th>Tipo</th><th>Operación</th><th>Suc</th><th>Nombre Sucursal</th><th>Caja</th><th>Nro. Deposito</th><th>Fecha</th><th>Monto</th><th>Observaciones</th><th>Fecha Cartola</th><th>Eliminar</th></tr>');
              $.each(res.depositosDetalle, function(index,value){

                  if (value.tipo == "1") {
                    $('#depositoDetalleTabla').append('<tr><td>' + value.folio +'</td><td>RETIROS DIARIOS</td><td>'+ value.OPER_DESC+"</td><td>"+value.SUCU_CODIGO+" </td><td>"+ value.SUCU_NOMBRE +"</td><td> - </td><td> - </td><td>"+ value.fecha_ingreso +" </td><td>"+ value.monto +"</td><td>"+ value.descripcion +"</td><td>"+ value.cartola_fecha +"</td><td>X</td></tr>");
                  } else {
                    $('#depositoDetalleTabla').append('<tr><td>' + value.folio +'</td><td>OTROS DEPOSITOS</td><td>'+ value.OPER_DESC+"</td><td>"+value.SUCU_CODIGO+" </td><td>"+ value.SUCU_NOMBRE +"</td><td> - </td><td> - </td><td>"+ value.fecha_ingreso +" </td><td>"+ value.monto +"</td><td>"+ value.descripcion +"</td><td>"+ value.cartola_fecha +"</td><td>X</td></tr>");
                  }
                  if (value.monto == null) {
                    montoTotal+=0;
                  } else {
                      montoTotal+=parseFloat(value.monto);
                  }
              });
              $('#depositoDetalleTabla').append("<tr><td></td><td></td><td></td><td> </td><td></td><td></td><td></td><td></td><td>"+ montoTotal +"</td><td></td><td></td><td></td></tr>");

          request.done(function( msg ) {
            // $( "#log" ).html( msg );
            console.log(msg);
          });

          request.fail(function( jqXHR, textStatus ) {
            console.log(jqXHR.responseText,textStatus);
            alert( "Request failed: " + textStatus + jqXHR.responseText);
          });
      });
    }
  });
// -------------------------------------------------------------
$(document).on('click','#buscar-otros-depositos',function(){

      var fecha1=$('#desde2').val();
      var fecha2=$('#hasta2').val();
      var montoOtroTotal= 0;
      // console.log(fecha1);
      // console.log(fecha2);

    if($.trim(fecha1) != '' && $.trim(fecha2) != '' ){

          request = $.get('obtener-otro-retiro',{fecha1:fecha1,fecha2:fecha2 },function(res){
                  console.log(res);
              $('#otroRetiroTabla').empty();
              $.each(res.otrosRetiros, function(index,value){
                  $('#otroRetiroTabla').append('<tr><td>' + value.folio +'</td><td>'+ value.fecha_ingreso +"</td><td>"+ value.descripcion+"</td><td>"+value.SUCU_NOMBRE+" </td><td>"+ value.OPER_DESC +"</td><td>"+ value.usuario +" </td><td> - </td><td>"+ value.monto +"</td></tr>");
                  if (value.monto == null) {
                    montoOtroTotal+=0;
                  } else {
                      montoOtroTotal+=parseFloat(value.monto);
                  }
              });
              $('#otroRetiroTabla').append("<tr><td></td><td></td><td></td><td></td><td></td><td></td><td> - </td><td>"+ montoOtroTotal +"</td></tr>");



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
// -------------------------------------------------------------

});

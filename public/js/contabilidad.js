$(document).ready(function(){

  $("#tableRetiroProsegur tbody").on('click','tr', function(e){
    $(this).addClass('tr-selected').siblings().removeClass('tr-selected');
  });
});

$(document).ready(function(){

$(document).on('click','#buscar-salida-bancos',function(){
          var fecha1=$('#desde1').val();
          var fecha2=$('#hasta1').val();
          var cantidad= 0 , monto= 0;
          // console.log({fecha1:fecha1,fecha2:fecha2 });
        if($.trim(fecha1) != '' && $.trim(fecha2) != '' ){
              $('#icono1').empty();
              $('#depositoDetalleHead').empty();
              $('#depositoDetalleTabla').empty();
              request = $.get('obtener-retiro',{fecha1:fecha1,fecha2:fecha2 },function(res){
                  // $('#retiro-head').empty();
                  $('#retiroTabla').empty();
                  $.each(res.retiros, function(index,value){

                      btn_report = '<a data-id="'+value.id_retiros_indice +'" data-fecha1="'+dateUTC(value.fecha_desde)+'" data-fecha2= "'+dateUTC(value.fecha_hasta) +'" type="button" value="" class="get-pdf-report btn blue btn-50 darken-1" href="#"> <i class="material-icons dp48">picture_as_pdf</i></a>';

                      if (value.estado == '1') {
                        $('#retiroTabla').append('<tr class="mostrar-detalle"><td>' +value.id_retiros_indice +'</td><td>'+ value.TP_RET_DESCRIPCION +"</td> <td>"+ dateUTC(value.fecha_desde) +"</td><td>"+ dateUTC(value.fecha_hasta) +"</td> <td>COMPLETO</td><td>"+ dateUTC(value.fecha_cierre) +"</td><td>"+ value.usuario_cierre +"</td><td>"+ value.observacion +"</td><td>"+parseFloat(value.doc_cantidad)+"</td><td>"+ addCommas((parseFloat(value.monto_total)).toFixed(2))+"</td><td>" + btn_report +"</td></tr>");
                      } else {
                        $('#retiroTabla').append('<tr class="mostrar-detalle"><td>' +value.id_retiros_indice +'</td><td>'+ value.TP_RET_DESCRIPCION +"</td> <td>"+ dateUTC(value.fecha_desde) +"</td><td>"+ dateUTC(value.fecha_hasta) +"</td> <td> </td><td>INCOMPLETO</td><td>"+ dateUTC(value.fecha_cierre) +"</td><td>"+ value.usuario_cierre +"</td><td>"+ value.observacion +"</td><td>"+parseFloat(value.doc_cantidad)+"</td><td>"+ addCommas((parseFloat(value.monto_total)).toFixed(2))+"</td><td>" + btn_report +"</td></tr>");
                      }

                      cantidad+=parseFloat(value.doc_cantidad);
                      monto+=parseFloat(value.monto_total);
                  });

                  $('#retiroTabla').append('<tr ><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>TOTAL</td><td>'+ cantidad+'</td><td>'+ addCommas((monto).toFixed(2))+"</td></tr>");

          });
          request.done(function( msg ) {
            // $( "#log" ).html( msg );
            console.log(msg);
            console.log("get completado");
            habilitar_boton_pdf();
          });

          request.fail(function( jqXHR, textStatus ) {
            //console.log(jqXHR.responseText,textStatus);
            alert( "Request failed: " + textStatus + jqXHR.responseText);
          });
        }
      });


function habilitar_boton_pdf() {

  $("a.get-pdf-report").on('click',function() {
    id_retiros=$(this).attr('id');
    var data=$(this).data();
    // console.log(data);
    window.open( 'reporte-prosegur-resumen/'+data.fecha1+'/'+data.fecha2+'/',"_blank").focus();


  });
}

//-------------------------------------------------
$('#table-detalle').on('click','.eliminar-item',function(){

      var id_retiro_detalle = $(this).attr('data-id');
      var row= $(this).parents("tr");

       request=$.get('eliminar-item',{id_retiro_detalle:id_retiro_detalle },function(res){

            if (res.b == 'eliminado') {
                  row.remove();
            } else {
              alerta('error','No se puede eliminar este depósito')
               // alert("No se puede eliminar este depósito");
            }
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

  // -------------------------------------------------------------
  $(document).on('click','#incluir-deposito',function(){

      var texto= $('#text-deposito').val();
      var id_retiro_indice = $(this).attr('data-id_retiros_indice');
      var fecha1 = $(this).attr('data-fecha_1');
      var fecha2 = $(this).attr('data-fecha_2');
      var montoTotal= 0;
      var valores;

      console.log("------------------");
      // console.log();
    // $(".eliminar-item").parents("tr").each(function(){
    //         valores+=$(this).html()+"\n";
    //     });
      valores = $(".eliminar-item").parents("tr")[2];
      console.log(valores.find());
      console.log("------------------");

      if($.trim(texto) != '' &&  $.trim(id_retiro_indice) != '' ){
         $.get('deposito-incluir-deposito',{texto:texto,id_retiro_indice:id_retiro_indice, fecha1:fecha1 ,fecha2:fecha2 },function(res){

              if (res.resultado == '0') {
                    if (res.depositoIncluir != '') {
                          $('#icono1').empty();
                          // $('#depositoDetalleHead').empty();
                          // $('#depositoDetalleTabla').empty();
                          $('#icono1').append('<div style="display: flex"><i class="material-icons dp48">subject</i><span class="card-title">Detalle Retiro Prosegur</span></div>');
                          // $('#depositoDetalleHead').append('<tr><th width="6%">Folio</th><th width="10%">Tipo</th><th width="10%">Operación</th><th>Suc</th><th width="10%">Nombre sucursal</th><th width="5%">Caja</th><th>Deposito</th><th width="11%">Fecha</th><th width="7%">Monto</th><th  width="11%">Observacion</th><th width="8%">Fecha cartola</th><th>Acción</th></tr>');

                          $.each(res.depositosDetalle1, function(index,value){

                                // $('#depositoDetalleTabla').append('<tr><td>' + value.folio +'</td><td>RETIROS DIARIOS</td><td>'+ value.OPER_DESC +"</td><td>"+value.id_sucursal +"</td><td>"+value.SUCU_NOMBRE+"</td><td>"+ value.num_caja+"</td><td>"+value.n_deposito +"</td><td>"+ dateUTC(value.fecha_caja) +" </td><td>"+addCommas((parseFloat(value.monto)).toFixed(2)) +"</td><td>"+ value.obs +"</td><td>"+ dateUTC(value.cartola_fecha) +'</td><td><button type="button" value="" data-id="'+ value.id_retiro_detalle+'"  class="eliminar-item  btn red btn-50 darken-1"> <i class="material-icons dp48">close</i></button></td></tr>');

                              if (value.monto == null) {
                                montoTotal+=0;
                              } else {
                                  montoTotal+=parseFloat(value.monto);
                              }
                          }); 

                          $.each(res.depositosDetalle2, function(index,value){

                              let OPER_DESC = value.OPER_DESC == null ? '-' : value.OPER_DESC;
                              let SUCU_CODIGO = value.SUCU_CODIGO == null ? '-' : value.SUCU_CODIGO;
                              let SUCU_NOMBRE = value.SUCU_NOMBRE == null ? '-' : value.SUCU_NOMBRE;
                              let fecha_ingreso = value.fecha_ingreso == null ? '-' : value.fecha_ingreso;
                              let monto = value.monto == null ? '-' : value.monto;
                              let descripcion = value.descripcion == null ? '-' : value.descripcion;
                              let cartola_fecha = value.cartola_fecha == null ? '-' : value.cartola_fecha;

                                // $('#depositoDetalleTabla').append('<tr><td>' + value.folio +'</td><td>OTROS DEPOSITOS</td><td>'+ OPER_DESC+"</td><td>"+SUCU_CODIGO+" </td><td>"+ SUCU_NOMBRE +"</td><td> - </td><td>"+value.deposito+"</td><td>"+ fecha_ingreso +" </td><td>"+ monto +"</td><td>"+ descripcion +"</td><td>"+ cartola_fecha +'</td><td><button type="button" value="" data-id="'+ value.id_retiro_detalle+'" class="eliminar-item  btn red btn-50 darken-1"><i class="material-icons dp48">close</i></button></td></tr>');
                              if (value.monto == null) {
                                montoTotal+=0;
                              } else {
                                  montoTotal+=parseFloat(value.monto);
                              }
                          });

                          $.each(res.depositoIncluir, function(index,value){

                                $('#depositoDetalleTabla').append('<tr><td>' + value.folio +'</td><td>RETIROS DIARIOS</td><td>'+ value.OPER_DESC +"</td><td>"+value.id_sucursal +"</td><td>"+value.SUCU_NOMBRE+"</td><td>"+ value.num_caja+"</td><td>"+value.n_deposito +"</td><td>"+ dateUTC(value.fecha_caja) +" </td><td>"+addCommas((parseFloat(value.monto)).toFixed(2)) +"</td><td>"+ value.obs +"</td><td>"+ dateUTC(value.cartola_fecha) +'</td><td><button type="button" value="" data-id="'+ value.id_retiro_detalle+'"  class="eliminar-item  btn red btn-50 darken-1"> <i class="material-icons dp48">close</i></button></td></tr>');

                              if (value.monto == null) {
                                montoTotal+=0;
                              } else {
                                  montoTotal+=parseFloat(value.monto);
                              }
                          });




                          $('#depositoDetalleTabla').append("<tr><td></td><td></td><td></td><td> </td><td></td><td></td><td></td><td></td><td></td><td>TOTAL</td><td>"+ addCommas(montoTotal.toFixed(2)) +"</td><td></td></tr>");

                          // alert("Deposito agregado al prosegur.");
                          alerta('success','Deposito agregado al prosegur.');
                    } else {
                      // alert("El depósito ingresado no existe, ingrese otro.");
                      alerta('error','El depósito ingresado no existe, ingrese otro.');
                    }

                  } else {
                      alerta('error','El depósito esta completo, no es posible agregar un retiro.');
                      // alert("El depósito esta completo, no es posible agregar un retiro.");
                  }
         });


      }
      else
      {
          alerta('error','Debe ingresar el número de depósito');
          // alert('Debe ingresar el número de depósito');
      }
  });
// -------------------------------------------------------------
$(document).on('click','.mostrar-detalle',function(){

      var fecha1;
      var fecha2;
      var montoTotal= 0;
// -------------------
      var valores = new Array();
      var i=0, j=1;

        $($(this)).find("td").each(function(){
            if (j>0) {
              valores[i] =$(this).html();
                    // console.log(valores[i] );
                    // console.log('entro al if');
              i++;
            }
            j++;
        });

        fecha1=valores[2];
        fecha2=valores[3];
    $('#icono0').empty();
    $('#icono0').append('<div class="form-group col l12 m12 s12 pb-2"><h6 class="center">Ingrese el número de depósito que desea agregar al Prosegur</h6></div><div class="form-group col l12 m12 s12  pb-2"><label for="" class="form-control-label col l4 m6 s12" style="text-align:right">Nro. de Depósito :</label><div class="col l6 m6 s12"><textarea  id="text-deposito" rows="6"  class="form-control-textarea browser-default" style="width:100%" name="txt_migracion"></textarea></div><div><div class="form-group col l6 m12 s12" style="display: flex; justify-content: flex-end"><button type="button" class="btn cyan" data-fecha_2="'+ fecha2 +'" data-fecha_1="'+ fecha1 +'"  data-id_retiros_indice="'+ valores[0] +'" id="incluir-deposito" name="button">Agregar</button></div>');

    if($.trim(fecha1) != '' && $.trim(fecha2) != '' ){
          $.get('obtener-retiro-detalle',{fecha1:fecha1,fecha2:fecha2 },function(res){
              $('#icono1').empty();
              $('#depositoDetalleHead').empty();
              $('#depositoDetalleTabla').empty();
              $('#icono1').append('<div style="display: flex"><i class="material-icons dp48">subject</i><span class="card-title">Detalle Retiro Prosegur</span></div>');
              $('#depositoDetalleHead').append('<tr><th width="6%">Folio</th><th width="10%">Tipo</th><th width="10%">Operación</th><th>Suc</th><th width="10%">Nombre sucursal</th><th width="5%">Caja</th><th>Deposito</th><th width="11%">Fecha</th><th  width="11%">Observacion</th><th width="8%">Fecha cartola</th><th width="7%">Monto</th><th>Acción</th></tr>');

              $.each(res.depositosDetalle1, function(index,value){

                    $('#depositoDetalleTabla').append('<tr><td>' + value.folio +'</td><td>RETIROS DIARIOS</td><td>'+ value.OPER_DESC +"</td><td>"+value.id_sucursal +"</td><td>"+value.SUCU_NOMBRE+"</td><td>"+ value.num_caja+"</td><td>"+value.n_deposito +"</td><td>"+ dateUTC(value.fecha_caja) +"</td><td>"+ value.obs +"</td><td>"+ dateUTC(value.cartola_fecha)+" </td><td>"+addCommas((parseFloat(value.monto)).toFixed(2))  +'</td><td><button type="button" value="" data-id="'+ value.id_retiro_detalle+'"  class="eliminar-item  btn red btn-50 darken-1"> <i class="material-icons dp48">close</i></button></td></tr>');

                  if (value.monto == null) {
                    montoTotal+=0;
                  } else {
                      montoTotal+=parseFloat(value.monto);
                  }
              });

              $.each(res.depositosDetalle2, function(index,value){

                  let OPER_DESC = value.OPER_DESC == null ? '-' : value.OPER_DESC;
                  let SUCU_CODIGO = value.SUCU_CODIGO == null ? '-' : value.SUCU_CODIGO;
                  let SUCU_NOMBRE = value.SUCU_NOMBRE == null ? '-' : value.SUCU_NOMBRE;
                  let fecha_ingreso = value.fecha_ingreso == null ? '-' : value.fecha_ingreso;
                  let monto = value.monto == null ? '-' : value.monto;
                  let descripcion = value.descripcion == null ? '-' : value.descripcion;
                  let cartola_fecha = value.cartola_fecha == null ? '-' : value.cartola_fecha;

                    $('#depositoDetalleTabla').append('<tr><td>' + value.folio +'</td><td>OTROS DEPOSITOS</td><td>'+ OPER_DESC+"</td><td>"+SUCU_CODIGO+" </td><td>"+ SUCU_NOMBRE +"</td><td> - </td><td>"+value.deposito+"</td><td>"+ fecha_ingreso +"</td><td>"+ descripcion +"</td><td>"+ cartola_fecha+" </td><td>"+ addCommas((parseFloat(monto)).toFixed(2))  +'</td><td><button type="button" value="" data-id="'+ value.id_retiro_detalle+'" class="eliminar-item  btn red btn-50 darken-1"><i class="material-icons dp48">close</i></button></td></tr>');
                  if (value.monto == null) {
                    montoTotal+=0;
                  } else {
                      montoTotal+=parseFloat(value.monto);
                  }
              });
              $('#depositoDetalleTabla').append("<tr><td></td><td></td><td></td><td> </td><td></td><td></td><td></td><td></td><td></td><td>TOTAL</td><td>"+ addCommas(montoTotal.toFixed(2)) +"</td><td></td></tr>");


      });
    }
  });
// -------------------------------------------------------------
$(document).on('click','#buscar-otros-depositos',function(){

      var fecha1=$('#desde2').val();
      var fecha2=$('#hasta2').val();
      var montoOtroTotal= 0;

    if($.trim(fecha1) != '' && $.trim(fecha2) != '' ){

          $.get('obtener-otro-retiro',{fecha1:fecha1,fecha2:fecha2 },function(res){
                  // console.log(res);
              $('#otroRetiroTabla').empty();
              $.each(res.otrosRetiros, function(index,value){
                  $('#otroRetiroTabla').append('<tr><td>' + value.folio +'</td><td>'+ value.fecha_ingreso +"</td><td>"+ value.descripcion+"</td><td>"+value.SUCU_NOMBRE+" </td><td>"+ value.OPER_DESC +"</td><td>"+ value.usuario +" </td><td>"+ value.deposito +"</td><td>"+ addCommas((parseFloat(value.monto)).toFixed(2)) +"</td></tr>");
                  if (value.monto == null) {
                    montoOtroTotal+=0;
                  } else {
                      montoOtroTotal+=parseFloat(value.monto);
                  }
              });
              $('#otroRetiroTabla').append("<tr><td></td><td></td><td></td><td></td><td></td><td></td><td>TOTAL</td><td>"+ addCommas(montoOtroTotal.toFixed(2)) +"</td></tr>");



      });


    }
  });
//--------------------------------------------------------------
$('#buscar-depositos-pendientes').on('click', function(){

      var fecha1=$('#desde3').val();
      var fecha2=$('#hasta3').val();
        var montoOtroDepositoTotal= 0;

    if($.trim(fecha1) != '' && $.trim(fecha2) != '' ){

      $.get('obtener-depositos-pendientes',{fecha1:fecha1,fecha2:fecha2 },function(res){
              $('#retiroPendienteTabla').empty();

              $.each(res.retirosPendientes1, function(index,value){
                  $('#retiroPendienteTabla').append('<tr><td>' + value.folio +'</td><td>'+ value.fecha_caja+"</td><td>"+value.OPER_DESC+" </td><td>"+ value.TPCHEQUE_DESC +"</td><td>"+ value.n_deposito +"</td><td>"+ addCommas((parseFloat(value.monto)).toFixed(2)) +"</td></tr>");
                  if (value.monto == null) {
                    montoOtroDepositoTotal+=0;
                  } else {
                      montoOtroDepositoTotal+=parseFloat(value.monto);
                  }
              });

              $.each(res.retirosPendientes2, function(index,value){
                  $('#retiroPendienteTabla').append('<tr><td>' + value.folio +"</td><td>"+ value.fecha_caja+"</td><td>"+value.OPER_DESC+" </td><td>"+ value.TPCHEQUE_DESC +"</td><td>"+ value.n_deposito +'</td><td>'+ addCommas((parseFloat(value.monto)).toFixed(2)) +"</td></tr>");
                  if (value.monto == null) {
                    montoOtroDepositoTotal+=0;
                  } else {
                      montoOtroDepositoTotal+=parseFloat(value.monto);
                  }
              });

              $.each(res.retirosPendientes3, function(index,value){
                  $('#retiroPendienteTabla').append('<tr><td>' + value.folio +"</td><td>"+ value.fecha_caja+"</td><td>"+value.OPER_DESC+" </td><td>"+ value.TPCHEQUE_DESC +"</td><td>"+ value.n_deposito +'</td><td>'+ addCommas((parseFloat(value.monto)).toFixed(2)) +"</td></tr>");
                  if (value.monto == null) {
                    montoOtroDepositoTotal+=0;
                  } else {
                      montoOtroDepositoTotal+=parseFloat(value.monto);
                  }
              });

              $('#retiroPendienteTabla').append("<tr><td></td><td></td><td></td><td></td><td>TOTAL</td><td>"+ addCommas(montoOtroDepositoTotal.toFixed(2)) +"</td></tr>");


      });
    }
  });
  //--------------------------------------------------------------
  $('#agregar-otro-retiro').on('click', function(){

        $.get('retiros-otros-generar',function(res){

            // console.log(res.numOtroRetiro[0].otroNum);
            if (res.numOtroRetiro[0].otroNum == '0') {

              // alert("Deposito generado exitosamente");
              alerta('success','Deposito generado exitosamente');
            } else {
              alerta('error','Ya existe un deposito generado');
              // alert("Ya existe un deposito generado");
            }
         });

  });
// -------------------------------------------------------------

$('#agregar-retiro-indice').on('click', function(){
      $.get('retiros-generar',function(res){

          if (res.numRetiro[0].num == '0') {
              alerta('success','Retiro generado exitosamente');

              // alert("Retiro generado exitosamente");
            } else {
              alerta('error','Ya existe un retiro generado');

              // alert("Ya existe un retiro generado");
          }
       });
});
// -------------------------------------------------------------

  function dateUTC(ms) {
    var ms, fecha,año, mes, dia, hora, minuto, segundo;

    ms = new Date(ms);
    año=ms.getUTCFullYear();
    mes=ms.getUTCMonth()+1;
    dia=ms.getUTCDate();
    fecha= año+'-'+ pad(mes) +'-'+ pad(dia);
    return fecha;
  }

  function pad(number) {
      if (number < 10) {
          if (number == 0) {
            return '0' + number;
          }
          else {
            return '0' + number;
          }
      }
      return number;
  }

  function addCommas(nStr)
  {
  	nStr += '';
  	x = nStr.split('.');
  	x1 = x[0];
  	x2 = x.length > 1 ? '.' + x[1] : '';
  	var rgx = /(\d+)(\d{3})/;
  	while (rgx.test(x1)) {
  		x1 = x1.replace(rgx, '$1' + ',' + '$2');
  	}
  	return x1 + x2;
  }

  function alerta(icon, title){
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })
    Toast.fire({
      icon: icon,
      title: title
    })
  }

});

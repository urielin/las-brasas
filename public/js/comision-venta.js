
$(document).ready(function(){

   
    $(document).on('click','#buscar-salida-bancos',function(){

            var fecha1=$('#desde1').val();
            var fecha2=$('#hasta1').val();
            var cantidad= 0 , monto= 0;
          if($.trim(fecha1) != '' && $.trim(fecha2) != '' ){
                request = $.get('obtener-retiro',{fecha1:fecha1,fecha2:fecha2 },function(res){
                    // $('#retiro-head').empty();
                    $('#retiroTabla').empty();
                    $.each(res.retiros, function(index,value){
                        $('#retiroTabla').append('<tr class="mostrar-detalle"><td>' +value.id_retiros_indice +'</td><td>'+ value.TP_RET_DESCRIPCION +"</td> <td>"+ dateUTC(value.fecha_desde) +"</td><td>"+ dateUTC(value.fecha_hasta) +"</td> <td>"+parseFloat(value.doc_cantidad)+"</td><td>"+ parseFloat(value.monto_total) +" </td><td>"+ value.estado +"</td><td>"+ dateUTC(value.fecha_cierre) +"</td><td>"+ value.usuario_cierre +"</td><td>"+ value.observacion +"</td></tr>");
                        cantidad+=parseFloat(value.doc_cantidad);
                        monto+=parseFloat(value.monto_total);
                    });
  
                    $('#retiroTabla').append('<tr "><td></td><td></td><td></td><td></td><td>'+ cantidad+"</td><td>"+ monto+"</td><td></td><td></td><td></td><td></td></tr>");
  
                request.done(function( msg ) {
                  // $( "#log" ).html( msg );
                  console.log(msg);
                });
  
                request.fail(function( jqXHR, textStatus ) {
                  //console.log(jqXHR.responseText,textStatus);
                  alert( "Request failed: " + textStatus + jqXHR.responseText);
                });
            });
        }
    
    
    
    
    
    });

    $('#gestion').on('change', function(){

        var gestion;
        gestion = $(this).val();

        if($.trim(gestion) != '' ){


            $.get('/obtener-mes', function(res){

                //console.log(res);

                $('#mes').empty();
                    
                $.each(res.meses, function(index,value){
                    
                   $('#mes').append('<option value="'+value.TP_MES+'">'+value.TP_DESC+'</option>');
                    
                });
            })

        }
    });


    $('#mes').on('change', function(){

        var mes;
        mes = $(this).val();

        if($.trim(mes) != '' ){


            $.get('/obtener-sucursal', function(res){

                //console.log(res);

                $('#sucursal').empty();
                    
                $.each(res.sucursal, function(index,value){
                    
                   $('#sucursal').append('<option value="'+value.SUCU_CODIGO+'">'+value.SUCU_NOMBRE+'</option>');
                    
                });
            })

        }
    });

    $('#sucursal').on('change', function(){

        var gestion,mes,sucursal;
        sucursal = $(this).val();
        gestion = $('#gestion').val();
        mes = $('#mes').val();
     
        console.log(sucursal);
        console.log(gestion);
        console.log(mes);
        if($.trim(sucursal) != '' ){


            $.get('/obtener-vendedor',{gestion:gestion,mes:mes,sucursal:sucursal}, function(res){

                console.log(res);

                $('#vendedor').empty();
                
                if(res.vendedor != ''){

                    $.each(res.vendedor, function(index,value){

                        $('#vendedor').append('<option value="'+value.COD_VENDEDOR+'">'+value.VEND_NOMBRE+'</option>'); 
                         
                     });

                }
                else{

                    $('#vendedor').append('<option value="">Sin vendedores</option>');
                }
                    
               
            })

        }
    });



        
});
  
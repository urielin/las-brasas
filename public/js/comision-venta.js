
$(document).ready(function(){

   

    $('#vendedor').on('change', function(){

        var vendedor,gestion,sucursal,mes;
        gestion = $('#gestion').val();
        sucursal = $('#sucursal').val();
        mes = $('#mes').val();
        vendedor = $('#vendedor').val();
        console.log(vendedor);
        console.log(gestion);
        console.log(mes);
        console.log(sucursal);

        if($.trim(vendedor) != '' && $.trim(gestion) != '' && $.trim(mes) != '' && $.trim(sucursal) != ''){
            
            request = $.get('obtener-reporte',{vendedor:vendedor,gestion:gestion,mes:mes,sucursal:sucursal},function(res){

                console.log(res);
                
                $('#contenido').empty();
                $('#tabla-comisiones').append('<tr class="mostrar-detalle"><td>Mes</td><td>Corriente</td><td class="detalles"></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>');
                
                $.each(res.comision, function(index,value){
                    
                    $('#tabla-comisiones').append('<tr class="mostrar-detalle"><td>'+value.id_venta+'</td><td>'+value.folio+'</td><td class="detalles">'+value.proc_folio_pedido+'</td><td>'+value.forma_pago+'</td><td>'+value.cod_vendedor +'</td><td>'+parseFloat(value.ptotal)+'</td><td>'+parseFloat(value.impuesto)+'</td><td>'+parseFloat(value.adicional)+'</td><td>'+parseFloat(value.comision)+'</td><td>'+value.rut_cliente+'</td><td>'+ dateUTC(value.fecha2)+'</td><td>'+dateUTC(value.fecha_pago)+'</td><td>'+parseFloat(value.monto)+'</td><td>'+value.tipo_documento+'</td><td>'+value.n_deposito+'</td></tr>');
                    //$('#tabla-comisiones').append('<tr class="mostrar-detalle"><td>'+value.id_venta+'</td><td>'+value.folio+'</td><td class="detalles"></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>');
                
                });

                $('#tabla-comisiones').append('<tr class="mostrar-detalle"><td>Mes</td><td>Anterior</td><td class="detalles"></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>');
                 $.each(res.comision1, function(index,value){
                    console.log(res.comision1);
                    
                    console.log('tE FALTA POQUITO CARNAL :VVVV');
                    //$('#tabla-comisiones').append('<tr class="mostrar-detalle"><td>'+value.id_venta+'</td><td>'+value.folio+'</td><td class="detalles">'+value.proc_folio_pedido+'</td><td>'+value.forma_pago+'</td><td>'+value.cod_vendedor +'</td><td>'+parseFloat(value.ptotal)+'</td><td>'+parseFloat(value.impuesto)+'</td><td>'+parseFloat(value.adicional)+'</td><td>'+parseFloat(value.comision)+'</td><td>'+value.rut_cliente+'</td><td>'+ dateUTC(value.fecha2)+'</td><td>'+dateUTC(value.fecha_pago)+'</td><td>'+parseFloat(value.monto)+'</td><td>'+value.tipo_documento+'</td><td>'+value.n_deposito+'</td></tr>');
                   
                 })  
            });
        }
    }); 

    $(document).on('click','.detalles',function(){


        console.log('AYUDAAA');


    })

    $('#gestion').on('change', function(){

        var gestion;
        gestion = $(this).val();
        //$('#mes').empty();

        //console.log(gestion);

        if($.trim(gestion) != '' ){


            $.get('/obtener-mes', function(res){

                //console.log(res);

                $('#mes').empty();
                    
                $('#mes').append('<option value="">Seleccione Mes</option>');

                $.each(res.meses, function(index,value){
                    
                    
                    $('#mes').append('<option value="'+value.TP_MES+'">'+value.TP_DESC+'</option>');
                    
                });
            })

        }
    });


    $('#mes').on('change', function(){

        var mes;
        mes = $(this).val();

        //console.log(mes);

        if($.trim(mes) != '' ){


            $.get('/obtener-sucursal', function(res){

                //console.log(res);

                $('#sucursal').empty();
                $('#sucursal').append('<option value="">Seleccione sucursal</option>');
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
     
        //console.log(sucursal);
        //console.log(gestion);
        //0console.log(mes);
        if($.trim(sucursal) != '' ){


            $.get('/obtener-vendedor',{gestion:gestion,mes:mes,sucursal:sucursal}, function(res){

                //console.log(res);

                $('#vendedor').empty();
                
                if(res.vendedor != ''){

                    $('#vendedor').append('<option value="">Seleccione vendedor</option>'); 
                    $.each(res.vendedor, function(index,value){

                        
                        $('#vendedor').append('<option value="'+value.cod_vendedor+'">'+value.VEND_NOMBRE+'</option>'); 
                         
                     });

                }
                else{

                    $('#vendedor').append('<option value="">Sin vendedores</option>');
                }
                    
               
            })

        }
    });

    function dateUTC(ms) {
        var ms, fecha,año, mes, dia, hora, minuto, segundo;
        // ms= res.dato_general[0]['fecha_embarque1']+' UTC';
    
        ms = new Date(ms);
    
        // ms = Date.parse(2020-01-27);
        // fecha = new Date(ms);
        // console.log('Año');
        // console.log(ms.getUTCFullYear());
        año=ms.getUTCFullYear();
        // console.log('Mes');
        // console.log(ms.getUTCMonth()+1);
        mes=ms.getUTCMonth()+1;
        // console.log('Dia');
        // console.log(ms.getUTCDate());
        dia=ms.getUTCDate();
        // console.log('Horas');
        // console.log(ms.getUTCHours()-4);
    
        fecha= año+'-'+ pad(mes) +'-'+ pad(dia);
        // console.log('fechaaaa:');
        // console.log(fecha);
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


  
});
  
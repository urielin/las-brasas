
$(document).ready(function(){



    $('#vendedor').on('change', function(){

        var vendedor,gestion,sucursal,mes,total;
        gestion = $('#gestion').val();
        sucursal = $('#sucursal').val();
        mes = $('#mes').val();
        vendedor = $('#vendedor').val();

        let elem =$('.tabs');
        let instance = M.Tabs.getInstance(elem);
        instance.select('test1');
        //$('#tabla-detalles').empty();

        //$('#contenido-detalles').empty();

        if($.trim(vendedor) != '' && $.trim(gestion) != '' && $.trim(mes) != '' && $.trim(sucursal) != ''){

            request = $.get('obtener-detalles',{vendedor:vendedor,gestion:gestion,mes:mes,sucursal:sucursal},function(res){
                
                var totales;
                //console.log(res);
                $('#contenido').empty();
                if(res.detalle == ''){

                    $.each(res.fecha_actual,function(index,value){

                        $('#tabla-comisiones').append('<tr class="meses"><td colspan="4">No hay ventas de '+value.mes+' - '+value.año+'</td>');
                    })
                }
                else{
                        totales=0;
                        $.each(res.fecha_actual,function(index,value){

                            $('#tabla-comisiones').append('<tr class="meses"><td colspan="4">Ventas de '+value.mes+' - '+value.año+' pagadas en '+value.mes+' - '+value.año+'</td>');
                        })
                            //$('#tabla-comisiones').append('<tr class="meses"><td colspan="14">Mes</td>');
                        $.each(res.detalle, function(index,value){
                            $('#tabla-comisiones').append('<tr><td>'+value.tipo_documento+'</td><td>'+value.TPDC_DESCRIPCION+'</td><td>'+value.documento+'</td><td>'+addCommas(value.total)+'</td></tr>');
                        //$('#tabla-comisiones').append('<tr class="mostrar-detalle"><td>'+value.id_venta+'</td><td>'+value.folio+'</td><td class="detalles"></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>');
                        totales=totales+parseFloat(value.total);
                        });

                        totales=totales.toFixed(2);
                        $('#tabla-comisiones').append('<tr><td align="center" colspan="2">Total</td><td>=</td><td>'+addCommas(totales)+'</td></tr>');
                }
                if(res.detalle1 == ''){

                    $.each(res.fecha_anterior,function(index,value){

                        $('#tabla-comisiones').append('<tr class="meses"><td colspan="4">No hay ventas de '+value.mesAnt+' - '+value.añoAnt+' pagadas en '+value.mes+' - '+value.añoAnt+'</td>');
                    })
                }
                else{
                    total=0;
                    $.each(res.fecha_anterior,function(index,value){

                        $('#tabla-comisiones').append('<tr class="meses"><td colspan="4">Ventas de '+value.mesAnt+' - '+value.añoAnt+' pagadas en '+value.mes+' - '+value.añoAnt+'</td>');
                    })
                    $.each(res.detalle1, function(index,value){
                    //console.log(res.comision1);
                    //console.log('tE FALTA POQUITO CARNAL :VVVV');
                    $('#tabla-comisiones').append('<tr><td>'+value.tipo_documento+'</td><td>'+value.TPDC_DESCRIPCION+'</td><td>'+value.documento+'</td><td>'+addCommas(value.total)+'</td></tr>');
                    total=total+parseFloat(value.total);
                    });

                    total=total.toFixed(2);
                    $('#tabla-comisiones').append('<tr><td align="center" colspan="2">Total</td><td>=</td><td>'+addCommas(total)+'</td></tr>');

                }

                if(res.detalle2 == ''){
                    $.each(res.fecha_actual,function(index,value){

                        $('#tabla-comisiones').append('<tr class="meses"><td colspan="4">No hay ventas de '+value.mes+' - '+value.año+' con pago posterior</td>');
                    })
                }
                else{
                    total=0;
                    $.each(res.fecha_actual,function(index,value){

                        $('#tabla-comisiones').append('<tr class="meses"><td colspan="14">Ventas de '+value.mes+' - '+value.año+' con pago posterior</td>');
                    })
                    $.each(res.detalle2, function(index,value){
                    //console.log(res.comision2);
                    //console.log('tE FALTA POQUITO CARNAL :VVVV');
                    $('#tabla-comisiones').append('<tr><td>'+value.tipo_documento+'</td><td>'+value.TPDC_DESCRIPCION+'</td><td>'+value.documento+'</td><td>'+addCommas(value.total)+'</td></tr>');
                    total=total+parseFloat(value.total);
                    });
                    total=total.toFixed(2);
                    $('#tabla-comisiones').append('<tr><td align="center" colspan="2">Total</td><td>=</td><td>'+addCommas(total)+'</td></tr>');

                }

                $('#tabla-comisiones').append('<style type="text/css">.meses{background-color: #00a6d6; color: white}</style>');

            });

            request = $.get('obtener-reporte',{vendedor:vendedor,gestion:gestion,mes:mes,sucursal:sucursal},function(res){
                console.log(res);
                $('#contenido-detalles').empty();
                //$('#contenido').empty();
                    if(res.comision == ''){

                        $.each(res.fecha_actual,function(index,value){

                            $('#tabla-detalles').append('<tr class="meses"><td colspan="14">No hay ventas de '+value.mes+' - '+value.año+'</td>');
                        })
                    }
                    else{
                            total=0;
                            $.each(res.fecha_actual,function(index,value){

                                $('#tabla-detalles').append('<tr class="meses"><td colspan="14">Ventas de '+value.mes+' - '+value.año+' pagadas en '+value.mes+' - '+value.año+'</td>');
                            })
                                //$('#tabla-comisiones').append('<tr class="meses"><td colspan="14">Mes</td>');
                            $.each(res.comision, function(index,value){
                                $('#tabla-detalles').append('<tr><td>'+value.id_venta+'</td><td id='+value.folio+'>'+value.folio+'</td><!--<td>'+value.proc_folio_pedido+'</td>--><td>'+value.forma_pago+'</td><td>'+value.cod_vendedor +'</td><td>'+addCommas(value.ptotal)+'</td><td>'+addCommas(value.impuesto)+'</td><td>'+addCommas(value.adicional)+'</td><td>'+addCommas(value.comision)+'</td><td>'+value.rut_cliente+'</td><td>'+ dateUTC(value.fecha2)+'</td><td>'+dateUTC(value.fecha_pago)+'</td><td>'+addCommas(value.monto)+'</td><td>'+value.tipo_documento+'</td><td>'+value.n_deposito+'</td></tr>');
                            //$('#tabla-comisiones').append('<tr class="mostrar-detalle"><td>'+value.id_venta+'</td><td>'+value.folio+'</td><td class="detalles"></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>');
                            total=total+parseFloat(value.comision);
                            });
                            total=total.toFixed(2);
                            $('#tabla-detalles').append('<tr><td align="center" colspan="6">Total</td><td>=</td><td>'+addCommas(total)+'</td><td colspan="6"></td></tr>');
                    }
                    if(res.comision1 == ''){

                        $.each(res.fecha_anterior,function(index,value){

                            $('#tabla-detalles').append('<tr class="meses"><td colspan="14">No hay ventas de '+value.mesAnt+' - '+value.añoAnt+' pagadas en '+value.mes+' - '+value.añoAnt+'</td>');
                        })
                    }
                    else{
                        total=0;
                        $.each(res.fecha_anterior,function(index,value){

                            $('#tabla-detalles').append('<tr class="meses"><td colspan="14">Ventas de '+value.mesAnt+' - '+value.añoAnt+' pagadas en '+value.mes+' - '+value.añoAnt+'</td>');
                        })
                        $.each(res.comision1, function(index,value){
                        //console.log(res.comision1);
                        //console.log('tE FALTA POQUITO CARNAL :VVVV');
                        $('#tabla-detalles').append('<tr><td>'+value.id_venta+'</td><td id='+value.folio+'>'+value.folio+'</td><!--<td>'+value.proc_folio_pedido+'</td>--><td>'+value.forma_pago+'</td><td>'+value.cod_vendedor +'</td><td>'+addCommas(value.ptotal)+'</td><td>'+addCommas(value.impuesto)+'</td><td>'+addCommas(value.adicional)+'</td><td>'+addCommas(value.comision)+'</td><td>'+value.rut_cliente+'</td><td>'+ dateUTC(value.fecha2)+'</td><td>'+dateUTC(value.fecha_pago)+'</td><td>'+addCommas(value.monto)+'</td><td>'+value.tipo_documento+'</td><td>'+value.n_deposito+'</td></tr>');
                        total=total+parseFloat(value.comision);
                        });
                        total=total.toFixed(2);
                        $('#tabla-detalles').append('<tr><td align="center" colspan="6">Total</td><td>=</td><td>'+addCommas(total)+'</td><td colspan="6"></td></tr>');

                    }

                    if(res.comision2 == ''){
                        $.each(res.fecha_actual,function(index,value){

                            $('#tabla-detalles').append('<tr class="meses"><td colspan="14">No hay ventas de '+value.mes+' - '+value.año+' con pago posterior</td>');
                        })
                    }
                    else{
                        total=0;
                        $.each(res.fecha_actual,function(index,value){

                            $('#tabla-detalles').append('<tr class="meses"><td colspan="14">Ventas de '+value.mes+' - '+value.año+' con pago posterior</td>');
                        })
                        $.each(res.comision2, function(index,value){
                        //console.log(res.comision2);
                        //console.log('tE FALTA POQUITO CARNAL :VVVV');
                            $('#tabla-detalles').append('<tr><td id="prueba">'+value.id_venta+'</td><td class="">'+value.folio+'</td><!--<td class="detalles">'+value.proc_folio_pedido+'</td>--><td>'+value.forma_pago+'</td><td>'+value.cod_vendedor +'</td><td>'+addCommas(value.ptotal)+'</td><td>'+addCommas(value.impuesto)+'</td><td>'+addCommas(value.adicional)+'</td><td>'+addCommas(value.comision)+'</td><td>'+value.rut_cliente+'</td><td>'+ dateUTC(value.fecha2)+'</td><td></td><td></td><td></td><td></td></tr>');
                            total=total+parseFloat(value.comision);
                        });
                        total=total.toFixed(2);
                        $('#tabla-detalles').append('<tr><td align="center" colspan="6">Total</td><td>=</td><td>'+addCommas(total)+'</td><td colspan="6"></td></tr>');

                    }

                    $('#tabla-detalles').append('<style type="text/css">.meses{background-color: #00a6d6; color: white}</style>');

                
            });

            
        }
    });

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

    $('#exportar-datos').on('click',function(){
        var vendedor,gestion,sucursal;
        gestion = $('#gestion').val();
        sucursal = $('#sucursal').val();
        mes = $('#mes').val();
        vendedor = $('#vendedor').val();

        if($.trim(vendedor) != '' && $.trim(gestion) != '' && $.trim(mes) != '' && $.trim(sucursal) != ''){

            request = $.get('exportar-datos',{vendedor:vendedor,gestion:gestion,mes:mes,sucursal:sucursal},function(res){
                alert("¡Datos históricos exportados con exito!");


                
            });
            request.done(function( msg ) {
                // $( "#log" ).html( msg );
                console.log(msg);
                console.log("get completado");
                //habilitar_boton_pdf();
              });
    
              request.fail(function( jqXHR, textStatus ) {
                //console.log(jqXHR.responseText,textStatus);
                //alert( "Request failed: " + textStatus + jqXHR.responseText);
                alert("Estos datos fueron exportados anteriormente");


              });
        }
        else{

            alert('LLene los campos respectivos');
        }
    })

    $('#tabla-detalles tbody' ).on('click','tr',function(){

        $(this).addClass('tr-selected').siblings().removeClass('tr-selected');
    })

    $('#exportar-detalle').on('click',function(){

        var year,mes,sucursal,vendedor;
        year = $('#gestion').val();
        mes = $('#mes').val();
        sucursal = $('#sucursal').val();
        vendedor = $('#vendedor').val();

        if(year != '' && mes != '' && sucursal != '' && vendedor !=''){
            console.log(year);
            console.log(mes);
            console.log(sucursal);
            console.log(vendedor);
            //window.open( 'reporte-prosegur-resumen/'+data.fecha1+'/'+data.fecha2+'/',"_blank").focus();
            window.open( 'reporte-comision/'+year+'/'+mes+'/'+sucursal+'/'+vendedor+'/',"_blank").focus();
            //window.open().focus();
            //window.open().focus();
        }
        else{
            alert('Complete todos los campos');

        }
    });

    $('#exportar-resumen').on('click',function(){

        var year,mes,sucursal,vendedor;
        year = $('#gestion').val();
        mes = $('#mes').val();
        sucursal = $('#sucursal').val();
        vendedor = $('#vendedor').val();

        if(year != '' && mes != '' && sucursal != '' && vendedor !=''){
            console.log(year);
            console.log(mes);
            console.log(sucursal);
            console.log(vendedor);
            //window.open( 'reporte-prosegur-resumen/'+data.fecha1+'/'+data.fecha2+'/',"_blank").focus();
            window.open( 'reporte-resumen/'+year+'/'+mes+'/'+sucursal+'/'+vendedor+'/',"_blank").focus();
            //window.open().focus();
            //window.open().focus();
        }
        else{
            alert('Complete todos los campos');

        }
    });

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
});

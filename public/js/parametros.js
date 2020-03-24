$(document).ready(function(){

    var request;
    
    $.get('/proveedor',function(res){


        console.log(res);
        $('#proveedor-datos').empty();
        $.each(res.proveedor,function(index,value){

            btn_editar='<a type="button" value="" class="get-pdf-edit btn blue btn-50 darken-1" style="cursor: pointer"> <i class="material-icons dp48">edit</i></a>';
            html='<tr data-id="'+value.id_proveedor +'"'; 
            html+='data-codigo="'+value.emp_codigo+'"'; 
            html+='data-rut="'+value.emp_rut+'"'; 
            html+='data-empNombre="'+value.emp_nombre+'"'; 
            html+='data-direccionPais="'+value.direccion_pais+'"';
            html+='data-direcciondire="'+value.direccion_direccion+'"';
            html+='data-telefono="'+value.com_telefono+'"';
            html+='data-movil="'+value.com_movil+'"'; 
            html+='data-fax="'+value.com_fax+'"';
            html+='data-email="'+value.com_email+'">';    
            html+='<td>'+btn_editar+'</td>';
            if(value.emp_codigo == ''){
                html+='<td>-</td>'; 
            }
            else{
                html+='<td>'+value.emp_codigo+'</td>';
            }
            if(value.emp_rut == ''){
                html+='<td>-</td>'; 
            }
            else{
                html+='<td>'+value.emp_rut+'</td>';
            }
            if(value.emp_nombre == ''){
                html+='<td>-</td>'; 
            }
            else{
                html+='<td>'+value.emp_nombre+'</td>';
            }
            if(value.direccion_pais == ''){
                html+='<td>-</td>'; 
            }
            else{
                html+='<td>'+value.direccion_pais+'</td>';
            }
            if(value.direccion_direccion == ''){
                html+='<td>-</td>'; 
            }
            else{
                html+='<td>'+value.direccion_direccion+'</td>';
            }
            if(value.com_telefono == ''){
                html+='<td>-</td>'; 
            }
            else{
                html+='<td>'+value.com_telefono+'</td>';
            }
            if(value.com_movil == ''){
                html+='<td>-</td>'; 
            }
            else{
                html+='<td>'+value.com_movil+'</td>';
            }
            if(value.com_fax == ''){
                html+='<td>-</td>'; 
            }
            else{
                html+='<td>'+value.com_fax+'</td>';
            }
            if(value.com_email == ''){
                html+='<td>-</td>'; 
            }
            else{
                html+='<td>'+value.com_email+'</td></tr>';
            }
            
            $('#tabla-proveedor').append(html);        
        })

    });

    $('#proveedor').on('change',function(){
        
        var valor,html;
        
        valor=$(this).val();

        if($.trim(valor) !== ''){

            console.log('valor');
            $('#proveedor-datos').empty();
            /*$.ajax({
                type: 'GET',
                data: {valor:valor},
                url: '/obtener-datos'
              }).then((data) => {
                
              })*/
              $.get('/obtener-datos',{valor:valor},function(res){
                
                console.log(res);
                $.each(res.datos,function(index,value){

                    btn_editar='<a type="button" value="" class="get-pdf-edit btn blue btn-50 darken-1" style="cursor: pointer"> <i class="material-icons dp48">edit</i></a>';
                    html='<tr data-id="'+value.id_proveedor +'"'; 
                    html+='data-codigo="'+value.emp_codigo+'"'; 
                    html+='data-rut="'+value.emp_rut+'"'; 
                    html+='data-empNombre="'+value.emp_nombre+'"'; 
                    html+='data-direccionPais="'+value.direccion_pais+'"';
                    html+='data-direcciondire="'+value.direccion_direccion+'"';
                    html+='data-telefono="'+value.com_telefono+'"';
                    html+='data-movil="'+value.com_movil+'"'; 
                    html+='data-fax="'+value.com_fax+'"';
                    html+='data-email="'+value.com_email+'">';    
                    html+='<td>'+btn_editar+'</td>';
                    if(value.emp_codigo == ''){
                        html+='<td>-</td>'; 
                    }
                    else{
                        html+='<td>'+value.emp_codigo+'</td>';
                    }
                    if(value.emp_rut == ''){
                        html+='<td>-</td>'; 
                    }
                    else{
                        html+='<td>'+value.emp_rut+'</td>';
                    }
                    if(value.emp_nombre == ''){
                        html+='<td>-</td>'; 
                    }
                    else{
                        html+='<td>'+value.emp_nombre+'</td>';
                    }
                    if(value.direccion_pais == ''){
                        html+='<td>-</td>'; 
                    }
                    else{
                        html+='<td>'+value.direccion_pais+'</td>';
                    }
                    if(value.direccion_direccion == ''){
                        html+='<td>-</td>'; 
                    }
                    else{
                        html+='<td>'+value.direccion_direccion+'</td>';
                    }
                    if(value.com_telefono == ''){
                        html+='<td>-</td>'; 
                    }
                    else{
                        html+='<td>'+value.com_telefono+'</td>';
                    }
                    if(value.com_movil == ''){
                        html+='<td>-</td>'; 
                    }
                    else{
                        html+='<td>'+value.com_movil+'</td>';
                    }
                    if(value.com_fax == ''){
                        html+='<td>-</td>'; 
                    }
                    else{
                        html+='<td>'+value.com_fax+'</td>';
                    }
                    if(value.com_email == ''){
                        html+='<td>-</td>'; 
                    }
                    else{
                        html+='<td>'+value.com_email+'</td></tr>';
                    }
                    
                    $('#tabla-proveedor').append(html);  
                })
              });
        }
    });

    $('#tabla-proveedor').on('click ','a.get-pdf-edit',function() {
        //var id_retiros=$(this).attr('id');
        //var data=$(this).data();
        //console.log(data);

        let codigo = $(this).parents('tr').attr('data-codigo');
        let rut = $(this).parents('tr').attr('data-rut');
        let empNombre = $(this).parents('tr').attr('data-empNombre');
        let direccionPais = $(this).parents('tr').attr('data-direccionPais');
        let direcciondire = $(this).parents('tr').attr('data-direcciondire');
        let telefono = $(this).parents('tr').attr('data-telefono');
        let movil = $(this).parents('tr').attr('data-movil');
        let fax = $(this).parents('tr').attr('data-fax');
        let email = $(this).parents('tr').attr('data-email');
        let id = $(this).parents('tr').attr('data-id');

        console.log(id);
        
        $(this).parents("tr").find("td:eq(1)").html('<input style="width:100%;height: 35px !important;" class="form-control browser-default" placeholder="Código" name="codigo" id="nombre" value="'+codigo+'" >');
        $(this).parents("tr").find("td:eq(2)").html('<input style="width:100%;height: 35px !important;" class="form-control browser-default" placeholder="RUT" name="rut" value="'+rut+'" >');
        $(this).parents("tr").find("td:eq(3)").html('<input style="width:100%;height: 35px !important;" class="form-control browser-default" placeholder="Empresa" name="empNombre" value="'+empNombre+'" >');
        $(this).parents("tr").find("td:eq(4)").html('<input style="width:100%;height: 35px !important;" class="form-control browser-default" placeholder="País" name="direccionPais" value="'+direccionPais+'" >');
        $(this).parents("tr").find("td:eq(5)").html('<input style="width:100%;height: 35px !important;" class="form-control browser-default" placeholder="Dirección" name="direcciondire" value="'+direcciondire+'" >');
        $(this).parents("tr").find("td:eq(6)").html('<input style="width:100%;height: 35px !important;" class="form-control browser-default" placeholder="Teléfono" name="telefono" value="'+telefono+'" >');
        $(this).parents("tr").find("td:eq(7)").html('<input style="width:100%;height: 35px !important;" class="form-control browser-default" placeholder="Móvil" name="movil" value="'+movil+'" >');
        $(this).parents("tr").find("td:eq(8)").html('<input style="width:100%;height: 35px !important;" class="form-control browser-default" placeholder="Fax" name="fax" value="'+fax+'" >');
        $(this).parents("tr").find("td:eq(9)").html('<input style="width:100%;height: 35px !important;" class="form-control browser-default" placeholder="ejm:usuario@example.com" name="email" value="'+email+'" >');
        $(this).parents("tr").find("td:eq(0)").prepend(`<span style='display: flex;'>
                                                      <button title='Guardar' style='padding: 5px 10px;' class='btn btn-50 cyan btn-xs btn-update'>

                                                          <i class="material-icons dp48">save</i>

                                                      </button>
                                                      <button title='Cancelar' style='padding: 5px 10px;' class='btn btn-50 red btn-xs btn-cancel'>

                                                          <i class="material-icons dp48">close</i>

                                                      </button>
                                                    </span>`)
        $(this).hide();
        //window.open( 'reporte-prosegur-resumen/'+data.fecha1+'/'+data.fecha2+'/',"_blank").focus();
    
        //console.log('gaa');
       
      });

      $("#tabla-proveedor").on("click", ".btn-cancel", function(){

        let codigo = $(this).parents("tr").attr('data-codigo');
        let rut = $(this).parents("tr").attr('data-rut');
        let empNombre = $(this).parents("tr").attr('data-empNombre');
        let direccionPais = $(this).parents("tr").attr('data-direccionPais');
        let direcciondire = $(this).parents("tr").attr('data-direcciondire');
        let telefono = $(this).parents("tr").attr('data-telefono');
        let movil = $(this).parents("tr").attr('data-movil');
        let fax = $(this).parents("tr").attr('data-fax');
        let email = $(this).parents("tr").attr('data-email');
        let id = $(this).parents("tr").attr('data-id');

        let data = $(this).parents('tr').data();
       
        console.log(data);

        //codigo='-';
        if(codigo==''){
            $(this).parents("tr").find("td:eq(1)").text('-');
        }
        else{
            $(this).parents("tr").find("td:eq(1)").text(codigo);
        }
        
        if(rut==''){
            $(this).parents("tr").find("td:eq(2)").text('-');
        }
        else{
            $(this).parents("tr").find("td:eq(2)").text(rut);
        }
        
        if(empNombre==''){
            $(this).parents("tr").find("td:eq(3)").text('-');
        }
        else{
            $(this).parents("tr").find("td:eq(3)").text(empNombre);
        }
        
        if(direccionPais==''){
            $(this).parents("tr").find("td:eq(4)").text('-');
        }
        else{
            $(this).parents("tr").find("td:eq(4)").text(direccionPais);
        }
        
        if(direcciondire==''){
            $(this).parents("tr").find("td:eq(5)").text('-');
        }
        else{
            $(this).parents("tr").find("td:eq(5)").text(direcciondire);
        }
        if(telefono==''){
            $(this).parents("tr").find("td:eq(6)").text('-');
        }
        else{
            $(this).parents("tr").find("td:eq(6)").text(telefono);
        }
        if(movil==''){
            $(this).parents("tr").find("td:eq(7)").text('-');
        }
        else{
            $(this).parents("tr").find("td:eq(7)").text(movil);
        }
        if(fax==''){
            $(this).parents("tr").find("td:eq(8)").text('-');
        }
        else{
            $(this).parents("tr").find("td:eq(8)").text(fax);
        }
        if(email==''){
            $(this).parents("tr").find("td:eq(9)").text('-');
        }
        else{
            $(this).parents("tr").find("td:eq(9)").text(email);
        }
        //$(this).parents("tr").find("td:eq(1)").text(codigo);
        //$(this).parents("tr").find("td:eq(2)").text(rut);
        //$(this).parents("tr").find("td:eq(3)").text(empNombre);
        //$(this).parents("tr").find("td:eq(4)").text(direccionPais);
        /*$(this).parents("tr").find("td:eq(5)").text(direcciondire);
        $(this).parents("tr").find("td:eq(6)").text(telefono);
        $(this).parents("tr").find("td:eq(7)").text(movil);
        $(this).parents("tr").find("td:eq(8)").text(fax);
        $(this).parents("tr").find("td:eq(9)").text(email);*/
        $(this).parents("tr").find(".get-pdf-edit").show();
        $(this).parents("tr").find(".btn-update").remove();
        $(this).parents("tr").find(".btn-cancel").remove();
    });
    
    $('#btn-nuevo').on('click', function(){
        console.log('nuevo');
        $.get('/nuevo',function(){
            //let news='<tr><td>gaaaa</td><td>gaaaa</td><td>gaaaa</td><td>gaaaa</td><td>gaaaa</td><td>gaaaa</td><td>gaaaa</td><td>gaaaa</td><td>gaaaa</td><td>gaaaa</td></tr>'
            console.log('gaa');
            $.get('/get-new',function(res){
                
                console.log(res);
                $.each(res.new,function(index,value){

                    btn_editar='<a type="button" value="" class="get-pdf-edit btn blue btn-50 darken-1" style="cursor: pointer"> <i class="material-icons dp48">edit</i></a>';
                    html='<tr data-id="'+value.id_proveedor +'"'; 
                    html+='data-codigo="'+value.emp_codigo+'"'; 
                    html+='data-rut="'+value.emp_rut+'"'; 
                    html+='data-empNombre="'+value.emp_nombre+'"'; 
                    html+='data-direccionPais="'+value.direccion_pais+'"';
                    html+='data-direcciondire="'+value.direccion_direccion+'"';
                    html+='data-telefono="'+value.com_telefono+'"';
                    html+='data-movil="'+value.com_movil+'"'; 
                    html+='data-fax="'+value.com_fax+'"';
                    html+='data-email="'+value.com_email+'">';    
                    html+='<td>'+btn_editar+'</td>';
                    if(value.emp_codigo == ''){
                        html+='<td>-</td>'; 
                    }
                    else{
                        html+='<td>'+value.emp_codigo+'</td>';
                    }
                    if(value.emp_rut == ''){
                        html+='<td>-</td>'; 
                    }
                    else{
                        html+='<td>'+value.emp_rut+'</td>';
                    }
                    if(value.emp_nombre == ''){
                        html+='<td>-</td>'; 
                    }
                    else{
                        html+='<td>'+value.emp_nombre+'</td>';
                    }
                    if(value.direccion_pais == ''){
                        html+='<td>-</td>'; 
                    }
                    else{
                        html+='<td>'+value.direccion_pais+'</td>';
                    }
                    if(value.direccion_direccion == ''){
                        html+='<td>-</td>'; 
                    }
                    else{
                        html+='<td>'+value.direccion_direccion+'</td>';
                    }
                    if(value.com_telefono == ''){
                        html+='<td>-</td>'; 
                    }
                    else{
                        html+='<td>'+value.com_telefono+'</td>';
                    }
                    if(value.com_movil == ''){
                        html+='<td>-</td>'; 
                    }
                    else{
                        html+='<td>'+value.com_movil+'</td>';
                    }
                    if(value.com_fax == ''){
                        html+='<td>-</td>'; 
                    }
                    else{
                        html+='<td>'+value.com_fax+'</td>';
                    }
                    if(value.com_email == ''){
                        html+='<td>-</td>'; 
                    }
                    else{
                        html+='<td>'+value.com_email+'</td></tr>';
                    }
                    
                    $('#tabla-proveedor > tbody > tr:first').before(html);
                })
              });
        });
    });

    $("#tabla-proveedor").on("click", ".btn-update",function(){
        let codigo = $(this).parents("tr").find("input[name='codigo']").val();
        let rut = $(this).parents("tr").find("input[name='rut']").val();
        let empNombre = $(this).parents("tr").find("input[name='empNombre']").val();
        let direccionPais = $(this).parents("tr").find("input[name='direccionPais']").val();
        let direcciondire = $(this).parents("tr").find("input[name='direcciondire']").val();
        let telefono = $(this).parents("tr").find("input[name='telefono']").val();
        let movil = $(this).parents("tr").find("input[name='movil']").val();
        let fax = $(this).parents("tr").find("input[name='fax']").val();
        let email = $(this).parents("tr").find("input[name='email']").val();
        //let id = $(this).parents("tr").find("input[name='code']").val();

        //console.log(rut);
        if(codigo==''){
            $(this).parents("tr").find("td:eq(1)").text('-');
        }
        else{
            $(this).parents("tr").find("td:eq(1)").text(codigo);
        }
        
        if(rut==''){
            $(this).parents("tr").find("td:eq(2)").text('-');
        }
        else{
            $(this).parents("tr").find("td:eq(2)").text(rut);
        }
        
        if(empNombre==''){
            $(this).parents("tr").find("td:eq(3)").text('-');
        }
        else{
            $(this).parents("tr").find("td:eq(3)").text(empNombre);
        }
        
        if(direccionPais==''){
            $(this).parents("tr").find("td:eq(4)").text('-');
        }
        else{
            $(this).parents("tr").find("td:eq(4)").text(direccionPais);
        }
        
        if(direcciondire==''){
            $(this).parents("tr").find("td:eq(5)").text('-');
        }
        else{
            $(this).parents("tr").find("td:eq(5)").text(direcciondire);
        }
        if(telefono==''){
            $(this).parents("tr").find("td:eq(6)").text('-');
        }
        else{
            $(this).parents("tr").find("td:eq(6)").text(telefono);
        }
        if(movil==''){
            $(this).parents("tr").find("td:eq(7)").text('-');
        }
        else{
            $(this).parents("tr").find("td:eq(7)").text(movil);
        }
        if(fax==''){
            $(this).parents("tr").find("td:eq(8)").text('-');
        }
        else{
            $(this).parents("tr").find("td:eq(8)").text(fax);
        }
        if(email==''){
            $(this).parents("tr").find("td:eq(9)").text('-');
        }
        else{
            $(this).parents("tr").find("td:eq(9)").text(email);
        }

        $(this).parents('tr').attr('data-codigo',codigo);
        $(this).parents('tr').attr('data-rut',rut);
        $(this).parents('tr').attr('data-empNombre',empNombre);
        $(this).parents('tr').attr('data-direccionPais',direccionPais);
        $(this).parents('tr').attr('data-direcciondire',direcciondire);
        $(this).parents('tr').attr('data-telefono',telefono);
        $(this).parents('tr').attr('data-movil',movil);
        $(this).parents('tr').attr('data-fax',fax);
        $(this).parents('tr').attr('data-email',email);
 
        let id = $(this).parents('tr').attr('data-id');

        let data = {id:id,
                    codigo:codigo,
                    rut:rut,
                    empNombre:empNombre,
                    direccioPais:direccionPais,
                    direcciondire:direcciondire,
                    telefono:telefono,
                    movil:movil,
                    email:email,
                    _token:$("meta[name='csrf-token']").attr("content")};
            
        $.ajax({
            type:'POST',
            url:'/updateproveedor',
            data: data,
            headers:{_token:$("meta[name='csrf-token']").attr("content")},
          }).then((data) => {
            alert('Proveedor actualizado');
          })

        $(this).parents("tr").find(".get-pdf-edit").show();
        $(this).parents("tr").find(".btn-cancel").remove();
        $(this).parents("tr").find(".btn-update").remove();
    })

});


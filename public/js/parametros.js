$(document).ready(function(){

    var id;
    tabla();
    

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
                    btn_detalles='<a type="button" value="" class="detalles btn blue btn-50 darken-1" style="cursor: pointer"><i class="material-icons dp48">remove_red_eye</i></a>';

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
                    /*if(value.com_telefono == ''){
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
                        html+='<td>'+value.com_email+'</td>';
                    }*/
                    html+='<td>'+btn_detalles+'</td></tr>';
        
                    
                    $('#tabla-proveedor').append(html);  
                })
              });
        }
    });
    
    $('#tabla-proveedor').on('click ','a.get-pdf-edit',function() {
        //var id_retiros=$(this).attr('id');
        //var data=$(this).data();
        //console.log(data);
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
    

        $('#formEdit').modal('open');

        $('#codigo_edit').val(codigo);
        $('#rut_edit').val(rut);
        $('#empresa_edit').val(empNombre);
        $('#pais_edit').val(direccionPais);
        $('#direccion_edit').val(direcciondire);
        $('#telefono_edit').val(telefono);
        $('#movil_edit').val(movil);
        $('#fax_edit').val(fax);
        $('#email_edit').val(email);
        $('#id_edit').val(id);

        
        

     
       
        
/*          
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
    
        //console.log('gaa');*/
       
      });

    $('#editar-proveedor').on('submit', function(){

        event.preventDefault();
        Swal.fire({
            title: '¿Esta seguro de guardar los cambios?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Actualizar'
  
          }).then((result) => {

            if(result.value){
                
            event.preventDefault();
            let codigo_edit = $('#codigo_edit').val();
            let rut_edit = $('#rut_edit').val();
            let empNombre_edit = $('#empresa_edit').val();
            let direccionPais_edit = $('#pais_edit').val();
            let direcciondire_edit = $('#direccion_edit').val();
            let telefono_edit = $('#telefono_edit').val();
            let movil_edit = $('#movil_edit').val();
            let fax_edit = $('#fax_edit').val();
            let email_edit = $('#email_edit').val();
            let id_edit = $('#id_edit').val();
            
           
            //let id = find("input[name='_edit']").val();
    
            let data = {id_edit:id_edit,
                        codigo_edit:codigo_edit,
                        rut_edit:rut_edit,
                        empNombre_edit:empNombre_edit,
                        direccionPais_edit:direccionPais_edit,
                        direcciondire_edit:direcciondire_edit,
                        telefono_edit:telefono_edit,
                        movil_edit:movil_edit,
                        fax_edit:fax_edit,
                        email_edit:email_edit,
                        _token:$("meta[name='csrf-token']").attr("content")};
    
                        console.log(data);
                        
                request=$.ajax({
                    type:'POST',
                    url:'/updateproveedor',
                    data: data,
                    headers:{_token:$("meta[name='csrf-token']").attr("content")},
                  }).then((data) => {
    
                       
                  })
        
                request.done(function( msg ) {
        
                    $( "#log" ).html( msg );
                      console.log(msg);
                });
         
                request.fail(function( jqXHR, textStatus ) {
                      console.log(jqXHR.responseText,textStatus);
                      alert( "Request failed: " + textStatus + jqXHR.responseText);
                });
            
            
            //alert('Proveedor actualizado');
            tabla();
            $('#formEdit').modal('close');
             

              Swal.fire({
                icon: 'success',
                title: '¡Proveedor actualizado exitosamente!',
                //text: '¡Complete todos los campos!'
                //footer: '<a href>Why do I have this issue?</a>'
                showConfirmButton: false,
                timer: 800
              })

            }
            
             

          }) 
       

    })


     /* $("#tabla-proveedor").on("click", ".btn-cancel", function(){

        /*let codigo = $(this).parents("tr").attr('data-codigo');
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
        }*/
        //$(this).parents("tr").find("td:eq(1)").text(codigo);
        //$(this).parents("tr").find("td:eq(2)").text(rut);
        //$(this).parents("tr").find("td:eq(3)").text(empNombre);
        //$(this).parents("tr").find("td:eq(4)").text(direccionPais);
        /*$(this).parents("tr").find("td:eq(5)").text(direcciondire);
        $(this).parents("tr").find("td:eq(6)").text(telefono);
        $(this).parents("tr").find("td:eq(7)").text(movil);
        $(this).parents("tr").find("td:eq(8)").text(fax);
        $(this).parents("tr").find("td:eq(9)").text(email);*/
        /*$(this).parents("tr").find(".get-pdf-edit").show();
        $(this).parents("tr").find(".btn-update").remove();
        $(this).parents("tr").find(".btn-cancel").remove();
    });*/
    



    $('#btn-nuevo').on('click', function(){
        $('#formNuevo').modal('open');
        /*console.log('nuevo');
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
        });*/
    });

    /*$("#tabla-proveedor").on("click", ".btn-update",function(){
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
    })*/

    $('#tabla-proveedor').on('click ','a.detalles',function() {
        $('#tableMostrarAdicional-cuerpo').empty();
        $('#tableMostrarAdicional2-cuerpo').empty();

        $('#tableMostrarAdicional-cuerpo').append(`
            <tr>
                <td class="strong" style="text-align:right" >Código:</td><td style="text-align:left">${$(this).parents("tr").attr('data-codigo')==''? '-':$(this).parents("tr").attr('data-codigo')}</td>
            </tr>
            <tr>
                <td class="strong" style="text-align:right">RUT:</td><td style="text-align:left">${$(this).parents("tr").attr('data-rut')==''?'-':$(this).parents("tr").attr('data-rut')}</td>
            </tr>
            <tr>
                <td class="strong" style="text-align:right">Nombre:</td><td style="text-align:left">${$(this).parents("tr").attr('data-empNombre')==''?'-':$(this).parents("tr").attr('data-empNombre')}</td>
            </tr>
            <tr>
                <td class="strong" style="text-align:right">Pais:</td><td style="text-align:left">${$(this).parents("tr").attr('data-direccionPais')==''?'-':$(this).parents("tr").attr('data-direccionPais')}</td>
            </tr>
            <tr>
                <td class="strong" style="text-align:right">Email:</td><td style="text-align:left">${$(this).parents("tr").attr('data-email')==''?'-':$(this).parents("tr").attr('data-email')}</td>
            </tr>
            `);

            $('#tableMostrarAdicional2-cuerpo').append(`
            
            <tr>
                <td class="strong" style="text-align:right">Teléfono:</td><td style="text-align:left">${$(this).parents("tr").attr('data-telefono')==''?'-':$(this).parents("tr").attr('data-telefono')}</td>
            </tr>
            <tr>
                <td class="strong" style="text-align:right">Movil:</td><td style="text-align:left">${$(this).parents("tr").attr('data-movil')==''?'-':$(this).parents("tr").attr('data-movil')}</td>
            </tr>
            <tr>
                <td class="strong" style="text-align:right">Fax:</td><td style="text-align:left">${$(this).parents("tr").attr('data-fax')==''?'-':$(this).parents("tr").attr('data-fax')}</td>
            </tr>
            <tr>
                <td class="strong" style="text-align:right">Direccion:</td><td style="text-align:left">${$(this).parents("tr").attr('data-direcciondire')=='' ? '-':$(this).parents("tr").attr('data-direcciondire')}</td>
            </tr>
            `);

            $('#formModal2').modal('open');

    });

    $('#nuevo-proveedor').on('submit', function(){
        event.preventDefault();

        console.log($(this).serialize());
        
           request=$.ajax({
             url: '/nuevo',
             method:"POST",
             data:$(this).serialize(),
             dataType:"json",
             success:function(res)
             {

                /*if (res.camionAgregar == '0') {*/
                    // alert('Se creo un nuevo proveedor');
                /*} else {
                    alerta('error','El contenedor ya existe, ingrese otro código');
                }*/

            }
           });
        

          Swal.fire({
            icon: 'success',
            title: '¡Proveedor creado exitosamente!',
            //text: '¡Complete todos los campos!'
            //footer: '<a href>Why do I have this issue?</a>'
            showConfirmButton: false,
            timer: 800
          })
           tabla();
           $('#codigo_nuevo').val('');
           $('#rut_nuevo').val('');
           $('#empresa_nuevo').val('');
           $('#pais_nuevo').val('');
           $('#direccion_nuevo').val('');
           $('#telefono_nuevo').val('');
           $('#movil_nuevo').val('');
           $('#fax_nuevo').val('');
           $('#email_nuevo').val('');

           
           /*$('#codigo_agregar').val('');
           $('#auxiliar_agregar').val('');
           $('#descripcion_agregar').val('');
           $('#contenido_agregar').val('');
           $('#documento_agregar').val('');
           $('#fecha_agregar').val('');
           $('#observaciones_agregar').val('');*/

           /*request.done(function( msg ) {

           $( "#log" ).html( msg );
             console.log(msg);
           });

           request.fail(function( jqXHR, textStatus ) {
             console.log(jqXHR.responseText,textStatus);
             alert( "Request failed: " + textStatus + jqXHR.responseText);
           });*/
        
       
        //$('#formNuevo').modal('close');

    })

    function tabla(){
        $.get('/proveedor',function(res){


            //console.log(res);
            $('#proveedor-datos').empty();
            $.each(res.proveedor,function(index,value){
    
                btn_editar='<a type="button" value="" class="get-pdf-edit btn blue btn-50 darken-1" style="cursor: pointer"> <i class="material-icons dp48">edit</i></a>';
                btn_detalles='<a type="button" value="" class="detalles btn blue btn-50 darken-1" style="cursor: pointer"><i class="material-icons dp48">remove_red_eye</i></a>';
                
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
                /*if(value.com_telefono == ''){
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
                    html+='<td>'+value.com_email+'</td>';
                }*/
                html+='<td>'+btn_detalles+'</td></tr>';
    
                
                $('#tabla-proveedor').append(html);        
            })
    
        }); 
    }

 
});


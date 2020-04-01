$(document).ready(function(){
    var id;
    //tabla();
    
    
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
    });

    /*$('#editar-proveedor').on('submit', function(){

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
            //tabla();
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
       

    })*/

    $('#btn-nuevo1').on('click', function(){
        console.log('asdasd');
        $('#formNuevo').modal('open');
       
    });
    
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
               
                html+='<td>'+btn_detalles+'</td></tr>';
    
                
                $('#tabla-proveedor').append(html);        
            })
    
        }); 
    }
    
 
});

$(document).ready(function(){

    var request;
    
    $.get('/proveedor',function(res){


        console.log(res);
        $('#proveedor-datos').empty();
        $.each(res.proveedor,function(index,value){

            btn_editar='<a data-id="'+value.id_proveedor +'" type="button" value="" class="get-pdf-report btn blue btn-50 darken-1" href="#"> <i class="material-icons dp48">edit</i></a>';
            $('#tabla-proveedor').append('<tr><td>'+value.emp_codigo+'</td><td>'+value.emp_rut+'</td><td>'+value.emp_nombre+'</td><td>'+value.direccion_pais+'</td><td>'+value.direccion_direccion+'</td><td>'+value.com_telefono+'</td><td>'+value.com_movil+'</td><td>'+value.com_fax+'</td><td>'+value.com_email+'</td><td>'+btn_editar+'</td></tr>');
        })

    });

    $('#proveedor').on('change',function(){
        
        var valor;
        
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

                    btn_editar='<a data-id="'+value.id_proveedor +'" type="button" value="" class="get-pdf-report btn blue btn-50 darken-1" href="#"> <i class="material-icons dp48">edit</i></a>';
                    $('#tabla-proveedor').append('<tr><td>'+value.emp_codigo+'</td><td>'+value.emp_rut+'</td><td>'+value.emp_nombre+'</td><td>'+value.direccion_pais+'</td><td>'+value.direccion_direccion+'</td><td>'+value.com_telefono+'</td><td>'+value.com_movil+'</td><td>'+value.com_fax+'</td><td>'+value.com_email+'</td><td>'+btn_editar+'</td></tr>');
                })
              });



        }
        
        
    });

});


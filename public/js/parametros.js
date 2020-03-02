$(document).ready(function(){

    var request;

    request=$.get('/proveedor',function(res){


        console.log(res);
        $('#proveedor-datos').empty();
        $.each(res.proveedor,function(index,value){

            btn_editar='<a data-id="'+value.id_proveedor +'" type="button" value="" class="get-pdf-report btn blue btn-50 darken-1" href="#"> <i class="material-icons dp48">picture_as_pdf</i></a>';
            $('#tabla-proveedor').append('<tr><td>'+value.emp_codigo+'</td><td>'+value.emp_rut+'</td><td>'+value.emp_nombre+'</td><td>'+value.direccion_pais+'</td><td>'+value.direccion_direccion+'</td><td>'+value.com_telefono+'</td><td>'+value.com_movil+'</td><td>'+value.com_fax+'</td><td>'+value.com_email+'</td><td>'+btn_editar+'</td></tr>');
        })

    });

    


});
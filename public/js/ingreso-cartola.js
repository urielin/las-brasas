$(document).ready(function(){

    $('#elegir-cuenta').on('change',function(){
        var cuenta = $(this).val();
        var gestion = $('#elegir-gestion').val()

        if (cuenta != 'disabled') {
            console.log('habilitar');
            $('#elegir-gestion').removeAttr('disabled');
            $('#insertar-cartolar').removeAttr('disabled');
            $('#insertar-migracion').removeAttr('disabled');
            console.log(gestion);
        } else {
            console.log('deshabilitar');
            $('#elegir-gestion').attr('disabled', 'disabled');
            $('#insertar-cartolar').attr('disabled', 'disabled');
            $('#insertar-migracion').attr('disabled', 'disabled');
        }

    });
 

});

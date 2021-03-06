$(document).ready(function(){

   
    $('#pagoTable').on('click', 'tbody tr td button.btn-check', function (event) {
        let code = $(this).parents("tr").find("td:eq(1)").text();
        let id = $(this).attr("data-id")
      
        $('#donePage').modal('open');  
        localStorage.setItem('id_camion', id);

        /*Swal.fire(
            'Pagar Camion?',
            '¿Estas seguro?',
            'question'
        ).then((result) => {
            if (result.value) {
                 $.ajax({
                    type:'POST',
                    url:'/contenedores-camiones/pagos/check',
                    data: {codigo: code, _token: $("meta[name='csrf-token']").attr("content") },
                    headers: {
                      _token: $("meta[name='csrf-token']").attr("content")  
                    }
                  }).then((data) => {
                      console.log(data)
                      if(data.status === 200) {
                        $(self).parents("tr").find(".btn-check").remove();
                          Swal.fire(
                              'Pago!',
                              'camion a sido pagado.',
                              'success'
                          ) 
                      } else { 
                          Swal.fire(
                              'Pago Error!',
                              'Intente nuevamente.',
                              'Error'
                          )
                      }
                     
                  })
            }
        })*/
    }); 
    $('.btn-save-page').on('click', function(event) {
      let tipo_pago = $('#tipo_pago').val();
      let fecha_pago = $('#fecha_pago').val();
      let tipo_cambio = $('#tipo_cambio').val();
      let monto_pagado = $('#monto_pagado').val();
      let observaciones = $('#observaciones').val(); 

      let data = {};
      data.id_camion = localStorage.getItem('id_camion');
      data.tipo_pago = tipo_pago;
      data.fecha_pago = fecha_pago;
      data.tipo_cambio = tipo_cambio;
      data.monto_pagado = monto_pagado;
      data.observaciones = observaciones;
      data._token = $("meta[name='csrf-token']").attr("content");
      
      $.ajax({
        type:'POST',
        url:'/contenedores-camiones/pagos/check',
        data: data,
        headers: {
          _token: $("meta[name='csrf-token']").attr("content")  
        }
      }).then((data) => {
           
          if(data.status === 200) {
            $(self).parents("tr").find(".btn-check").remove();
              Swal.fire(
                  'Pago!',
                  'camion a sido pagado.',
                  'success'
              ) 
              paginator.listarPagos()
              paginator.listarHistories() 
              $('#donePage').modal('close'); 
          } else { 
              Swal.fire(
                  'Pago Error!',
                  'Intente nuevamente.',
                  'Error'
              )
              $('#donePage').modal('close'); 
          }
         
      })

    })
    $('#pagoTable').on('click', 'tbody tr td button.btn-edit', function (event) {
   
        let forward = $(this).parents("tr").attr('data-forward') == 'null' ? '-': $(this).parents("tr").attr('data-forward');
        let forward_fecha = $(this).parents("tr").attr('data-forward_fecha') === 'null' ? '': $(this).parents("tr").attr('data-forward_fecha'); 
        let forward_compromiso = $(this).parents("tr").attr('data-forward_compromiso') === 'null' ? '': $(this).parents("tr").attr('data-forward_compromiso');
        let swift = $(this).parents("tr").attr('data-swift') == 'null' ? '-': $(this).parents("tr").attr('data-swift'); 
        let switf_fecha = $(this).parents("tr").attr('data-switf_fecha') === 'null' ?  '': $(this).parents("tr").attr('data-switf_fecha');
        let id = $(this).attr("data-id_camion");

        $(this).parents("tr").find("td:eq(5)").html('<input   style="height: 30px !important;font-size: 11px;" class="form-control browser-default" name="forward" value="'+forward+'">');
        $(this).parents("tr").find("td:eq(6)").html('<input onclick="dateInputMask(event)"  maxlength="10"  style="height: 30px !important;font-size: 11px;" class="form-control browser-default js-date" name="forward_fecha" placeholder="yyyy-mm-dd" value="'+forward_fecha+'">');
        $(this).parents("tr").find("td:eq(7)").html('<input onclick="dateInputMask(event)" maxlength="10"  style="height: 30px !important;font-size: 11px;" class="form-control browser-default js-date" name="forward_compromiso" placeholder="yyyy-mm-dd" value="'+forward_compromiso+'">');
        $(this).parents("tr").find("td:eq(8)").html('<input style="height: 30px !important;font-size: 11px;" class="form-control browser-default" name="swift" value="'+swift+'">');
        $(this).parents("tr").find("td:eq(9)").html('<input onclick="dateInputMask(event)" maxlength="10"  style="height: 30px !important;font-size: 11px;" class="form-control browser-default js-date" name="switf_fecha" placeholder="yyyy-mm-dd" value="'+switf_fecha+'">');
        
        $(this).parents("tr").find("td:eq(11)").prepend(`<span style='display: flex;'>
                                                          <button data-id_camion='${id}' title='Guardar' style='padding: 5px 10px;' class='btn btn-50 cyan btn-xs btn-update'> 
                                                              <i class="material-icons dp48">save</i> 
                                                          </button>
                                                          <button title='Cancelar' style='padding: 5px 10px;' class='btn btn-50 red btn-xs btn-cancel'> 
                                                              <i class="material-icons dp48">close</i> 
                                                          </button>
                                                        </span>`)
                       
        $(this).hide();
      });

      $("#pagoTable").on("click", ".btn-cancel", function(){  
          let forward = $(this).parents("tr").attr('data-forward') == 'null' ? '-': $(this).parents("tr").attr('data-forward');
          let forward_fecha = $(this).parents("tr").attr('data-forward_fecha') === 'null' ? '': $(this).parents("tr").attr('data-forward_fecha'); 
          let forward_compromiso = $(this).parents("tr").attr('data-forward_compromiso') === 'null' ? '': $(this).parents("tr").attr('data-forward_compromiso');
          let swift = $(this).parents("tr").attr('data-swift') == 'null' ? '-': $(this).parents("tr").attr('data-swift'); 
          let switf_fecha = $(this).parents("tr").attr('data-switf_fecha') === 'null' ?  '': $(this).parents("tr").attr('data-switf_fecha');
     
          $(this).parents("tr").find("td:eq(5)").text(forward); 
          $(this).parents("tr").find("td:eq(6)").text(forward_fecha);
          $(this).parents("tr").find("td:eq(7)").text(forward_compromiso);
          $(this).parents("tr").find("td:eq(8)").text(swift);
          $(this).parents("tr").find("td:eq(9)").text(switf_fecha);

          $(this).parents("tr").find(".btn-edit").show();
          $(this).parents("tr").find(".btn-update").remove();
          $(this).parents("tr").find(".btn-cancel").remove();
      });

      $("#pagoTable").on("click", ".btn-update", function(){ 
          let id = $(this).attr("data-id_camion");
          let code = $(this).parents("tr").find("td:eq(1)").text();
          let forward = $(this).parents("tr").find("input[name='forward']").val();  
          let forward_fecha = $(this).parents("tr").find("input[name='forward_fecha']").val();
          let forward_compromiso = $(this).parents("tr").find("input[name='forward_compromiso']").val();
          let swift = $(this).parents("tr").find("input[name='swift']").val();
          let switf_fecha = $(this).parents("tr").find("input[name='switf_fecha']").val();
     
          $(this).parents("tr").find("td:eq(5)").text(forward);
          $(this).parents("tr").find("td:eq(6)").text(forward_fecha);
          $(this).parents("tr").find("td:eq(7)").text(forward_compromiso);
          $(this).parents("tr").find("td:eq(8)").text(swift);
          $(this).parents("tr").find("td:eq(9)").text(switf_fecha);
     
          $(this).parents("tr").attr('data-forward', forward); 
          $(this).parents("tr").attr('data-forward_fecha', forward_fecha);
          $(this).parents("tr").attr('data-forward_compromiso', forward_compromiso);
          $(this).parents("tr").attr('data-swift', swift);
          $(this).parents("tr").attr('data-switf_fecha', switf_fecha);
    
          $(this).parents("tr").find(".btn-edit").show();
          $(this).parents("tr").find(".btn-cancel").remove();
          $(this).parents("tr").find(".btn-update").remove(); 
           
          updatePagos({
                        id: id,
                        code: code,
                        forward: forward,
                        forward_fecha: forward_fecha,
                        forward_compromiso:  forward_compromiso,
                        swift: swift,
                        switf_fecha: switf_fecha,
                        _token: $("meta[name='csrf-token']").attr("content") 
                    });
      });
})

 
function updatePagos(data) {
    $.ajax({
      type:'POST',
      url:'/contenedores-camiones/pagos/update',
      data: data,
      headers: {
        _token: $("meta[name='csrf-token']").attr("content") 

      }
    }).then((data) => {
      
    })
  }
function checkPagos(data) {
    let self = data.self;
    
  } 
function dateInputMask(e) {
  
    let elm = e.target;
    elm.addEventListener('keypress', function(e) {
    if(e.keyCode < 47 || e.keyCode > 57) {
      e.preventDefault();
    }
    
    var len = elm.value.length;
    
    // If we're at a particular place, let the user type the slash
    // i.e., 12/12/1212
    if(len !== 4 || len !== 7) {
      if(e.keyCode == 47) {
        e.preventDefault();
      }
    }
    
    // If they don't add the slash, do it for them...
    if(len === 4) {
      elm.value += '-';
    }

    // If they don't add the slash, do it for them...
    if(len === 7) {
      elm.value += '-';
    }
  });
}
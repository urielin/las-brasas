$(document).ready(function(){
    $('#pagoTable').on('click', 'tbody tr td button.btn-check', function (event) {
        let code = $(this).parents("tr").find("td:eq(1)").text();
        let self = this;
        Swal.fire(
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
        })
    });
    $('#pagoTable').on('click', 'tbody tr td button.btn-edit', function (event) {
   
        let forward = $(this).parents("tr").attr('data-forward') == undefined ? ' ': $(this).parents("tr").attr('data-forward');
        let forward_fecha = $(this).parents("tr").attr('data-forward_fecha') == undefined ? ' ': $(this).parents("tr").attr('data-forward_fecha'); 
        let forward_compromiso = $(this).parents("tr").attr('data-forward_compromiso') == undefined ? ' ': $(this).parents("tr").attr('data-forward_compromiso');
        let swift = $(this).parents("tr").attr('data-swift') == undefined ? ' ': $(this).parents("tr").attr('data-swift');
        let switf_fecha = $(this).parents("tr").attr('data-switf_fecha') == undefined ? ' ': $(this).parents("tr").attr('data-switf_fecha');
         
        $(this).parents("tr").find("td:eq(5)").html('<input style="width:110px;height: 30px !important;font-size: 11px;" class="form-control browser-default" name="forward" value="'+forward+'">');
        $(this).parents("tr").find("td:eq(6)").html('<input type="date" style="width:138px;height: 30px !important;font-size: 11px;" class="form-control browser-default" name="forward_fecha" value="'+forward_fecha+'">');
        $(this).parents("tr").find("td:eq(7)").html('<input type="date" style="width:138px;height: 30px !important;font-size: 11px;" class="form-control browser-default" name="forward_compromiso" value="'+forward_compromiso+'">');
        $(this).parents("tr").find("td:eq(8)").html('<input style="width:70px; height: 30px !important;font-size: 11px;" class="form-control browser-default" name="swift" value="'+swift+'">');
        $(this).parents("tr").find("td:eq(9)").html('<input type="date" style="width:138px;height: 30px !important;font-size: 11px;" class="form-control browser-default" name="switf_fecha" value="'+switf_fecha+'">');
        
        $(this).parents("tr").find("td:eq(11)").prepend(`<span style='display: flex;'>
                                                          <button title='Guardar' style='padding: 5px 10px;' class='btn btn-50 cyan btn-xs btn-update'> 
                                                              <i class="material-icons dp48">save</i> 
                                                          </button>
                                                          <button title='Cancelar' style='padding: 5px 10px;' class='btn btn-50 red btn-xs btn-cancel'> 
                                                              <i class="material-icons dp48">close</i> 
                                                          </button>
                                                        </span>`)
                       
        $(this).hide();
      });

      $("#pagoTable").on("click", ".btn-cancel", function(){
          let forward = $(this).parents("tr").attr('data-forward');
          let forward_fecha = $(this).parents("tr").attr('data-forward_fecha');
          let forward_compromiso = $(this).parents("tr").attr('data-forward_compromiso');
          let swift = $(this).parents("tr").attr('data-swift');
          let switf_fecha = $(this).parents("tr").attr('data-switf_fecha');
         
     
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
            console.log("DATOS TODOS ", {
                code: code,
                forward: forward,
                forward_fecha: forward_fecha,
                forward_compromiso:  forward_compromiso,
                swift: swift,
                switf_fecha: switf_fecha,
                _token: $("meta[name='csrf-token']").attr("content") 
            })
          updatePagos({
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
      alert('CAMION ACTUALIZADO')
    })
  }
function checkPagos(data) {
    let self = data.self;
    
  } 
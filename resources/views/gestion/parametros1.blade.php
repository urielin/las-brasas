@extends('layouts.dashboard')

@section('content')
<div class="card card card card-default scrollspy">
  <div class="card-content">
    <div class="row"> 
          <div class="col s12">
            <div style="display: flex; justify-content: space-between;margin-bottom:10px">
              <div style="display: flex">
                <i class="material-icons dp48">subject</i>
                <span >DETALLE DE PROVEEDORES</span>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="form-control-label">Proveedor</label>
              <select class="form-control browser-default" id="proveedor" name="proveedor">
              <!--<select size class="form-control browser-default" id="proveedor" name="proveedor">-->
                <option value="">Seleccione un proveedor</option>
                @foreach ($proveedor as $p)
                  <option value="{{$p->id_proveedor}}">{{$p->emp_nombre}}</option>
                @endforeach 
               </select>
            </div>
          </div>
        </div>
    </div>
</div>
<div class="card card card card-default scrollspy">
  <div class="card-content">
    <div class="row">


      <div class="col s12">
        <ul class="tabs">
          <li class="tab col m6"><a class="active" href="#test1">Detalle Proveedor</a></li>
         </ul>
      </div>
      <div id="test1" class="col s12">
        <div class="responsive-table" style="overflow-x: scroll; width: 100%;margin-top: 20px;padding:10px">
            <div style="display: flex; justify-content: space-between">
                          <!--<div style="display: flex">
                            <i class="material-icons dp48">subject</i><span class="card-title">Catalogo de Productos</span>
                          </div>-->
                          <div class="">

                          </div>
                          <div style="display: flex;">
                           
                            <button type="button"  class="btn btn-50 green pull-rigth btn-icon-only rounded-circle float-right" id="btn-nuevo1"name="button">
                              <i class="material-icons dp48">add_box</i>
                            </button>
                            
                          </div>
                        </div>
                        <br>
          <table class="table table-responsive responsive-table centered"  id="tabla-proveedor">
            <thead>
              <tr>
                <th>Editar</th>
                <th>Código</th>
                <th>RUT</th>
                <th>Empresa</th>
                <th>País</th>
                <th>Dirección</th>
                <!--<th>Teléfono</th>
                <th>Móvil</th>
                <th>Fax</th>
                <th>Email</th>-->
                <th>Ver</th>

              </tr>
            </thead>
            <tbody id="proveedor-datos">

            </tbody>
          </table>
        </div>

        <nav style="box-shadow: none; background:white;margin-left: 14px;" id="ocultar">
          <ul id="paginationNav">

          </ul>

        </nav>
      </div>

    </div>
  </div>
</div>
@endsection



@section('js')
  <script src="{{asset('js/parametros1.js') }}"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  
@endsection

@section('modal')
  <div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Modal Header</h4>
      <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
  </div>
  <div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <div class=" col s6 pb-2">
              <h5 class="modal-title">Detalles del proveedor</h5>
            </div>
            <div class="col s6" align="right">
              <button type="button" class="modal-action modal-close waves-effect waves-green btn-flat" data-dismiss="modal">&times;</button>
            </div>
          </div>
        </div>

        <div class="modal-body">
          <span id="form_result"></span>
          <form  method="POST" id="" class="form-horizontal">
            @csrf
            <div class="row container">
                                  <div class="detalle">
                                       
                                          <label for="codigo_agregar">Código: </label>
                                          <input disabled type="text" name="codigo_detalle" readonly="readonly" id="codigo_detalle" placeholder=" " class="validate form-control-jhon" step="1">
                                        
                                  </div>
                                  <p></p>
                                  <div class="detalle">
                                        
                                          <label for="auxiliar_agregar">RUT:</label>
                                          <input disabled type="text" name="rut_detalle" readonly="readonly" id="rut_detalle" placeholder=" " class="validate form-control-jhon" step="1">
                                       
                                  </div>
                                  <p></p>
                                  <div class="detalle">
                                        
                                          <label for="descripcion_agregar">Empresa: </label>
                                          <input disabled type="text" name="empresa_detalle" readonly="readonly" id="empresa_detalle" placeholder=" " class="validate form-control-jhon" step="1">
                                     
                                        
                                  </div>
                                  <p></p>
                                  <div class="detalle">
                                        
                                          <label for="contenido_agregar">País:</label>
                                          <input disabled type="text" name="pais_detalle" readonly="readonly" id="pais_detalle" placeholder=" " class="validate form-control-jhon" step="1">
                                        
                                  </div>
                                  <p></p>
                                  <div class="detalle">
                                        
                                          <label for="documento_agregar">Móvil: </label>
                                          <input disabled type="text" name="movil_detalle" readonly="readonly" id="movil_detalle" placeholder=" " class="validate form-control-jhon" step="1">
                                        
                                        
                                  </div>
                                  <p></p>
                                  <div class="detalle">
                                        
                                          <label for="fecha_agregar">Fax:</label>
                                          <input disabled type="text" name="fax_detalle" readonly="readonly" id="fax_detalle" placeholder=" "  class="validate form-control-jhon" step="1">
                                        
                                  </div>
                                  <p></p>
                                  <div class="detalle">
                                        
                                          <label for="observaciones_agregar">Email: </label>
                                          <input disabled type="text" name="email_detalle" readonly="readonly" id="email_detalle" placeholder=" " class="validate form-control-jhon" step="1">
                                      
                                        
                                  </div>
                                  <p></p>
                                  <div class="detalle">
                                        
                                          <label for="fecha_agregar">Teléfono:</label><p></p>
                                          <input disabled type="text" name="telefono_detalle" readonly="readonly" id="telefono_detalle" placeholder=" "  class="validate form-control-jhon" step="1">
                                        
                                  </div>
                                    <p></p>
                                  <div class="detalle">
                                        
                                          <label for="documento_agregar">Dirección: </label>
                                          <input disabled type="text" name="direccion_detalle" readonly="readonly" id="direccion_detalle" placeholder=" " class="validate form-control-jhon" step="1">
                                          
                                        
                                  </div>
                                  <div class="row ">
                                        
                                        </div>
                                  </div>
                                  <style>
                                    .detalle label{
                                      width:100px;
                                      float:left;
                                      text-align: right;
                                    }
                                  </style>
                                  
             </div>
            <br />
          </form>
        </div>
      </div>
    </div>
  </div>

  <div id="formModal2" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <div class=" col s6 pb-2">
              <h5 class="modal-title">Detalle general</h5>
            </div>
          </div>
        </div>

        <div class="modal-body">
            <div class="row container">
              <div class="row pb-2">
                <div class="col s12 l6">
                      <table id="tableMostrarAdicional" class="table responsive-table centered">

                        <tbody id="tableMostrarAdicional-cuerpo">

                        </tbody>
                      </table>
                </div>

                <div class="col s12 l6">
                      <table id="tableMostrarAdicional2" class="table responsive-table centered">

                        <tbody id="tableMostrarAdicional2-cuerpo">

                        </tbody>
                      </table>
                </div>
              </div>


              <div class="modal-footer">
                <div class="col s12 l12" align="right">
                  <button type="button" class="modal-action modal-close waves-effect grey lighten-1 btn-flat" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
             </div>
            <br />

        </div>
      </div>
    </div>
  </div>

  <div id="formNuevo" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <div class=" col s6 pb-2">
              <h5 class="modal-title">Agregar nuevo proveedor</h5>
            </div>
            
          </div>
        </div>

        <div class="modal-body">
          <span id="form_result"></span>
          <form  method="POST" id="nuevo-proveedor" class="form-horizontal">
            @csrf
            <div class="row container">
                                  <div class="row pb-2">
                                    <div class="col s12 l6">
                                          <label for="codigo_agregar">Código: </label>
                                          <input type="text" name="codigo_nuevo"  id="codigo_nuevo" placeholder="¡Solo 8 caracteres!" class="validate form-controls" step="1" maxlength="8">
                                        </div>
                                        <div class="col s12 l6">
                                          <label for="auxiliar_agregar">RUT:</label>
                                          <input type="text" name="rut_nuevo"  id="rut_nuevo" placeholder="Ejm.00125698" class="validate form-controls" step="1">
                                        </div>
                                  </div>
                                  <div class="row pb-2">
                                        <div class="col s12 l6">
                                          <label for="descripcion_agregar">Empresa: </label>
                                          <input type="text" name="empresa_nuevo"  id="empresa_nuevo" placeholder="Ejm.Corporaciones Anita" class="validate form-controls" step="1">
                                        </div>
                                        <div class="col s12 l6">
                                          <label for="contenido_agregar">País:</label>
                                          <input type="text" name="pais_nuevo"  id="pais_nuevo" placeholder="Ejm. Chile" class="validate form-controls" step="1">
                                        </div>
                                  </div>
                                  
                                  <div class="row pb-2">
                                        <div class="col s12 l6">
                                          <label for="documento_agregar">Móvil: </label>
                                          <input type="text" name="movil_nuevo" id="movil_nuevo" placeholder="Ejm. 956847123" class="validate form-controls" step="1">
                                        </div>
                                        <div class="col s12 l6">
                                          <label for="fecha_agregar">Fax:</label>
                                          <input type="text" name="fax_nuevo"  id="fax_nuevo" placeholder="Ejm. 124587"  class="validate form-controls" step="1">
                                        </div>
                                  </div>

                                  <div class="row pb-2">
                                        <div class="col s12 l6">
                                          <label for="observaciones_agregar">Email: </label>
                                          <input type="text" name="email_nuevo"  id="email_nuevo" placeholder="Ejm. brasas@email.com" class="validate form-controls" step="1">
                                        </div>
                                        <div class="col s12 l6">
                                          <label for="fecha_agregar">Teléfono:</label>
                                          <input type="text" name="telefono_nuevo"  id="telefono_nuevo" placeholder="Ejm. 152364"  class="validate form-controls" step="1">
                                        </div>

                                  </div>

                                  <div class="row">
                                        <div class="col s12 l12">
                                          <label for="documento_agregar">Dirección: </label>
                                          <input type="text" name="direccion_nuevo"  id="direccion_nuevo" placeholder="Ejm. Av. Bolognesi 145" class="validate form-controls" step="1">
                                        </div>
                                        
                                  </div>
                                  <div class="row ">
                                        
                                        
                                  </div>
                                  
                                  <br>
                                  <div class="row pb-2" align="right">
                                        <div class="col s12 l12">

                                          <button type="button" class="modal-action modal-close waves-effect grey lighten-1 btn-flat" style="margin-right: 25px;" data-dismiss="modal">Cerrar</button>

                                          <input type="submit" name="agregar_button" id="action_agregar" style="background-color: #2D9741" class="btn btn-warning" value="Agregar">
                                        </div>

                                        
                                  </div>
             </div>
            <br />
          </form>
        </div>
      </div>
    </div>
  </div>
  <div id="formEdit" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <div class="col s6 pb-2">
              <h5 class="modal-title">Actualizar proveedor</h5>
            </div>
            
          </div>
        </div>

        <div class="modal-body">
          <span id="form_result"></span>
          <form  method="POST" id="editar-proveedor" class="form-horizontal">
            @csrf
            <div class="row container">
            <div class="row pb-2">
                                    <div class="col s12 l6">
                                          <label for="codigo_agregar">Código: </label>
                                          <input type="text" name="codigo_edit"  id="codigo_edit" placeholder="¡Solo 8 caracteres!" class="validate form-controls" step="1" maxlength="8" >
                                        </div>
                                        <div class="col s12 l6">
                                          <label for="auxiliar_agregar">RUT:</label>
                                          <input type="text" name="rut_edit"  id="rut_edit" placeholder="Ejm.00125698" class="validate form-controls" step="1">
                                        </div>
                                  </div>
                                  <div class="row pb-2">
                                        <div class="col s12 l6">
                                          <label for="descripcion_agregar">Empresa: </label>
                                          <input type="text" name="empresa_edit"  id="empresa_edit" placeholder="Ejm.Corporaciones Anita" class="validate form-controls" step="1">
                                        </div>
                                        <div class="col s12 l6">
                                          <label for="contenido_agregar">País:</label>
                                          <input type="text" name="pais_edit"  id="pais_edit" placeholder="Ejm. Chile" class="validate form-controls" step="1">
                                        </div>
                                  </div>
                                  
                                  <div class="row pb-2">
                                        <div class="col s12 l6">
                                          <label for="documento_agregar">Móvil: </label>
                                          <input type="text" name="movil_edit"  id="movil_edit" placeholder="Ejm. 956847123" class="validate form-controls" step="1">
                                        </div>
                                        <div class="col s12 l6">
                                          <label for="fecha_agregar">Fax:</label>
                                          <input type="text" name="fax_edit"  id="fax_edit" placeholder="Ejm. 14896"  class="validate form-controls" step="1">
                                        </div>
                                  </div>

                                  <div class="row pb-2">
                                        <div class="col s12 l6">
                                          <label for="observaciones_agregar">Email: </label>
                                          <input type="text" name="email_edit"  id="email_edit" placeholder="Ejm. brasas@email.com" class="validate form-controls" step="1">
                                        </div>
                                        <div class="col s12 l6">
                                          <label for="fecha_agregar">Teléfono:</label>
                                          <input type="text" name="telefono_edit"  id="telefono_edit" placeholder="Ejm. 985612"  class="validate form-controls" step="1">
                                        </div>

                                  </div>

                                  <div class="row">
                                      <div class="col s12 l12">
                                          <label for="documento_agregar">Dirección: </label>
                                          <input type="text" name="direccion_edit"  id="direccion_edit" placeholder="Ejm. Av. Bolognesi 1458" class="validate form-controls" step="1">
                                        </div>
                                        <div id="ocultar-id" style="display:none">
                                          <input type="text" name="id_edit"  id="id_edit" placeholder=" " class="validate form-controls" step="1">
                                        </div>
                                  </div>
                                  <div class="row ">
                                        
                                        </div>
                                  </div>
                                  
                                  <br>
                                  <div class="row" align="right">
                                        <div class="col s12 l12">
                                          <button type="button" class="modal-action modal-close waves-effect grey lighten-1 btn-flat" style="margin-right: 25px;" data-dismiss="modal">Cerrar</button>

                                          <input type="submit" name="update_button" id="action_actualizar" style="background-color: #2D9741; margin: 5px;" class="btn btn-warning" value="Actualizar">
                                                                                    <button type="button" class="modal-action modal-close waves-effect grey lighten-1 btn-flat" style="margin-right: 25px;" data-dismiss="modal">Cerrar</button>

                                        </div>
                                  </div>
             </div>
            <br />
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('after-scripts')
    <script type="text/javascript" src="{{asset('js/tabs.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>
    <script>
        $(document).ready(function(){
          paginator.listarPagos();
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
                  
                  paginator.listarPagos();
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
                  paginator.listarPagos();
                  $('#codigo_nuevo').val('');
                  $('#rut_nuevo').val('');
                  $('#empresa_nuevo').val('');
                  $('#pais_nuevo').val('');
                  $('#direccion_nuevo').val('');
                  $('#telefono_nuevo').val('');
                  $('#movil_nuevo').val('');
                  $('#fax_nuevo').val('');
                  $('#email_nuevo').val('');

            })

          })
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
                    $('#ocultar').addClass('oculto');
          });
          let paginator = { 
          pagesNumber(pagination) {
            let offset = 8;
            
                    if(!pagination.to) {
                        return [];
                    }

                    var from = pagination.current_page - offset;
                    if(from < 1) {
                        from = 1;
                    }

                    var to = from + (offset * 2);
                    if(to >= pagination.last_page){
                        to = pagination.last_page;
                    }

                    var pagesArray = [];
                    while(from <= to) {
                        pagesArray.push(from);
                        from++;
                    }
                    return pagesArray;
          },
          setPaginatorHTML(data) {
            let numberPager = this.pagesNumber(data);
            
            let html = [], preview, next;
            for (let i = 0; i < numberPager.length; i++) {
              let active = numberPager[i]  == data.current_page  ? 'active' : '';
              if (data.current_page> 1) {
                  preview =  `<li class="page-item" >
                                  <a class="page-link"  onclick="paginator.cambiarPagina('${data.current_page - 1}')">Ant</a>
                              </li>`
              } 
              if (data.current_page < data.last_page) {
                  next = `<li class="page-item "  >
                            <a class="page-link "  onclick="paginator.cambiarPagina('${data.current_page + 1}')">Sig</a>
                        </li>`
              }  
              html[i] =  `<li class="page-item  ${active}">
                          <a class="page-link" onclick="paginator.cambiarPagina(${numberPager[i]})">${numberPager[i]}</a>
                        </li>`  
            }
            html.unshift(preview);
            html.push(next);

            return html;  
          },
          setPagosHtml(data) {
            let html = [];
            //let check = [];
            for (let i = 0; i < data.length; i++) {

                btn_editar='<a type="button" value="" class="get-pdf-edit btn blue btn-50 darken-1" style="cursor: pointer"> <i class="material-icons dp48">edit</i></a>';
                btn_detalles='<a type="button" value="" class="detalles btn blue btn-50 darken-1" style="cursor: pointer"><i class="material-icons dp48">remove_red_eye</i></a>';
                
                let id = data[i].id_proveedor==null ? '':data[i].id_proveedor;
                let emp_codigo = data[i].emp_codigo==null ? '':data[i].emp_codigo;
                let emp_rut = data[i].emp_rut==null ? '':data[i].emp_rut;
                let emp_nombre = data[i].emp_nombre==null ? '':data[i].emp_nombre;
                let direccion_pais = data[i].direccion_pais==null ? '':data[i].direccion_pais;
                let direccion_direccion = data[i].direccion_direccion==null ? '':data[i].direccion_direccion;
                let com_telefono = data[i].com_telefono==null? '':data[i].com_telefono;
                let com_movil = data[i].com_movil==null ? '':data[i].com_movil;
                let com_fax = data[i].com_fax==null ? '':data[i].com_fax;
                let com_email = data[i].com_email==null ? '':data[i].com_email;

              html[i] = `<tr data-id='${data[i].id_proveedor==null ? '':data[i].id_proveedor}'
                            data-codigo='${data[i].emp_codigo==null ? '':data[i].emp_codigo}'
                            data-rut='${data[i].emp_rut==null ? '':data[i].emp_rut}'
                            data-empNombre= '${data[i].emp_nombre==null ? '':data[i].emp_nombre}'
                            data-direccionPais='${data[i].direccion_pais==null ? '':data[i].direccion_pais}'
                            data-direcciondire='${data[i].direccion_direccion==null ? '':data[i].direccion_direccion}'
                            data-telefono='${data[i].com_telefono==null? '':data[i].com_telefono}'
                            data-movil='${data[i].com_movil==null ? '':data[i].com_movil}'
                            data-fax='${data[i].com_fax==null ? '':data[i].com_fax}'
                            data-email='${data[i].com_email==null ? '':data[i].com_email}'>

                          <td>${btn_editar}</td>
                          <td>${emp_codigo==''?'-':emp_codigo}</td>
                          <td>${emp_rut==''?'-':emp_rut}</td>
                          <td>${emp_nombre==''?'-':emp_nombre}</td>
                          
                          <td>${direccion_pais==''?'-':direccion_pais}</td>
                          <td>${direccion_direccion==''?'-':direccion_direccion}</td> 
                          <td>${btn_detalles}</td>
                          
                        </tr>`;
            }
            return html; 
          },
          cambiarPagina(page){ 
              localStorage.setItem('page', page)
              this.listarPagos(page);
          },
          async listarPagos(page = 0){
            $('#ocultar').toggleClass(function(){
              if($(this).is('.oculto')){
                $('#ocultar').removeClass('oculto');
              } 
            })
            let me=this;
            var url= '/contenedores-camiones/proveedors?page=' + page; 
            let { data: data, status } = await axios.get(url); 
            let pagination = this.setPaginatorHTML(data.pagination)
            let pagos = this.setPagosHtml(data.pagos.data); 
            $('#tabla-proveedor tbody').empty().append(pagos);
            $('#paginationNav ').empty().append(pagination); 
            return page;
          },
          addCommas(nStr) {
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
        }  
  </script>
@endsection
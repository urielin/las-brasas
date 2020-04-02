@extends('layouts.dashboard')

@section('content')
 
<div class="card card card card-default scrollspy">
  <div class="card-content">
    <div class="row">

      <div class="col s12">
        <ul class="tabs">
          <li class="tab col m6"><a class="active" href="#test1">Camiones por pagar</a></li>
          <li class="tab col m6"><a href="#test2">Historial de pago de camiones</a></li>
        </ul>
      </div>
      <div id="test1" class="col s12">
        <div class="responsive-table" style="overflow-x: scroll; width: 100%;margin: 15px;"> 
          <table id='pagoTable' class="table centered responsive-table" style="font-size:13px">
              <thead>
                <tr>
                  <th> </th>
                  <th>Código</th>
                  <th>Descripción</th>
                  <th>Pagar a:</th>
                <!--<th>Total de Factura</th>--> 
                  <th>Total</th>
                  <!--<th>Moneda</th>
                  <th>Fecha Llegada</th>-->
                  <th>Forward</th>
                  <th>Fecha Forward</th>
                  <th>Fecha compromiso</th>
                  <th>Swift</th>
                  <th>Fecha Swift</th> 
                  <!--<th>Pagado Fecha</th>-->
                  <th>Ver</th>

                  <th>Editar</th>
                </tr>
              </thead>
              <tbody> 
              
              </tbody>
              
                
              
          </table> 
           
        </div>
        <nav style="box-shadow: none; background:white;margin-left: 14px;">
          <ul id="paginationNav">

          </ul>

        </nav>
        
      </div>
      <div id="test2" class="col s12">
        <div  style="overflow-x: scroll; width: 100%;margin: 15px;">
          <table id="historieTable" class="table centered responsive-table" >
          <thead>
            <tr>
              <th>Código</th>
              <th width='18%'>Descripción</th>
              <!--<th>FP</th>-->
              <!--<th>Resol. Sanit</th>-->
              <!--<th>Embarque</th>-->
              <th width='10%'>Llegada</th>
              <th>Pago Estimado.</th>
              <!--<th>Ítems</th>-->
              <th>Forma Pago</th> 
              <!--<th>Déspues</th>-->
              <th>Moneda</th>
              <th>Total Factura</th> 
              <th>Pagado</th>
              <th>Total pagado</th>

             <th>Ver</th> 
            </tr>
          </thead>
          <tbody> 

          </tbody>
        </table>  
        
         
        </div>
        <nav style="box-shadow: none; background:white; margin-left:14px">
          <ul id="paginationNav2">

          </ul>

        </nav>
      </div>

    </div>
    <div id="showModal" class="modal">
      <div class="modal-content">
        <div style="margin-bottom: 20px;">

          <h5>CAMIONES A PAGAR DETALLE</h5>
        </div>
        <div class="row" style="margin-top: 20px">
       
        <div class="col l6 m6 s12">
          <table class="table striped">
            <tbody>
              <tr>
                <td style="text-align:right;"><label for="">Codigo: </label></td>
                <td id="show_code"></td>
              </tr>
              <tr>
                <td style="text-align:right;"><label for="">Descripcion: </label></td>
                <td id="show_descripcion"></td>
              </tr>
              <tr>
                <td style="text-align:right;"><label for=""> Proveedor:</label> </td>
                <td id="show_proveedor"></td>
              </tr>
              <tr>
                <td style="text-align:right;"><label for=""> Valor Total: </label></td>
                <td id="show_valor_total"></td>
              </tr>
              <tr>
                <td style="text-align:right;"><label for=""> Tipo moneda: </label></td>
                <td id="show_tipo_moneda"></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col l6 m6 s12">
          <table class="table striped">   
            <tbody>
              
              <tr>
                <td  style="text-align:right; "><label for="">Fecha llegada: </label></td>
                <td  id="show_fecha_llegada"> </td>
              </tr>
              <tr>
                <td  style="text-align:right;"><label for="">Forward: </label></td>
                <td  id="show_forward"> </td>
              </tr>
              <tr>
                <td  style="text-align:right;"><label for="">Fecha Forward: </label></td>
                <td  id="show_fowrard_fecha"> </td>
              </tr>
              <tr>
                <td  style="text-align:right;"><label for="">Forward compromiso: </label></td>
                <td  id="show_forward_compromiso"> </td>
              </tr>
              <tr>
                <td  style="text-align:right;"><label for="">Swift: </label></td>
                <td  id="show_swift"> </td>
              </tr>
              <tr>
                <td  style="text-align:right;"><label for="">Fecha Pagado: </label></td>
                <td  id="show_pagado_fecha"> </td>
              </tr>
            </tbody>
          </table>
        </div> 
      
        </div>
      </div>
      <div class="modal-footer">
        <div class="col l12 m12 s12"> 
          <a href="#!" class="modal-action modal-close waves-effect  btn-flat">Cerrar</a>
        </div>
      </div>
    </div>
    <div id="showModal2" class="modal">
      <div class="modal-content">
        <div class="col l12 m12 s12">

          <h5>CAMIONES A PAGAR DETALLE</h5>
        </div>
        <div class="row">
            
          <div class="col l6 m6 s12">
            <table class="table striped">
              <tbody>
                <tr>
                  <td style="text-align:right;"><label for="">Camion: </label></td>
                  <td id="show_id_camion2" width='45%'></td>
                </tr>
                <tr>
                  <td style="text-align:right;"><label for="">Codigo: </label></td>
                  <td id="show_codigo2"></td>
                </tr>
                <tr>
                  <td style="text-align:right;"><label for="">Descripcion: </label></td>
                  <td id="show_descripcion2"></td>
                </tr>
                <tr>
                  <td style="text-align:right;"><label for=""> Fecha resolucion:</label> </td>
                  <td id="show_fecha_resolucion2"></td>
                </tr>
                <tr>
                  <td style="text-align:right;"><label for=""> Fecha embarque: </label></td>
                  <td id="show_fecha_embarque2"></td>
                </tr>
                <tr>
                  <td style="text-align:right;"><label for=""> Fecha llegada: </label></td>
                  <td id="show_fecha_llegada2"></td>
                </tr>
                <tr>
                  <td style="text-align:right;"><label for=""> Fecha pago: </label></td>
                  <td id="show_fecha_pago2"></td>
                </tr> 
                <tr>
                  <td  style="text-align:right; "><label for="">Cierre items: </label></td>
                  <td  id="show_cierre_items2"> </td>
                </tr>
              </tbody> 
            </table>
          </div>
          <div class="col l6 m6 s12">
            <table class="table striped">   
              <tbody>
                
                <tr>
                  <td  style="text-align:right;"><label for="">Forma Pago: </label></td>
                  <td  id="show_forma_pago2"> </td>
                </tr>
                <tr>
                  <td  style="text-align:right;"><label for="">Tipo Moneda: </label></td>
                  <td  id="show_tipo_moneda2"> </td>
                </tr>
                <tr>
                  <td  style="text-align:right;"><label for="">Dias despues: </label></td>
                  <td  id="show_dias_despues2"> </td>
                </tr>
                <tr>
                  <td  style="text-align:right;"><label for="">Despues fecha: </label></td>
                  <td  id="show_despues_fecha2"> </td>
                </tr>
                <tr>
                  <td  style="text-align:right;"><label for="">Fecha Pagado: </label></td>
                  <td  id="show_pagado_fecha"> </td>
                </tr>
                <tr>
                  <td  style="text-align:right;"><label for="">Valor total: </label></td>
                  <td  id="show_valor_total2"> </td>
                </tr>
                <tr>
                  <td  style="text-align:right;"><label for="">Pagado: </label></td>
                  <td  id="show_tipo_pagado2"> </td>
                </tr>
                <tr>
                  <td  style="text-align:right;"><label for="">Total pagado: </label></td>
                  <td  id="show_total_pagos2"> </td>
                </tr>
              </tbody>
            </table> 

        
        </div>
      </div>
      <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect  btn-flat">Cerrar</a>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>

  <script src="{{asset('js/pagos.js')}}"></script>
  <script>
    $(document).ready(function(){
       paginator.listarPagos()
       paginator.listarHistories()



    })
    let paginator = { 
      async showPago(id) {

          $('#showModal').modal('open'); 
          let url= '/contenedores-camiones/find-one?id=' + id; 
          let { data: info, status } = await axios.get(url);   
          const data  = info.data;
          
          $('#show_code').text(data.codigo)   

          $('#show_proveedor').text(data.proveedor)  
          $('#show_descripcion').text(data.descripcion)  
          $('#show_fecha_resolucion2').text(data.proveedor)  
          $('#show_valor_total').text(data.valor_total)   
          $('#show_tipo_moneda').text(data.tipo_moneda)    
          $('#show_fecha_llegada').text(data.fecha_llegada)    
          $('#show_forward').text(data.forward)    
          $('#show_fowrard_fecha').text(data.fowrard_fecha)    
          $('#show_forward_compromiso').text(data.forward_compromiso)    
          $('#show_swift').text(data.swift)    
          $('#show_switf_fecha').text(data.switf_fecha)    
          $('#show_tipo_moneda').text(data.tipo_moneda)    
          $('#show_pagado_fecha').text(data.pagado_fecha)    
  
     
      },
      async showPago2(id) {
        $('#showModal2').modal('open'); 
          let url= '/contenedores-camiones/find-one?id=' + id; 
          let { data: info, status } = await axios.get(url);   
          const data  = info.data; 
          console.log("DATA", data)
          $('#show_id_camion2').text(data.id_camion)   
          $('#show_codigo2').text(data.codigo)  
          $('#show_descripcion2').text(data.descripcion)    
          $('#show_fecha_resolucion2').text(data.fecha_resolucion)  
          $('#show_fecha_embarque2').text(data.fecha_embarque)   
          $('#show_fecha_llegada2').text(data.fecha_llegada)    
          $('#show_fecha_pago2').text(data.fecha_pago)    
          $('#show_cierre_items2').text(data.cierre_items)    
          $('#show_forma_pago2').text(data.forma_pago)    
          $('#show_dias_despues2').text(data.despues_dias)    
          $('#show_despues_fecha2').text(data.despues_fecha)    
          $('#show_tipo_moneda2').text(data.tipo_moneda)   
          $('#show_tipo_valor_total2').text(data.valor_total)   
          $('#show_tipo_pagado2').text(data.pagado)   
          $('#show_total_pagos2').text(data.total_pagos)   

      },
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
                      <a class="page-link"  onclick="paginator.cambiarPagina(${numberPager[i]})">${numberPager[i]}</a>
                    </li>`  
        }
        html.unshift(preview);
        html.push(next);

        return html;  
      },
      setPaginatorHTML2(data) {
        let numberPager = this.pagesNumber(data);
        
        let html = [], preview, next;
        for (let i = 0; i < numberPager.length; i++) {
          let active = numberPager[i]  == data.current_page  ? 'active' : '';
          if (data.current_page> 1) {
              preview =  `<li class="page-item" >
                              <a class="page-link"  onclick="paginator.cambiarPagina2('${data.current_page - 1}')">Ant</a>
                          </li>`
          } 
          if (data.current_page < data.last_page) {
              next = `<li class="page-item "  >
                        <a class="page-link "  onclick="paginator.cambiarPagina2('${data.current_page + 1}')">Sig</a>
                     </li>`
          }  
          html[i] =  `<li class="page-item  ${active}">
                      <a class="page-link"  onclick="paginator.cambiarPagina2(${numberPager[i]})">${numberPager[i]}</a>
                    </li>`  
        }
        html.unshift(preview);
        html.push(next);

        return html;  
      },
      setHistorieHTML(data) {
        let html = []; 
        for (let i = 0; i < data.length; i++) {
         
          let codigo = data[i].codigo ? data[i].codigo : '-';
          let descripcion = data[i].descripcion ? data[i].descripcion : '-'; 
          let fecha_resolucion = data[i].fecha_resolucion ? data[i].fecha_resolucion : '-';
          let fecha_embarque = data[i].fecha_embarque ? data[i].fecha_embarque : '-';

          let fecha_pago = data[i].fecha_pago ? data[i].fecha_pago : '-';
          let fecha_llegada = data[i].fecha_llegada ? data[i].fecha_llegada : '-'; 
          let forward_fecha = data[i].forward_fecha ? data[i].forward_fecha : '-';

          let cierre_items = data[i].cierre_items ? data[i].cierre_items : '-' ;
          let forma_pago = data[i].forma_pago ? data[i].forma_pago : '-';
          let despues_dias = data[i].despues_dias ? data[i].despues_dias : '-';
          
          let despues_fecha = data[i].despues_fecha ? data[i].despues_fecha : '-';
          let tipo_moneda = data[i].tipo_moneda ? data[i].tipo_moneda : '-';
          let valor_total = data[i].valor_total ? data[i].valor_total : '-';
          let pagado = data[i].pagado ? data[i].pagado : '-';

           

          html[i] = `<tr> 
                    <td>${codigo}</td>
                    <td>${descripcion}</td> 
                    <td>${fecha_llegada}</td> 
                    <td>${forward_fecha}</td> 
                    <td>${forma_pago}</td>  
                      <td>${tipo_moneda}</td> 
                      <td>${valor_total}</td> 
                      <td>${pagado}</td> 
                      <td>${pagado}</td> 

                    <td> 
                      <button  data-id='${codigo}' onclick="paginator.showPago2('${codigo}')" class ='btn btn-50 cyan btn-ver2 ' > 
                      <i class="material-icons dp48"> remove_red_eye </i>  
                      </button> 
                    </td>

                  </tr>`;
        }
        return html; 
      },
      setPagosHtml(data, total) {
        let html = [];
        let check = [];
        for (let i = 0; i < data.length; i++) {
         
          
          if (data[i].pagado == 0) {
            check[0] = `<button data-id='${data[i].codigo}'  class ='btn btn-50 green btn-check' >
                          <i class="material-icons dp48"> check </i>  
                        </button>`
          } else {
            check[0] = '-'
          }
          let descripcion = data[i].descripcion ? data[i].descripcion : '-'; 
          let proveedor = data[i].proveedor ? data[i].proveedor : '-';
          let valor_total = data[i].valor_total ? data[i].valor_total : '-';
          let tipo_moneda = data[i].tipo_moneda ? data[i].tipo_moneda : '-';
          let fecha_llegada = data[i].fecha_llegada ? data[i].fecha_llegada : '-';
          let forward = data[i].forward ? data[i].forward : '-';
          let forward_fecha = data[i].forward_fecha ? data[i].forward_fecha : '-';
          let forward_compromiso = data[i].forward_compromiso ? data[i].forward_compromiso : '-' ;
          let swift = data[i].swift ? data[i].swift : '-';
          let switf_fecha = data[i].switf_fecha ? data[i].switf_fecha : '-';
          let pagado_fecha = data[i].pagado_fecha ? data[i].pagado_fecha : '-';

          html[i] = `<tr data-code='${data[i].codigo}' 
                        data-forward='${data[i].forward}'
                        data-fecha_llegada='${data[i].fecha_llegada}'
                        data-forward_fecha='${data[i].forward_fecha}' 
                        data-forward_compromiso='${data[i].forward_compromiso}'
                        data-swift='${data[i].swift}'
                        data-switf_fecha='${data[i].switf_fecha}' >

                      <td> 
                        ${check[0]}
                      </td>
                      <td>${data[i].codigo}</td>
                      <td>${descripcion}</td>
                      <td>${proveedor}</td>
                      <td>${this.addCommas(valor_total)}</td>
                     
                      <td>${forward}</td>
                      <td>${forward_fecha}</td> 
                      <td>${forward_compromiso}</td>
                      <td>${swift}</td>
                      <td>${switf_fecha}</td>  
                      <td> 
                        <button  data-id='${data[i].codigo}' onclick="paginator.showPago('${data[i].codigo}')" class ='btn btn-50 cyan btn-ver ' > 
                        <i class="material-icons dp48"> remove_red_eye </i>  
                        </button> 
                      </td>
                      <td> 
                        <button data-id='${data[i].codigo}' class ='btn btn-50 cyan btn-edit' >
                        <i class="material-icons dp48"> edit </i>  
                        </button> 
                      </td>
                    </tr>`;
        }
        const last = `<tr> 
                        <td colspan='3'></td>
                        <td>Total: </td> 
                        <td>${total}</td> 
                      </tr>`;
        html.push(last)
        return html; 
      },
      cambiarPagina(page){  
          this.listarPagos(page);

      },
      cambiarPagina2(page){   
          this.listarHistories(page); 
      },
      async listarPagos(page = 0){
        let me=this;
        var url= '/contenedores-camiones/paginador?page=' + page; 
        let { data: data, status } = await axios.get(url); 
        let pagination = this.setPaginatorHTML(data.pagination)
        let pagos = this.setPagosHtml(data.pagos.data, data.total); 
        $('#pagoTable tbody').empty().append(pagos);
        $('#paginationNav ').empty().append(pagination); 
      },
      async listarHistories(page = 0) {
        let me=this;
        var url= '/contenedores-camiones/histories?page=' + page; 
        let { data: data, status } = await axios.get(url); 
        let pagination = this.setPaginatorHTML2(data.pagination)
        let historie = this.setHistorieHTML(data.histories.data); 
        $('#historieTable tbody').empty().append(historie);
        $('#paginationNav2').empty().append(pagination); 
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
      }, 
      
    }  
  </script>
@endsection

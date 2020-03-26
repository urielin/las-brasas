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
             
              <!--<tr >
                <td colspan="3"> 
                 
                </td> 
                <td>Total</td>
                <td> 
                 {{$total}}
                </td>  
              </tr>-->
             
          </table> 
        </div>
        <nav style="box-shadow: none; background:white;margin-left: 14px;">
          <ul id="paginationNav">

          </ul>

        </nav>
        
      </div>
      <div id="test2" class="col s12">
        <div  style="overflow-x: scroll; width: 100%;margin: 15px;">
          <table class="table centered responsive-table" >
          <thead>
            <tr>
              <th>Código</th>
              <th>Descripción</th>
              <th>FP</th>
              <th>Resol. Sanit</th>
              <th>Embarque</th>
              <th>Llegada</th>
              <th>Pago Estimado.</th>
              <th>Ítems</th>
              <th>Forma Pago</th>
              <th>-</th>
              <th>Déspues</th>
              <th>Moneda</th>
              <th>Total Factura</th>
              <th>Pagado</th>
             <!-- <th>Total Pagos</th>-->
            </tr>
          </thead>
          <tbody>
            @foreach ($histories as $camion)
                
                    <tr> 
                       <td>{{$camion->codigo}}</td> 
                      <td>{{$camion->descripcion ? $camion->descripcion : '-' }}</td> 
                      <td>{{$camion->fecha_resolucion ? $camion->fecha_resolucion : '-' }}</td> 
                      <td>{{$camion->fecha_embarque ? $camion->fecha_embarque : '-' }}</td> 
                      <td>{{$camion->fecha_llegada ? $camion->fecha_llegada : '-' }}</td> 
                      <td>{{$camion->fecha_pago ? $camion->fecha_pago : '-' }}</td> 
                      <td>{{$camion->forward_fecha ? $camion->forward_fecha : '-' }}</td> 
                      <td>{{$camion->cierre_items? $camion->cierre_items : '-' }}</td> 
                      <td>{{$camion->forma_pago ? $camion->forma_pago : '-' }}</td> 
                      <td>{{$camion->despues_dias ? $camion->despues_dias : '-' }}</td> 
                      <td>{{$camion->despues_fecha ? $camion->despues_fecha : '-' }}</td> 
                      <td>{{$camion->tipo_moneda ? $camion->tipo_moneda : '-' }}</td> 
                      <td>{{$camion->valor_total ? $camion->valor_total : '-' }}</td> 
                      <td>{{$camion->pagado ? $camion->pagado : '-' }}</td> 
                      <!--<td>"10000"</td>  -->
                    </tr>  
                @endforeach
               
          </tbody>
        </table>
           
            <ul>
          
 
              <ul  class="pagination">
                   
              </ul>
             
        </div>
      </div>

    </div>
    <div id="showModal" class="modal">
      <div class="modal-content">
        <div class="col l12 m12 s12">

          <h5>CAMIONES A PAGAR DETALLE</h5>
        </div>
        <div class="row">
          <div class="col l12 m12 s12">
            <div class="form-group col l6 m6 s12">  
              <label for=""> Codigo: </label>
              <span id="show_code"> </span>
            </div>
            <div class="form-group col l6 m6 s12">  
              <label for=""> Descripcion: </label>
              <span id="show_descripcion"> </span>
            </div>
            <div class="form-group col l6 m6 s12">  
              <label for=""> Proveedor: </label>
              <span id="show_proveedor"> </span>
            </div>
            <div class="form-group col l6 m6 s12">  
              <label for=""> Valor Total: </label>
              <span id="show_valor_total"> </span>
            </div>
            <div class="form-group col l6 m6 s12">  
              <label for=""> Fecha llegada: </label>
              <span id="show_fecha_llegada"> </span>
            </div>
            <div class="form-group col l6 m6 s12">  
              <label for=""> Forward: </label>
              <span id="show_forward"> </span>
            </div>
            <div class="form-group col l6 m6 s12">  
              <label for=""> Fecha Forward: </label>
              <span id="show_fowrard_fecha"> </span>
            </div>
            <div class="form-group col l6 m6 s12">  
              <label for=""> Forward compromiso: </label>
              <span id="show_forward_compromiso"> </span>
            </div>
            <div class="form-group col l6 m6 s12">  
              <label for=""> Swift: </label>
              <span id="show_swift"> </span>
            </div>
            <div class="form-group col l6 m6 s12">  
              <label for=""> Fecha swift: </label>
              <span id="show_switf_fecha"> </span>
            </div>
            <div class="form-group col l6 m6 s12">  
              <label for=""> Tipo moneda: </label>
              <span id="show_tipo_moneda"> </span>
            </div>
            <div class="form-group col l6 m6 s12">  
              <label for=""> Fecha Pagado: </label>
              <span id="show_pagado_fecha"> </span>
            </div>
             
          </div>
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
    })
    let paginator = { 
        async showPago(id) {
          $('#showModal').modal('open');
          console.log('id', id)

     
        let url= '/contenedores-camiones/find-one?id=' + id; 
        let { data: info, status } = await axios.get(url);   
        const data  = info.data;
        console.log('DATA',data);
        
        $('#show_code').text(data.codigo)  
        $('#show_descripcion').text(data.descripcion)  
        $('#show_proveedor').text(data.proveedor)  
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
      setPagosHtml(data) {
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
          let descripcion = data[i].descripcion ? data[i].proveedor : '-'; 
          let proveedor = data[i].proveedor ? data[i].proveedor : '-';
          let valor_total = data[i].valor_total ? data[i].valor_total : '-';
          let tipo_moneda = data[i].tipo_moneda ? data[i].tipo_moneda : '-';
          let fecha_llegada = data[i].fecha_llegada ? data[i].fecha_llegada : '-';
          let forward = data[i].forward ? data[i].forward : '-';
          let forward_fecha = data[i].forward_fecha ? data[i].forward_fecha : '-';
          let forward_compromiso = data[i].forward_compromiso ? data[i].forward_compromiso : '-' ;
          let swift = data[i].swift ? data[i].swift : '-';
          let switf_fecha = data[i].switf_fecha ? data[i].swift_fecha : '-';
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
                      <!--<td>${tipo_moneda}</td>
                      <td>${fecha_llegada}</td>-->
                      <td>${forward}</td>
                      <td>${forward_fecha}</td> 
                      <td>${forward_compromiso}</td>
                      <td>${swift}</td>
                      <td>${switf_fecha}</td> 
                      <!--  <td>${pagado_fecha}</td>-->
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
        return html; 
      },
      cambiarPagina(page){ 
          localStorage.setItem('page', page)
          this.listarPagos(page);
      },
      async listarPagos(page = 0){
        let me=this;
        var url= '/contenedores-camiones/paginador?page=' + page; 
        let { data: data, status } = await axios.get(url); 
        let pagination = this.setPaginatorHTML(data.pagination)
        let pagos = this.setPagosHtml(data.pagos.data); 
        $('#pagoTable tbody').empty().append(pagos);
        $('#paginationNav ').empty().append(pagination); 
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

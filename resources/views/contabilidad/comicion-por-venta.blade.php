@extends('layouts.dashboard')

@section('content')
<div class="card card card card-default scrollspy">
  <div class="card-content">
      <div style="display: flex">
        <i class="material-icons dp48">subject</i>
        <span style="margin-bottom: 10px;">Seleccionar resumen por mes de los asientos contables</span>

       
      </div>
      <div class="row">
        <div class="form-group col l3 m6 s12">
          <label for="" class="form-control-label">Gestión</label>
          <select class="form-control browser-default" id="gestion" name="gestion">
          <option value="">Seleccione gestión</option>  
            @foreach ($gestion as $g)
                <option value="{{$g->TP_GESTION}}">{{$g->ges}}</option>
            @endforeach 
          </select>
        </div>
        <div class="form-group col l3 m6 s12">
          <label for="" class="form-control-label">Meses</label>
          <select class="form-control browser-default" id="mes" name="mes">
          
          </select>
        </div>
        <div class="form-group col l3 m6 s12">
          <label for="" class="form-control-label">Sucursal</label>
          <select class="form-control browser-default" id="sucursal" name="sucursal">
          
          </select>
        </div>
        <div class="form-group col l3 m6 s12">
          <label for="" class="form-control-label">Vendedor</label>
          <select class="form-control browser-default" id="vendedor" name="vendedor">
          
          </select>
        </div>
        <div class="form-group col l12 m12 s12 " style="display:flex; justify-content: flex-end; margin-top:10px;margin-left: 20px;" id="botones">
       
          <!--<button type="button" class="btn btn-45 cyan" name="updateReport" id="actualizar">Actualizar Informes</button>-->
          <!--<button type="button" class="btn btn-45 cyan" name="sumarySeller">Resumen por Vendedor</button>-->
          <button type="button" class="btn cyan" name="exportSells" id="exportar-resumen" style="width: 120px;padding: 2px;margin-right: 20px;"><i class="material-icons dp48 icon-preview col s6 m3">file_download</i> Resumen</button>
          <button type="button" class="btn cyan" name="exportSells" id="exportar-detalle" style="width: 110px;padding: 2px;margin-right: 20px;"><i class="material-icons dp48 icon-preview col s6 m3">file_download</i> Detalle </button>
          <button type="button" class="btn cyan" name="reportSells" id="exportar-datos" style="width: 130px;padding: 2px;margin-right: 20px;display:none;"><i class="material-icons dp48 icon-preview col s6 m3">file_upload</i> Históricos</button>

        </div>
      </div>
  </div>
</div>
<div class="card card card card-default scrollspy">
  <div class="card-content">
    <div class="row">

      <div class="col s12">
        <ul class="tabs">
          <li class="tab"><a class="active" href="#test1" id="tabla1">Resumen de comisiones</a></li>
          <li class="tab"><a href="#test2" id="tabla2">Detalle de comisiones</a></li>
          <li class="tab"><a href="#test3" id="tabla3">Comisiones de proveedores</a></li>
          
        </ul>
      </div>
      <div id="test1" class="col s12">
        <div class="responsive-table" style="overflow-x: scroll; width: 100%;margin-top:20px;">

          <table class="table table-responsive responsive-table centered" id="tabla-comisiones" >
            <thead>
              
              <tr>
                <th>CodigoDocumento</th>
                <th>Tipo Documento</th>
                <th>Cantidad</th>
                <th>Total</th>
                
              </tr>
            </thead>
            <tbody id="contenido">

            </tbody>
          </table>
        </div>
      </div>
      <div id="test2" class="col s12">
        <div class="responsive-table" style="overflow-x: scroll; width: 100%;margin-top:20px;">
          <table class="table table-responsive responsive-table centered" id="tabla-detalles">
          <thead>
            <tr>
                <th>ID Venta</th>
                <th>Folio</th>
                <!--<th>Proc Folio Pedido</th>-->
                <!--<th>Fecha Venta</th>-->
                <th>FormaDePago</th>
                <th>Código Vendedor</th>
                <th>Precio Total</th>
                <th>Impuesto</th>
                <th>Adicional</th>
                
                <th>Precio Neto</th>
                <th>RUT Cliente</th>
                <!--<th>Comision</th>-->
                <th>Fecha Venta</th>
                <th>Fecha de Pago</th>
                <th>Monto</th>
                <th>Tipo de Documento</th>
                <th>N° Depósito</th>
                <th>ID Cartola</th>
            </tr>
          </thead>
          <tbody id="contenido-detalles">

          </tbody>
        </table>
        </div>
      </div>
      <div id="test3" class="col s12">
        <div class="responsive-table" style="overflow-x: scroll; width: 100%;margin-top:20px;">

          <table class="table table-responsive responsive-table centered" id="comisiones-vendedor" >
            <thead>
              <tr>
                <th>Editar</th>
                <th>Vendedor</th>
                <th>Nivel 1</th>
                <th>Comisión</th>
                <th>Nivel 2</th>
                <th>Comisión</th>
                <th>Nivel 3</th>
                <th>Comisión</th>
              </tr>
            </thead>
            <tbody id="contenido-vendedor">

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
    <script src="{{asset('js/comision-venta.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>
   <script>
        $(document).ready(function(){
          paginator.listarPagos();
        })
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

                btn_editar='<a type="button" value="" class="edit btn blue btn-50 darken-1" style="cursor: pointer"> <i class="material-icons dp48">edit</i></a>';
                
              html[i] = `<tr data-id='${data[i].id_vendedor}'
                            data-nombre='${data[i].nombre_vendedor}'
                            data-nivel1='${data[i].nivel1==null ? '0':data[i].nivel1}'
                            data-comision1= '${data[i].comision1==null ? '0':data[i].comision1}'
                            data-nivel2='${data[i].nivel2==null ? '0':data[i].nivel2}'
                            data-comision2='${data[i].comision2==null ? '0':data[i].comision2}'
                            data-nivel3='${data[i].nivel3==null? '0':data[i].nivel3}'
                            data-comision3='${data[i].comision3==null ? '0':data[i].comision3}'>

                          <td>${btn_editar}</td>
                          <td>${data[i].nombre_vendedor}</td>
                          
                          <td>${this.addCommas(data[i].nivel1==null ? '0':data[i].nivel1)}</td>
                          <td>${data[i].comision1==null ? '0':data[i].comision1}%</td>
                          <td>${this.addCommas(data[i].nivel2==null ? '0':data[i].nivel2)}</td>
                          
                          <td>${data[i].comision2==null ? '0':data[i].comision2}%</td>
                          <td>${this.addCommas(data[i].nivel3==null? '0':data[i].nivel3)}</td> 
                          <td>${data[i].comision3==null ? '0':data[i].comision3}%</td>
                          
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
            var url= 'comisiones-vendedor1?page=' + page; 
            let { data: data, status } = await axios.get(url); 
            let pagination = this.setPaginatorHTML(data.pagination)
            let pagos = this.setPagosHtml(data.pagos.data); 
            $('#comisiones-vendedor tbody').empty().append(pagos);
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

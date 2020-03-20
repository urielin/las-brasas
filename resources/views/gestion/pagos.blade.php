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
         <table id='pagoTable' class="table centered responsive-table">
            <thead>
              <tr>
                <th> </th>
                <th>Código</th>
                <th>Descripción</th>
                <th>Pagar a:</th>
               <!--<th>Total de Factura</th>--> 
                <th>Total</th>
                <th>Moneda</th>
                <th>Fecha Llegada</th>
                <th>Forward</th>
                <th>Fecha Forward</th>
                <th>Fecha compromiso</th>
                <th>Swift</th>
                <th>Fecha Swift</th> 
                <th>Pagado Fecha</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($paginator as $camion) 
                    <tr data-code='{{$camion->codigo}}' 
                        data-forward='{{$camion->forward}}'
                        data-fecha_llegada='{{$camion->fecha_llegada}}'
                        data-forward_fecha='{{$camion->forward_fecha}}' 
                        data-forward_compromiso='{{$camion->forward_compromiso}}'
                        data-swift='{{$camion->swift}}'
                        data-switf_fecha='{{$camion->switf_fecha}}' >

                      <td> 
                        @if ($camion->pagado == 0)
                          <button data-id='{{$camion->codigo}}' class ='btn btn-50 cyan btn-check' >
                            <i class="material-icons dp48"> check </i>  
                          </button>
                        @endif 
                      </td>
                      <td>{{$camion->codigo}}</td>
                      <td>{{$camion->descripcion ? $camion->descripcion : '-' }}</td>
                      <td>{{$camion->proveedor ? $camion->proveedor : '-' }}</td>
                      <td>{{$camion->valor_total ? $camion->valor_total : '-' }}</td>
                      <td>{{$camion->tipo_moneda ? $camion->tipo_moneda : '-' }}</td>
                      <td>{{$camion->fecha_llegada ? $camion->fecha_llegada : '-' }}</td>
                      <td>{{$camion->forward ? $camion->forward : '-' }}</td>
                      <td>{{$camion->forward_fecha ? $camion->forward_fecha : '-'}}</td> 
                      <td>{{$camion->forward_compromiso ? $camion->forward_compromiso : '-' }}</td>
                      <td>{{$camion->swift ? $camion->swift : '-' }}</td>
                      <td>{{$camion->switf_fecha ? $camion->swift_fecha : '-' }}</td> 
                      <td>{{$camion->pagado_fecha ? $camion->pagado_fecha : '-'}}</td>
                      <td> 
                        <button data-id='{{$camion->codigo}}' class ='btn btn-50 cyan btn-edit' >
                        <i class="material-icons dp48"> edit </i>  
                        </button> 
                      </td>
                    </tr>  
                @endforeach
                    <tr >
                      <td colspan="3"> 
                       
                      </td> 
                      <td>Total</td>
                      <td> 
                       {{$total}}
                      </td>  
                    </tr> 
            </tbody>
          </table> 
        </div>
        <nav>
          @if ($paginator->lastPage() > 1)
            <ul class="pagination">
                <li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
                    <a href="{{ $paginator->url(1) }}">Previous</a>
                </li>
                @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                    <li class=" page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                        <a class='page-link' href="{{ $paginator->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
                    <a href="{{ $paginator->url($paginator->currentPage()+1) }}" >Next</a>
                </li>
            </ul>
          @endif

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
          <nav>
            <ul>
              <li class="page-item" v-if="pagination.current_page > 1">
                <a class="page-link" href="#" onclick="cambiarPagina(pagination.current_page - 1)">Ant</a>
              </li>
              <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                <a class="page-link" href="#" onclick="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
              </li>
              <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                <a class="page-link" href="#" onclick="cambiarPagina(pagination.current_page)">Sig</a>
              </li>
            </ul>


            @if ($histories->lastPage() > 1)
              <ul class="pagination">
                  <li class="{{ ($histories->currentPage() == 1) ? ' disabled' : '' }}">
                      <a href="{{ $histories->url(1) }}">Previous</a>
                  </li>
                  @for ($i = 1; $i <= $histories->lastPage(); $i++)
                      <li class=" page-item {{ ($histories->currentPage() == $i) ? ' active' : '' }}">
                          <a class='page-link' href="{{ $histories->url($i) }}">{{ $i }}</a>
                      </li>
                  @endfor
                  <li class="{{ ($histories->currentPage() == $histories->lastPage()) ? ' disabled' : '' }}">
                      <a href="{{ $histories->url($histories->currentPage()+1) }}" >Next</a>
                  </li>
              </ul>
            @endif
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
  <script>
    
  </script>
  <script src="{{asset('js/pagos.js')}}"></script>
  <script>
    $(document).ready(function(){
      this.paginator.listarPagos()
    })
    let paginator = { 
      pagesNumber() => {
                if(!this.pagination.to) {
                    return [];
                }

                var from = this.pagination.current_page - this.offset;
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
      },
      setPaginatorHTML() => {
        let numberPager = this.pagesNumber();
        let hmtl = [];
        for (let i = 0; i < numberPager.length; i++) {
          let page == numberPager[i] ? 'active' : '';
          html =. `<li class="page-item">
                    <a class="page-link" href="#" onclick="paginator.cambiarPagina(${numberPager[i]})" v-text="page"></a>
                  </li>` 
        } 
      },
      cambiarPagina(page){
          let me = this; 
          me.pagination.current_page = page; 
          this.listarIngreso(page);
      },
      listarPagos(page = 1){
        let me=this;
        var url= 'contenedores-camiones/pagos?page=' + page;

        $.ajax({
          url: url,
          type: 'GET',
        }).then((data) => {
          var respuesta= response.data;
          me.arrayIngreso = respuesta.ingresos.data;
          me.pagination= respuesta.pagination;
          
        })
        axios.get(url).then(function (response) {
        
        })
        .catch(function (error) {
            console.log(error);
        });
      }
    } 
  </script>
@endsection

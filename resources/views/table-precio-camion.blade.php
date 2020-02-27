@php
          //dd($PrecioCamion);
          $PrecioCamion = isset($PrecioCamion[0]) ? $PrecioCamion :  array($PrecioCamion);
          //agrupamos los datos por camion
          if(!empty($PrecioCamion[0])){
          //dd($PrecioCamion[0]);
          foreach ($PrecioCamion as $camion) {
              $result[$camion->camion][] = $camion;
          }
          $col_count=count($result);
          }
          //dd($result);


        @endphp
        <table class="table-precio-camion" style="background: white;margin-top: -6px;width: auto;max-height: 60vh;">
          <thead class="thead-light">
             <tr>
              <th scope="col"colspan="2"></th>

              <th scope="col"colspan="2"></th>
              @if(!empty($result))
              @foreach($result as $key => $value)
              <th scope="col"colspan="2" class="text-center">{{$key}}</th>
              @endforeach
              @endif
            </tr>
            <tr>
              <th scope="col"colspan="2"></th>
              <th scope="col"colspan="2"></th>
              @if(!empty($col_count))
              @for($i = 0; $i < $col_count; $i++)
              <th scope="col">Publico</th>
              <th scope="col">P.Mayor</th>
              @endfor
              @endif
            </tr>
          </thead>
          <tbody>
            @if(!empty($PrecioCamion[0]))
            @foreach($PrecioCamion as $camion)
                @php
                      //si hay solo una columna asignamos col_count a 2 para que se ejecute switch case(1) para todas las filas
                      $col_count=count($result)==1?2:count($result);

                      $fecha_actual = new \DateTime();
                      $fecha_actual->setTimezone(new \DateTimeZone('America/Lima'));
                      
                      //si no hay fecha de baja DateTime tomara la fecha actual
                      $fecha_baja = new \DateTime($camion->fecha_baja);
          
                      //diferencia en formato dias
                      $interval = $fecha_actual->diff($fecha_baja);
                      $interval_dias = intval($interval->format('%R%a'));
                      $interval = intval($interval->format('%R%h')) + $interval_dias*24;
                      $fecha_baja= $fecha_baja->format('Y-m-d');
                      $td_class = $interval==0 ? '' : ($interval<=0 ? 'red-text' : ($interval<=48 ? 'amber-text': ($interval<=168? 'green-text' :''))) ;
                      $td_tooltip = $interval==0 ? '' : ($interval<=0 ? 'Oferta caducada' : ($interval<=48 ? 'A dias de vencer': ($interval<=168? 'Vence en una semana' :''))) ;

                @endphp
                @switch($loop->iteration % $col_count)
                  @case(1)
                    <tr>
                      <th scope="row">
                        {{$camion->codigo}}
                      </th>
                      <th scope="row">
                        {{$camion->descripcion}}
                      </th>
                      <th scope="row">
                        {{floatval($camion->lista_publico)}}
                      </th>
                      <th scope="row" style=" ">
                        {{floatval($camion->lista_mayor)}}
                      </th>
                      <td data-tooltip="{{$td_tooltip}}" class="{{$td_class}} mostrar-info right-align {{!empty($td_tooltip)?'tooltipped':''}}" data-codigo="{{$camion->codigo}}" data-camion="{{$camion->camion}}" data-descripcion="{{$camion->descripcion}}"
                           data-sucursal="{{$camion->sucursal}}" data-publico="{{floatval($camion->precio_publico)}}" data-mayor="{{floatval($camion->precio_mayor)}}" data-fecha_baja="{{$fecha_baja}}" data-interval="{{$interval}}" data-cif_tierra="{{$camion->cif_tierra}}">
                           @if(!empty($td_tooltip))
                           <i class="{{$td_class}} text-lighten-2 material-icons small-icons p-0 m-0" style=" ">fiber_manual_record </i>
                           @endif
                           {{floatval($camion->precio_publico)}}
                      </td>
                      <td data-tooltip="{{$td_tooltip}}" class="{{$td_class}} mostrar-info right-align {{!empty($td_tooltip)?'tooltipped':''}}" data-codigo="{{$camion->codigo}}" data-camion="{{$camion->camion}}" data-descripcion="{{$camion->descripcion}}"
                           data-sucursal="{{$camion->sucursal}}" data-publico="{{floatval($camion->precio_publico)}}" data-mayor="{{floatval($camion->precio_mayor)}}" data-fecha_baja="{{$fecha_baja}}" data-interval="{{$interval}}" data-cif_tierra="{{$camion->cif_tierra}}">
                           @if(!empty($td_tooltip))
                           <i class="{{$td_class}} text-lighten-2 material-icons small-icons p-0 m-0" style=" ">fiber_manual_record </i>
                           @endif
                           {{floatval($camion->precio_mayor)}}
                      </td>
                        @break

                  @case(0)
                      <td data-tooltip="{{$td_tooltip}}" class="{{$td_class}} mostrar-info right-align {{!empty($td_tooltip)?'tooltipped':''}}" data-codigo="{{$camion->codigo}}" data-camion="{{$camion->camion}}" data-descripcion="{{$camion->descripcion}}"
                           data-sucursal="{{$camion->sucursal}}" data-publico="{{floatval($camion->precio_publico)}}" data-mayor="{{floatval($camion->precio_mayor)}}" data-fecha_baja="{{$fecha_baja}}" data-interval="{{$interval}}" data-cif_tierra="{{$camion->cif_tierra}}">
                           @if(!empty($td_tooltip))
                           <i class="{{$td_class}} text-lighten-2 material-icons small-icons p-0 m-0" style=" ">fiber_manual_record </i>
                           @endif
                           {{floatval($camion->precio_publico)}}
                      </td>
                      <td data-tooltip="{{$td_tooltip}}" class="{{$td_class}} mostrar-info right-align {{!empty($td_tooltip)?'tooltipped':''}}" data-codigo="{{$camion->codigo}}" data-camion="{{$camion->camion}}" data-descripcion="{{$camion->descripcion}}"
                           data-sucursal="{{$camion->sucursal}}" data-publico="{{floatval($camion->precio_publico)}}" data-mayor="{{floatval($camion->precio_mayor)}}" data-fecha_baja="{{$fecha_baja}}" data-interval="{{$interval}}" data-cif_tierra="{{$camion->cif_tierra}}">
                           @if(!empty($td_tooltip))
                           <i class="{{$td_class}} text-lighten-2 material-icons small-icons p-0 m-0" style=" ">fiber_manual_record </i>
                           @endif
                           {{floatval($camion->precio_mayor)}}
                      </td>
                    </tr> 
                    @break
 
                  @default
                      <td data-tooltip="{{$td_tooltip}}" class="{{$td_class}} mostrar-info right-align {{!empty($td_tooltip)?'tooltipped':''}}" data-codigo="{{$camion->codigo}}" data-camion="{{$camion->camion}}" data-descripcion="{{$camion->descripcion}}"
                           data-sucursal="{{$camion->sucursal}}" data-publico="{{floatval($camion->precio_publico)}}" data-mayor="{{floatval($camion->precio_mayor)}}" data-fecha_baja="{{$fecha_baja}}" data-interval="{{$interval}}" data-cif_tierra="{{$camion->cif_tierra}}">
                           @if(!empty($td_tooltip))
                           <i class="{{$td_class}} text-lighten-2 material-icons small-icons p-0 m-0" style=" ">fiber_manual_record </i>
                           @endif
                           {{floatval($camion->precio_publico)}}
                      </td>
                      <td data-tooltip="{{$td_tooltip}}" class="{{$td_class}} mostrar-info right-align {{!empty($td_tooltip)?'tooltipped':''}}" data-codigo="{{$camion->codigo}}" data-camion="{{$camion->camion}}" data-descripcion="{{$camion->descripcion}}"
                           data-sucursal="{{$camion->sucursal}}" data-publico="{{floatval($camion->precio_publico)}}" data-mayor="{{floatval($camion->precio_mayor)}}" data-fecha_baja="{{$fecha_baja}}" data-interval="{{$interval}}" data-cif_tierra="{{$camion->cif_tierra}}">
                           @if(!empty($td_tooltip))
                           <i class="{{$td_class}} text-lighten-2 material-icons small-icons p-0 m-0" style=" ">fiber_manual_record </i>
                           @endif
                           {{floatval($camion->precio_mayor)}}
                      </td>
                @endswitch

            @endforeach
            @endif
          </tbody>
        </table>
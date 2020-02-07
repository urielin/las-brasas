@php
          //dd($PrecioCamion);
          $PrecioCamion = isset($PrecioCamion[0]) ? $PrecioCamion :  array($PrecioCamion);
          //agrupamos los datos por camion
          if(!empty($PrecioCamion[0])){
          //dd($PrecioCamion[0]);
          foreach ($PrecioCamion as $camion) {
              $result[$camion->camion][] = $camion;
          }
          $row_count=count($result);
          }
          //dd($result);


        @endphp
        <table class="responsive-table striped">
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
              <th scope="col"></th>
              <th scope="col"></th>
              <th scope="col"></th>
              <th scope="col"></th>
              @if(!empty($row_count))
              @for($i = 0; $i < $row_count; $i++)
              <th scope="col">Publico</th>
              <th scope="col">Mayorista</th>
              @endfor
              @endif
            </tr>
          </thead>
          <tbody>
            @if(!empty($PrecioCamion[0]))
            @foreach($PrecioCamion as $camion)
                @php
                      $row_count=count($result)==1?2:count($result);
                      $fecha_actual = new \DateTime();
                      $fecha_actual->setTimezone(new \DateTimeZone('America/Lima'));
                      //$fecha_actual= $fecha_actual->format('d-m-Y H:i:s');

                      $fecha_baja = new \DateTime($camion->fecha_baja);
                      //$fecha_baja->setTimezone(new \DateTimeZone('America/Lima'));
                      //$fecha_baja= $fecha_baja->format('d-m-Y H:i:s');

                      //diferencia en formato dias
                      $interval = $fecha_actual->diff($fecha_baja);
                      $interval_dias = intval($interval->format('%R%a'));
                      $interval = intval($interval->format('%R%h')) + $interval_dias*24;
                      $fecha_baja= $fecha_baja->format('d/m/Y');
                      $td_class = $interval==0 ? '' : ($interval<=0 ? 'table-danger' : ($interval<=48 ? 'table-warning': ($interval<=168? 'table-success' :''))) ;
                @endphp
                @switch($loop->iteration % $row_count)
                  @case(1)
                    <tr>
                      <th scope="row">
                        {{$camion->codigo}}
                      </th>
                      <th scope="row">
                        {{$camion->descripcion}}
                      </th>
                      <th scope="row">
                        {{$camion->lista_publico}}
                      </th>
                      <th scope="row">
                        {{$camion->lista_mayor}}
                      </th>
                      <td class="mostrar-info {{$td_class}}" data-codigo="{{$camion->codigo}}" data-camion="{{$camion->camion}}" data-descripcion="{{$camion->descripcion}}"
                           data-sucursal="{{$camion->sucursal}}" data-publico="{{$camion->precio_publico}}" data-mayor="{{$camion->precio_mayor}}" data-fecha_baja="{{$fecha_baja}}" data-interval="{{$interval}}">
                        {{$camion->precio_publico}}
                      </td>
                      <td class="mostrar-info  {{$td_class}}" data-codigo="{{$camion->codigo}}" data-camion="{{$camion->camion}}" data-descripcion="{{$camion->descripcion}}"
                           data-sucursal="{{$camion->sucursal}}" data-publico="{{$camion->precio_publico}}" data-mayor="{{$camion->precio_mayor}}" data-fecha_baja="{{$fecha_baja}}" data-interval="{{$interval}}">
                        {{$camion->precio_mayor}}
                      </td>
                        @break

                  @case(0)
                      <td class="mostrar-info {{$td_class}}" data-codigo="{{$camion->codigo}}" data-camion="{{$camion->camion}}" data-descripcion="{{$camion->descripcion}}"
                           data-sucursal="{{$camion->sucursal}}" data-publico="{{$camion->precio_publico}}" data-mayor="{{$camion->precio_mayor}}" data-fecha_baja="{{$fecha_baja}}" data-interval="{{$interval}}">                         {{$camion->precio_publico}}
                        </td>
                      <td class="mostrar-info {{$td_class}}" data-codigo="{{$camion->codigo}}" data-camion="{{$camion->camion}}" data-descripcion="{{$camion->descripcion}}"
                           data-sucursal="{{$camion->sucursal}}" data-publico="{{$camion->precio_publico}}" data-mayor="{{$camion->precio_mayor}}" data-fecha_baja="{{$fecha_baja}}" data-interval="{{$interval}}">                          {{$camion->precio_mayor}}
                      </td>
                    </tr> 
                    @break
 
                  @default
                        <td class="mostrar-info {{$td_class}}" data-codigo="{{$camion->codigo}}" data-camion="{{$camion->camion}}" data-descripcion="{{$camion->descripcion}}"
                           data-sucursal="{{$camion->sucursal}}" data-publico="{{$camion->precio_publico}}" data-mayor="{{$camion->precio_mayor}}" data-fecha_baja="{{$fecha_baja}}" data-interval="{{$interval}}">                         {{$camion->precio_publico}}
                        </td>
                        <td class="mostrar-info {{$td_class}}" data-codigo="{{$camion->codigo}}" data-camion="{{$camion->camion}}" data-descripcion="{{$camion->descripcion}}"
                           data-sucursal="{{$camion->sucursal}}" data-publico="{{$camion->precio_publico}}" data-mayor="{{$camion->precio_mayor}}" data-fecha_baja="{{$fecha_baja}}" data-interval="{{$interval}}">                          {{$camion->precio_mayor}}
                        </td>
                @endswitch

            @endforeach
            @endif
          </tbody>
        </table>
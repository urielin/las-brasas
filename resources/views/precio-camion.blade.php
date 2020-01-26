@extends('layouts.dashboard')

@section('content')

<div class="main-content ">
    <div class="bg-gradient-primary container-fluid pb-7 pt-3">
      <p class="h1 mb-0 text-white text-uppercase d-lg-inline-block" >Precios / Camión</p>

      <div class="row">
        <div class="col-4">
          <form action="{{route('precio-camion')}}" method="GET">
          @csrf
          <label class="h4 mb-0 text-white d-lg-inline-block" for="sel1">Clasificacion</label>
          <select name="clasificacion" class="form-control" id="sel1" onchange="this.form.submit()">
          @foreach($CamionesClasificacion as $item)
            <option value="{{$item->cod_int}}" {{ $item->cod_int==$clasificacion?'selected':' '}} >{{$item->desc01}}</option>
          @endforeach
          </select>
          </form>
        </div>
<!--
        <div class="col-4">
          <label class="h4 mb-0 text-white d-lg-inline-block" for="usr">Camión</label>
          <button type="button" class="btn btn-primary btn-sm">Agregar/Retirar</button>
          <input type="text" class="form-control" id="agregar-camion">
        </div>

        <div class="col-4">
          <label class="h4 mb-0 text-white d-lg-inline-block" for="pwd">Código</label>
          <button type="button" class="btn btn-primary btn-sm">Agregar/Retirar</button>
          <input type="text" class="form-control" id="producto-camion">
        </div> -->
      </div>
    </div>
    <div class="container-fluid mt--7">
    <div class="row ">
    <div class="col-xl-12 mb-5 mb-xl-0">
        <div class="card shadow mt-3">
          <div class="card-header border-0  mb--2">
            <div class="row align-items-center">
              <div class="col-12 ">
                  <div class="row">
                    <div class="col-4 media">
                      <h1 class="mb-0">Saldo por camiones        </h2>
                    </div>
                    <div class="col-4">
                      <!-- <button type="button" class="btn btn-primary">Imprimir</button> -->
                      <a href="{{route('precio-camion')}}" type="button" class="btn btn-success">Actualizar</a>
                    </div>
                    <div class="col-4">
                    </div>
                  </div>


                {{-- <h1 class="mb-0">Edición del precio de Camión</h3> --}}
              </div>


            </div>
          </div>
          <div class="table-responsive  table-hover">
          <div id="table-precio-camion" class="table-responsive">
           <!--  tabla -->
           @include('table-precio-camion', ['PrecioCamion' => $PrecioCamion])
            <!--  endtabla -->
 
          </div>

            <!-- Projects table -->

          </div>
        </div>



        </div>
        </div>
      </div>


    <!-- Footer -->

    </div>
</div>

<!-- modal  -->
<div id="formalModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Modificar precio</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body card-body px-lg-5 py-lg-4">
          <span id="form_result"></span>
          <form method="post" id="actualizar_precio" action="{{route('actualizar-ofertas')}}" enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
                <label class="control-label col-md-4 mb-0">Camión: </label>
                <input id="camion" type="text" name="camion"  class="form-control col-md-8 form-control-alternative" disabled>

            </div>
            <div class="form-group row">
                <label class="control-label col-md-4 mb-0">Código: </label>
                <input id="codigo" type="text" name="codigo" class="form-control col-md-8 form-control-alternative" disabled>

            </div>
            <div class="form-group row">
                <label class="control-label col-md-4 mb-0">Descripción: </label>
                <input id="descripcion" type="text" name="descripcion"  class="form-control col-md-8 form-control-alternative" disabled> 

            </div>


            <div class="form-group row">
              <label class="control-label col-md-4">Precio público: </label>
              
              <input id="publico" type="text" name="publico"  class="form-control col-md-8" id="example" placeholder ="">

            </div>
            <div class="form-group row">
              <label class="control-label col-md-4">Precio mayorista: </label>
              <input id="mayor" type="text" name="mayor" class="form-control col-md-8">
            </div>

          <div class="form-group row">
              <div class="input-group ">
                  <label class="control-label col-md-4" for="exampleDatepicker">Fecha de caducidad</label>

                  <div class="input-group-prepend ">
                          <span class="input-group-text"><i class="ni ni-calendar-grid-58" style=" max-height: 46px; "></i></span>
                  </div>
                  <input id="fecha_baja"  name="fecha_baja" class="form-control datepicker col-md-8" placeholder="Selecciona una fecha" type="text" value="">
              </div>
          </div>
            <br>
            <div class="form-group align-center">
              <input type="hidden" name="hidden_id" id="hidden_id">
              <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Actualizar Datos">
            </div>
          </form>
      </div>
    </div>
  </div>
</div>
@endsection

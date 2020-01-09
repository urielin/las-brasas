@extends('layouts.dashboard')

@section('content')

<div class="main-content ">
    <div class="bg-gradient-primary container-fluid ">

    <div class="row ">
    <div class="col-xl-12 mb-5 mb-xl-0">
        <div class="card shadow mt-3">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col-10 ">
                <h1 class="mb-0">Edición del precio de Camión</h3>
              </div>

              <div class="col-2 text-right">
                <a href="#!" class="btn btn-sm btn-primary">See all</a>
              </div>
            </div>
          </div>
          <div class="table-responsive table-dark table-hover">
            <!-- Projects table -->
            <table class="table align-items-center table-flush">
              {{-- <thead class="thead-light"> --}}
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Usuario</th>
                  <th scope="col">Apellido Paterno</th>
                  <th scope="col">Apellido Materno</th>
                  <th scope="col">Nombres</th>
                  <th scope="col">Cargo</th>
                </tr>
              {{-- </thead> --}}
              <tbody>
                @foreach($PrecioCamion as $camion)
                  <tr>
                    <th scope="row">
                      {{$camion->camion}}
                    </th>
                    <td>
                      {{$camion->codigo}}
                    </td>
                    <td>
                     {{$camion->descripcion}}
                    </td>
                    <td>
                     {{$camion->lista_publico}}
                    </td>
                    <td>
                     {{$camion->precio_publico}}
                    </td>
                    <td>
                     {{$camion->precio_mayor}}
                    </td>

                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
    <!-- Footer -->

    </div>
</div>
@endsection

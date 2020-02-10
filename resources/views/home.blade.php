@extends('layouts.dashboard')

@section('content')
 
<div class="container-fluid mt--7">

<div class="row mt-5">
<div class="col-xl-12 mb-5 mb-xl-0">
    <div class="card shadow">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">Usuarios</h3>
          </div>
          <div class="col text-right">
            <a href="#!" class="btn btn-sm btn-primary">See all</a>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Usuario</th>
              <th scope="col">Apellido Paterno</th>
              <th scope="col">Apellido Materno</th>
              <th scope="col">Nombres</th>
              <th scope="col">Cargo</th>
            </tr>
          </thead>
          <tbody>
            @foreach($usuarios as $usuario)
              <tr>
                <th scope="row">
                  {{$usuario->id_usuario}}
                </th>
                <td>
                  {{$usuario->usuario}}
                </td>
                <td>
                 {{$usuario->paterno}}
                </td>
                <td>
                 {{$usuario->materno}}
                </td>
                <td>
                 {{$usuario->nombres}}
                </td>
                <td>
                 {{$usuario->cargo}}
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
@endsection

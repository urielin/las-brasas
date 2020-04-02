@extends('layouts.dashboard')

@section('content')

<div class="container">
    <div class="row ">
       <div class="col l12 m12 s12">
          <div class="card">
            <div class="card-header "  style="padding-left: 15px">
              <div class="row align-items-center">
                <div style="display: flex; justify-content: space-between">
                  <div style="display: flex">
                    <i class="material-icons dp48">subject</i><span class="card-title">Lista de usuarios</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body" style="padding: 15px">
              <div class="table-wrapper" style="margin: 10px;" >
              <table class="table centered responsive-table " style="padding: 15px">
                <thead >
                  <tr>
                    <th >#</th>
                    <th  >Usuario</th>
                    <th >Ap. Paterno</th>
                    <th >Ap. Materno</th>
                    <th >Nombres</th>
                    <th  >Cargo</th>
               
                  </tr>
                </thead>
                <tbody>
                  @foreach($usuarios as $usuario)
                    <tr>
                      <td >
                        {{$usuario->id_usuario}}
                      </td>
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
    </div>
</div>
@endsection

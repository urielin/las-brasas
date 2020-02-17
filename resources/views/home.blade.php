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
                    <i class="material-icons dp48">subject</i><span class="card-title">Usuarios</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body" style="padding: 15px">
              <div class="table-wrapper" style="margin: 10px;" >
              <table class="table responsive-table " style="padding: 15px">
                <thead class="thead-light">
                  <tr>
                    <th >#</th>
                    <th scope="col" >Usuario</th>
                    <th scope="col" >Ap. Paterno</th>
                    <th scope="col" >Ap. Materno</th>
                    <th scope="col" >Nombres</th>
                    <th scope="col">Cargo</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($usuarios as $usuario)
                    <tr>
                      <th style='text-align: center;'>
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
    </div>
</div>
@endsection

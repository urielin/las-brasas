@extends('layouts.dashboard')

@section('content')
  <div class="main-content">
    <div class="bg-gradient-primary container-fluid pb-7 pt-3">
      <p class="h1 mb-0 text-white text-uppercase d-lg-inline-block" >GESTIÓN CAMIONES</p>
      <br><br>
      <div class="row ">
        <div class="col-3 bg-gradient-secondary border mf-2 mr-1">
          <div class="form-group">
            <label for="exampleFormControlInput1">Buscar camiones</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Ingrese código camión">
          </div>
        </div>


        <div class="col-8 bg-gradient-secondary border ">
          <div class="row">
            <div class="form-group col-6">
              <label for="exampleFormControlSelect1">Example select</label>
              <select class="form-control" id="exampleFormControlSelect1">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div>

            <div class="form-group col-6">
              <label for="exampleFormControlSelect2">Ingresar año </label>
              <select multiple class="form-control" id="exampleFormControlSelect2">
                <option>2020</option>
                <option>2019</option>
                <option>2018</option>
                <option>2017</option>
                <option>2016</option>
              </select>
            </div>
          </div>
        </div>
      </div>

      <hr>

      <div class="row">
        <div class="table-responsive table-dark table-hover">
          <table  class="table align-items-center table-flush">
            <thead>
              <tr>
                <th scope="col">Fecha</th>
                <th scope="col">Cambio</th>
                <th scope="col">USUARIO</th>
              </tr>
            </thead>
            <tbody>

              <tr>
                <td>
                  A
                </td>
                <td>
                  B
                </td>
                <td>
                  C
                </td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>

      
    </div>
  </div>
@endsection

@extends('layouts.dashboard')

@section('content')

<div class="main-content ">
    <div class="bg-gradient-primary container-fluid pb-7 pt-3">
      <p class="h1 mb-0 text-white text-uppercase d-lg-inline-block" >Precios / Camión</p>

      <div class="row">
        <div class="col-4">
          <label class="h4 mb-0 text-white d-lg-inline-block" for="sel1">Clasificacion</label>
          <select class="form-control" id="sel1">
            <option>VACIO</option>
            <option>CONGELADO</option>
            <option>CERDO</option>
            <option>POLLO</option>
            <option>TRASPASOS</option>
            <option>OTROS</option>
          </select>
        </div>

        <div class="col-4">
          <label class="h4 mb-0 text-white d-lg-inline-block" for="usr">Camión</label>
          <button type="button" class="btn btn-primary btn-sm">Agregar/Retirar</button>
          <input type="text" class="form-control" id="usr">
        </div>

        <div class="col-4">
          <label class="h4 mb-0 text-white d-lg-inline-block" for="pwd">Código</label>
          <button type="button" class="btn btn-primary btn-sm">Agregar/Retirar</button>
          <input type="text" class="form-control" id="usr">
        </div>
      </div>
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
                      <button type="button" class="btn btn-primary">Imprimir</button>
                      <button type="button" class="btn btn-success">Actualizar</button>
                    </div>
                    <div class="col-4">
                    </div>
                  </div>


                {{-- <h1 class="mb-0">Edición del precio de Camión</h3> --}}
              </div>


            </div>
          </div>
          <div class="table-responsive table-dark table-hover">

            <!-- Projects table -->
            <table class="table align-items-center table-flush">
              <thead>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th>18BL11</th>
                  <th>18BL11</th>
                  <th>18BL11</th>
                  <th>18BL11</th>
                  <th>18BL11</th>
                  <th>18BL11</th>
                  <th>18BL11</th>
                  <th>18BL11</th>
                  <th>18BL11</th>
                  <th>18BL11</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>Público</td>
                  <td>Mayorista</td>
                  <td>Público</td>
                  <td>Mayorista</td>
                  <td>Público</td>
                  <td>Mayorista</td>
                  <td>Público</td>
                  <td>Mayorista</td>
                  <td>Público</td>
                  <td>Mayorista</td>
                </tr>
                <tr>
                  <td>2189</td>
                  <td>BOLA LOMO CAT V</td>
                  <td>3890</td>
                  <td>3790</td>
                  <td></td>
                  <td class="mostrar-info">4090</td>
                  <td></td>
                  <td  class="mostrar-info">4090</td>
                  <td></td>
                  <td class="mostrar-info">4090</td>
                  <td></td>
                  <td class="mostrar-info">4090</td>
                  <td class="mostrar-info">4190</td>
                  <td class="mostrar-info">4090</td>
                </tr>

                <tr>
                  <td>2799</td>
                  <td>FIL.PESCADO PANGASIUS</td>
                  <td>2500</td>
                  <td>2400</td>
                  <td></td>
                  <td>4090</td>
                  <td></td>
                  <td class="mostrar-info">4090</td>
                  <td class="mostrar-info">4190</td>
                  <td></td>
                  <td></td>
                  <td class="mostrar-info">4090</td>
                  <td></td>
                  <td></td>
                </tr>

                <tr>
                  <td>3075</td>
                  <td>Post.Rosada Cong</td>
                  <td>3390</td>
                  <td>3940</td>
                  <td>4190</td>
                  <td class="mostrar-info">4090</td>
                  <td class="mostrar-info">4190</td>
                  <td class="mostrar-info">4090</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>

              </tbody>
            </table>
          </div>
          <div >



        </div>
        </div>
      </div>

    </div>
    <!-- Footer -->

    </div>
</div>
@endsection

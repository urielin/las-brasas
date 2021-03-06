@extends('layouts.dashboard')

@section('content')

<div class="container">
    <div class="section valign-wrapper" style=" position: relative; height: calc(100vh - 150px); display: flex; align-items: center; justify-content: center; ">
    <div class="row vertical-modern-dashboard">
      <div class="col s12 m4 l4 offset-l2">
         <!-- Current Balance -->
         <div class="card animate fadeLeft">
            <div class="card-content pt-0 pb-0">
               <img class="" src="assets/images/favicon/logo.png" alt="las brasas logo" style="width: 93%;">
            </div>
         </div>
      </div>
      <div class="col s12 m4 l4 animate fadeRight">
         <!-- Total Transaction -->
         <div class="card">
            <div class="card-content">
               <h4 class="card-title mb-0">SISTEMA WEB LAS BRASAS</h4>
               <p class="medium-small">Aplicación web administrativa renovada, para gestión de contenedores, retiros, ventas y más.</p>

            </div>
         </div>
      </div>
   </div>
    </div>
</div>
@endsection

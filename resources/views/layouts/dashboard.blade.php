<!DOCTYPE html>
<html>
<head lang="es">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Las brasas | Grupo Arinez</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon/icon-32x32.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">



    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/vertical-modern-menu-template/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/dashboard.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom/custom.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/flag-icon/css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/data-tables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/data-tables/css/select.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/data-tables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/variables.css') }}">
    <link href="{{ asset('css/las-brasas.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/tabs.css') }}" rel="stylesheet">
     <style>
      body {
          font-family: Muli, sans-serif !important;
          font-size: 14px;
          color: #000;
          font-weight: lighter;
      }

    </style>
     
   </head>
  <body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 2-columns   " data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">
    <header class="page-topbar" id="header">
      <div class="navbar navbar-fixed">
        <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-dark gradient-45deg-indigo-purple no-shadow">
          <div class="nav-wrapper">

            <ul class="navbar-list right">
               <li class="hide-on-med-and-down">
                 <a class="waves-effect waves-block waves-light toggle-fullscreen" href="javascript:void(0);">
                   <i class="material-icons">settings_overscan</i>
                 </a>
               </li>
               <li class="hide-on-large-only search-input-wrapper">
                 <a class="waves-effect waves-block waves-light search-button" href="javascript:void(0);">
                   <i class="material-icons">search</i>
                 </a>
               </li>
               <li>
                 <a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);" data-target="profile-dropdown">
                   <span class="avatar-status avatar-online">
                     <img src="{{ asset('assets/images/avatar/avatar-7.png') }}" alt="avatar"><i></i></span></a></li>
             </ul>
            <ul class="dropdown-content" id="translation-dropdown">

            </ul>
            <ul class="dropdown-content" id="notifications-dropdown">
              <li>
                <h6>NOTIFICATIONS<span class="new badge">5</span></h6>
              </li>

            </ul>
            <ul class="dropdown-content" id="profile-dropdown">
              <li><a class="grey-text text-darken-1" href="/logout">Cerrar sesion</a></li>
            </ul>
          </div>

        </nav>
      </div>
    </header>

    <aside class="sidenav-main nav-collapsible sidenav-light sidenav-active-square nav-collapsed">
    <!--aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square"-->
      <div class="brand-sidebar">
        <h1 class="logo-wrapper"><a class="brand-logo darken-1 hide-on-med-and-down" href="/">
        <img class="" src="{{ asset('assets/images/favicon/icon.png') }}" alt="materialize logo" style=" position: absolute; top: 15px; margin: 0 6px; height: 32px; ">
        <span>
        <img class="" src="{{ asset('assets/images/favicon/logo.png') }}" alt="materialize logo" style=" position: relative; top: -20px; height: 60px; width: 150px; ">
        </span>
        </a>
        <a class="navbar-toggler" href="#"><i class="material-icons">radio_button_unchecked</i></a>
        </h1>
      </div>
      <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
        <li class=" bold">
          <a class="  waves-effect waves-cyan " href="{{route('usuarios')}}">
            <i class="material-icons">home</i>
            <span class="menu-title" data-i18n="Dashboard">Administrador</span>
          </a>
        </li>
        <li class="navigation-header">
          <a class="navigation-header-text">Applications</a>
          <i class="navigation-header-icon material-icons">more_horiz</i>
        </li>
        <li class="bold">
          <a class="waves-effect waves-cyan " href="./">
            <i class="material-icons">public</i>
            <span class="menu-title" data-i18n="Mail">Prosegur</span>
           </a>
        </li>
        <li class="bold">
          <a class="collapsible-header waves-effect waves-cyan">
            <i class="material-icons">insert_chart</i>
            <span class="menu-title" data-i18n="Chat">Contabilidad</span>
          </a>
          <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
              <li>
                <a class="collapsible-header waves-effect waves-cyan" >
                  <i class="material-icons">radio_button_unchecked</i>
                  <span data-i18n="404">Prosegur</span>
                </a>
                <div class="collapsible-body">
                  <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li><a href="/contabilidad">
                      <i class="material-icons">radio_button_unchecked</i>
                      <span data-i18n="Page Maintenanace"> Retiros </span></a>
                    </li>
                    <li><a href="/ingreso-cartolas">
                      <i class="material-icons">radio_button_unchecked</i>
                      <span data-i18n="Page Maintenanace"> Ingreso Cartolas </span></a>
                    </li>
                  </ul>
                </div>
              </li>
              <li><a href="/comicion-por-venta">
                <i class="material-icons">radio_button_unchecked</i>
                <span data-i18n="Page Maintenanace"> Comisiones por Venta </span></a>
              </li>


            </ul>
          </div>
        </li>
       <li class="navigation-header">
         <a class="navigation-header-text">SISTEMA DE GESTIÓN </a>
         <i class="navigation-header-icon material-icons">more_horiz</i>
        </li>

        <li class="bold">
          <a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)">
            <i class="material-icons">local_shipping</i>
            <span class="menu-title" data-i18n="Misc">Maestro</span>
          </a>
          <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
              <li>
                <a href="{{route('precio-camion')}}" >
                  <i class="material-icons" style=" font-size: 1.2rem; ">local_offer</i>
                  <span data-i18n="404">Precios por camion</span>
                </a>
              </li>
              <li><a href="{{route('product.index')}}">
                <i class="material-icons">radio_button_unchecked</i>
                <span data-i18n="Page Maintenanace"> Catalogo de producto </span></a>
              </li>
              <li>
                <a href="{{route('tipo-cambio')}}">
                <i class="material-icons" style=" font-size: 1.2rem; ">monetization_on</i>
                <span data-i18n="500">Tipo de cambio </span>
                </a>
              </li>
              <li class="">
                <a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)" tabindex="0">
                  <i class="material-icons" style=" font-size: 1.2rem; ">local_shipping</i>
                  <span data-i18n="Second level child">Gestión de camiones</span>
                </a>
                <div class="collapsible-body" style="">
                  <ul class="collapsible" data-collapsible="accordion">
                    <li>
                      <a href="{{route('gestion-camion')}}">
                        <i class="material-icons" style=" font-size: 1.2rem; ">call_made</i>
                        <span data-i18n="Third level"> Para recepción</span>
                      </a>
                    </li>
                    <li>
                      <a href="{{route('gestion-camion-r')}}">
                        <i class="material-icons" style=" font-size: 1.2rem; ">call_received</i>
                        <span data-i18n="Third level"> Recepcionados</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
       </li>



        <li class=" bold">
          <a class="collapsible-header waves-effect waves-cyan">
            <i class="material-icons">local_shipping</i>
            <span class="menu-title" data-i18n="Dashboard">Contenedor/Camión</span>
          </a>
          <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
              <li><a href="{{route('gestion-administracion.index')}}">
                <i class="material-icons">radio_button_unchecked</i>
                <span data-i18n="Page Maintenanace"> Gestión / Administración </span></a>
              </li>
              <li><a href="{{route('contenedor.pagos')}}">
                <i class="material-icons">radio_button_unchecked</i>
                <span data-i18n="Page Maintenanace"> Seguimiento a Pagos </span></a>
              </li>
              <!--<li><a href="{{route('contenedor.parametros')}}">
                <i class="material-icons">radio_button_unchecked</i>
                <span data-i18n="Page Maintenanace"> Gestión de Parámetros </span></a>
              </li>-->
              <li><a href="{{route('contenedor.parametros1')}}">
                <i class="material-icons">radio_button_unchecked</i>
                <span data-i18n="Page Maintenanace">Gestión de Parámetros</span></a>
              </li>
            </ul>
          </div>
        </li>




       </ul>
      <div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
    </aside>
    <div id="main" class="main-full">
      <div class="row">
        <div class="col s12">
          <div class="container">
              <div class="section">
                @yield('content')
              </div>
           </div>
        <div class="content-overlay"></div>
        <div class="theme-cutomizer">

        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
  <!--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>-->

    <script src="{{ asset('assets/js/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/sparkline/jquery.sparkline.min.js') }}"></script>
    <!--<script src="assets/vendors/chartjs/chart.min.js"></script>-->
    <script src="{{ asset('assets/js/plugins.min.js') }}"></script>
    <script src="{{ asset('assets/js/search.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/custom-script.min.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/customizer.min.js') }}"></script>
    <!--<script src="assets/js/scripts/dashboard-analytics.min.js"></script>-->

    <script src="{{ asset('assets/vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/data-tables/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/customizer.min.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/data-tables.min.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/advance-ui-modals.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <!-- <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script> -->

    <script src="{{ asset('js/gestion-camion.js') }}"></script>
    
    <!--<script src="{{ asset('js/tabs.js') }}"></script>-->
    @yield('js')
    @yield('modal')
    @yield('after-scripts')
    


  </body>

 </html>

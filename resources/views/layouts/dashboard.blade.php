<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
 <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google.">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>Dashboard Analytics | Materialize - Material Design Admin Template</title>
    <link rel="apple-touch-icon" href="assets/images/favicon/apple-touch-icon-152x152.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon/favicon-32x32.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link href="assets/css/main.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="assets/vendors/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/themes/vertical-modern-menu-template/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/themes/vertical-modern-menu-template/style.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/pages/dashboard.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/custom/custom.css">

    <!-- <link href="{{ asset('assets___\js\plugins\bootstrap-datepicker\dist\css\bootstrap-datepicker.min.css') }}" rel="stylesheet" /> -->

    <link rel="stylesheet" type="text/css" href="assets/vendors/flag-icon/css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendors/data-tables/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendors/data-tables/css/select.dataTables.min.css">
     <link rel="stylesheet" type="text/css" href="assets/css/pages/data-tables.min.css">
     <link rel="stylesheet" type="text/css" href="assets/css/variables.css">
     <link href="{{ asset('css/las-brasas.css') }}" rel="stylesheet">

     <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
     {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}
   </head>
  <body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 2-columns   " data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">
    <header class="page-topbar" id="header">
      <div class="navbar navbar-fixed">
        <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-dark gradient-45deg-indigo-purple no-shadow">
          <div class="nav-wrapper">

            <ul class="navbar-list right">
               <li class="hide-on-med-and-down"><a class="waves-effect waves-block waves-light toggle-fullscreen" href="javascript:void(0);"><i class="material-icons">settings_overscan</i></a></li>
              <li class="hide-on-large-only search-input-wrapper"><a class="waves-effect waves-block waves-light search-button" href="javascript:void(0);"><i class="material-icons">search</i></a></li>
               <li><a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);" data-target="profile-dropdown"><span class="avatar-status avatar-online"><img src="assets/images/avatar/avatar-7.png" alt="avatar"><i></i></span></a></li>
             </ul>
            <ul class="dropdown-content" id="translation-dropdown">

            </ul>
            <ul class="dropdown-content" id="notifications-dropdown">
              <li>
                <h6>NOTIFICATIONS<span class="new badge">5</span></h6>
              </li>

            </ul>
            <ul class="dropdown-content" id="profile-dropdown">
              <li><a class="grey-text text-darken-1" href="user-profile-page.html"><i class="material-icons">person_outline</i> Profile</a></li>
              <li><a class="grey-text text-darken-1" href="app-chat.html"><i class="material-icons">chat_bubble_outline</i> Chat</a></li>
              <li><a class="grey-text text-darken-1" href="page-faq.html"><i class="material-icons">help_outline</i> Help</a></li>
              <li class="divider"></li>
              <li><a class="grey-text text-darken-1" href="user-lock-screen.html"><i class="material-icons">lock_outline</i> Lock</a></li>
              <li><a class="grey-text text-darken-1" href="user-login.html"><i class="material-icons">keyboard_tab</i> Logout</a></li>
            </ul>
          </div>

        </nav>
      </div>
    </header>

    <aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
      <div class="brand-sidebar">
        <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="index-2.html">
          <img class="hide-on-med-and-down" src="assets/images/logo/materialize-logo-color.png" alt="materialize logo"/><img class="show-on-medium-and-down hide-on-med-and-up" src="assets/images/logo/materialize-logo.png" alt="materialize logo"/><span class="logo-text hide-on-med-and-down">Materialize</span></a><a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
      </div>
      <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
        <li class="active bold">
          <a class="  waves-effect waves-cyan " href="{{route('usuarios')}}">
            <i class="material-icons">settings_input_svideo</i>
            <span class="menu-title" data-i18n="Dashboard">Administrador</span>
          </a>
        </li>
        <li class="navigation-header">
          <a class="navigation-header-text">Applications</a>
          <i class="navigation-header-icon material-icons">more_horiz</i>
        </li>
        <li class="bold">
          <a class="waves-effect waves-cyan " href="./">
            <i class="material-icons">mail_outline</i>
            <span class="menu-title" data-i18n="Mail">Prosegur</span>
           </a>
        </li>
        <li class="bold">
          <a class="waves-effect waves-cyan " href="./">
            <i class="material-icons">chat_bubble_outline</i>
            <span class="menu-title" data-i18n="Chat">Contabilidad</span>
          </a>
        </li>
       <li class="navigation-header">
         <a class="navigation-header-text">Pages </a>
         <i class="navigation-header-icon material-icons">more_horiz</i>
        </li>
        <li class="bold">
          <a class="waves-effect waves-cyan " href="./">
          <i class="material-icons">person_outline</i>
          <span class="menu-title" data-i18n="User Profile">Contenedores y Camiones</span>
          </a>
        </li>
        <li class="bold">
          <a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)">
            <i class="material-icons">filter_tilt_shift</i>
            <span class="menu-title" data-i18n="Misc">Maestro</span>
          </a>
          <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
              <li><a href="{{route('precio-camion')}}" >
                <i class="material-icons" style=" font-size: 1.2rem; ">local_offer</i>
                <span data-i18n="404">Precios unitarios</span>
              </a>
              </li>
              <li><a href="{{route('product.index')}}">
                <i class="material-icons">radio_button_unchecked</i>
                <span data-i18n="Page Maintenanace"> Catalogo de producto </span></a>
              </li>
              <li>
                <a href="{{route('tipo-cambio')}}">
                <i class="material-icons">radio_button_unchecked</i>
                <span data-i18n="500">Tipo de cambio </span>
                </a>
              </li>
              <li class="">
                <a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)" tabindex="0">
                  <i class="material-icons">radio_button_unchecked</i>
                  <span data-i18n="Second level child">Gestion de camiones</span>
                </a>
                <div class="collapsible-body" style="">
                  <ul class="collapsible" data-collapsible="accordion">
                    <li>
                      <a href="{{route('gestion-camion')}}">
                        <i class="material-icons">radio_button_unchecked</i>
                        <span data-i18n="Third level"> Para recepción</span>
                      </a>
                    </li>
                    <li>
                      <a href="{{route('gestion-camion-r')}}">
                        <i class="material-icons">radio_button_unchecked</i>
                        <span data-i18n="Third level"> Recepcionados</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
       </li>
       </ul>
      <div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
    </aside>

    <div id="main">
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

    <script src="assets/js/vendors.min.js"></script>
    <script src="assets/vendors/sparkline/jquery.sparkline.min.js"></script>
    <!--<script src="assets/vendors/chartjs/chart.min.js"></script>-->
    <script src="assets/js/plugins.min.js"></script>
    <script src="assets/js/search.min.js"></script>
    <script src="assets/js/custom/custom-script.min.js"></script>
    <script src="assets/js/scripts/customizer.min.js"></script>
    <!--<script src="assets/js/scripts/dashboard-analytics.min.js"></script>-->

     <script src="assets/vendors/data-tables/js/jquery.dataTables.min.js"></script>
    <script src="assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/vendors/data-tables/js/dataTables.select.min.js"></script>
     <script src="assets/js/scripts/customizer.min.js"></script>
    <script src="assets/js/scripts/data-tables.min.js"></script>
    <script src="assets/js/scripts/advance-ui-modals.min.js"></script>

    <!-- <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script> -->

    @section('js')
      <script src="{{ asset('js/las-brasas.js') }}"></script>
      <script src="{{ asset('js/product.js') }}"></script>
    @show
  </body>

 </html>

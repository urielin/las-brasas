<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <title>{{ config('app.name', 'Las Brasas') }}</title> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">


    <title>LAS BRASAS</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <!--
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">-->
    <link href="{{ asset('css/preloader.css') }}" rel="styleshee1t">
    <link href="{{ asset('css/las-brasas.css') }}" rel="stylesheet">
    <!-- LAS BRASAS BOOTSTRAP -->
    <link href="{{ asset('assets/img/brand/favicon.png') }}" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="{{ asset('assets/js/plugins/nucleo/css/nucleo.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <!-- <link href="{{ asset('assets/css/argon-dashboard.css?v=1.1.1') }}" rel="stylesheet" /> -->
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/argon.min.css?v=1.2.0" rel="stylesheet" />
    
    <link href="{{ asset('assets\js\plugins\bootstrap-datepicker\dist\css\bootstrap-datepicker.min.css') }}" rel="stylesheet" />
    <style media="screen">
    .form-inline .form-group {
      margin-bottom: 2px
    }
    #productTable tbody tr td {border: 1px #DDD solid; padding: 5px; cursor: pointer;}

   .selected {
       background-color: brown;
       color: #FFF;
   }
    </style>
</head>
<body class="">
    <div class="loader loader-6 d-none cyan full-loader" id="loader-6">
              <span></span>
              <span></span>
              <span></span>
              <span></span>
            </div>
    <div id="app">
        <!-- vertical nav -->
        <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
            <div class="scroll-wrapper scrollbar-inner" style="position: relative;">
                <div class="scrollbar-inner scroll-content scroll-scrollx_visible scroll-scrolly_visible" style="height: auto; margin-bottom: 0px; margin-right: 0px; max-height: 244px;">
                    <!-- Brand -->
                    <div class="sidenav-header  d-flex  align-items-center">
                        <a class="navbar-brand pt-0" href="./">
                            <img src="data:image/png;base64,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" class="navbar-brand-img" alt="..." style="
                  max-height: 87px;
                  width: 156px;
                  margin-top: 25px;
              "> </a>
                        <div class=" ml-auto ">
                            <!-- Sidenav toggler -->
                            <div class="sidenav-toggler d-none d-xl-block active" data-action="sidenav-unpin" data-target="#sidenav-main">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="navbar-inner">
                        <!-- Collapse -->
                        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                            <!-- Nav items -->
                            <ul class="navbar-nav">
                                <li class="nav-item ">
                                    <a class="nav-link  active " href="{{route('usuarios')}}">
                                        <i class="ni ni-tv-2 text-primary"></i>
                                        <span class="nav-link-text">Administrador</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="#navbar-maestro" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-maestro">
                                        <i class="ni ni-planet text-blue"></i>
                                        <span class="nav-link-text">Maestro</span>
                                    </a>
                                    <div class="collapse " id="navbar-maestro" style="">
                                        <ul class="nav nav-sm flex-column">
                                            <li class="nav-item">
                                                <a href="{{route('precio-camion')}}" class="nav-link">
                                                    <span class="sidenav-mini-icon">P</span>
                                                    <span class="sidenav-normal"> Precios unitarios </span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{route('product.index')}}" class="nav-link">
                                                    <span class="sidenav-mini-icon">C</span>
                                                    <span class="sidenav-normal"> Catalogo de producto </span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{route('tipo-cambio')}}" class="nav-link">
                                                    <span class="sidenav-mini-icon">T</span>
                                                    <span class="sidenav-normal"> Tipo de cambio </span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#navbar-maestro1" class="nav-link" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-maestro">
                                                    <span class="sidenav-mini-icon">G</span>
                                                    <span class="sidenav-normal"> Gestión de camiones </span>
                                                </a>

                                                <div class="collapse " id="navbar-maestro1" style="">
                                                    <ul class="nav nav-sm flex-column">
                                                        <li class="nav-item">
                                                            <a href="{{route('gestion-camion')}}" class="nav-link">
                                                                <span class="sidenav-mini-icon">P</span>
                                                                <span class="sidenav-normal"> Para recepción </span>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="{{route('gestion-camion-r')}}" class="nav-link">
                                                                <span class="sidenav-mini-icon">R</span>
                                                                <span class="sidenav-normal"> Recepcionados </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="./">
                                        <i class="ni ni-pin-3 text-orange"></i>
                                        <span class="nav-link-text">Prosegur</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="./">
                                        <i class="ni ni-single-02 text-yellow"></i>
                                        <span class="nav-link-text">Contabilidad</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="./">
                                        <i class="ni ni-bullet-list-67 text-red"></i>
                                        <span class="nav-link-text">Contenedores y Camiones</span>
                                    </a>
                                </li>

                                <!-- <li class="nav-item">
                                    <a href="{{route('test')}}" class="nav-link">Test</a>
                                </li> -->
                            </ul>
                            <!-- Divider -->

                        </div>
                    </div>
                </div>
                <div class="scroll-element scroll-x scroll-scrollx_visible scroll-scrolly_visible">
                    <div class="scroll-element_outer">
                        <div class="scroll-element_size"></div>
                        <div class="scroll-element_track"></div>
                        <div class="scroll-bar" style="width: 19px; left: 0px;"></div>
                    </div>
                </div>
                <div class="scroll-element scroll-y scroll-scrollx_visible scroll-scrolly_visible">
                    <div class="scroll-element_outer">
                        <div class="scroll-element_size"></div>
                        <div class="scroll-element_track"></div>
                        <div class="scroll-bar" style="height: 66px; top: 0px;"></div>
                    </div>
                </div>
            </div>
        </nav>   
        <!-- end vertical nav -->

        <!-- <main > -->
        <div class="main-content">
          <!-- header nav -->
          <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
            <div class="container-fluid">
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Search form -->
                
                <!-- <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
                  <div class="form-group mb-0">
                    <div class="input-group input-group-alternative input-group-merge">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                      </div>
                      <input class="form-control" placeholder="Search" type="text">
                    </div>
                  </div>
                  <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </form> -->
                <!-- Navbar links -->
                <ul class="navbar-nav align-items-center  ml-md-auto ">
                  <li class="nav-item d-xl-none">
                    <!-- Sidenav toggler -->
                    <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                      <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                      </div>
                    </div>
                  </li>
                @auth

                  
                  <li class="nav-item d-sm-none">
                    <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                      <i class="ni ni-zoom-split-in"></i>
                    </a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="ni ni-bell-55"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-xl  dropdown-menu-right  py-0 overflow-hidden">
                      <!-- Dropdown header -->
                      <div class="px-3 py-3">
                        <h6 class="text-sm text-muted m-0">You have <strong class="text-primary">13</strong> notifications.</h6>
                      </div>
                      <!-- List group -->
                      <div class="list-group list-group-flush">
                        <a href="#!" class="list-group-item list-group-item-action">
                          <div class="row align-items-center">
                            <div class="col-auto">
                              <!-- Avatar -->
                              <img alt="Image placeholder" src="../../assets/img/theme/team-1.jpg" class="avatar rounded-circle">
                            </div>
                            <div class="col ml--2">
                              <div class="d-flex justify-content-between align-items-center">
                                <div>
                                  <h4 class="mb-0 text-sm">{{ Auth::user()->name }}</h4>
                                </div>
                                <div class="text-right text-muted">
                                  <small>2 hrs ago</small>
                                </div>
                              </div>
                              <p class="text-sm mb-0">Let's meet at Starbucks at 11:30. Wdyt?</p>
                            </div>
                          </div>
                        </a>
                        <a href="#!" class="list-group-item list-group-item-action">
                          <div class="row align-items-center">
                            <div class="col-auto">
                              <!-- Avatar -->
                              <img alt="Image placeholder" src="../../assets/img/theme/team-2.jpg" class="avatar rounded-circle">
                            </div>
                            <div class="col ml--2">
                              <div class="d-flex justify-content-between align-items-center">
                                <div>
                                  <h4 class="mb-0 text-sm">{{ Auth::user()->name }}</h4>
                                </div>
                                <div class="text-right text-muted">
                                  <small>3 hrs ago</small>
                                </div>
                              </div>
                              <p class="text-sm mb-0">A new issue has been reported for Argon.</p>
                            </div>
                          </div>
                        </a>
                        <a href="#!" class="list-group-item list-group-item-action">
                          <div class="row align-items-center">
                            <div class="col-auto">
                              <!-- Avatar -->
                              <img alt="Image placeholder" src="../../assets/img/theme/team-3.jpg" class="avatar rounded-circle">
                            </div>
                            <div class="col ml--2">
                              <div class="d-flex justify-content-between align-items-center">
                                <div>
                                  <h4 class="mb-0 text-sm">{{ Auth::user()->name }}</h4>
                                </div>
                                <div class="text-right text-muted">
                                  <small>5 hrs ago</small>
                                </div>
                              </div>
                              <p class="text-sm mb-0">Your posts have been liked a lot.</p>
                            </div>
                          </div>
                        </a>
                        <a href="#!" class="list-group-item list-group-item-action">
                          <div class="row align-items-center">
                            <div class="col-auto">
                              <!-- Avatar -->
                              <img alt="Image placeholder" src="../../assets/img/theme/team-4.jpg" class="avatar rounded-circle">
                            </div>
                            <div class="col ml--2">
                              <div class="d-flex justify-content-between align-items-center">
                                <div>
                                  <h4 class="mb-0 text-sm">{{ Auth::user()->name }}</h4>
                                </div>
                                <div class="text-right text-muted">
                                  <small>2 hrs ago</small>
                                </div>
                              </div>
                              <p class="text-sm mb-0">Let's meet at Starbucks at 11:30. Wdyt?</p>
                            </div>
                          </div>
                        </a>
                        <a href="#!" class="list-group-item list-group-item-action">
                          <div class="row align-items-center">
                            <div class="col-auto">
                              <!-- Avatar -->
                              <img alt="Image placeholder" src="./assets/img/theme/team-1-800x800.jpg" class="avatar rounded-circle">
                            </div>
                            <div class="col ml--2">
                              <div class="d-flex justify-content-between align-items-center">
                                <div>
                                  <h4 class="mb-0 text-sm">{{ Auth::user()->name }}</h4>
                                </div>
                                <div class="text-right text-muted">
                                  <small>3 hrs ago</small>
                                </div>
                              </div>
                              <p class="text-sm mb-0">A new issue has been reported for Argon.</p>
                            </div>
                          </div>
                        </a>
                      </div>
                      <!-- View all -->
                      <a href="#!" class="dropdown-item text-center text-primary font-weight-bold py-3">View all</a>
                    </div>
                   </li>
                  
                   <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="ni ni-ungroup"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-dark bg-default  dropdown-menu-right ">
                      <div class="row shortcuts px-4">
                        <a href="#!" class="col-4 shortcut-item">
                          <span class="shortcut-media avatar rounded-circle bg-gradient-red">
                            <i class="ni ni-calendar-grid-58"></i>
                          </span>
                          <small>Calendar</small>
                        </a>
                        <a href="#!" class="col-4 shortcut-item">
                          <span class="shortcut-media avatar rounded-circle bg-gradient-orange">
                            <i class="ni ni-email-83"></i>
                          </span>
                          <small>Email</small>
                        </a>
                        <a href="#!" class="col-4 shortcut-item">
                          <span class="shortcut-media avatar rounded-circle bg-gradient-info">
                            <i class="ni ni-credit-card"></i>
                          </span>
                          <small>Payments</small>
                        </a>
                        <a href="#!" class="col-4 shortcut-item">
                          <span class="shortcut-media avatar rounded-circle bg-gradient-green">
                            <i class="ni ni-books"></i>
                          </span>
                          <small>Reports</small>
                        </a>
                        <a href="#!" class="col-4 shortcut-item">
                          <span class="shortcut-media avatar rounded-circle bg-gradient-purple">
                            <i class="ni ni-pin-3"></i>
                          </span>
                          <small>Maps</small>
                        </a>
                        <a href="#!" class="col-4 shortcut-item">
                          <span class="shortcut-media avatar rounded-circle bg-gradient-yellow">
                            <i class="ni ni-basket"></i>
                          </span>
                          <small>Shop</small>
                        </a>
                      </div>
                    </div>
                  </li>
                  
                @endauth
                </ul>
                <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                @guest 
                  <li class="nav-item dropdown">
                    <a href="#" class="nav-link shortcut-item d-flex align-items-center p-0" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                      <span class="shortcut-media avatar rounded-circle bg-gradient-green">
                        <i class="fa fa-users"></i>
                      </span>
                      <div class="media-body  ml-2  d-none d-lg-block">
                          <span class="mb-0 text-sm  font-weight-bold">Ingresa a tu cuenta</span>
                      </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-dark bg-default dropdown-menu-right">
                      <div class="row shortcuts px-4">
                        <a href="{{ route('login') }}" class="col shortcut-item">
                          <span class="shortcut-media avatar rounded-circle bg-gradient-purple">
                            <i class="fa fa-user"></i>
                          </span>
                          <small>{{ __('Login') }}</small>
                        </a>
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="col shortcut-item">
                          <span class="shortcut-media avatar rounded-circle bg-gradient-yellow">
                            <i class="fa fa-pen"></i>
                          </span>
                          <small>{{ __('Register') }}</small>
                        </a>
                        @endif
                      </div>
                    </div>
                  </li>
                @else 
                  <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                          <img alt="Image placeholder" src="./assets/img/theme/team-1-800x800.jpg">
                        </span>
                        <div class="media-body  ml-2  d-none d-lg-block">
                          <span class="mb-0 text-sm  font-weight-bold">{{ Auth::user()->name }}</span>
                        </div>
                      </div>
                    </a>
                    <div class="dropdown-menu  dropdown-menu-right ">
                      <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Bienvenido</h6>
                      </div>
                      <a href="#!" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>Mi perfil</span>
                      </a>
                      <!-- <a href="#!" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>Settings</span>
                      </a>
                      <a href="#!" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>Activity</span>
                      </a>
                      <a href="#!" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>Support</span>
                      </a> -->
                      <div class="dropdown-divider"></div>
                      <a href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();" class="dropdown-item">
                          <i class="ni ni-user-run"></i>
                          <span>Logout</span>
                      </a>
                      </div>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                    </div>
                  </li>
                @endguest
                </ul>
                
              </div>
            </div>
          </nav>
          <!-- header nav -->
          <!-- main content-->
          @yield('content')
          <!-- End main content -->

        </div>
        <!-- </main> -->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>


    <!--   Core   -->
    <!-- <script src="{{ asset('assets/js/plugins/jquery/dist/jquery.min.js') }}"></script> -->
    <!-- <script src="{{ asset('assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script> -->
    <!--   Optional JS   -->
    <script src="{{ asset('assets/js/plugins/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/chart.js/dist/Chart.extension.js') }}"></script>
    <!--   Argon JS   -->
    <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
    <script src="{{ asset('js/las-brasas.js') }}"></script>
    <script src="{{ asset('js/product.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- <script src="{{ asset('assets/js/argon-dashboard.min.js?v=1.1.1') }}"></script> -->
    <script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/js/argon.min.js?v=1.2.0"></script>
    @yield('js')


</body>
</html>


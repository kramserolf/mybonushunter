<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Best Online Casino 2022</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    {{-- icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>    --}}



<style>
    #images, #settings {
        color: 	#C0C0C0;
    }
</style>
</head>
<body>  
        <div class="container-fluid" style="margin: 0; box-sizing:border-box;">
            <div class="row flex-nowrap">
                <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-primary">
                    <div class="d-flex sidebar flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                        {{-- <hr class="align-middle fs-5 mb-1 text-white px-3"> --}}
                        <a href="#" class="d-flex align-items-center pb-4 mb-md-0 me-md-auto text-white text-decoration-none">
                            <span class="fs-5 d-none d-sm-inline">Admin Panel</span>
                        </a>
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                            <li class="nav-item">
                                <a href="{{route('admin.home')}}" class="nav-link  align-middle fs-5 mb-1 text-white px-3" id="home">
                                    <i class="bi-house-fill" id="homeIcon"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                                </a>
                            <li class="nav-item">
                                <a href="/admin/offers" class="nav-link  align-middle fs-5 mb-1 text-white px-3" id="offers">
                                    <i class="bi-cash"></i>  <span class="ms-1 d-none d-sm-inline">Offers</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/banners" class="nav-link  align-middle fs-5 mb-1 text-white px-3" id="Banners">
                                    <i class="bi-flag-fill"></i>  <span class="ms-1 d-none d-sm-inline">Banners</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/links" class="nav-link  align-middle fs-5 mb-1 text-white px-3" id="links">
                                    <i class="bi-youtube"></i>  <span class="ms-1 d-none d-sm-inline">Links</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/registered-users" class="nav-link  align-middle fs-5 mb-1 text-white px-3" id="users">
                                    <i class="bi-people-fill"></i>  <span class="ms-1 d-none d-sm-inline">Registered Users</span>
                                </a>
                            </li>
                            {{-- <li class="nav-item has-submenu">

                                <ul class="submenu list-unstyled">
                                    <li style="margin-left: 1.75rem">
                                        <a class="nav-link  text-white" href="{{route('admin.banner')}}" id="banners">
                                            <i class="bi-flag-fill"></i> Banners
                                        </a>
                                    </li>
                                    <li style="margin-left: 1.75rem">
                                        <a class="nav-link  text-white" href="{{route('admin.tip')}}" id="tips">
                                            <i class="bi-info-square-fill"></i> Tips
                                        </a>
                                    </li>
                                    <li style="margin-left: 1.75rem">
                                        <a class="nav-link  text-white" href="{{route('admin.link')}}" id="links">
                                            <i class="bi-youtube"></i> Link
                                        </a>
                                    </li>
                                    <li style="margin-left: 1.75rem">
                                        <a class="nav-link  text-white" href="{{route('admin.help')}}" id="help">
                                            <i class="bi-google"></i> Help
                                        </a>
                                    </li>
                                </ul>
                            </li> --}}
                            <li class="nav-item has-submenu">
                                <button class="nav-link  align-middle fs-5 mb-1 px-3" id="settings" href=""><i class="bi-wrench"></i>
                                    <span class="ms-1 d-none d-sm-inline">Settings</span>
                                </button>
                                
                                <ul class="submenu list-unstyled">
                                    <li style="margin-left: 1.75rem">
                                        <hr class="align-middle fs-5 mb-1 text-white px-3">
                                        <a class="nav-link  text-white" href="{{route('admin.profile')}}" id="profile">
                                            <i class="bi-gear-fill"></i> Profile
                                        </a>
                                    </li>
                                    <li style="margin-left: 1.75rem">
                                        <a type="button" class="nav-link  text-white" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                            <i class="bi-exclamation-diamond-fill"></i> Sign out
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <hr>
                        <!-- Logout Modal-->
                        <div class="modal fade text-black" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ __('Ready to Leave?') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Select "Logout" below if you want to end your current session.
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-link" type="button" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                                        <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown pb-4">
                            <a href="#" class="d-flex align-items-center text-white text-decoration-none ">
                                {{-- <img src="https://github.com/mdo.png" alt="hugenerd" width="40" height="40" class="rounded-circle"> --}}
                                
                                <span class="badge bg-success fs-5 d-none d-sm-inline">
                                    @if(Auth::check())
                                    <i class="bi-person-circle"></i> {{Auth::user()->name}}
                                    @endif
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col" width="100%">
                  @yield('content')
                </div>
            </div>
        </div>
    
</body>
</html>

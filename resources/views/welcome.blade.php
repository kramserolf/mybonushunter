<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Home - Best Casino Bonus 2022</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    

    <!-- Styles -->
   

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  

    

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        .navbar-custom {
            background-color: #863c99;
        }

        .navbar-custom li{
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 15px;
        }
        .footer a:link{
            text-decoration: none;
            color: white
        }
        .footer a:visited{
            text-decoration: none;
            color: white
        }

        .footer a:hover{
            text-decoration: none;
            color: gray;
        }
        .links a:link{
            font-size: 17px;
        }
        .icons {
            color: white;
        }
    </style>
</head>

<body class="antialiased">
    <div class="min-vh-100 d-flex flex-column justify-content-between" id="app" data-v-app="">
        <div>
            <header>
                <nav class="navbar navbar-expand-lg navbar-custom navbar-dark">
                    <div class="container"><a class="navbar-brand" href="/"><img src="{{asset('images/logo.png')}}"
                                alt="My Bonus Hunter" style="height: 40px;"></a><button class="navbar-toggler"
                            type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false"
                            aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                @if(!Auth::check())
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{route('home')}}" id="home">Home</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" aria-current="page"
                                    href="{{route('bonus')}}" id="bonus">Casino Bonus</a></li>
                                <li class="nav-item"><a class="nav-link" aria-current="page" href="{{route('tips')}}" id="tips">Casino
                                        Tips</a></li>
                                <li class="nav-item"><a class="nav-link" aria-current="page" href="{{route('help')}}" id="help">Help</a></li>
                                @endif
                                @auth
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{route('user.home')}}" id="home">Home</a>
                                </li>
                            </li>
                                <li class="nav-item"><a class="nav-link" aria-current="page"
                                    href="{{route('bonus')}}" id="bonus">Casino Bonus</a></li>
                                <li class="nav-item"><a class="nav-link" aria-current="page" href="{{route('tips')}}" id="tips">Casino
                                        Tips</a></li>
                                <li class="nav-item"><a class="nav-link" aria-current="page" href="{{route('help')}}" id="help">Help</a></li>
                                <div class="dropdown ">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                      {{Auth::user()->name}} 
                                    </a>
                                  
                                    <ul class="dropdown-menu">
                                            <div class="d-flex justify-content-center">
                                                <li class="text-capitalize">  <span style="font-size: 12px">  credits: </span>
                                                    <span class="badge bg-primary">
                                                    <strong>
                                                       ${{$credit}}
                                                    </span></strong>
                                                </li>
                                            </div>
                                        <li><hr class="dropdown-divider"></li>
                                      <li class="text-capitalize"><a class="dropdown-item" href="{{route('user.profile')}}">Profile</a></li>
                                      <li class="text-capitalize">
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                    </ul>
                                  </div>
                                @endauth
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            <div class="mt-5 container">
                @yield('content')
            </div>
        </div>
        <footer class="container-fluid mt-5 footer bg-dark text-white">
            <div class="container py-5">
                <div class="row">
                    <div class="col-12 col-md-3 mt-4 mt-md-0">
                        <h4>Get In Touch</h4>
                        <div class="mt-4"><i class="me-2 bi bi-house-door-fill"></i><span> Business Labs, Birkakara,
                                Malta </span></div>
                        <div class="mt-4"><i class="me-2 bi bi-envelope-fill"></i><span> info@mybonushunter.com </span>
                        </div>
                        <div class="mt-4"><i class="me-2 bi bi-telephone-fill"></i><span> +356 9935 6680 </span></div>
                    </div>
                    <div class="col-12 col-md-3 mt-4 mt-md-0">
                        <h4>Useful Links</h4>
                        <div class="mt-4"><i class="me-2 bi bi-arrow-right"></i><a
                                href="https://www.begambleaware.org/">Gamble Aware</a></div>
                        <div class="mt-4"><i class="me-2 bi bi-arrow-right"></i><a
                                href="https://en.wikipedia.org/wiki/Responsible_gambling">Responsible Gambling</a></div>
                        <div class="mt-4"><i class="me-2 bi bi-arrow-right"></i><a
                                href="https://www.thegamesilo.com/">Free to Play</a></div>
                    </div>
                    <div class="col-12 col-md-3 mt-4 mt-md-0">
                        <h4>Quick Links</h4>
                        <div class="mt-4"><i class="me-2 bi bi-arrow-right"></i><a href="/best-casino-bonus">Best Casino
                                Bonus</a></div>
                        <div class="mt-4"><i class="me-2 bi bi-arrow-right"></i><a href="/no-deposit-bonus">No Deposit
                                Bonus</a></div>
                        <div class="mt-4"><i class="me-2 bi bi-arrow-right"></i><a href="/free-spins-offer">Free Spins
                                Offers</a></div>
                        <div class="mt-4"><i class="me-2 bi bi-arrow-right"></i><a href="/sign-up-bonus">Best Sign-up
                                Offers</a></div>
                    </div>
                    <div class="col-12 col-md-3 mt-4 mt-md-0">
                        <h4>Newsletter</h4>
                        <p class="mt-4">From our desk to your inbox, pronto! Simply add your email and get live updates.
                        </p>
                        <form class="newsletter" data-v-8094d002=""><input class="form-control mb-2" type="email" id="email"
                                placeholder="Your email here" data-v-8094d002=""><button type="submit" class="btn"
                                id="subs" disabled="" data-v-8094d002=""> Submit </button></form>
                    </div>
                </div>
                <div class="mt-5 d-flex flex-column">
                    <ul class="nav justify-content-center">
                        <li class="nav-item">
                          <a class="nav-link" aria-current="page" href="#">Terms of Use</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Privacy Policy</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Help</a>
                        </li>
                      </ul>
                      <ul class="nav justify-content-center">
                        <li class="nav-item">
                          <a class="nav-link" aria-current="page" href="#">Advertise with Us</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="/contact">Contact Us</a>
                        </li>
                      </ul>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>

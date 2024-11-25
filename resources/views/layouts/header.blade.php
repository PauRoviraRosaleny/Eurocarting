
<link rel="stylesheet" href="{{asset('css/header.css')}}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.0.0/css/flag-icons.min.css"/>

<body>
<header class="p-3" >
    <div class="header-container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
            </a>
            <a href="{{route('index')}}"><img src="{{ asset('Uploads/logo.png') }} " alt="" height="50px"></a>
            <a href="{{route('index')}}"class="nav-link text-white"><h2>Eurocarting</h2></a>
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            </ul>

            @guest <!-- Verifica si el usuario no ha iniciado sesión -->
            <div class="text-end">
                <a href="{{ route('login') }}"><button type="button" class="btn btn-danger me-2">{{__('messages.Iniciarsesión')}}</button></a>
                <a href="{{ route('register') }}"><button type="button" class="btn btn-danger me-2">{{__('messages.Registrarse')}}</button></a>
                <a href="{{ route('contact') }}"><button type="button" class="btn btn-danger me-2">{{__('messages.Contáctanos')}}</button></a>
            </div>
            @endguest

            @auth <!-- Verifica si el usuario ha iniciado sesión -->
            <div class="text-end">
                    <div class="dropdown">
                      <a class="btn btn-secondary dropdown-toggle" style="background-color: #dc3545" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                          Bienvenido, {{(Auth::user()->name)}}&nbsp;
                      </a>

                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item" href="{{ route('account') }}">{{__('messages.Cuenta')}}</a></li>
                        @if( Auth::User()->role == "admin")
                        <li><a class="dropdown-item" href="{{ route('create') }}">{{__('messages.Añadircoche')}}</a></li>
                        @else
                        <li><a class="dropdown-item" href="{{ route('contact') }}">{{__('messages.Contáctanos')}}</a></li>
                        @endif
                        <li><a class="dropdown-item" href="{{ route('logout') }}">{{__('messages.Cerrarsesion')}}</a></li>
                      </ul>
                    </div>
            </div>
            @endauth
            <li style="list-style-type: none; margin-left: 10px" class="nav-item dropdown">
    <a class="btn btn-secondary dropdown-toggle" style="background-color: #dc3545" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="fi fi-{{Config::get('languages')[App::getLocale()]['flag-icon']}}"></span> {{ Config::get('languages')[App::getLocale()]['display'] }}
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        @foreach (Config::get('languages') as $lang => $language)
            @if ($lang != App::getLocale())
                <li><a class="dropdown-item" href="{{ route('lang.switch', $lang) }}"><span class="fi fi-{{$language['flag-icon']}}"></span> {{$language['display']}}</a></li>
            @endif
        @endforeach
    </ul>
</>

        </div>
    </div>
  </header>

@yield('content')


<footer class="footer mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h9><strong>&copy; 2024 Eurocarting. All rights reserved.</strong></h9>
            </div>
            <div class="col-md-6">
                <ul class="list-inline social-media">
                    <li class="list-inline-item"><a href="#"><i class="bi bi-facebook" style="color: #83072D;"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="bi bi-twitter" style="color: #83072D;"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="bi bi-instagram" style="color: #83072D;"></i></a></li>
                    <!-- Agrega aquí más iconos y enlaces a tus redes sociales -->
                </ul>
            </div>
        </div>
    </div>
</footer>


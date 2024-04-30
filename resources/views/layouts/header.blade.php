
<body>
    
<header class="p-3 bg-dark text-white">
    <div class="header-container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
            </a>
            <a href="{{route('index')}}"><img src="{{ asset('Uploads/logo.png') }} " alt="" height="50px"></a>
            <a href="{{route('index')}}"class="nav-link text-white"><h2>  Eurocarting</h2></a>
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            </ul>
  
            @guest <!-- Verifica si el usuario no ha iniciado sesión -->
            <div class="text-end">
                <a href="{{ route('login') }}"><button type="button" class="btn btn-outline-light me-2">Login</button></a>
                <a href="{{ route('register') }}"><button type="button" class="btn btn-warning">Sign-up</button></a>
            </div>
            @endguest
  
            @auth <!-- Verifica si el usuario ha iniciado sesión -->
            <div class="text-end">
                    <div class="dropdown">
                      <a class="btn btn-secondary dropdown-toggle" style="background-color:#212529" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                          {{(Auth::user()->name)}}&nbsp;
                      </a>
                    
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item" href="{{ route('account') }}">Account</a></li>
                        @if( Auth::User()->role == "admin")
                        <li><a class="dropdown-item" href="{{ route('create') }}">Add a new car</a></li>
                        @endif
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                      </ul>
                    </div>
            </div>
            @endauth
        </div>
    </div>
  </header>
   
</body>
@yield('content')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{-- {{ config('app.name', 'Laravel') }} --}}
        Yalla Notlob

    </title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href=" {{ asset('css/home.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
       
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm navo ">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                    <h2 style="color: white;">Yalla Notlob</h2>
                </a>


                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto colo">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a style="color: white !important;" class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a style="color: white !important;" class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li> 
                                <a style="color: white !important;" class="nav-link mx-5" href="{{route('home')}}">Home</a>
                            </li>
                            <li class="nav-item dropdown ">
                                <a style="color: white !important;" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i style="font-size: large ;" class="fa-solid fa-user mx-2 "></i> {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a style="color: #ff0000  !important;" class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>

</body>
</html>

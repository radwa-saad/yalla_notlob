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

    <link rel="stylesheet" href=" {{ asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        body{
            color:darkgrey !important;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm navo ">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                    <h2 class="colo">Yalla Notlob</h2>
                </a>

                <a class="nav-link mx-5" href="{{route('home')}}">Home</a>
                <a class="nav-link mx-5" href="{{route('friends.index')}}">Friends</a>
                <a class="nav-link mx-5" href="{{route('groups.index')}}">Groups</a>
                <a class="nav-link mx-5" href="{{route('orders.index')}}">Orders</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto colo">
                         <!-- Notifications -->
                    <div class="dropdown">
                        <a class="text-reset me-3 dropdown-toggle hidden-arrow" href="#"
                            id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" v-pre>
                            <i class="fas fa-bell"></i>
                            <span class="badge rounded-pill badge-notification bg-danger" id="nots_count"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" id="nots"
                            aria-labelledby="navbarDropdownMenuLink">

                        </ul>
                    </div>
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
                            <li class="nav-item dropdown ">
                                <a style="color: white !important;" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i style="font-size: large ;" class="fa-solid fa-user mx-2 "></i>{{ Auth::user()->name }}
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

        <main >
            <div class="all py-5">
            @yield('content')
            </div>
        </main>
    </div>
    <script src="{{asset('jquery/jquery-3.5.1.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>

    @yield('script')
    {{--<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>--}}

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}

    <script>
        let ul = document.querySelector('#nots');
        fetch('/notifications')
            .then(res => res.json())
            .then(res => {
                // console.log(res);
                document.querySelector('#nots_count').textContent = res.length;
                if (res.length == 0) {
                    document.querySelector('#nots_count').textContent = '';
                    ul.innerHTML = '<small>There is no any invitation</small>';
                } else {
                    for (let i = 0; i < res.length; i++) {
                        addListItem(res[i].sender.name)
                    }
                }
            })
        document.querySelector('#navbarDropdownMenuLink').addEventListener('click', () => {
            fetch('/notifyseen/' + {{ auth()->id() }}).then(res => res.json()).then(res => document.querySelector(
                '#nots_count').textContent = '')
        })
        function addListItem(sender) {
            let li = document.createElement('li');
            li.innerHTML =
                `<a class="dropdown-item"><b class="text-danger">${sender}</b> has invited you to eat together</a>`;
            ul.appendChild(li);
        }
        // $(document).ready(function() {
        //     $('.js-example-basic-multiple').select2();
        // });
    </script>

   @yield('js')
</body>
</html>

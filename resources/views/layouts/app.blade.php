<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>HarmonyWorks</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('images/Icon.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>
    <header class="main-header">
        <div class="top-left">
            <a href="/">
                <img src="{{ asset('images/brandLogo.png') }}" alt="Brand Logo Image" class="headerLogo">
            </a>
        </div>
        <div class="top-right links">
            @guest
            @if (Route::has('login'))
            
                <a  href="{{ route('login') }}">{{ __('Prisijungti') }}</a>
            
            @endif
            @if (Route::has('register'))
            
                <a  href="{{ route('register') }}">{{ __('Registruotis') }}</a>
            
            @endif
            @else
            <div class="web-topbar-header-userarea">
                    @auth
                    <li class="dropdown links dropdown-main">
                        <a id="navbarDropdown" class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->first_name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Atsijungti') }}
                            </a>
                            <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endauth
                </div>
            @endguest
        </div>
    </header>
    <main style="background-image: url('{{ asset('images/background4.jpg') }}')" class="app-background-image">
        <div class="app-background-main"> 
            @yield('content')
        </div>
    </main>

</body>

</html>
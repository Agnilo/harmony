<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>HarmonyWorks</title>

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
        <header>
            <div class="top-left">
                <a href="/">
                    <img src="{{ asset('images/Logo.png') }}" alt="Brand Logo Image" class="headerLogo">
                </a>
            </div>
            <nav class="top-middle">
                    <a class="top-middle-a" href="{{ url('/susisiekti') }}">Susisiekite</a>
                    <a class="top-middle-a" href="{{url('/apie')}}">Apie mus</a>
            </nav>        
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <li class="nav-item dropdown links">
                    <a id="navbarDropdown" class="dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Atsijungti') }}
                        </a>
                        @can('manage-users')
                            <a class="dropdown-item" href="{{route('admin.users.index')}}">
                                Naudotojų valdymas
                            </a>
                        @endcan
                        <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @else
                <a href="{{ url('/login') }}">Prisijungti</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Registruotis</a>
                @endif
            @endauth
        </div>
    @endif
    </header>

<div class="home-background" style="background-image: url('{{ asset('images/background.jpg') }}')">
    Sveiki
</div>
<br>

<footer>
    <div class="copyright-wrapper">
        <p>HarmonyWorks</p>
        <p> © 2024. All rights reserved. </p>
    </div>
</footer>

    </body>
</html>
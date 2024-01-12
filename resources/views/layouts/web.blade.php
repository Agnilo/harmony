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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body class="web-body">
    @auth
    @if(auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('superuser')))

    @else

    @endif
    @endauth
    <div>
        <div class="side-menu">
            <div class="side-menu-inside">
                <div class="web-brand-logo">
                    <a href="/pagrindinis">
                        <img src="{{ asset('images/brandLogo.png') }}" alt="Brand Logo Image" class="web-Logo">
                    </a>
                </div>
                <ul>
                    <li><a href="{{ route('dashboard') }}" class="{{ Request::is('dashboard') ? 'active' : '' }}">Pagrindinis</a></li>
                    <li><a href="{{ route('profile') }}" class="{{ Request::is('profile') ? 'active' : '' }}">Profilis</a></li>
                    <li><a href="{{ route('benefits') }}" class="{{ Request::is('benefits') ? 'active' : '' }}">Privalumai</a></li>
                    <li><a href="{{ route('leaveRequest') }}" class="{{ Request::is('leaveRequest') ? 'active' : '' }}">Atostogos</a></li>
                    <li><a href="{{ route('colleagues') }}" class="{{ Request::is('colleagues') ? 'active' : '' }}">Mano kolegos</a></li>
                    @hasrole('Admin|SuperUser')
                    <li><a href="{{ route('admin.users.index') }}" class="{{ Request::is('admin.users.index') ? 'active' : '' }}">Naudotojų valdymas</a></li>
                    <li><a href="{{ route('leaveRequests.approve') }}" class="{{ Request::is('leaveRequests.approve') ? 'active' : '' }}">Atostogų prašymų valdymas</a></li>
                    @endhasrole
                    @hasrole('SuperUser')
                    <li><a href="{{ route('benefits.index') }}" class="{{ Request::is('benefits.index') ? 'active' : '' }}">Privalumų valdymas</a></li>
                    @endhasrole
                </ul>
            </div>
        </div>

        <header class="web-topbar">
            <div class="web-topbar-header">
                <div class="web-topbar-header-title">
                    {{ Route::currentRouteName() }}

                </div>
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
            </div>
            <div class="web-topbar-body">
            </div>
        </header>
    </div>

    <div class="web-yield-content">
        @yield('content')
    </div>

    <script>
        $(document).ready(function() {
            $('.expandable-row').on('click', function() {
                $(this).toggleClass('expanded');
            });
        });
    </script>

</body>

</html>
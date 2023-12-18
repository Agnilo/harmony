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
                            {{ __('Logout') }}
                        </a>
                        @can('manage-users')
                            <a class="dropdown-item" href="{{route('admin.users.index')}}">
                                User Management
                            </a>
                        @endcan
                        <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @else
                <a href="{{ url('/login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="container">
    <br>
    <div class="row justify-content-md-center">
        <div class="col-md-auto">
            <h2><a href="{{ url('/home') }}" style="color: #262626">PREKĖS</a></h2>
        </div>
        <div class="col-md-auto">
            <h2><a href="{{url('/delivery')}}" style="color: #262626">PRISTATYMAS</a></h2>
        </div>
        <div class="col-md-auto">
            <h2><a href="{{url('/about')}}" style="color: #262626">APIE MUS</a></h2>
        </div>
    </div>
    <br>
    <div class="row justify-content-md-center" style="background-color: lightgrey">
        <br>
    </div>
    <div class="row pt-5">
        <div class="col-2 card">
            @if($user = Auth::user())
                <h3>Gamintojai</h3>
                @foreach ($brands as $brand)
                    <a href="{{ url('/brand/') }}/{{$brand->id}}" style="color: #262626">{{$brand->name}}</a>
                @endforeach
            @endif
        </div>
        
    </div>
</div>
<br>

<footer style="background-color: lightgrey">
    <div class="container">
        <br>
        <br>
        <h3>Informacija</h3><br>
        <p>Petro g. 3, LT-12345 Vilnius<br>
            Telefonas: (8 5) 123 4567<br>
            El. paštas: info@catshop.com<br>
            Kodas: 123456789<br>
            PVM kodas: LT1123456789</p>
        <br>
        <br>
    </div>
</footer>

    <!-- <header>
        <h1>Sveiki atvykę į HarmonyWorks!</h1>
    </header>

    <nav>
        <ul>
            <li><a href="#">Pagrindinis</a></li>
            <li><a href="#">Apie</a></li>
            <li><a href="#">Paslaugos</a></li>
            <li><a href="#">Kontaktai</a></li>
        </ul>
    </nav>

    <main>
        <h2>Turinys</h2>
        <p>This is the main content area of the page..</p>
        <p>You can add more sections, content, and customize it as needed.</p>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> HarmonyWork</p>
    </footer> -->

    </body>
</html>
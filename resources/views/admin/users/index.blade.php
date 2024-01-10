@extends('layouts.web')

@section('content')
<div class="web-child-content">>
    <div class="row justify-content-md-center" style="background-color: lightgrey">
        <br>
        <br>
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <li class="nav-item dropdown links">
                <a id="navbarDropdown" class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <a class="dropdown-item" href="{{route('admin.users.index')}}">
                        User Management
                    </a>

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
        <div class="col-md-auto my-font" style="color: white">
            <h1>CatShop</h1>
        </div>
        <br>
        <br>
    </div>
    <div class="container">
        <br>
        <div class="row justify-content-md-center">
            <div class="col-md-auto">
                <h2><a style="color: #262626">Vartotojai</a></h2>
            </div>
        </div>
        <br>
        <div class="row justify-content-md-center" style="background-color: lightgrey">
            <br>
        </div>
        <main class="py-4">

            @include('partials.alerts')

        </main>
        <div class="card-body">
            <a href="{{ route('home') }}"><button type="button" class="btn btn-dark">Pagrindinis</button></a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Vardas</th>
                        <th scope="col">Email</th>
                        <th scope="col">Vaidmuo</th>
                        <th scope="col">Veiksmas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->first_name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{implode(', ', $user->roles()->get()->pluck('name')->toArray())}}</td>
                        <td>
                            <a href="{{route('admin.users.edit', $user->id)}}"><button type="button" class="btn btn-secondary float-left">Redaguoti</button></a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="float-left">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger">Ištrinti</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
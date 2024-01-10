@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <div class="container">
        <br>
        <div class="row justify-content-md-center">
            <div class="col-md-auto">
                <h2><a style="color: #262626">Naudotojai</a></h2>
            </div>
        </div>
        <br>

        <main class="py-4">

            @include('partials.alerts')

        </main>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Vardas</th>
                        <th scope="col">Pavardė</th>
                        <th scope="col">Email</th>
                        <th scope="col">Vaidmuo</th>
                        <th scope="col">Veiksmas</th>
                    </tr>
                </thead>
                <tbody>
                    @role('Admin')
                    @foreach($users as $user)
                    @if(!$user->hasRole('Admin') && !$user->hasRole('SuperUser'))
                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->first_name}}</td>
                        <td>{{$user->last_name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{implode(', ', $user->roles()->get()->pluck('name')->toArray())}}</td>
                        <td class="user-buttons">
                            <a href="{{route('admin.users.edit', $user->id)}}">
                                <button type="button" class="btn btn-secondary float-left user-button-inside">Redaguoti</button>
                            </a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="float-left">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger user-button-inside">Ištrinti</button>
                            </form>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                    @endrole

                    @can('edit-admin')
                    @foreach($users as $user)

                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->first_name}}</td>
                        <td>{{$user->last_name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{implode(', ', $user->roles()->get()->pluck('name')->toArray())}}</td>
                        <td class="user-buttons">
                            <a href="{{route('admin.users.edit', $user->id)}}">
                                <button type="button" class="btn btn-secondary float-left user-button-inside">Redaguoti</button>
                            </a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="float-left">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger user-button-inside">Ištrinti</button>
                            </form>
                        </td>
                    </tr>

                    @endforeach
                    @endcan
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
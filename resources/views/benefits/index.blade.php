@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <div class="container">

        <div class="row justify-content-md-center">
            <div class="col-md-auto">
                <h2>Privalumai</h2>
            </div>
        </div>

        @can('create-benefit')
        <div class="create-new-user-button">
            <a href="{{ route('benefits.create') }}" class="btn btn-primary">
                Sukurti privalumą
            </a>
        </div>
        @endcan

        <div class="card-body card-body-index">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Vardas</th>
                        <th scope="col">Pavardė</th>
                        <th scope="col">El. Paštas</th>
                        <th scope="col">Vaidmuo</th>
                        <th scope="col">Patvirtintas</th>
                        <th scope="col">Veiksmas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($benefits as $benefit)
                    <tr>
                        <th scope="row">{{$benefit->id}}</th>
                        <td>{{$benefit->name}}</td>
                        <td>{{$benefit->description}}</td>
                        <td class="user-buttons">
                            <!-- <a href="{{route('benefits.edit', $benefit->id)}}"> -->
                            <a href="{{route('benefits.index', $benefit->id)}}">
                                <button type="button" class="btn btn-secondary float-left user-button-inside">Redaguoti</button>
                            </a>
                            <!-- <form action="{{ route('benefits.destroy', $benefit) }}" method="POST" class="float-left"> -->
                            <form action="{{ route('benefits.index', $benefit) }}" method="POST" class="float-left">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger user-button-inside">Ištrinti</button>
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
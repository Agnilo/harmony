@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <div class="container">
      
                <h2>Privalumai</h2>

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
                        <th scope="col">Pavadinimas</th>
                        <th scope="col">Aprašymas</th>
                        <th scope="col">Veiksmai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($benefits as $benefit)
                    <tr>
                        <th scope="row">{{$benefit->id}}</th>
                        <td>{{$benefit->benefit_name}}</td>
                        <td>{{$benefit->description}}</td>
                        <td class="user-buttons">
                            
                            <a href="{{route('benefits.edit', $benefit->id)}}">
                                <button type="button" class="btn btn-secondary float-left user-button-inside">Redaguoti</button>
                            </a>
                            
                            <form action="{{ route('benefits.destroy', $benefit) }}" method="POST" class="float-left">
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
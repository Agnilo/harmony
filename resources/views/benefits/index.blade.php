@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <div class="container">
        
        <div class="row justify-content-md-center">
            <div class="col-md-auto">
                <h2>Privalumai</h2>
            </div>
        </div>
        
        <div class="create-new-user-button">
            <a href="{{ route('benefits.create') }}" class="btn btn-primary">
                    Sukurti privalumą
            </a>
        </div>

    </div>
</div>
@endsection
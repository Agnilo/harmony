@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <div class="profile-container">
        <div class="profile-card">
            <div class="profile-edit-employee">
                <div class="profile-edit-employee-navbar">
                    <div class="profile-edit-employee-imagesection">
                        nuotraukėlė
                    </div>
                    <div class="profile-edit-employee-tab">
                        tabai
                    </div>
                </div>
                <div class="profile-eidt-employee-content">
                    <div class="profile-edit-employee-content-padding">
                        <h1>{{ $user->name }}'s Profile</h1>

                        <h2>Selected Benefits:</h2>
                        <ul>
                            @foreach ($selectedBenefits as $benefit)
                            <li>{{ $benefit->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
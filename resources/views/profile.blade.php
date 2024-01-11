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
                        <h1>{{ $user->first_name }}'s Profile</h1>

                        <h2>Selected Benefits:</h2>
                        <ul>
                            @foreach ($selectedBenefits as $benefit)
                            <li>{{ $benefit->benefit_name }}</li>
                            @endforeach
                        </ul>

                        @extends('layouts.app')


                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header">Darbo užmokesčio informacija</div>

                                        <div class="card-body">
                                            <div>
                                                <h5>Work Hours: {{ $workHours }}</h5>
                                                <h5>Work Days: {{ $workDays }}</h5>
                                                <h5>Gross Salary: ${{ $grossSalary }}</h5>
                                                <h5>Net Salary: ${{ $netSalary }}</h5>
                                                <h5>Info: ${{ $info }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
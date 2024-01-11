@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <div class="profile-container">
        <div class="profile-card">
            <div class="profile-edit-employee">
                <div class="profile-edit-employee-navbar">
                    <div class="profile-edit-employee-imagesection">
                        <img src="{{ asset('images/user.jpg') }}" alt="Example Image" class="profile-img">
                    </div>
                    <div class="profile-edit-employee-tab">
                        <h5>{{ $user->first_name }} {{ $user->last_name }}</h5>
                    </div>
                </div>
                <div class="profile-eidt-employee-content">
                    <div class="profile-edit-employee-content-padding">
                        <div class="row">
                            <div class="profile-information">
                                <div class="profile-information-header">
                                    Asmeninė informacija
                                </div>
                                <div class="profile-information-content">
                                    <div class="profile-information-text">
                                        <div class="profile-element-padding"> El. Paštas</div>
                                        <div class="profile-element-padding"> {{ $user->email }}</div>
                                    </div>
                                    <div class="profile-information-text">
                                        <div class="profile-element-padding"> Lytis</div>
                                        <div class="profile-element-padding"> {{ $user->gender }}</div>
                                    </div>
                                    <div class="profile-information-text">
                                        <div class="profile-element-padding"> Adresas </div>
                                        <div class="profile-element-padding"> {{ $user->street_address }}</div>
                                    </div>
                                    <div class="profile-information-text">
                                        <div class="profile-element-padding"> Pašto kodas </div>
                                        <div class="profile-element-padding"> {{ $user->zip_code }}</div>
                                    </div>
                                    <div class="profile-information-text">
                                        <div class="profile-element-padding"> Miestas </div>
                                        <div class="profile-element-padding"> {{ $user->city }}</div>
                                    </div>
                                    <div class="profile-information-text">
                                        <div class="profile-element-padding"> Šalis </div>
                                        <div class="profile-element-padding"> {{ $user->country }}</div>
                                    </div>
                                </div>
                            </div>

                        </div>


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
                                            <h5>Gross Salary: {{ $grossSalary }}€</h5>
                                            <h5>Net Salary: {{ $netSalary }}€</h5>
                                            <h5>Info: {{ $info }}</h5>
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
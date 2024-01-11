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
                        <table class="profile-information-table">
                            <tr class="profile-information-row">
                                <td class="profile-information-cell profile-label">El. Paštas:</td>
                                <td class="profile-information-cell">{{ $user->email }}</td>
                            </tr>
                            <tr class="profile-information-row">
                                <td class="profile-information-cell profile-label">Lytis:</td>
                                <td class="profile-information-cell">{{ $user->gender }}</td>
                            </tr>
                            <tr class="profile-information-row">
                                <td class="profile-information-cell profile-label">Adresas:</td>
                                <td class="profile-information-cell">{{ $user->street_address }}</td>
                            </tr>
                            <tr class="profile-information-row">
                                <td class="profile-information-cell profile-label">Pašto kodas:</td>
                                <td class="profile-information-cell">{{ $user->zip_code }}</td>
                            </tr>
                            <tr class="profile-information-row">
                                <td class="profile-information-cell profile-label">Miestas:</td>
                                <td class="profile-information-cell">{{ $user->city }}</td>
                            </tr>
                            <tr class="profile-information-row">
                                <td class="profile-information-cell profile-label">Šalis:</td>
                                <td class="profile-information-cell">{{ $user->country }}</td>
                            </tr>
                        </table>
                        <h2>Selected Benefits:</h2>
                        <ul>
                            @foreach ($selectedBenefits as $benefit)
                            <li>{{ $benefit->benefit_name }}</li>
                            @endforeach
                        </ul>
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
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
                        <div class="profile-information-header">
                            <h5>Asmeninė informacija</h5>
                        </div>
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
                        <div class="profile-information-header">
                            <h5>Darbo užmokesčio informacija</h5>
                        </div>
                        <table class="profile-information-table">
                            <tr class="profile-information-row">
                                <td class="profile-information-cell profile-label">Darbo valandos per savaitę</td>
                                <td class="profile-information-cell">{{ $workHours }}</td>
                            </tr>
                            <tr class="profile-information-row">
                                <td class="profile-information-cell profile-label">Darbo dienos per savaitę:</td>
                                <td class="profile-information-cell">{{ $workDays }}</td>
                            </tr>
                            <tr class="profile-information-row">
                                <td class="profile-information-cell profile-label">Bruto užmokestis:</td>
                                <td class="profile-information-cell">{{ $grossSalary }}€</td>
                            </tr>
                            <tr class="profile-information-row">
                                <td class="profile-information-cell profile-label">Neto Užmokestis</td>
                                <td class="profile-information-cell">{{ $netSalary }}€</td>
                            </tr>
                            <tr class="profile-information-row">
                                <td class="profile-information-cell profile-label">Informacija</td>
                                <td class="profile-information-cell">{{ $info }}</td>
                            </tr>
                        </table>
                        <div class="profile-information-header">
                            <h5>Pasirinkti privalumai</h5>
                        </div>
                        <table class="profile-information-table">
                            @foreach ($selectedBenefits as $benefit)
                            <tr class="profile-information-row">
                                <td class="profile-information-cell profile-label">{{ $benefit->benefit_name }}</td>
                            </tr>
                            <tr class="profile-information-row">
                                <td class="profile-information-cell profile-label">Kaina</td>
                                <td class="profile-information-cell">{{ $benefit->price }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
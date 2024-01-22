@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <div class="profile-container">
        <div class="profile-card">
            <div class="profile-edit-employee">
                <div class="profile-edit-employee-navbar">
                    <div class="profile-edit-employee-imagesection">


                        @php
                        $userAvatar = $user->userMeta ? $user->userMeta->firstWhere('meta_key', 'avatar') : null;
                        $avatarPath = $userAvatar ? 'storage/' . $userAvatar->meta_value : 'images/user.jpg';
                        @endphp

                        <img src="{{ asset($avatarPath) }}" alt="User Image" class="profile-img">





                        <!-- <img src="{{ asset('images/user.jpg') }}" alt="Example Image" class="profile-img"> -->
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
                                <td class="profile-information-cell profile-label-payroll">Darbo valandos per savaitę</td>
                                <td class="profile-information-cell">{{ $workHours }}</td>
                            </tr>
                            <tr class="profile-information-row">
                                <td class="profile-information-cell profile-label-payroll">Darbo dienos per savaitę:</td>
                                <td class="profile-information-cell">{{ $workDays }}</td>
                            </tr>
                            <tr class="profile-information-row">
                                <td class="profile-information-cell profile-label-payroll">Apmokamų atostogų dienų skaičius:</td>
                                <td class="profile-information-cell">{{ $user->vacation_days }}</td>
                            </tr>
                            <tr class="profile-information-row">
                                <td class="profile-information-cell profile-label-payroll">Darbo užmokestis neatskaičius mokesčių:</td>
                                <td class="profile-information-cell">{{ $grossSalary }}€</td>
                            </tr>
                            <tr class="profile-information-row">
                                <td class="profile-information-cell profile-label-payroll">Darbo užmokestis atskaičius mokesčius:</td>
                                <td class="profile-information-cell">{{ $netSalary }}€</td>
                            </tr>
                            <tr class="profile-information-row">
                                <td class="profile-information-cell profile-label-payroll">Informacija:</td>
                                <td class="profile-information-cell">{{ $info }}</td>
                            </tr>
                        </table>
                        <div class="profile-information-header">
                            <h5>Pasirinkti privalumai</h5>
                        </div>
                        <table class="profile-information-table">
                            @foreach ($selectedBenefits as $benefit)
                            <tr class="profile-information-row">
                                <td class="profile-information-cell profile-label">
                                    <a href="{{ route('benefits.show', $benefit->id) }}" class="benefit-link-profile">{{ $benefit->benefit_name }}</a>
                                </td>
                            </tr>
                            <tr class="profile-information-row">
                                <td class="profile-information-cell">Kaina</td>
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
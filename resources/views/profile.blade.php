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
                        content before 
                        @auth
    @if(auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('superuser')))
<a class="dropdown-item" href="{{route('admin.users.index')}}">
                                User Management
                            </a>
    @else
        content else
    @endif
    @endauth
                            
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

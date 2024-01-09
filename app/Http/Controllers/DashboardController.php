<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        //return view('dashboard');

        $user = Auth::user();
        $roles = $user->roles;
        return view('dashboard', ['user' => $user, 'roles' => $roles]);
    }
}
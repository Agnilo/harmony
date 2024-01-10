<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ColleaguesController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('colleagues')->with('users', $users);
    }
}

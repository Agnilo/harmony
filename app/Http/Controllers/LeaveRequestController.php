<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    public function index()
    {
        return view('leaveRequest'); // Grąžinama "home" pavadinimo peržiūros failas (view)
    }
}
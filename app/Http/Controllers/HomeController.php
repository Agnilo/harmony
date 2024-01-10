<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('guest.home'); // Grąžinama "home" pavadinimo peržiūros failas (view)
    }
}
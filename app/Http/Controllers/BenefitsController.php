<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BenefitsController extends Controller
{
    public function index()
    {
        return view('benefits');
    }
}
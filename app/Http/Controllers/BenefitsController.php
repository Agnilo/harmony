<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Benefits;

class BenefitsController extends Controller
{
    public function index()
    {
        $benefits = Benefits::all(); // Fetch all benefits from the database

        return view('benefits', compact('benefits')); // Pass benefits data to the view
    }
}
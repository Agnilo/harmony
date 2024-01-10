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

    public function superuserindex()
    {
        $benefits = Benefits::all(); // Fetch all benefits from the database

        return view('benefits.index', compact('benefits')); // Pass benefits data to the view
    }

    public function create()
    {
        return view('beneftis.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'benefit_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'picture' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        Benefits::create($validatedData);

        return redirect()->route('benefits.index')->with('success', 'Privalumas sukurtas sėkmingai');
    }
}
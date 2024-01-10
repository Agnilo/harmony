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
        return view('benefits.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'benefit_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'picture' => 'required|image|max:2048',
            'price' => 'required|numeric',
        ]);

        $picturePath = $request->file('picture')->store('benefit_pictures', 'public');

        Benefits::create([
            'benefit_name' => $validatedData['benefit_name'],
            'description' => $validatedData['description'],
            'picture' => $picturePath,
            'price' => $validatedData['price'],
        ]);

        return redirect()->route('benefits.index')->with('success', 'Privalumas sukurtas sėkmingai');
    }
}
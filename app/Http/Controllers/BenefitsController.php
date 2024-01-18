<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Benefits;
use Illuminate\Support\Facades\Log;

class BenefitsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $benefits = Benefits::all();

        return view('benefits', compact('benefits'));
    }

    public function superuserindex()
    {
        $benefits = Benefits::all();

        return view('benefits.index', compact('benefits'));
    }

    public function show(Benefits $benefit)
    {
        return view('benefits.show', compact('benefit'));
    }

    public function edit(Benefits $benefit)
    {
        if (auth()->user()->can('edit-benefit')) {
            return view('benefits.edit', compact('benefit'));
        } else {

            return redirect()->route('benefits.index');
        }
    }

    public function update(Request $request, Benefits $benefit)
    {

        $validatedData = $request->validate([
            'benefit_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:60',
            'picture' => 'nullable|image|max:2048', // Update to nullable, as picture is not required in update
            'price' => 'required|numeric',
            'introduction' => 'nullable|string',
            'content' => 'nullable|string',
        ]);

        // Update benefit properties
        $benefit->update($validatedData);

        if ($request->hasFile('picture')) {
            // Update picture only if a new file is uploaded
            $picturePath = $request->file('picture')->store('benefit_pictures', 'public');
            $benefit->picture = $picturePath;
            $benefit->save();
        }

        if ($benefit->save()) {
            $request->session()->flash('success', 'Privalumas ' . $benefit->benefit_name . ' buvo atnaujintas');
        } else {
            $request->session()->flash('warning', 'Iškilo problema atnaujinant vartotoją');
        }

        return redirect()->route('benefits.index');
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
            'introduction' => 'nullable|string',
            'content' => 'nullable|string',
        ]);

        $picturePath = $request->file('picture')->store('benefit_pictures', 'public');

        Benefits::create([
            'benefit_name' => $validatedData['benefit_name'],
            'description' => $validatedData['description'],
            'picture' => $picturePath,
            'price' => $validatedData['price'],
            'introduction' => $validatedData['introduction'],
            'content' => $validatedData['content'],
        ]);

        return redirect()->route('benefits.index')->with('success', 'Privalumas sukurtas sėkmingai');
    }

    public function destroy(Benefits $benefit)
    {

        if (auth()->user()->can('delete-benefit')) {

            $benefit->delete();

            return redirect()->route('benefits.index')->with('success', 'Privalumas ištrintas sėkmingai');;
        } else {

            return redirect()->route('benefits.index')->with('error', 'Neturi tam teisių');
        }
    }

    public function selectBenefit(Benefits $benefit)
    {
        $user = auth()->user();

        $user->load('selectedBenefits');

        if ($user && !$user->selectedBenefits->contains($benefit->id)) {
            Log::info("User {$user->id} is selecting benefit {$benefit->id}");

            $user->benefits()->attach($benefit->id);
            return redirect()->route('benefits')->with('success', 'Privalumas pasirinktas sėkmingai.');
        }

        return redirect()->route('benefits.show', $benefit)->with('warning', 'Jau esate pasirinkę šį privalumą');
    }
}

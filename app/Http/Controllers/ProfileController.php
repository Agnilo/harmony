<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Benefits;

class ProfileController extends Controller
{
    public function index()
    {

        $user = auth()->user();
        $selectedBenefits = $user->selectedBenefits;
        $payroll = $user->payroll;

        return view('profile', compact('user', 'selectedBenefits', 'payroll'));
    }
}
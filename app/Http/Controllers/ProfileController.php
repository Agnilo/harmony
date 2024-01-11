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

        $payroll = optional($user->payroll)->toArray();

        $workHours = $payroll ? $payroll['work_hours'] : 0;
        $workDays = $payroll ? $payroll['work_days'] : 0;
        $grossSalary = $payroll ? $payroll['gross'] : 0;
        $netSalary = $payroll ? $payroll['net'] : 0;
        $info = $payroll ? $payroll['info'] : '';

        return view('profile', compact('user', 'selectedBenefits', 'workHours', 'workDays', 'grossSalary', 'netSalary', 'info'));
    }
}

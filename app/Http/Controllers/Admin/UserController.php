<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index')->with('users', $users);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */

    public function edit(User $user)
    {
        if (auth()->user()->can('edit-users')) {

            $roles = Role::all();
            $payroll = $user->payroll;

            $workHours = $payroll ? $payroll['work_hours'] : 0;
            $workDays = $payroll ? $payroll['work_days'] : 0;
            $overtime = $payroll ? $payroll['overtime'] : 0;
            $grossSalary = $payroll ? $payroll['gross'] : 0;
            $netSalary = $payroll ? $payroll['net'] : 0;
            $info = $payroll ? $payroll['info'] : '';

            return view('admin.users.edit', compact('user', 'roles', 'workHours', 'workDays', 'overtime', 'grossSalary', 'netSalary', 'info'));
        } else {

            return redirect()->route('admin.users.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->is_verified = $request->is_verified;

        //$user->syncRoles($request->roles);

        $validateRoleIds = $request->roles;
        $roles = Role::whereIn('id', $validateRoleIds)->get();
        $user->syncRoles($roles);

        if ($user->save()) {
            $request->session()->flash('success', 'Vartotojas ' . $user->first_name . ' buvo atnaujintas');
        } else {
            $request->session()->flash('warning', 'Iškilo problema atnaujinant vartotoją');
        }

        $payrollData = [
            'year' => $request->year,
            'month' => $request->month,
            'work_hours' => $request->work_hours,
            'work_days' => $request->work_days,
            'leave_hours' => $request->leave_hours,
            'overtime' => $request->overtime,
            'gross' => $request->gross,
            'net' => $this->calculateNetSalary($request->gross, $request),
            'info' => $request->info,
        ];

        if ($user->payroll) {

            $user->payroll->update($payrollData);
        } else {

            $user->payroll()->create($payrollData);
        }

        return redirect()->route('admin.users.index');
    }

    private function calculateNetSalary($gross, $request)
    {

        $userBenefits = Auth::user()->selectedBenefits;

        $taxRate = 0.25;
        $healthInsuranceRate = 0.15;

        $userWorkHours = $request->work_hours;
        $userWorkDays = $request->work_days;

        //hour per week
        if ($userWorkDays != 0) {
            $userWorkHoursPerDay = $userWorkHours / $userWorkDays;
        } else {
            $userWorkHoursPerDay = 0;
        }

        $baseHours = $userWorkHours * 4; //Base amount of hours

        //general hourly rate
        if ($baseHours != 0) {
            $baseHourlyRate = $gross / $baseHours;
        } else {
            $baseHourlyRate = 0;
        }

        $totalDeductionRate = $taxRate + $healthInsuranceRate; //general tax deduction

        $overtimeSum = 0;
        $unpaidLeaveDeduction = 0;
        $paidLeaveSum = 0;


        if ($request->leave_request_id) {
            
            $leaveRequest = LeaveRequest::findOrFail($request->leave_request_id); // Fetch the leave request details

            $leaveMonth = date('m', strtotime($leaveRequest->start_date));
            $leaveYear = date('Y', strtotime($leaveRequest->start_date));

            if ($leaveMonth == $request->month && $leaveYear == $request->year) {
                
                if ($leaveRequest->leave_type === 'unpaid_leave') { // Determine if it's a paid or unpaid leave

                    $unpaidleaveHours = $leaveRequest->days * $userWorkHoursPerDay; //unpaid leave total work hours

                    $unpaidLeaveDeduction = $unpaidleaveHours * $baseHourlyRate; //unpain leave deduction 

                } elseif ($leaveRequest->leave_type === 'paid_leave') {

                    $paidLeaveHours = $leaveRequest->days * $userWorkHoursPerDay; //paid leave total work hours

                    $paidLeaveSum = $paidLeaveHours * ($baseHourlyRate * 1.1); //paid leave sum
                }
            }

            $overtimeSum = ($request->overtime !== null && $request->overtime !== 0) ? ($request->overtime * $baseHourlyRate) * 1.5 : 0;

            $totalBenefitPrice = $userBenefits->sum('price');

            $grossWithoutPaidLeave = ($baseHours - $paidLeaveHours) * $baseHourlyRate;

            $gross = $grossWithoutPaidLeave + $paidLeaveSum - $unpaidLeaveDeduction - $totalBenefitPrice + $overtimeSum;

            $net = $gross * (1 - $totalDeductionRate);
        }

        return $net;
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'gender' => 'nullable',
            'year' => 'required|integer',
            'month' => 'required|integer',
            'work_hours' => 'required|numeric',
            'work_days' => 'required|integer',
            'leave_hours' => 'required|numeric',
            'overtime' => 'required|numeric',
            'gross' => 'required|numeric',
            'net' => 'required|numeric',
            'info' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'gender' => $validatedData['gender'],
            'is_verified' => true,

        ]);

        $defaultRole = Role::where('name', 'User')->first();
        $user->assignRole($defaultRole);

        $user->payroll()->create([
            'year' => $validatedData['year'],
            'month' => $validatedData['month'],
            'work_hours' => $validatedData['work_hours'],
            'work_days' => $validatedData['work_days'],
            'leave_hours' => $validatedData['leave_hours'],
            'overtime' => $validatedData['overtime'],
            'gross' => $validatedData['gross'],
            'net' => $validatedData['net'],
            'info' => $validatedData['info'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Naudotojas sukurtas sėkmingai');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        if (auth()->user()->can('delete-users')) {

            $user->payroll()->delete();

            $user->roles()->detach();
            $user->delete();

            return redirect()->route('admin.users.index');
        } else {

            return redirect()->route('admin.users.index');
        }
    }
}

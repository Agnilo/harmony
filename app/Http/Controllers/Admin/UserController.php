<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use App\Models\LeaveRequest;
use App\Models\Payroll;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

            $work_hours = $payroll ? $payroll['work_hours'] : 0;
            $work_days = $payroll ? $payroll['work_days'] : 0;
            $overtime = $payroll ? $payroll['overtime'] : 0;
            $gross = $payroll ? $payroll['gross'] : 0;
            $net = $payroll ? $payroll['net'] : 0;
            $info = $payroll ? $payroll['info'] : '';

            return view('admin.users.edit', compact('user', 'roles', 'work_hours', 'work_days', 'overtime', 'gross', 'net', 'info'));
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

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'is_verified' => 'nullable|boolean',
        ]);


        $payrollValidation = $request->validate([
            'work_hours' => 'nullable|numeric|between:0,99.9',
            'work_days' => 'nullable|integer|min:0',
            'overtime' => 'nullable|numeric',
            'gross' => 'nullable|numeric|between:0,999999.99',
            'info' => 'nullable|string|max:255',
        ]);

        $user->fill([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'is_verified' => $validatedData['is_verified'],
        ]);

        $validateRoleIds = $request->roles;

        if (!is_array($validateRoleIds)) {
            $validateRoleIds = [$validateRoleIds];
        }

        $roles = Role::whereIn('id', $validateRoleIds)->get();
        $user->syncRoles($roles);

        if ($user->save()) {
            $request->session()->flash('success', 'Vartotojas ' . $user->first_name . ' buvo atnaujintas');
        } else {
            $request->session()->flash('warning', 'Iškilo problema atnaujinant vartotoją');
        }

        $payrollData = [
            'work_hours' => $payrollValidation['work_hours'],
            'work_days' => $payrollValidation['work_days'],
            'overtime' => $payrollValidation['overtime'],
            'gross' => $payrollValidation['gross'],
            'net' => isset($payrollValidation['gross']) ? $this->calculateNetSalary($payrollValidation['gross'], $request) : 0,
            //'net' => $this->calculateNetSalary($payrollValidation['gross'], $request),
            //'net' => $payrollValidation['net'] ?? 0,
            'info' => $payrollValidation['info'],
        ];

        if ($user->payroll) {     
            $user->payroll->update($payrollData);
        } else {
            $user->payroll()->create($payrollData);
        }

        $payroll = Payroll::all();

        $leaveRequestIds = $request->input('leave_request_ids', []);
        dd($leaveRequestIds);
        $payroll->leaveRequests()->sync($leaveRequestIds);

        return redirect()->route('admin.users.index');
    }

    private function calculateNetSalary($gross, $request)
    {
        $net = 0;

        $userBenefits = Auth::user()->selectedBenefits;

        $taxRate = 0.25;
        $healthInsuranceRate = 0.15;

        $userWorkHours = $request->work_hours ?? 0;
        $userWorkDays = $request->work_days ?? 0;

        $userWorkHoursPerDay = ($userWorkDays != 0) ? ($userWorkHours / $userWorkDays) : 0;

        $baseHours = $userWorkHours * 4;

        $baseHourlyRate = ($baseHours != 0) ? ($gross / $baseHours) : 0;

        $totalDeductionRate = $taxRate + $healthInsuranceRate;

        $overtimeSum = 0;
        $unpaidLeaveDeduction = 0;
        $paidLeaveSum = 0;



        if ($request->leave_request_id) {
            $leaveRequest = LeaveRequest::findOrFail($request->leave_request_id);

            $leaveMonth = date('m', strtotime($leaveRequest->start_date));
            $leaveYear = date('Y', strtotime($leaveRequest->start_date));

            if ($leaveMonth == $request->month && $leaveYear == $request->year) {
                if ($leaveRequest->leave_type === 'unpaid_leave') {
                    $unpaidleaveHours = $leaveRequest->days * $userWorkHoursPerDay;
                    $unpaidLeaveDeduction = $unpaidleaveHours * $baseHourlyRate;
                } elseif ($leaveRequest->leave_type === 'paid_leave') {
                    $paidLeaveHours = $leaveRequest->days * $userWorkHoursPerDay;
                    $paidLeaveSum = $paidLeaveHours * ($baseHourlyRate * 1.1);
                }
            }
        }

        $overtimeSum = ($request->overtime !== null && $request->overtime !== 0) ? ($request->overtime * $baseHourlyRate) * 1.5 : 0;

        $totalBenefitPrice = $userBenefits->sum('price');

        $grossWithoutPaidLeave = ($baseHours - ($paidLeaveHours ?? 0)) * $baseHourlyRate;

        $gross = $grossWithoutPaidLeave + $paidLeaveSum - $unpaidLeaveDeduction - $totalBenefitPrice + $overtimeSum;

        $net = $gross * (1 - $totalDeductionRate);

        return $net;
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        Log::info("Store method invoke");

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,',
            'password' => 'required|min:8',
            'gender' => 'nullable|in:Vyras,Moteris,Kita',
            'is_verified' => 'nullable|boolean',
            'work_hours' => 'nullable|numeric|between:0,99.9',
            'work_days' => 'nullable|integer|min:0',
            'overtime' => 'nullable|numeric',
            'gross' => 'nullable|numeric|between:0,999999.99',
            'info' => 'nullable|string|max:255',
        ]);

        Log::info("Data verified");

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'gender' => 'nullable|in:Vyras,Moteris,Kita',
            'work_hours' => 'required|numeric',
            'work_days' => 'required|integer',
            'leave_hours' => 'required|numeric',
            'overtime' => 'required|numeric',
            'gross' => 'required|numeric',           
            'info' => 'nullable|string|max:255',
        ]);

        Log::info("Data verified 2");

        $user = User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'gender' => $validatedData['gender'],
            'is_verified' => true,

        ]);

        Log::info("User {$user->id} is created");

        $defaultRole = Role::where('name', 'User')->first();
        $user->assignRole($defaultRole);

        Log::info("User {$user->id} has $defaultRole");

        $user->payroll()->create([
            'year' => $validatedData['year'],
            'month' => $validatedData['month'],
            'work_hours' => $validatedData['work_hours'],
            'work_days' => $validatedData['work_days'],
            'leave_hours' => $validatedData['leave_hours'],
            'overtime' => $validatedData['overtime'],
            'gross' => $validatedData['gross'],
            
            'info' => $validatedData['info'],
        ]);

        Log::info("User {$user->id} payroll created");

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

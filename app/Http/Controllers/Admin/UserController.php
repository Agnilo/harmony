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
            'gender' => 'nullable|in:Vyras,Moteris,Kita',
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
            'gender' => $validatedData['gender'],
            'is_verified' => $validatedData['is_verified'],
        ]);

        $validateRoleIds = $request->roles;

        if (!is_array($validateRoleIds)) {
            $validateRoleIds = [$validateRoleIds];
        }

        $roles = Role::whereIn('id', $validateRoleIds)->get();
        $user->syncRoles($roles);

        $payroll = $user->payroll;

        $leaveRequests = LeaveRequest::where('user_id', $user->id)->get();

        $payrollMonth = $payroll->month;
        $payrollYear = $payroll->year;

        $totalPaidLeaveDays = 0;
        $totalUnpaidLeaveDays = 0;

        if (!$leaveRequests->isEmpty()) {

            foreach ($leaveRequests as $leaveRequest) {
                $startDate = new \DateTime($leaveRequest->start_date);
                $endDate = new \DateTime($leaveRequest->end_date);

                $startYear = (int)$startDate->format('Y');
                $startMonth = (int)$startDate->format('m');
                $endYear = (int)$endDate->format('Y');
                $endMonth = (int)$endDate->format('m');

                if (
                    ($startYear == $payrollYear && $startMonth == $payrollMonth) ||
                    ($endYear == $payrollYear && $endMonth == $payrollMonth) ||
                    ($startYear < $payrollYear && $endYear > $payrollYear)
                ) {
                    if ($leaveRequest->leave_type === 'paid_leave') {
                        $totalPaidLeaveDays += $leaveRequest->days;
                    } elseif ($leaveRequest->leave_type === 'unpaid_leave') {
                        $totalUnpaidLeaveDays += $leaveRequest->days;
                    }
                }
            }
        

            $salaryCalculationRequest = new Request();
            $salaryCalculationRequest->replace([
                'total_paid_leave_days' => $totalPaidLeaveDays,
                'total_unpaid_leave_days' => $totalUnpaidLeaveDays,
                'work_hours' => $payroll->work_hours,
                'work_days' => $payroll->work_days,
                'overtime' => $payroll->overtime,
                'gross' => $payroll->gross,
                'month' => $payroll->month,
                'year' => $payroll->year,
                'leave_request_id' => $leaveRequest->id,
            ]);

            $net = $user->calculateNetSalary($payrollValidation['gross'], $salaryCalculationRequest, $totalPaidLeaveDays, $totalUnpaidLeaveDays);
        } else {

            $salaryCalculationRequest = new Request();
            $salaryCalculationRequest->replace([
                'total_paid_leave_days' => $totalPaidLeaveDays,
                'total_unpaid_leave_days' => $totalUnpaidLeaveDays,
                'work_hours' => $payroll->work_hours,
                'work_days' => $payroll->work_days,
                'overtime' => $payroll->overtime,
                'gross' => $payroll->gross,
                'month' => $payroll->month,
                'year' => $payroll->year,
            ]);

            $net = $user->calculateNetSalary($payrollValidation['gross'], $salaryCalculationRequest, $totalPaidLeaveDays, $totalUnpaidLeaveDays);
        }

        $info = $payrollValidation['info'] ?? '';

        $payrollData = array_merge($payrollValidation, ['net' => $net, 'info' => $info]);

        if ($user->payroll) {
            $user->payroll->update($payrollData);
        } else {
            $user->payroll()->create($payrollData);
        }

        $leaveRequestIds = $request->input('leave_request_ids', []);
        if (!empty($leaveRequestIds)) {
            $user->payroll->leaveRequests()->sync($leaveRequestIds);
        }

        if ($user->save()) {
            $request->session()->flash('success', 'Vartotojas ' . $user->first_name . ' buvo atnaujintas');
        } else {
            $request->session()->flash('warning', 'Iškilo problema atnaujinant vartotoją');
        }

        return redirect()->route('admin.users.index');
    }


    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        // Log::info("Store method invoke");

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,',
            'password' => 'required|min:8',
            'gender' => 'nullable|in:Vyras,Moteris,Kita',
            'work_hours' => 'nullable|numeric|between:0,99.9',
            'work_days' => 'nullable|integer|min:0',
            'overtime' => 'nullable|numeric',
            'gross' => 'nullable|numeric|between:0,999999.99',
            'info' => 'nullable|string|max:255',
        ]);

        // Log::info("Data verified");

        $user = User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'gender' => $validatedData['gender'],
            'is_verified' => true,

        ]);

        // Log::info("User {$user->id} is created");

        $defaultRole = Role::where('name', 'User')->first();
        $user->assignRole($defaultRole);

        // Log::info("User {$user->id} has $defaultRole");

        $user->payroll()->create([
            'work_hours' => $validatedData['work_hours'],
            'work_days' => $validatedData['work_days'],
            'overtime' => $validatedData['overtime'],
            'gross' => $validatedData['gross'],
            'net' => isset($validatedData['gross']) ? $user->calculateNetSalary($validatedData['gross'], $request) : 0,
            'info' => $validatedData['info'] ?? '',
        ]);

        // Log::info("User {$user->id} payroll created");

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

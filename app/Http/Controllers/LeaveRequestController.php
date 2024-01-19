<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LeaveRequestController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $leaveRequests = Auth::user()->leaveRequests;
        $leaveRequests->load('payrolls');

        return view('leaveRequest', compact('leaveRequests'));
    }

    public function create()
    {
        if (auth()->user()->can('create-leaveRequest')) {
            return view('leave.create');
        } else {

            return redirect()->route('leaveRequest');
        }
    }

    public function edit(LeaveRequest $leaveRequest)
    {
        if (auth()->user()->can('edit-leaveRequest')) {
            return view('leave.edit', compact('leaveRequest'));
        } else {

            return redirect()->route('leaveRequest');
        }
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'leaveRequest_name' => 'required|string|max:255',
            'leave_type' => 'required|in:paid_leave,unpaid_leave',
            'reason' => 'required|string|max:255',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'days' => 'required|integer|min:1|max:' . $user->vacation_days,
            'file_upload' => 'nullable|mimes:pdf,doc,docx|max:2048',
            'remarks' => 'nullable|string|max:255',
        ]);

        $filePath = $request->file('file_upload') ? $request->file('file_upload')->store('leaveRequests', 'public') : null;

        $payroll = $user->payroll()->latest()->first();
        $payrollMonth = $payroll->month;
        $payrollYear = $payroll->year;

        $newLeaveRequest = new LeaveRequest([
            'leaveRequest_name' => $validatedData['leaveRequest_name'],
            'leave_type' => $validatedData['leave_type'],
            'reason' => $validatedData['reason'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'days' => $validatedData['days'],
            'file_upload' => $filePath,
            'remarks' => $validatedData['remarks'],
            'approval_status' => 'Prašymas neperžiūrėtas',
        ]);

        $user->leaveRequests()->save($newLeaveRequest);

        $newLeaveRequest->payrolls()->attach($payroll->id);

        $existingLeaveRequests = LeaveRequest::where('user_id', $user->id)->get();

        //$existingLeaveRequests->push($newLeaveRequest);

        $totalPaidLeaveDays = 0;
        $totalUnpaidLeaveDays = 0;

        foreach ($existingLeaveRequests as $leaveRequest) {
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
                } 

                elseif ($leaveRequest->leave_type === 'unpaid_leave') {
                    $totalUnpaidLeaveDays += $leaveRequest->days;
                }

                // switch ($leaveRequest->leave_type) {
                //     case 'paid_leave':
                //         $totalPaidLeaveDays += $leaveRequest->days;
                //         break;

                //     case 'unpaid_leave':
                //         $totalUnpaidLeaveDays += $leaveRequest->days;
                //         break;
                // }
            }
        }

        $salaryCalculationRequest = new Request([
            'work_hours' => $payroll->work_hours,
            'work_days' => $payroll->work_days,
            'overtime' => $payroll->overtime,
            'gross' => $payroll->gross,
            'month' => $payrollMonth,
            'year' => $payrollYear,
            'total_paid_leave_days' => $totalPaidLeaveDays,
            'total_unpaid_leave_days' => $totalUnpaidLeaveDays,
            'leave_request_id' => $newLeaveRequest->id,
        ]);

        $netSalary = $user->calculateNetSalary($payroll->gross, $salaryCalculationRequest, $totalPaidLeaveDays, $totalUnpaidLeaveDays);
        $payroll->update(['net' => $netSalary]);


        if ($validatedData['leave_type'] == 'paid_leave') {
            $newVacationDays = $user->vacation_days - $validatedData['days'];
            $user->vacation_days = $newVacationDays;
            $user->save();
        }

        return redirect()->route('leaveRequest')->with('success', 'Atostogų prašymas sukurtas sėkmingai.');
    }

    public function update(Request $request, LeaveRequest $leaveRequest)
    {
        $user = Auth::user();


        $validatedData = $request->validate([
            'leaveRequest_name' => 'required|string|max:255',
            'leave_type' => 'required|in:paid_leave,unpaid_leave',
            'reason' => 'required|string|max:255',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'days' => 'required|integer|min:1|max:' . $user->vacation_days,
            'file_upload' => 'nullable|mimes:pdf,doc,docx|max:2048',
            'remarks' => 'nullable|string|max:255',
        ]);


        if ($request->hasFile('file_upload')) {
            $filePath = $request->file('file_upload')->store('leaveRequests', 'public');
            $validatedData['file_upload'] = $filePath;
        }

        $leaveRequest->update($validatedData);

        $user = $leaveRequest->user;
        $payroll = $user->payroll()->latest()->first();
        $payrollMonth = $payroll->month;
        $payrollYear = $payroll->year;

        $existingLeaveRequests = LeaveRequest::where('user_id', $user->id)->get();

        $totalPaidLeaveDays = 0;
        $totalUnpaidLeaveDays = 0;

        foreach ($existingLeaveRequests as $leaveRequest) {
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

        //$existingLeaveRequests->push($leaveRequest);

        $salaryCalculationRequest = new Request([
            'work_hours' => $payroll->work_hours,
            'work_days' => $payroll->work_days,
            'overtime' => $payroll->overtime,
            'gross' => $payroll->gross,
            'month' => $payrollMonth,
            'year' => $payrollYear,
            'total_paid_leave_days' => $totalPaidLeaveDays,
            'total_unpaid_leave_days' => $totalUnpaidLeaveDays,
            'leave_request_id' => $leaveRequest->id,
        ]);

        $netSalary = $user->calculateNetSalary($payroll->gross, $salaryCalculationRequest, $totalPaidLeaveDays, $totalUnpaidLeaveDays);
        $payroll->update(['net' => $netSalary]);


        if ($validatedData['leave_type'] == 'paid_leave') {
            $newVacationDays = $user->vacation_days - $validatedData['days'];
            $user->vacation_days = $newVacationDays;
            $user->save();
        }

        return redirect()->route('leaveRequest')->with('success', 'Atostogų prašymas buvo atnaujintas sėkmingai.');
    }

    public function destroy(LeaveRequest $leaveRequest)
    {

        if (auth()->user()->can('delete-leaveRequest')) {
            $user = $leaveRequest->user;
            $payroll = $user->payroll()->latest()->first();

            if ($payroll) {

                $currentLeaveRequests = LeaveRequest::where('user_id', $user->id)
                    ->where('id', '!=', $leaveRequest->id)
                    ->get();

                $totalPaidLeaveDays = 0;
                $totalUnpaidLeaveDays = 0;

                foreach ($currentLeaveRequests as $lr) {
                    if ($lr->leave_type === 'paid_leave') {
                        $totalPaidLeaveDays += $lr->days;
                    } elseif ($lr->leave_type === 'unpaid_leave') {
                        $totalUnpaidLeaveDays += $lr->days;
                    }
                }

                // dd($totalPaidLeaveDays, $totalUnpaidLeaveDays);

                // if ($leaveRequest->leave_type === 'paid_leave') {
                //     $totalPaidLeaveDays -= $leaveRequest->days;
                // } //elseif ($leaveRequest->leave_type === 'unpaid_leave') {
                //     $totalUnpaidLeaveDays -= $leaveRequest->days;
                // }

                // dd($totalPaidLeaveDays, $totalUnpaidLeaveDays);

                $salaryCalculationRequest = new Request([
                    'work_hours' => $payroll->work_hours,
                    'work_days' => $payroll->work_days,
                    'overtime' => $payroll->overtime,
                    'gross' => $payroll->gross,
                    'month' => $payroll->month,
                    'year' => $payroll->year,
                    'total_paid_leave_days' => $totalPaidLeaveDays,
                    'total_unpaid_leave_days' => $totalUnpaidLeaveDays,
                    'leave_request_id' => $leaveRequest->id,
                ]);

                //dd($totalPaidLeaveDays, $totalUnpaidLeaveDays);

                $netSalary = $user->calculateNetSalary($payroll->gross, $salaryCalculationRequest, $totalPaidLeaveDays, $totalUnpaidLeaveDays);
                $payroll->update(['net' => $netSalary]);
            }


            if ($leaveRequest->leave_type === 'paid_leave') {
                $user->vacation_days += $leaveRequest->days;
                $user->save();
            }

            $leaveRequest->delete();
            return redirect()->route('leaveRequest')->with('success', 'Atostogų prašymas ištrintas sėkmingai');;
        } else {

            return redirect()->route('leaveRequest')->with('error', 'Neturite tam teisių');
        }
    }

    public function indexForApproval()
    {
        $leaveRequests = LeaveRequest::all();

        return view('leave.approve', compact('leaveRequests'));
    }

    public function updateApproval(Request $request, LeaveRequest $leaveRequest)
    {


        $validatedData = $request->validate([
            'approval_status' => 'required|in:pending,approved,rejected',
        ]);

        $leaveRequest->update($validatedData);



        return redirect()->route('leaveRequests.approve')->with('success', 'Prašymas buvo sėkmingai atnaujintas.');
    }
}

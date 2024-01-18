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

        $leaveRequest = new LeaveRequest([
            'leaveRequest_name' => $validatedData['leaveRequest_name'],
            'leave_type' => $validatedData['leave_type'],
            'reason' => $validatedData['reason'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'days' => $validatedData['days'],
            'file_upload' => $filePath,
            'remarks' => $validatedData['remarks'],
            'approval_status' => 'prašymas neperžiūrėtas',
        ]);

        $user = Auth::user();
        $user->leaveRequests()->save($leaveRequest);

        $payrollId = $request->input('payroll_id');
        if ($payrollId) {
            $leaveRequest->payrolls()->attach($payrollId);
        }

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

        $payrollId = $request->input('payroll_id');
        if ($payrollId) {
            $leaveRequest->payrolls()->sync([$payrollId]);
        }

        return redirect()->route('leaveRequest')->with('success', 'Atostogų prašymas buvo atnaujintas sėkmingai.');
    }

    public function destroy(LeaveRequest $leaveRequest)
    {

        if (auth()->user()->can('delete-leaveRequest')) {

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

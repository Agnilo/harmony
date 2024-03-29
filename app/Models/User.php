<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'gender',
        'is_verified',
        'position',
        'street_address',
        'zip_code',
        'city',
        'country',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function  roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasAnyRole($role)
    {

        if ($this->roles()->whereIn('name', $role)->first()) {
            return true;
        }

        return false;
    }

    public function selectedBenefits()
    {
        return $this->belongsToMany(Benefits::class, 'user_benefits')->withTimestamps();
    }

    public function leaveRequests()
    {
        return $this->hasMany(LeaveRequest::class);
    }

    public function payroll()
    {
        return $this->hasOne(Payroll::class);
    }

    public function userMeta()
    {
        return $this->hasOne(UserMeta::class);
    }

    public function calculateNetSalary($gross, $request, $totalPaidLeaveDays, $totalUnpaidLeaveDays)
    {

        //dd($gross, $request->all(), $totalPaidLeaveDays, $totalUnpaidLeaveDays);

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

        //dd('Received in calculateNetSalary', $totalPaidLeaveDays, $totalUnpaidLeaveDays);


        if ($request->leave_request_id) {
            $leaveRequest = LeaveRequest::findOrFail($request->leave_request_id);

            $leaveMonth = date('m', strtotime($leaveRequest->start_date));
            $leaveYear = date('Y', strtotime($leaveRequest->start_date));

            if ($leaveMonth == $request->month && $leaveYear == $request->year) {
                // switch ($leaveRequest->leave_type) {
                //     case 'paid_leave':
                //         $paidLeaveHours = $totalPaidLeaveDays * $userWorkHoursPerDay;
                //         $paidLeaveSum = $paidLeaveHours * ($baseHourlyRate * 1.1);
                //         break;

                //     case 'unpaid_leave':
                //         $unpaidleaveHours = $totalUnpaidLeaveDays * $userWorkHoursPerDay;
                //         $unpaidLeaveDeduction = $unpaidleaveHours * $baseHourlyRate;
                //         break;
                // }
                if ($totalUnpaidLeaveDays > 0) {
                    $unpaidleaveHours = $totalUnpaidLeaveDays * $userWorkHoursPerDay;
                    $unpaidLeaveDeduction = $unpaidleaveHours * $baseHourlyRate;
                    //dd($unpaidleaveHours);
                }
                if ($totalPaidLeaveDays > 0) {
                    $paidLeaveHours = $totalPaidLeaveDays * $userWorkHoursPerDay;
                    $paidLeaveSum = $paidLeaveHours * ($baseHourlyRate * 1.1);
                    //dd($paidLeaveSum);
                }
            }
        }


        $overtimeSum = ($request->overtime !== null && $request->overtime !== 0) ? ($request->overtime * $baseHourlyRate) * 1.5 : 0;

        $totalBenefitPrice = $userBenefits->sum('price');

        $grossWithoutPaidLeave = ($baseHours - ($paidLeaveHours ?? 0)) * $baseHourlyRate;

        $gross = $grossWithoutPaidLeave + $paidLeaveSum - $unpaidLeaveDeduction - $totalBenefitPrice + $overtimeSum;

        //dd($gross, $grossWithoutPaidLeave, $paidLeaveSum, $unpaidLeaveDeduction, $totalBenefitPrice, $overtimeSum);

        $net = $gross * (1 - $totalDeductionRate);

        //dd($net, $gross, $grossWithoutPaidLeave, $paidLeaveSum, $unpaidLeaveDeduction, $totalBenefitPrice, $overtimeSum);

        //dd('baseHourlyRate',$baseHourlyRate,'baseHours',$baseHours, 'grossWithoutPaidLeave:', $grossWithoutPaidLeave, 'gross:', $gross, 'net', $net);

        if ($net < 0) {
            $net = 0;
            return $net;
        } else
        return $net;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function leaveRequests()
    {
        return $this->belongsToMany(LeaveRequest::class, 'leave_request_payroll');
    }
}

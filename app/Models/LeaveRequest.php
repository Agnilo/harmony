<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    protected $table = 'leave_requests';

    protected $fillable = [
        'leaveRequest_name',
        'leave_type',
        'reason',
        'start_date',
        'end_date',
        'days',
        'remarks',
        'approval_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payrolls()
    {
        return $this->belongsToMany(Payroll::class, 'leave_request_payroll');
    }
}

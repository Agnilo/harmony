<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $fillable = [
        'user_id',
        'year',
        'month',
        'paid_leave',
        'unpaid_leave',
        'work_hours',
        'work_days',
        'leave_hours',
        'overtime',
        'gross',
        'net',
        'info',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($payroll) {
            
            $payroll->year = $payroll->year ?: now()->year;
            $payroll->month = $payroll->month ?: now()->month;
        });
    }

    protected $table = 'payroll';

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function leaveRequests()
    {
        return $this->belongsToMany(LeaveRequest::class, 'leave_request_payroll');
    }
}

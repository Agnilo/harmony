<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    protected $fillable = [
        'leaveRequest_name',
        'leave_type',
        'reason',
        'start_date',
        'end_date',
        'days',
        'remarks',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

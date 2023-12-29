<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeBenefits extends Model
{
    public function benefits()
    {
        return $this->hasMany(Employee::class);
    }
}

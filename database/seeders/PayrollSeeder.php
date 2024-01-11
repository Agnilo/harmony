<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Payroll;

class PayrollSeeder extends Seeder
{
    public function run()
    {

        $users = User::all();

        foreach ($users as $user) {
            Payroll::create([
                'user_id' => $user->id,
                'year' => now()->year, 
                'month' => now()->month, 
                'work_hours' => 0, 
                'work_days' => 0,
                'leave_hours' => 0,
                'overtime' => 0,
                'gross' => 0,
                'net' => 0,
                'info' => 'Darbo užmokestis: ' . $user->id,
            ]);
        }
    }
}
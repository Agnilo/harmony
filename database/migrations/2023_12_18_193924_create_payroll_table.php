<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payroll', function (Blueprint $table) {
            $table->salaryid();
            $table->unsignedBigInteger('user_id');
            $table->integer('year');
            $table->integer('month');
            $table->decimal('paid_leave', 3,1)->default(0.0);
            $table->decimal('unpaid_leave', 3,1)->default(0.0);
            $table->decimal('work_hours', 3,1)->default(0.0);
            $table->integet('work_days', 1)->default(0);
            $table->decimal('leave_hours', 3,1)->default(0.0);
            $table->decimal('overtime', 3,1)->default(0.0);
            $table->decimal('gross', 10, 2)->default(0.00);
            $table->decimal('net', 10, 2)->default(0.00);
            $table->string('info');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll');
    }
};

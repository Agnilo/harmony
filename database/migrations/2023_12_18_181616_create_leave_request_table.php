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
        Schema::create('leave_request', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('leave_type');
            $table->string('reason')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('days');
            $table->string('file_upload')->nullable();
            $table->string('remarks')->nullable();
            $table->string('approval_status')->default('prašymas neperžiūrėtas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_request');
    }
};

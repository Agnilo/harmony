<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('leave_request', 'leave_requests');

        Schema::table('users', function (Blueprint $table) {
            $table->integer('vacation_days')->default(25); // Adjust the default value as needed
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('leave_requests', 'leave_request');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('vacation_days');
        });
    }
};
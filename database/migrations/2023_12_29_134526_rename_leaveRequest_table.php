<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameLeaveRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('leave_requests', 'leaveRequest');

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
        Schema::rename('leaveRequest', 'leave_requests');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('vacation_days');
        });
    }
};
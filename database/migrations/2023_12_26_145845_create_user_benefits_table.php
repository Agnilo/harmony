<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up():void
    {
        Schema::create('user_benefits', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('benefits_id');
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('benefits_id')->references('id')->on('benefits')->onDelete('cascade');

            // Primary key
            $table->primary(['user_id', 'benefits_id']);
        });
    }

    public function down():void
    {
        Schema::dropIfExists('user_benefits');
    }
};

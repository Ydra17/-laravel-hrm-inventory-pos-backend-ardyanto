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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            //month
            $table->integer('month');
            //year
            $table->integer('year');
            //basic_salary
            $table->decimal('basic_salary', 10, 2);
            //net salary
            $table->decimal('net_salary', 10, 2);
            //total days
            $table->integer('total_days');
            //working days
            $table->integer('working_days');
            //present days
            $table->integer('present_days');
            //total office time
            $table->integer('total_office_time');
            //total worked time
            $table->integer('total_worked_time');
            //half day
            $table->integer('half_day');
            //late days
            $table->integer('late_days');
            //paid leaves
            $table->integer('paid_leaves');
            //unpaid leaves
            $table->integer('unpaid_leaves');
            //holiday count
            $table->integer('holiday_count');
            //payment date
            $table->date('payment_date')->nullable();
            //status
            $table->string('status')->default('generated');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};

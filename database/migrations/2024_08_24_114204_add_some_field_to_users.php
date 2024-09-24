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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->after('id');
            $table->unsignedBigInteger('company_id')->after('username');
            $table->boolean('is_superadmin')->default(false)->after('company_id');
            $table->unsignedBigInteger('role_id')->after('is_superadmin');
            $table->string('user_type')->after('role_id')->default('employee');
            $table->boolean('login_enabled')->default(true)->after('user_type');
            $table->string('profile_image')->nullable()->after('login_enabled');
            $table->string('status')->default('enable')->after('profile_image');
            $table->string('phone')->nullable()->after('status');
            $table->text('address')->nullable()->after('phone');
            $table->unsignedBigInteger('department_id')->nullable()->after('address');
            $table->unsignedBigInteger('designation_id')->nullable()->after('department_id');
            $table->unsignedBigInteger('shift_id')->nullable()->after('designation_id');

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('designation_id')->references('id')->on('designations')->onDelete('cascade');
            $table->foreign('shift_id')->references('id')->on('shifts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};

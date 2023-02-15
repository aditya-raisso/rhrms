<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('emp_id',50)->unique()->nullable();
            $table->string('first_name',50)->nullable();
            $table->string('last_name',50)->nullable();
            $table->string('middle_name',50)->nullable();
            $table->string('gender',50)->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('mobile_number',15)->nullable();
            $table->string('report_to')->nullable();
            $table->string('department',100)->nullable();
            $table->string('designation',100)->nullable();
            $table->date('start_date')->comment('Joining Date')->nullable();
            $table->date('end_date')->comment('Resignation Date')->nullable();
            $table->longText('reason_for_resignation',100)->comment('reason_for_resignation')->nullable();
            $table->string('working_type')->nullable();
            $table->string('shift_timing')->nullable();
            $table->integer('marital_status')->default(0)
            ->comment('0 is Not married 1 is married')->nullable();
            $table->string('country',100)->nullable();
            $table->string('state',100)->nullable();
            $table->string('city',100)->nullable();
            $table->string('salary_type',100)->nullable();
            $table->integer('pincode')->nullable();
            $table->longText('current_address')->nullable();
           
            $table->unsignedBigInteger('employment_category_id');
            $table->foreign('employment_category_id')->references('id')->on('employee_categories');
            $table->string('employment_type')->nullable();

              $table->longText('permanent_address')->nullable();
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->string('type',100)->comment('employee type')->nullable();
            $table->string('account_status')->default(0)->comment('0 is inactive 1 is active');
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

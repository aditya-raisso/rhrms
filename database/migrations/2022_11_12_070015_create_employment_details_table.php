<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employment_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('job_title')->nullable();
            $table->string('company_name')->nullable();
            $table->string('location')->nullable();
            $table->longText('describer_work_here')->nullable();
            $table->string('currently_work_here')->default(0)->comment('1 is working now 0 is not');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
           
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
        Schema::dropIfExists('employment_details');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeliveryManagerRecruiterLeadRecruiterAccountManagerBdmVpToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('assign_delivery_manager')->nullable();
            $table->integer('assign_recruiter_lead')->nullable();
            $table->integer('assign_recruiter')->nullable();
            $table->integer('assign_account_manager')->nullable();
            $table->integer('assign_bdm')->nullable();
            $table->integer('assign_vp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
        Schema::dropIfExists('assign_delivery_manager');
        Schema::dropIfExists('assign_recruiter_lead');
        Schema::dropIfExists('assign_recruiter');
        Schema::dropIfExists('assign_account_manager');
        Schema::dropIfExists('assign_bdm');
        Schema::dropIfExists('assign_vp');
        //
        });
    }
}

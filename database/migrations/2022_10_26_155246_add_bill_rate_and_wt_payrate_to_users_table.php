<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBillRateAndWtPayrateToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('bill_rate')->nullable();
            $table->string('vendor_cost_id')->comment('vms_cost')->nullable();
            $table->string('wt_payrate')->comment('w2 payrate')->nullable();
             $table->string('net_margin')->comment('net_margin')->nullable();
            
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
            Schema::dropIfExists('bill_rate');
            Schema::dropIfExists('vendor_cost_id');
             Schema::dropIfExists('wt_payrate');
             Schema::dropIfExists('net_margin');
        });
    }
}

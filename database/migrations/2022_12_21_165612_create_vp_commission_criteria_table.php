<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVpCommissionCriteriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vp_commission_criterias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('from_net_margin')->nullable();
            $table->string('to_net_margin')->nullable();
            $table->string('percent')->nullable();
            
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
        Schema::dropIfExists('vp_commission_criteria');
    }
}

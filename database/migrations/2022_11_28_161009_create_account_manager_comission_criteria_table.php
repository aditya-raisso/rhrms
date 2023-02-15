<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountManagerComissionCriteriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_manager_comission_criteria', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('from_net_margin_per');
            $table->string('to_net_margin_per');
            $table->string('monthly_from_net_margin');
            $table->string('monthly_to_net_margin');
            $table->string('monthly_commission');
            
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
        Schema::dropIfExists('account_manager_comission_criteria');
    }
}

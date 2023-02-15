<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBDMCommissionCriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bdm_commission_criterias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('from_net_margin_per')->nullable();
            $table->string('to_net_margin_per')->nullable();
            $table->string('monthly_from_net_margin')->nullable();
            $table->string('monthly_to_net_margin')->nullable();
            $table->string('monthly_commission')->nullable();
            $table->integer('type')->default(0)->comment('0 is direct commission 1 is indirect commission');
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
        Schema::dropIfExists('b_d_m_commission_criterias');
    }
}

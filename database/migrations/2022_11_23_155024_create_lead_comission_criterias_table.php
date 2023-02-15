<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadComissionCriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_comission_criterias', function (Blueprint $table) {
             $table->bigIncrements('id');
            $table->string('from_net_margin');
            $table->string('to_net_margin');
            $table->string('from_slab');
            $table->string('to_slab');
            $table->string('comission_amount');
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
        Schema::dropIfExists('lead_comission_criterias');
    }
}

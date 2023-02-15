<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionCriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commission_criterias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('from_net_margin')->default(0);
            $table->string('to_net_margin')->default(0);
            $table->integer('commission')->default(0)->comment('% commission');
            
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
        Schema::dropIfExists('commission_criterias');
    }
}

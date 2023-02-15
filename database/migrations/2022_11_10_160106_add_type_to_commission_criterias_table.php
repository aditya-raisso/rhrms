<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToCommissionCriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commission_criterias', function (Blueprint $table) {
              $table->string('criteria_type')->comment('role type')->after('commission');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commission_criterias', function (Blueprint $table) {
            
         Schema::dropIfExists('criteria_type');
        });
    }
}

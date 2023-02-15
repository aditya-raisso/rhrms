<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBloodGroupAndMarriageDateAndDobAndEmergencyContactToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('blood_group')->nullable();
            $table->string('dob')->nullable();
            $table->string('married_date')->after('marital_status')->nullable();
            $table->string('emergency_contact')->nullable();
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
            Schema::dropIfExists('dob');
            Schema::dropIfExists('married_date');
            Schema::dropIfExists('emergency_contact');
             Schema::dropIfExists('blood_group');
        });
    }
}

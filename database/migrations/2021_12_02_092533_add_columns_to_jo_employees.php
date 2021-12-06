<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToJoEmployees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hr_jo_employees', function (Blueprint $table) {
            $table->string('name_ext')->nullable(true);
            $table->string('sex')->nullable(true);
            $table->date('birthday')->nullable(true);
            $table->string('civil_status')->nullable(true);
            $table->string('address_province')->nullable(true);
            $table->string('address_city')->nullable(true);
            $table->string('address_brgy')->nullable(true);
            $table->string('address_detailed')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hr_jo_employees', function (Blueprint $table) {
            $table->dropColumn(['name_ext','sex','birthday','address_province','address_city','address_brgy','address_detailed','civil_status']);
        });
    }
}

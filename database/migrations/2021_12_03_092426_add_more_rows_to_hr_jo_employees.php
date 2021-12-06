<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreRowsToHrJoEmployees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hr_jo_employees', function (Blueprint $table) {
            $table->string('email')->nullable(true);
            $table->string('phone')->nullable(true);
            $table->string('department_unit')->nullable(true);
            $table->string('position')->nullable(true);
            $table->string('user_created')->nullable(true);
            $table->string('user_updated')->nullable(true);
            $table->string('ip_created')->nullable(true);
            $table->string('ip_updated')->nullable(true);
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
            $table->dropColumn(['email','phone','department_unit','position','user_created','user_updated','ip_created','ip_updated']);
        });
    }
}

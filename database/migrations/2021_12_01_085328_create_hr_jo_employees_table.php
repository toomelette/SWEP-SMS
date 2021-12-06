<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrJoEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_jo_employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_no');
            $table->string('firstname');
            $table->string('middlename')->nullable(true);
            $table->string('lastname');
            $table->string('biometric_user_id');
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
        Schema::dropIfExists('hr_jo_employees');
    }
}

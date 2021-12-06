<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHrDailyTimeRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_daily_time_records',function (Blueprint $table){
            $table->increments('id');
            $table->string('employee_no');
            $table->string('biometric_user_id');
            $table->string('biometric_uid');
            $table->date('date')->nullable(true);
            $table->time('am_in')->nullable(true);
            $table->time('am_out')->nullable(true);
            $table->time('pm_in')->nullable(true);
            $table->time('pm_out')->nullable(true);
            $table->time('ot_in')->nullable(true);
            $table->time('ot_out')->nullable(true);
            $table->integer('late')->nullable(true);
            $table->integer('undertime')->nullable(true);
            $table->integer('calculated')->nullable(true);
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
        Schema::dropIfExists('hr_daily_time_records');
    }
}

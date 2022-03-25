<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUptoDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hr_employee_service_records', function (Blueprint $table) {
            $table->integer('upto_date')->nullable(true);
        });

        DB::statement('ALTER TABLE `swep_afd`.`hr_employee_service_records` 
        CHANGE COLUMN `upto_date` `upto_date` INT NULL DEFAULT NULL AFTER `to_date`;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hr_employee_service_records', function (Blueprint $table) {
            $table->dropColumn('upto_date');
        });
    }
}

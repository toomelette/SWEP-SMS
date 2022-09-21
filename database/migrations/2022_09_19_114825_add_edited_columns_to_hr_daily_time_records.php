<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEditedColumnsToHrDailyTimeRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hr_daily_time_records', function (Blueprint $table) {
            DB::statement('ALTER TABLE `swep_afd`.`hr_daily_time_records` 
            ADD COLUMN `am_in_e` VARCHAR(45) NULL AFTER `updated_at`,
            ADD COLUMN `am_out_e` VARCHAR(45) NULL AFTER `am_in_e`,
            ADD COLUMN `pm_in_e` VARCHAR(45) NULL AFTER `am_out_e`,
            ADD COLUMN `pm_out_e` VARCHAR(45) NULL AFTER `pm_in_e`;
            ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hr_daily_time_records', function (Blueprint $table) {
            $table->removeColumn('am_in_e');
            $table->removeColumn('am_out_e');
            $table->removeColumn('pm_in_e');
            $table->removeColumn('pm_out_e');
        });
    }
}

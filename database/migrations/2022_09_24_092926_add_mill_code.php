<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMillCode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('weekly_reports', function (Blueprint $table) {
            DB::statement('ALTER TABLE `swep_sms`.`weekly_reports` 
            ADD COLUMN `mill_code` VARCHAR(45) NULL AFTER `slug`,
            ADD COLUMN `report_type` VARCHAR(45) NULL AFTER `mill_code`;');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weekly_reports', function (Blueprint $table) {
            $table->dropColumn('mill_code','report_type');
        });
    }
}

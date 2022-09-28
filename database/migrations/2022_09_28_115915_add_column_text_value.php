<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTextValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `swep_sms`.`weekly_reports_details` 
            ADD COLUMN `text_value` VARCHAR(255) NULL AFTER `prev_value`;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weekly_reports_details', function (Blueprint $table) {
            $table->dropColumn('text_value');
        });
    }
}

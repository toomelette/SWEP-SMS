<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Aaa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `swep_afd`.`hr_dtr_edits` 
            DROP COLUMN `time`,
            ADD COLUMN `am_in` TIME NULL AFTER `biometric_user_id`,
            ADD COLUMN `am_out` TIME NULL AFTER `am_in`,
            ADD COLUMN `pm_in` TIME NULL AFTER `am_out`,
            ADD COLUMN `pm_out` TIME NULL AFTER `pm_in`,
            CHANGE COLUMN `user_updated` `user_updated` VARCHAR(255) NULL ;
            ');
        Schema::table('hr_dtr_edits', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hr_dtr_edits', function (Blueprint $table) {
            //
        });
    }
}

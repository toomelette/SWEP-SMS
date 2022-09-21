<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Aaaaa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `swep_afd`.`hr_dtr_edits` 
            DROP COLUMN `pm_out`,
            DROP COLUMN `pm_in`,
            DROP COLUMN `am_out`,
            DROP COLUMN `am_in`,
            ADD COLUMN `time` VARCHAR(45) NULL AFTER `biometric_user_id`,
            ADD COLUMN `type` VARCHAR(45) NULL AFTER `time`;
            ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

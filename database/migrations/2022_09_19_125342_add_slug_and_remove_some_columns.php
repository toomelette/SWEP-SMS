<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugAndRemoveSomeColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `swep_afd`.`hr_daily_time_records` 
        DROP COLUMN `pm_out_e`,
        DROP COLUMN `pm_in_e`,
        DROP COLUMN `am_out_e`,
        DROP COLUMN `am_in_e`,
        ADD COLUMN `slug` VARCHAR(45) NULL AFTER `id`;
        ');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hr_daily_time_records', function (Blueprint $table) {
            $table->removeColumn('slug');
        });
    }
}

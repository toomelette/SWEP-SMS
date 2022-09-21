<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Aaaa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `swep_afd`.`hr_dtr_edits` 
        ADD COLUMN `dtr_slug` VARCHAR(45) NULL AFTER `slug`;
        ');
        Schema::table('hr_dtr_edits', function (Blueprint $table) {

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
            $table->removeColumn('dtr_slug');
        });
    }
}

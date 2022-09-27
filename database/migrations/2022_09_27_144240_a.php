<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class A extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `swep_sms`.`form5_deliveries` 
        ADD COLUMN `qty_prev` DECIMAL(20,3) NULL AFTER `qty`;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form5_deliveries',function (Blueprint $table){
            $table->dropColumn('qty_prev');
        });
    }
}

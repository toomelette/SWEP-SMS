<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RearrangePpmp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE `swep_afd`.`ppu_ppmp` 
            CHANGE COLUMN `slug` `slug` VARCHAR(50) NOT NULL AFTER `id`,
            CHANGE COLUMN `ppmp_code` `ppmp_code` VARCHAR(50) NOT NULL AFTER `slug`,
            CHANGE COLUMN `budget_type` `budget_type` VARCHAR(10) NOT NULL AFTER `pap_code`,
            CHANGE COLUMN `qty_may` `qty_may` INT NOT NULL AFTER `qty_apr`;
            ');

        \Illuminate\Support\Facades\DB::statement('ALTER TABLE `swep_afd`.`ppu_ppmp` 
            CHANGE COLUMN `qty_jan` `qty_jan` INT NULL ,
            CHANGE COLUMN `qty_feb` `qty_feb` INT NULL ,
            CHANGE COLUMN `qty_mar` `qty_mar` INT NULL ,
            CHANGE COLUMN `qty_apr` `qty_apr` INT NULL ,
            CHANGE COLUMN `qty_may` `qty_may` INT NULL ,
            CHANGE COLUMN `qty_jun` `qty_jun` INT NULL ,
            CHANGE COLUMN `qty_jul` `qty_jul` INT NULL ,
            CHANGE COLUMN `qty_aug` `qty_aug` INT NULL ,
            CHANGE COLUMN `qty_sep` `qty_sep` INT NULL ,
            CHANGE COLUMN `qty_oct` `qty_oct` INT NULL ,
            CHANGE COLUMN `qty_nov` `qty_nov` INT NULL ,
            CHANGE COLUMN `qty_dec` `qty_dec` INT NULL ,
            CHANGE COLUMN `remark` `remark` VARCHAR(255) NULL ;
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

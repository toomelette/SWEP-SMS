<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMolassesWeeklyReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('molasses_weekly_report', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('crop_year');
            $table->string('mill_code');
            $table->date('week_ending');
            $table->decimal('manufactured_raw');
            $table->decimal('retention_adjustment_overages');
            $table->decimal('manufactured_refined');
            $table->decimal('planters_share');
            $table->decimal('mill_share');
            $table->decimal('refinery_molasses');
            $table->decimal('wd_raw_export');
            $table->decimal('wd_raw_domestic');
            $table->decimal('wd_raw_distillery');
            $table->decimal('wd_raw_others');
            $table->decimal('wd_refined_export');
            $table->decimal('wd_refined_domestic');
            $table->decimal('wd_refined_distillery');
            $table->decimal('wd_refined_others');
            $table->decimal('balance_raw');
            $table->decimal('balance_refined');
            $table->decimal('price_raw');
            $table->decimal('price_refined');
            $table->decimal('msc_raw');
            $table->decimal('msc_refined');
            $table->decimal('molasses_distribution_factor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('molasses_weekly_report');
    }
}

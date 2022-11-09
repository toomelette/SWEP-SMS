<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('weekly_reports_series_pcs');
        Schema::create('sms_series', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->string('weekly_report_slug')->nullable();
            $table->string('sugarClass')->nullable();
            $table->string('seriesFrom')->nullable();
            $table->string('seriesTo')->nullable();
            $table->integer('noOfPcs')->nullable();
            $table->string('type')->nullable();
            $table->string('sugarType')->nullable();
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
        Schema::dropIfExists('sms_series');
    }
}

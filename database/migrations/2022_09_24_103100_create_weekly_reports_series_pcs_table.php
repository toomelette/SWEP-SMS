<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeeklyReportsSeriesPcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weekly_reports_series_pcs', function (Blueprint $table) {
            $table->id();
            $table->string('weekly_report_slug');
            $table->string('input_field');
            $table->integer('series_from');
            $table->integer('series_to');
            $table->integer('no_of_pcs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weekly_reports_series_pcs');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeeklyReportsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weekly_reports_details', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('input_field');
            $table->decimal('current_value',20,3);
            $table->decimal('prev_value',20,3)->nullable();
            $table->string('weekly_report_slug');
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
        Schema::dropIfExists('weekly_reports_details');
    }
}

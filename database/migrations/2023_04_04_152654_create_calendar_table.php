<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('calendar')){
            Schema::create('calendar', function (Blueprint $table) {
                $table->id();
                $table->string('slug')->nullable();
                $table->integer('report_no')->nullable();
                $table->date('week_ending')->nullable();
                $table->string('crop_year')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendar');
    }
}

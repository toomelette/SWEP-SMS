<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForm5ServedSrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form5_served_sros', function (Blueprint $table) {
            $table->id();
            $table->string('weekly_report_slug')->nullable();
            $table->string('slug')->nullable();
            $table->string('sro_no')->nullable();
            $table->string('cea')->nullable();
            $table->string('permit_portion')->nullable();
            $table->string('user_created')->nullable();
            $table->string('user_updated')->nullable();
            $table->string('ip_created')->nullable();
            $table->string('ip_updated')->nullable();
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
        Schema::dropIfExists('form5_served_sros');
    }
}

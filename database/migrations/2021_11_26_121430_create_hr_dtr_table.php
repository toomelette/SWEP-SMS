<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrDtrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_dtr', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid');
            $table->integer('user');
            $table->integer('state');
            $table->integer('type');
            $table->dateTime('timestamp');
            $table->string('ip');
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
        Schema::dropIfExists('hr_dtr');
    }
}

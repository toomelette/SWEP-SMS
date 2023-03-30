<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePriceMonitoring extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_market', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->string('store')->nullable();
            $table->string('geog_loc')->nullable();
            $table->decimal('retail_raw',20,3)->nullable();
            $table->decimal('retail_refined',20,3)->nullable();
            $table->decimal('wholesale_raw',20,3)->nullable();
            $table->decimal('wholesale_refined',20,3)->nullable();
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
        Schema::dropIfExists('price_market');
    }
}

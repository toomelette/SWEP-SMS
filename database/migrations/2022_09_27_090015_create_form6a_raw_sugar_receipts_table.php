<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForm6aRawSugarReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form6a_raw_sugar_receipts', function (Blueprint $table) {
            $table->id();
            $table->string('weekly_report_slug')->nullable();
            $table->string('slug')->nullable();
            $table->string('delivery_no')->nullable();
            $table->string('trader')->nullable();
            $table->string('mill_source')->nullable();
            $table->string('raw_sro_sn')->nullable();
            $table->string('liens_or')->nullable();
            $table->decimal('qty')->nullable();
            $table->decimal('refined_sugar_equivalent')->nullable();
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
        Schema::dropIfExists('form6a_raw_sugar_receipts');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInputFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('input_fields', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('report_type');
            $table->string('field');
            $table->string('parent');
            $table->integer('is_end_node');
            $table->string('sorting');
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
        Schema::dropIfExists('input_fields');
    }
}

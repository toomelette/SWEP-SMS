<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForm5IssuancesOfSroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form5_issuances_of_sro', function (Blueprint $table) {
            $table->id();
            $table->string('weekly_report_slug')->nullable();
            $table->string('slug')->nullable();
            $table->string('sro_no')->nullable();
            $table->string('trader')->nullable();
            $table->string('cea')->nullable();
            $table->date('date_of_issue')->nullable();
            $table->string('liens_or')->nullable();
            $table->string('sugar_class')->nullable();
            $table->decimal('qty',20,3)->nullable();
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
        Schema::dropIfExists('form5_issuances_of_sro');
    }
}

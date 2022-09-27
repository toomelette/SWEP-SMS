<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForm5aIssuancesOfSroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form5a_issuances_of_sro', function (Blueprint $table) {
            $table->id();
            $table->string('weekly_report_slug')->nullable();
            $table->string('slug')->nullable();
            $table->date('date_of_issue')->nullable();
            $table->string('sro_no')->nullable();
            $table->string('trader')->nullable();
            $table->decimal('raw_qty',20,2)->nullable();
            $table->string('monitoring_fee_or_no')->nullable();
            $table->string('rsq_no')->nullable();
            $table->decimal('refined_qty',20,2)->nullable();
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
        Schema::dropIfExists('form5a_issuances_of_sro');
    }
}

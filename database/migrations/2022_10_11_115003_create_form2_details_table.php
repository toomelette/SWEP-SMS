<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForm2DetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form2_details', function (Blueprint $table) {
            $table->id();
            $table->string('weekly_report_slug');
            $table->decimal('carryOver',20,3)->nullable();
            $table->decimal('coveredBySro',20,3)->nullable();
            $table->decimal('notCoveredBySro',20,3)->nullable();
            $table->decimal('otherMills',20,3)->nullable();
            $table->decimal('imported',20,3)->nullable();
            $table->decimal('melted',20,3)->nullable();
            $table->decimal('rawWithdrawals',20,3)->nullable();
            $table->decimal('prodDomestic',20,3)->nullable();
            $table->decimal('prodImported',20,3)->nullable();
            $table->decimal('prodReturn',20,3)->nullable();

            $table->decimal('prev_carryOver',20,3)->nullable();
            $table->decimal('prev_coveredBySro',20,3)->nullable();
            $table->decimal('prev_notCoveredBySro',20,3)->nullable();
            $table->decimal('prev_otherMills',20,3)->nullable();
            $table->decimal('prev_imported',20,3)->nullable();
            $table->decimal('prev_melted',20,3)->nullable();
            $table->decimal('prev_rawWithdrawals',20,3)->nullable();
            $table->decimal('prev_prodDomestic',20,3)->nullable();
            $table->decimal('prev_prodImported',20,3)->nullable();
            $table->decimal('prev_prodReturn',20,3)->nullable();

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
        Schema::dropIfExists('form2_details');
    }
}

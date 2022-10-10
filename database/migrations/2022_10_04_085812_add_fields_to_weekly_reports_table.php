<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToWeeklyReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form1_details', function (Blueprint $table) {
            $table->id();
            $table->string('weekly_report_slug');
            $table->decimal('manufactured',20,3)->nullable();
            $table->decimal('A',20,3)->nullable();
            $table->decimal('B',20,3)->nullable();
            $table->decimal('C',20,3)->nullable();
            $table->decimal('C1',20,3)->nullable();
            $table->decimal('D',20,3)->nullable();
            $table->decimal('DX',20,3)->nullable();
            $table->decimal('DE',20,3)->nullable();
            $table->decimal('DR',20,3)->nullable();
            $table->decimal('total_issuance',20,3)->nullable();

            $table->decimal('prev_manufactured',20,3)->nullable();
            $table->decimal('prev_A',20,3)->nullable();
            $table->decimal('prev_B',20,3)->nullable();
            $table->decimal('prev_C',20,3)->nullable();
            $table->decimal('prev_C1',20,3)->nullable();
            $table->decimal('prev_D',20,3)->nullable();
            $table->decimal('prev_DX',20,3)->nullable();
            $table->decimal('prev_DE',20,3)->nullable();
            $table->decimal('prev_DR',20,3)->nullable();
            $table->decimal('prev_total_issuance',20,3)->nullable();

            $table->decimal('tdc',20,3)->nullable();
            $table->decimal('gtcm',20,3)->nullable();
            $table->decimal('lkgtc_gross',20,3)->nullable();
            $table->decimal('share_planter',20,3)->nullable();
            $table->decimal('share_miller',20,3)->nullable();


            $table->decimal('price_A',20,3)->nullable();
            $table->decimal('price_B',20,3)->nullable();
            $table->decimal('price_C',20,3)->nullable();
            $table->decimal('price_C1',20,3)->nullable();
            $table->decimal('price_D',20,3)->nullable();
            $table->decimal('price_DX',20,3)->nullable();
            $table->decimal('price_DE',20,3)->nullable();
            $table->decimal('price_DR',20,3)->nullable();

            $table->decimal('wholesale_raw',20,3)->nullable();
            $table->decimal('wholesale_refined',20,3)->nullable();
            $table->decimal('retail_raw',20,3)->nullable();
            $table->decimal('retail_refined',20,3)->nullable();
            $table->decimal('dist_factor',20,10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form1_details');
    }
}

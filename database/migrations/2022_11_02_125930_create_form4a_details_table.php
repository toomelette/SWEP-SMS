<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForm4aDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form4_details', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->string('weekly_report_slug')->nullable();
            $table->decimal('carryOver',20,3)->nullable();
            $table->decimal('receipts',20,3)->nullable();
            $table->decimal('withdrawals',20,3)->nullable();
            $table->decimal('transferToRefinery',20,3)->nullable();

            $table->decimal('prev_carryOver',20,3)->nullable();
            $table->decimal('prev_receipts',20,3)->nullable();
            $table->decimal('prev_withdrawals',20,3)->nullable();
            $table->decimal('prev_transferToRefinery',20,3)->nullable();
            $table->timestamps();
        });

        Schema::create('sms_subsidiaries',function (Blueprint $table){
            $table->id();
            $table->string('slug')->nullable();
            $table->string('weekly_report_slug')->nullable();
            $table->string('sugarType')->nullable();
            $table->string('transactionType')->nullable();
            $table->string('warehouseAlias')->nullable();
            $table->decimal('current',20,3)->nullable();
            $table->decimal('prev',20,3)->nullable();
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
        Schema::dropIfExists('form4_details');
        Schema::dropIfExists('sms_subsidiaries');
    }
}

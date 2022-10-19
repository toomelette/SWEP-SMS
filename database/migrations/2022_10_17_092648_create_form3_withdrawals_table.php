<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForm3WithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form3_withdrawals', function (Blueprint $table) {
            $table->id();
            $table->string('weekly_report_slug')->nullable();
            $table->string('slug')->nullable();
            $table->date('date')->nullable();
            $table->string('mro_no')->nullable();
            $table->string('trader')->nullable();
            $table->decimal('qty',20,3)->nullable();
            $table->decimal('qty_prev',20,3)->nullable();
            $table->decimal('qty_current',20,3)->nullable();
            $table->string('withdrawal_type')->nullable();
            $table->string('sugar_type')->nullable();
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
        Schema::dropIfExists('form3_withdrawals');
    }
}

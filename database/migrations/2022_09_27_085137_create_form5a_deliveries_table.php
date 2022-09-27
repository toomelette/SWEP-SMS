<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForm5aDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form5a_deliveries', function (Blueprint $table) {
            $table->id();
            $table->string('weekly_report_slug')->nullable();
            $table->string('slug')->nullable();
            $table->date('date_of_withdrawal')->nullable();
            $table->string('sro_no')->nullable();
            $table->string('trader')->nullable();
            $table->decimal('qty_standard',20,2)->nullable();
            $table->decimal('qty_premium',20,2)->nullable();
            $table->decimal('qty_total',20,2)->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('form5a_deliveries');
    }
}

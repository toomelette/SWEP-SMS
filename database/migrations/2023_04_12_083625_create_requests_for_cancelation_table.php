<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsForCancelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('requests_for_cancellation')){
            Schema::create('requests_for_cancellation', function (Blueprint $table) {
                $table->id();
                $table->string('weekly_report_slug')->nullable();
                $table->dateTime('cancelled_at')->nullable();
                $table->string('cancelled_by')->nullable();
                $table->dateTime('approved_at')->nullable();
                $table->string('approved_by')->nullable();
            });
        }

        if(!Schema::hasTable('report_status')){
            Schema::create('report_status',function (Blueprint $table){
                $table->id();
                $table->string('weekly_report_slug')->nullable();
                $table->integer('status')->nullable();
                $table->string('status_text')->nullable();
                $table->string('status_details')->nullable();
                $table->string('user_created')->nullable();
                $table->string('user_updated')->nullable();
                $table->string('ip_created')->nullable();
                $table->string('ip_updated')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests_for_cancellation');
        Schema::dropIfExists('report_status');
    }
}

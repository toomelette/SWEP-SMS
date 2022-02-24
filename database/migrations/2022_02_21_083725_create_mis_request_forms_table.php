<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMisRequestFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mis_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('request_no');
            $table->string('requisitioner');
            $table->string('nature_of_request');
            $table->string('request_details')->nullable(true);
            $table->string('summary_of_diagnostics')->nullable(true);
            $table->string('recommendations')->nullable(true);
            $table->string('returned')->nullable(true);
            $table->date('date_returned')->nullable(true);
            $table->string('user_created')->nullable(true);
            $table->string('user_updated')->nullable(true);
            $table->string('ip_created')->nullable(true);
            $table->string('ip_updated')->nullable(true);
            $table->timestamps();
        });

    }

    /**we
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mis_requests');
    }
}

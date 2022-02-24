<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMisRequestsStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mis_requests_status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('request_slug');
            $table->string('status');
            $table->string('user_created');
            $table->string('ip_created');
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
        Schema::dropIfExists('mis_requests_status');
    }
}

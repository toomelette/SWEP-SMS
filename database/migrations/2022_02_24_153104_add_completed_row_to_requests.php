<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompletedRowToRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mis_requests', function (Blueprint $table) {
            $table->dateTime('completed_at')->nullable(true);
            $table->string('user_completed')->nullable(true);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mis_requests', function (Blueprint $table) {
            $table->dropColumn(['completed_at','user_completed']);
        });
    }
}

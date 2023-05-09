<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFilenameOn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requests_for_cancellation', function (Blueprint $table) {
            $table->dropColumn('approved_by','approved_at');
            $table->string('slug')->after('id')->nullable();
            $table->string('filename')->nullable();
            $table->string('full_path')->nullable();
            $table->longText('reason')->nullable();
            $table->string('action')->nullable();
            $table->string('action_by')->nullable();
            $table->dateTime('action_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requests_for_cancellation', function (Blueprint $table) {
            $table->dropColumn('filename','full_path','slug','reason');
        });
    }
}

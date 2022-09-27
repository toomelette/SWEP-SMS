<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRefiningToForm5IssuancesOfSroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form5_issuances_of_sro', function (Blueprint $table) {
            $table->integer('refining')->nullable();
        });
        Schema::table('form5_deliveries', function (Blueprint $table) {
            $table->integer('refining')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form5_issuances_of_sro', function (Blueprint $table) {
            $table->dropColumn('refining');
        });
        Schema::table('form5_deliveries', function (Blueprint $table) {
            $table->dropColumn('refining');
        });
    }
}

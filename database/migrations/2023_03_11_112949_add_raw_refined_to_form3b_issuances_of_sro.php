<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRawRefinedToForm3bIssuancesOfSro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form3b_issuances_of_sro', function (Blueprint $table) {
            $table->string('type')->nullable()->after('qty_prev');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form3b_issuances_of_sro', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}

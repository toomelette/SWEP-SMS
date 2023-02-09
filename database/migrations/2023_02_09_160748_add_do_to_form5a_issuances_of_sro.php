<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDoToForm5aIssuancesOfSro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form5a_issuances_of_sro', function (Blueprint $table) {
            $table->string('delivery_no')->after('liens_or')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form5a_issuances_of_sro', function (Blueprint $table) {
            $table->dropColumn('delivery_no');
        });
    }
}

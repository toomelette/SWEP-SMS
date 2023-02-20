<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColToForm5aIssuancesOfSro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form5a_issuances_of_sro', function (Blueprint $table) {
            $table->string('raw_sro_no')->after('date_of_issue')->nullable();
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
            $table->dropColumn('raw_sro_no');
        });
    }
}

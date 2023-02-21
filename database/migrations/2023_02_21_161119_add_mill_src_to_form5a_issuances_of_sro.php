<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMillSrcToForm5aIssuancesOfSro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form5a_issuances_of_sro', function (Blueprint $table) {
            $table->string('mill_source')->after('delivery_no')->nullable();
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
            $table->dropColumn('mill_source');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQtyPrevToForm5IssuancesOfSro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form5_issuances_of_sro', function (Blueprint $table) {
            $table->decimal('qty_prev',20,3)->nullable()->after('qty');
        });
        Schema::table('form3b_issuances_of_sro', function (Blueprint $table) {
            $table->decimal('qty_prev',20,3)->nullable()->after('qty');
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
            $table->dropColumn('qty_prev');
        });
        Schema::table('form3b_issuances_of_sro', function (Blueprint $table) {
            $table->dropColumn('qty_prev');
        });
    }
}

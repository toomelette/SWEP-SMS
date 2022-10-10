<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrev extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form5a_issuances_of_sro', function (Blueprint $table) {
            $table->decimal('prev_raw_qty',20,2)->nullable()->after('raw_qty');
            $table->decimal('prev_refined_qty',20,2)->nullable()->after('refined_qty');
            $table->string('consumption')->nullable()->after('prev_refined_qty');
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
            $table->dropColumn('prev_raw_qty','prev_refined_qty','consumption');
        });
    }
}

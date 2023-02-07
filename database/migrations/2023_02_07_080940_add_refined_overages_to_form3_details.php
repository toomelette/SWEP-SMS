<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRefinedOveragesToForm3Details extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form3_details', function (Blueprint $table) {
            $table->decimal('raoRefined',20,3)->after('manufacturedRefined')->nullable();
            $table->decimal('prev_raoRefined',20,3)->after('prev_manufacturedRefined')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form3_details', function (Blueprint $table) {
            $table->dropColumn('raoRefined','prev_raoRefined');
        });
    }
}

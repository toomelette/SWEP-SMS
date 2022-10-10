<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForSwapping extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form5_deliveries', function (Blueprint $table) {
            $table->string('for_swapping')->nullable()->after('sugar_class');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form5_deliveries', function (Blueprint $table) {
            $table->dropColumn('for_swapping');
        });
    }
}

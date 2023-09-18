<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form3_details', function (Blueprint $table) {
            $table->decimal('prev_notCoveredByMsc',20,3)->after('prev_refineryMolasses')->nullable();
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
            $table->dropColumn('prev_notCoveredByMsc');
        });
    }
};

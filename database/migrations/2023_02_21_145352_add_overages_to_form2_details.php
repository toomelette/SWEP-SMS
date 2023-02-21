<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOveragesToForm2Details extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form2_details', function (Blueprint $table) {
            $table->decimal('overage')->after('prodImported')->nullable();
            $table->decimal('prev_overage')->after('prev_prodImported')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form2_details', function (Blueprint $table) {
            $table->dropColumn('overage','prev_overage');
        });
    }
}

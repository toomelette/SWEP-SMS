<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSyrupToForm1Details extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form1_details', function (Blueprint $table) {
            $table->decimal('lkgtc_gross_syrup',20,3)->after('lkgtc_gross')->nullable();
            $table->decimal('egtcm',20,3)->after('lkgtc_gross')->nullable();
            $table->decimal('tds',20,3)->after('lkgtc_gross')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form1_details', function (Blueprint $table) {
            $table->dropColumn('lkgtcGross_syrup','egtcm','tds');
        });
    }
}

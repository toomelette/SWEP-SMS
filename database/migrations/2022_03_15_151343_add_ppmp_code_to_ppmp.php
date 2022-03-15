<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPpmpCodeToPpmp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ppu_ppmp', function (Blueprint $table) {
            $table->string('ppmp_code','50');
            $table->string('slug',50);
            $table->integer('qty_may');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ppu_ppmp', function (Blueprint $table) {
            $table->dropColumn('ppmp_code','slug','qty_may');
        });
    }
}

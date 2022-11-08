<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModForm5aDeliveries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form5a_deliveries', function (Blueprint $table) {
            $table->decimal('qty_prev',20,2)->after('qty_total')->nullable();
            $table->decimal('qty_current',20,2)->after('qty_total')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form5a_deliveries', function (Blueprint $table) {
            $table->dropColumn('qty_prev','qty_current');
        });
    }
}

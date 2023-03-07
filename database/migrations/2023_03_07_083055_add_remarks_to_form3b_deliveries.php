<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRemarksToForm3bDeliveries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form3b_deliveries', function (Blueprint $table) {
            $table->string('remarks')->nullable()->after('sugar_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form3b_deliveries', function (Blueprint $table) {
            $table->dropColumn('remarks');
        });
    }
}

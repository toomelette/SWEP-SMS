<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnsAddressInHrJoEmployees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hr_jo_employees', function (Blueprint $table) {
            $table->renameColumn('address_province','province');
            $table->renameColumn('address_city','city');
            $table->renameColumn('address_brgy','brgy');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hr_jo_employees', function (Blueprint $table) {
            $table->renameColumn('province','address_province');
            $table->renameColumn('city','address_city');
            $table->renameColumn('brgy','address_brgy');
        });
    }
}

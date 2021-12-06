<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnsInHrJoEmployees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hr_jo_employees', function (Blueprint $table) {
            $table->renameColumn('first_name','firstname');
            $table->renameColumn('middle_name','middlename');
            $table->renameColumn('last_name','lastname');
            $table->renameColumn('biometric_id','biometric_user_id');
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
            $table->renameColumn('firstname','first_name');
            $table->renameColumn('middlename','middle_name');
            $table->renameColumn('lastname','last_name');
            $table->renameColumn('biometric_user_id','biometric_id');
        });
    }
}

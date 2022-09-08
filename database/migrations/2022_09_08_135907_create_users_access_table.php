<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersAccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_access', function (Blueprint $table) {
            $table->id();
            $table->string('user',45);
            $table->string('access',45);
            $table->string('for',45);
        });

        Schema::table('hr_employees',function (Blueprint $table){
            $table->removeColumn('access');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_access');
        Schema::table('hr_employees',function (Blueprint $table){
            $table->string('access');
        });
    }
}
